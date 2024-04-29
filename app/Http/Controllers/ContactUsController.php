<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Models\ContactInformation;
use Yajra\DataTables\Facades\DataTables;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public $title = 'Contact Us';

    public function index()
    {
        $title = $this->title;
        return view('contact-us.index',compact('title'));
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
    public function show(string $id)
    {
        $title = $this->title;
        $contactus = ContactUs::findOrFail($id);
        $contactus->status = 'verified';
        $contactus->save();
        return view('contact-us.show',compact('contactus', 'title'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contactInformation = ContactInformation::findOrFail($id);
        $contactInformation->phone = $request->phone;
        $contactInformation->short_location = $request->short_location;
        $contactInformation->location = $request->location;
        $contactInformation->email = $request->email;
        $contactInformation->facebook = $request->facebook;
        $contactInformation->twitter = $request->twitter;
        $contactInformation->youtube = $request->youtube;
        $contactInformation->linkedin = $request->linkedin;
        $contactInformation->save();

        return redirect()->back()->with('success','Contact Information Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = ContactUs::destroy($id);
        return response()->json(['success' => $response]);


    }

    public function getContactData()
    {
        $query = ContactUs::orderBy('created_at','desc')->get();

        return DataTables::of($query)
        ->editColumn('status',function($contactus){
            if($contactus->status == 'verified')
                return '<span class="text-success">'.ucwords($contactus->status).'</span>';
            else
                return '<span class="text-danger">'.ucwords($contactus->status).'</span>';
        })
        ->editColumn('created_at',function($contactus){
            return date('F j, Y H:i:s', strtotime($contactus->created_at));
        })
        ->addColumn('action', function ($contactus) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item" href="'.route('contact-us.show', $contactus->id).'">Show</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('contact-us.destroy', $contactus->id).'" data-id="'.$contactus->id.'">Delete</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }

    public function information(Request $request)
    {
        $title = $this->title;
        $information = ContactInformation::select('phone','location','email','facebook','twitter','youtube','linkedin','short_location')->first();
        return view('contact-us.information',compact('title','information'));
    }

}
