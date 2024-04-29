<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Teams;
use App\Models\Events;
use App\Models\Slider;
use App\Models\AboutUs;
use App\Models\Products;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Models\Certifications;
use App\Http\Controllers\Controller;

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
        $products = Products::paginate(12);
        return view('frontend.products',compact('products'));
    }

    public function events()
    {
        $events = Events::orderBy('id','desc')->paginate(5);
        return view('frontend.events',compact('events'));
    }
    public function contactus(){
        return view('frontend.contact-us');
    }

    public function certificates()
    {
        $certificates = Certifications::orderBy('id','desc')->get();
        return view('frontend.certificates',compact('certificates'));
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

    public function privacypolicy()
    {
        $privacyPolicy = AboutUs::first();
        return view('frontend.privacypolicy',compact('privacyPolicy'));
    }
    public function terms()
    {
        $terms = AboutUs::first();
        return view('frontend.terms',compact('terms'));
    }

    public function team()
    {
        $teams = Teams::select('name','designation','image','description','mobile')->get();
        return view('frontend.team',compact('teams'));
    }

    public function eventDetails(Request $request, $eventId)
    {
        $event = Events::findOrFail($eventId);
        return view('frontend.event-details',compact('event'));
    }

}
