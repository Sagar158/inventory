<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public $title = 'Dashboard';
    public function data(Request $request)
    {
        $title = $this->title;
        // Fetching top 5 suppliers with the most products
        $data = Supplier::withCount('products')
                        ->has('products')
                        ->orderByDesc('products_count')
                        ->take(5)
                        ->get(['name', 'products_count']);

        // Converting the Eloquent collection to a plain array
        $data = $data->map(function ($supplier) {
            return [
                'supplier_name' => $supplier->name,
                'product_count' => $supplier->products_count,
            ];
        })->toArray();
        return view('dashboard', compact('title','data'));
    }
}
