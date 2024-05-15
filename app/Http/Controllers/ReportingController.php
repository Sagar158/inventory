<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Dompdf\Dompdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrderExport;

class ReportingController extends Controller
{
    public function index()
    {
        $title = trans('general.reporting');

        return view('reports.index', compact('title'));
    }

    public function getReportData(Request $request, $export = false)
    {
        $this->authorize('view',Order::class);
        $query = Order::with(['orderDetails'])->orderBy('id', 'desc');

        if($request->filled('assigned_to'))
        {
            $query = $query->where('assigned_to',$request->assigned_to);
        }

        if($request->filled('status'))
        {
            $query = $query->where('status',$request->status);
        }

        if($request->filled('from'))
        {
            $query = $query->whereDate('created_at','>=',$request->from);
        }

        if($request->filled('to'))
        {
            $query = $query->whereDate('created_at','<=',$request->to);
        }

        if($export)
        {
            return $query;
        }


        return DataTables::of($query)
               ->editColumn('status',function($order){
                  return Order::STATUS[$order->status];
                })
                ->addColumn('assigned_to', function($order){
                    return isset($order->assignedTo->full_name) ? $order->assignedTo->full_name : '-';
                })
                ->addColumn('order_amount', function($order){
                    $totalPrice = 0;
                    if(isset($order->orderDetails))
                    {
                        foreach($order->orderDetails as $detail)
                        {
                            $totalPrice += $detail->total_price;
                        }
                    }
                    return 'MAD '. number_format($totalPrice,2);
                })
                ->editColumn('created_at',function($order){
                    return date('F j, Y h:i:s a', strtotime($order->created_at));
                })
                ->make(true);

    }

    public function exportPDF(Request $request)
    {
        // Fetch data using the same query logic you provided
        $query = $this->getReportData($request, true);
        $data = $query->get();

        $pdf = new Dompdf();
        $pdf->loadHtml(view('reports.pdf', ['data' => $data]));
        $pdf->render();
        $output = $pdf->output();
        return response()->streamDownload(
            function () use ($output) {
                echo $output;
            },
            'sales-report-'.time().'.pdf'
        );

    }

    public function exportExcel(Request $request)
    {
        // Fetch data using the same query logic you provided
        $query = $this->getReportData($request, true);

        $data = $query->get();

        return Excel::download(new OrderExport($data), 'orders.xlsx');
    }
}
