<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Teams;
use App\Models\Events;
use App\Models\Slider;
use App\Models\AboutUs;
use App\Models\Products;
use App\Models\ContactUs;
use App\Models\Countries;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Certifications;
use App\Http\Controllers\Controller;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slider::select('image','title','subtitle','description')->get();
        $products = Products::orderBy('id','desc')->limit(6)->get();
        return view('frontend.index',compact('slides','products'));
    }

    public function products()
    {
        $categories = Categories::with('products')->get();
        return view('frontend.products',compact('categories'));
    }

    public function contactus(){
        return view('frontend.contact-us');
    }

    public function contactStore(Request $request)
    {
        ContactUs::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'description' => $request->comments
        ]);

        return response()->json(['message' => 'Your Query has been successfully submitted to our team. Our team will contact you soon.']);
    }

    public function productDetails($productId)
    {
        $product = Products::findOrFail($productId);

        return view('frontend.productDetails', compact('product'));
    }

    public function viewCart()
    {
        return view('frontend.viewCart');
    }

    public function checkout()
    {
        $countries = Countries::select('id','name')->pluck('name','id')->toArray();

        return view('frontend.checkout', compact('countries'));
    }

    public function orderPlace(Request $request)
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
                'product_price.*'   => 'required|numeric',
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
            $order->amount = $request->amount;
            $order->save();

            if (!empty($request->product_id))
            {
                foreach ($request->product_id as $key => $productId)
                {
                    OrderDetails::create([
                        'order_id' => $order->id,
                        'product_id' => $request->product_id[$key],
                        'price' => $request->product_price[$key],
                        'quantity' => $request->quantity[$key],
                        'total_price' => $request->product_price[$key] * $request->quantity[$key],
                    ]);

                    $product = Products::findOrFail($request->product_id[$key]);
                    $product->quantity -= $request->quantity[$key];
                    $product->save();
                }
            }

            DB::commit();
            return redirect()->route('order.thankyou', $order->id);
            return view('frontend.thankyou', compact('order'));
        } catch (\Exception $e) {
            DB::rollBack();
            // Handle the error appropriately
            return redirect()->back()->withErrors('Error processing your order: ' . $e->getMessage());
        }
    }

    public function thankyou($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('frontend.thankyou',compact('order'));
    }

    public function trackOrder(Request $request)
    {
        $title = 'Track Order';
        if($request->filled('tracking_number'))
        {
            $order = Order::where('order_number',$request->tracking_number)->first();
        }
        else
        {
            $order = new Order;
        }

        return view('frontend.orderTrack',compact('title','order'));
    }

    public function myOrders()
    {
        return view('frontend.myorders');
    }


}
