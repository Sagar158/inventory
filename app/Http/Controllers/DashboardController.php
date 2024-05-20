<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
class DashboardController extends Controller
{
    public $title = 'Dashboard';
    public function data(Request $request)
    {
        $title = $this->title;

        $data = Supplier::withCount('products')
                        ->has('products')
                        ->orderByDesc('products_count')
                        ->take(5)
                        ->get(['name', 'products_count']);

        $data = $data->map(function ($supplier) {
            return [
                'supplier_name' => $supplier->name,
                'product_count' => $supplier->products_count,
            ];
        })->toArray();


        $topProducts = DB::table('order_details')
                        ->join('products', 'order_details.product_id', '=', 'products.id')
                        ->select('products.id', 'products.product_name', DB::raw('SUM(order_details.quantity) as total_quantity'))
                        ->groupBy('products.id', 'products.product_name') // Include all selected fields that are not aggregated
                        ->orderBy('total_quantity', 'DESC')
                        ->take(5)
                        ->get();
        $formattedData = $topProducts->map(function ($item) {
                            return [
                                'product_name' => $item->product_name,
                                'total_quantity' => $item->total_quantity,
                            ];
                        })->toArray();

        $years = collect(range(Carbon::now()->subYears(5)->year, Carbon::now()->year));

        $yearlySales = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select(
                DB::raw('YEAR(order_details.created_at) as year'),
                DB::raw('SUM(order_details.quantity) as total_quantity'),
                DB::raw('SUM(order_details.quantity * order_details.price) as total_sales')
            )
            ->where('order_details.created_at', '>=', Carbon::now()->subYears(5)->startOfYear())
            ->groupBy(DB::raw('YEAR(order_details.created_at)'))
            ->get()
            ->keyBy('year'); // This will index the collection by year

        $filledSales = $years->map(function ($year) use ($yearlySales) {
            return [
                'year' => $year,
                // 'total_quantity' => $yearlySales->has($year) ? $yearlySales[$year]->total_quantity : 0,
                'total_sales' => $yearlySales->has($year) ? $yearlySales[$year]->total_sales : 0
            ];
        });


        $topProductsYearly = DB::table('order_details')
        ->join('products', 'order_details.product_id', '=', 'products.id')
        ->select('products.id', 'products.product_name', DB::raw('SUM(order_details.quantity * order_details.price) as total_sales'))
        ->whereYear('order_details.created_at', Carbon::now()->year)
        ->groupBy('products.id', 'products.product_name') // Include products.product_name in GROUP BY
        ->orderBy('total_sales', 'DESC')
        ->take(3)
        ->pluck('products.id'); // This will get only the IDs of the top 3 products

        // Define years and quarters
        $currentYear = Carbon::now()->year;
        $quarters = collect(range(1, 4));

        // Perform the query
        $quarterlySales = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select(
                'products.id',
                'products.product_name',
                DB::raw('QUARTER(order_details.created_at) as quarter'),
                DB::raw('SUM(order_details.quantity * order_details.price) as total_sales')
            )
            ->whereIn('products.id', $topProductsYearly)
            ->whereYear('order_details.created_at', $currentYear)
            ->groupBy('products.id', 'products.product_name', 'quarter')
            ->get()
            ->groupBy('id'); // Group by product ID for easier access

        // Map and fill data structure
        $filledQuarterlySales = $topProductsYearly->mapWithKeys(function ($productId) use ($quarterlySales, $quarters) {
            $productData = $quarterlySales->get($productId) ?? collect();
            return [$productId => $quarters->map(function ($quarter) use ($productData) {

                $quarterData = $productData->firstWhere('quarter', $quarter);
                return [
                    'quarter' => $quarter,
                    'product_name' => $quarterData ? $quarterData->product_name : '',
                    'total_sales' => $quarterData ? $quarterData->total_sales : 0,
                ];
            })];
        });

        $processedSalesData = [];

        foreach ($filledQuarterlySales as $productID => $salesData) {

            $data = [
                'name' => "Product-". $productID, // You might want to fetch the actual product name if available
                'data' => $salesData->map(function ($item) {
                    return $item['total_sales'];
                })->all()
            ];

            array_push($processedSalesData, $data);
        }

        return view('dashboard', compact('title','data','formattedData','filledSales','filledQuarterlySales','processedSalesData'));
    }
}
