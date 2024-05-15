<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Products;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\ProductDetails;
use Yajra\DataTables\DataTables;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title;

    public function __construct()
    {
        $this->title = trans('general.products');
    }
    public function index()
    {
        $title = $this->title;
        $this->authorize('viewAny',Products::class);
        return view('products.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',Products::class);
        $title = $this->title;
        $product = new Products;
        return view('products.edit', compact('title','product'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create',Products::class);
        $validatedData = $request->validate([
            'product_name' => 'required|string',
            'status' => 'required|string',
            'price' => 'numeric|required',
            'quantity' => 'numeric|required',
            'category_id' => 'required|string',
            'supplier_id' => 'required|string',
            'description' => 'nullable|string'
        ]);


        $product = new Products();
        $product->product_name = $validatedData['product_name'];
        $product->status = $validatedData['status'];
        $product->price = $validatedData['price'];
        $product->product_number = Helper::generateUniqueKey();
        $product->category_id = $validatedData['category_id'];
        $product->supplier_id = $validatedData['supplier_id'];
        $product->quantity = $validatedData['quantity'];
        $product->description = $validatedData['description'];
        $product->save();

        if($request->has('images'))
        {
            $isFirstImage = true;
            foreach($request->images as $image)
            {
                ProductDetails::create([
                    'product_id' => $product->id,
                    'image' => Helper::imageUpload($image),
                    'primary' => $isFirstImage,
                ]);
                $isFirstImage = false;
            }
        }

        return redirect()->route('products.index')->with('success','Product added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show($productId)
    {
        $this->authorize('viewAny',Products::class);
        $title = $this->title;
        $product = Products::with(['category','supplier','details'])->findOrFail($productId);

        return view('products.show', compact('product','title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($productId)
    {
        $this->authorize('update',Products::class);
        $title = $this->title;
        $product = Products::findOrFail($productId);
        return view('products.edit', compact('title', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $productId)
    {
        $this->authorize('update',Products::class);
        $validatedData = $request->validate([
            'status' => 'required|string',
            'product_name' => 'required|string',
            'price' => 'numeric|required',
            'quantity' => 'numeric|required',
            'category_id' => 'required|string',
            'supplier_id' => 'required|string',
            'description' => 'nullable|string'
        ]);

        $product = Products::findOrFail($productId);
        $product->product_name = $validatedData['product_name'];
        $product->status = $validatedData['status'];
        $product->price = $validatedData['price'];
        $product->category_id = $validatedData['category_id'];
        $product->supplier_id = $validatedData['supplier_id'];
        $product->quantity = $validatedData['quantity'];
        $product->description = $validatedData['description'];
        $product->save();

        if($request->has('images'))
        {
            $isFirstImage = true;
            ProductDetails::where('product_id', $product->id)->delete();
            foreach($request->images as $image)
            {
                ProductDetails::create([
                    'product_id' => $product->id,
                    'image' => Helper::imageUpload($image),
                    'primary' => $isFirstImage,
                ]);
                $isFirstImage = false;
            }
        }
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($productId)
    {
        $this->authorize('delete',Products::class);
        ProductDetails::where('product_id', $productId)->delete();
        $record = Products::destroy($productId);
        return response()->json(['success' => $record]);
    }

    public function getProductData()
    {
        $this->authorize('viewAny',Products::class);
        $query = Products::with(['supplier','category']);

        return DataTables::of($query)
            ->editColumn('status',function($product){
                return ucfirst($product->status);
            })
            ->editColumn('price',function($product){
                return Products::$currency.''.$product->price;
            })
            ->addColumn('supplier',function($product){
                return $product->supplier->name;
            })
            ->addColumn('category',function($product){
                return $product->category->name;
            })
            ->addColumn('action', function ($product) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                <a class="dropdown-item" href="'.route('products.show', $product->id).'">'.trans('general.show').'</a>
                                <a class="dropdown-item" href="'.route('products.edit', $product->id).'">'.trans('general.edit').'</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('products.destroy', $product->id).'" data-id="'.$product->id.'">'.trans('general.delete').'</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action','price'])
            ->make(true);
    }

    public function fetchData(Request $request)
    {
        $products = Products::select('id','product_name as name');
        if($request->filled('search')){
            $products = $products->where('product_name', 'LIKE','%'.$request->search.'%');
        }
        $products = $products->get();

        return response()->json(['data' => $products]);
    }

}
