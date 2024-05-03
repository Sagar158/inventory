<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Sales;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sales $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sales $sales)
    {
        //
    }

    public function getSalesData(){
        $this->authorize('viewAny',Order::class);
        $query = Order::with(['supplier','category']);

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
}
