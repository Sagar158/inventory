<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Order;
use App\Models\Sales;
use App\Models\Products;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\View;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = "Sales";
    public function index()
    {
        $title = $this->title;
        $this->authorize('viewAny',Order::class);
        return view('sales.index', compact('title'));
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
        $query = Order::with(['country']);

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

        return response()->json([
            'status' => true,
            'message' => 'Order has been assigned to employee'
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
         'message' => 'Status changed successfully'
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


}
