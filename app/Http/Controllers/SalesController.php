<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\User;
use App\Models\Order;
use App\Models\Sales;
use App\Models\Products;
use App\Models\Countries;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Notifications\AssignToEmployee;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title;

    public function __construct()
    {
        $this->title = trans('general.sales');
    }
    public function index()
    {
        $this->authorize('viewAny',Order::class);
        $title = $this->title;
        return view('sales.index', compact('title'));
    }

    public function create()
    {
        $countries = Countries::select('id','name')->pluck('name','id')->toArray();
        $title = $this->title;
        return view('sales.edit', compact('title','countries'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validate([
                'first_name'        => 'required|string|max:255',
                'last_name'         => 'required|string|max:255',
                'email'             => 'required|email|max:255',
                'phone'             => 'required|numeric',
                'country_id'        => 'required|integer',
                'state'             => 'required|string|max:255',
                'city'              => 'required|string|max:255',
                'zip_code'          => 'required|string|max:255',
                'address'           => 'required|string|max:1024',
                'order_notes'       => 'nullable|string|max:1024',
                'product_id.*'      => 'required|integer|exists:products,id',
                'price.*'   => 'required|numeric',
                'quantity.*'        => 'required|integer|min:1'
            ]);

            $order = new Order;
            $order->first_name = $validatedData['first_name'];
            $order->last_name = $validatedData['last_name'];
            $order->email = $validatedData['email'];
            $order->phone = $validatedData['phone'];
            $order->country_id = $validatedData['country_id'];
            $order->state = $validatedData['state'];
            $order->city = $validatedData['city'];
            $order->zip_code = $validatedData['zip_code'];
            $order->street_address = $validatedData['address'];
            $order->status = Order::ORDER_PLACED;
            $order->order_notes = $validatedData['order_notes'];
            $order->amount = array_sum($request['total_price']);
            $order->save();

            if (!empty($request->product_id))
            {
                foreach ($request->product_id as $key => $productId)
                {
                    OrderDetails::create([
                        'order_id' => $order->id,
                        'product_id' => $request->product_id[$key],
                        'price' => $request->price[$key],
                        'quantity' => $request->quantity[$key],
                        'total_price' => $request->total_price[$key],
                    ]);

                    $product = Products::findOrFail($request->product_id[$key]);
                    $product->quantity -= $request->quantity[$key];
                    $product->save();
                }
            }

            DB::commit();
            return redirect()->route('sales.index')->with('success',trans('general.order_created_success'));
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->withErrors('Error processing your order: ' . $e->getMessage());
        }
    }

    public function show($salesId)
    {
        $title = $this->title;
        $this->authorize('viewAny',Order::class);
        $sales = Order::with(['orderDetails','assignedTo'])->findOrFail($salesId);

        return view('sales.show', compact('title','sales'));

    }

    public function destroy($salesId)
    {
        $this->authorize('delete',Order::class);
        $record = Order::destroy($salesId);
        return response()->json(['success' => $record]);
    }

    public function getSalesData(Request $request)
    {
        $this->authorize('viewAny',Order::class);
        $query = Order::with(['country'])->orderBy('id', 'desc');

        if($request->filled('assigned_to'))
        {
            $query = $query->where('assigned_to',$request->assigned_to);
        }
        if($request->filled('status'))
        {
            $query = $query->where('status',$request->status);
        }

        return DataTables::of($query)
            ->editColumn('status',function($order){
                return Order::STATUS[$order->status];
            })
            ->addColumn('person_name', function($order){
                return $order->first_name.' '. $order->last_name;
            })
            ->addColumn('country', function($order){
                return $order->country->name;
            })
            ->addColumn('assigned_to', function($order){
                return isset($order->assignedTo->full_name) ? $order->assignedTo->full_name : '-';
            })
            ->addColumn('action', function ($order) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item" href="'.route('sales.show', $order->id).'">'.trans('general.show').'</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('sales.destroy', $order->id).'" data-id="'.$order->id.'">'.trans('general.delete').'</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action','price'])
            ->make(true);
    }

    public function assignedToEmployee(Request $request)
    {
        $orderId = $request->orderId;
        $employeeId = $request->employeeId;

        Order::where('id', $orderId)->update([
            'assigned_to' => $employeeId
        ]);

        $user = User::findOrFail($employeeId);
        $order = Order::findOrFail($orderId);
        $link = route('sales.show', $orderId);
        $notificationMessage = $order->order_number.' '.trans('general.order_assigned_to_you');
        $user->notify(new AssignToEmployee($link, $notificationMessage));

        return response()->json([
            'status' => true,
            'message' => trans('general.order_assigned_to_employee')
        ]);
    }

    public function changeStatus(Request $request){
        $orderId = $request->orderId;
        $status = $request->status;

        $order = Order::findOrFail($orderId);
        $order->status = $status;
        $order->save();

        if($status == Order::CANCELLED)
        {
            $this->returnProducts($order->id);
        }

        return response()->json([
         'status' => true,
         'message' => trans('general.status_changed_success'),
        ]);
    }

    public function downloadReceipt($orderId)
    {

        $sales = Order::with(['orderDetails'])->findOrFail($orderId);

        $data = [
            'sales' => $sales,
        ];

        $html = View::make('sales.receipt', $data)->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        return $dompdf->stream($sales->order_number.'-'.time().'.pdf');
    }

    public function returnProducts($orderId)
    {
        $orderDetails = OrderDetails::where('order_id', $orderId)->get();
        if(!empty($orderDetails))
        {
            foreach($orderDetails as $detail)
            {
                $product = Products::findOrFail($detail->product_id);
                $product->quantity += $detail->quantity;
                $product->save();
            }
        }

    }

    public function fetchProductAmount(Request $request)
    {
        $productId = $request->productId;
        $product = Products::findOrFail($productId);

        return response()->json([
            'price' => $product->price
        ]);
    }

    public function cancel(Request $request, $orderId)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validate([
                'cancellation_reason' => 'required|string|max:255',
                'rejection_status' => 'required|string'

            ]);

            Order::where('id', $orderId)->update([
                'returned_reason' => $request['cancellation_reason'],
                'status' => $request['rejection_status']
            ]);

            DB::commit();
            return redirect()->route('sales.show', $orderId)->with('success',trans('general.order_cancelled_status'));
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->withErrors('Error processing your order: ' . $e->getMessage());
        }
    }


}
