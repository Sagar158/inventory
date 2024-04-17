<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public $title = 'User Types';
    public function index()
    {
        $this->authorize('viewAny',UserType::class);
        $title = $this->title;
        return view('usertypes.index',compact('title'));
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
    public function show(UserType $userType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $userTypeId)
    {
        $this->authorize('update',UserType::class);
        $title = $this->title;
        $userType = UserType::findOrFail($userTypeId);
        $permissions = config('permissions');
        $userPermissions = json_decode($userType->permissions, true);
        return view('usertypes.permissions',compact('title','userType','permissions','userPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $userTypeId)
    {
        $this->authorize('update',UserType::class);
        $userType = UserType::findOrFail($userTypeId);
        $userType->permissions = json_encode($request->permission);
        $userType->save();
        return redirect()->route('usertype.index')->with('success','Permissions has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserType $userType)
    {
        //
    }

    public function getUserTypeData(){
        $this->authorize('viewAny',UserType::class);
        $query = UserType::query(); // Modify as needed to get your data

        return DataTables::of($query)
            ->addColumn('action', function ($vehicle) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item" href="'.route('usertype.permissions.edit', $vehicle->id).'">Edit Permissions</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }
}
