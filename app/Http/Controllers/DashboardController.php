<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public $title = 'Dashboard';
    public function data(Request $request)
    {
        $title = $this->title;
        return view('dashboard', compact('title'));
    }
}
