<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Supplier';

    public function index()
    {
        $title = $this->title;
        return view('suppliers.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        $supplier = new Supplier;
        return view('suppliers.edit', compact('title', 'supplier'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create',Supplier::class);
        $validatedData = $request->validate([
            'name' => 'required|string',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        $supplier = new Supplier;
        $supplier->name = $validatedData['name'];
        $supplier->phone = $validatedData['phone'];
        $supplier->email = $validatedData['email'];
        $supplier->address = $validatedData['address'];
        $supplier->save();

        return redirect()->route('suppliers.index')->with('success', 'Supplier added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($supplierId)
    {
        $this->authorize('update',Supplier::class);
        $supplier = Supplier::findOrFail($supplierId);
        $title = $this->title;
        return view('suppliers.edit', compact('title','supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $supplierId)
    {
        $this->authorize('update',Supplier::class);
        $validatedData = $request->validate([
            'name' => 'required|string',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        $supplier = Supplier::findOrFail($supplierId);
        $supplier->name = $validatedData['name'];
        $supplier->phone = $validatedData['phone'];
        $supplier->email = $validatedData['email'];
        $supplier->address = $validatedData['address'];
        $supplier->save();

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($supplierId)
    {
        $this->authorize('delete',Supplier::class);
        $record = Supplier::destroy($supplierId);
        return response()->json(['success' => $record]);

    }

    public function getSupplierData()
    {
        $this->authorize('viewAny',Supplier::class);
        $query = Supplier::orderBy('created_at','DESC');

        return DataTables::of($query)
            ->addColumn('action', function ($supplier) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item" href="'.route('suppliers.edit', $supplier->id).'">'.trans('general.edit').'</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('suppliers.destroy', $supplier->id).'" data-id="'.$supplier->id.'">'.trans('general.delete').'</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function getData(Request $request)
    {
        $suppliers = Supplier::select('id','name');
        if($request->filled('search'))
        {
            $suppliers = $suppliers->where('name', 'LIKE','%'.$request->search.'%');
        }
        $suppliers = $suppliers->get();

        return response()->json(['data' => $suppliers]);
    }


}
