<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Categories';
    public function index()
    {
        $title = $this->title;
        $this->authorize('viewAny',Categories::class);
        return view('categories.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',Categories::class);
        $title = $this->title;
        $category = new Categories;
        return view('categories.edit', compact('title', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create',Categories::class);
        $validatedData = $request->validate([
            'name' => 'required|string|unique:categories,name',
            'status' => 'required|string',
        ]);

        $category = new Categories();
        $category->name = $validatedData['name'];
        $category->status = $validatedData['status'];
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Categories added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($categoryId)
    {
        $this->authorize('update',Categories::class);
        $title = $this->title;
        $category = Categories::findOrFail($categoryId);
        return view('categories.edit', compact('title', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $categoryId)
    {
        $this->authorize('update',Categories::class);
        $validatedData = $request->validate([
            'name' => 'required|string|unique:categories,name,' . $categoryId,
            'status' => 'required|string',
        ]);

        $category = Categories::findOrFail($categoryId);
        $category->name = $validatedData['name'];
        $category->status = $validatedData['status'];
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($categoryId)
    {
        $this->authorize('delete',Categories::class);
        $record = Categories::destroy($categoryId);
        return response()->json(['success' => $record]);
    }

    public function getCategoryData(Request $request)
    {
        $query = Categories::query(); // Modify as needed to get your data

        return DataTables::of($query)
            ->editColumn('status', function($category){
                return ucfirst($category->status);
            })
            ->addColumn('action', function ($category) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item" href="'.route('categories.edit', $category->id).'">'.trans('general.edit').'</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('categories.destroy', $category->id).'" data-id="'.$category->id.'">'.trans('general.delete').'</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }

    public function getData(Request $request)
    {
        $categories = Categories::select('id','name');
        if($request->filled('search'))
        {
            $categories = $categories->where('name', 'LIKE','%'.$request->search.'%');
        }
        $categories = $categories->get();

        return response()->json(['data' => $categories]);
    }
}
