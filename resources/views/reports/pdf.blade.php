<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <style>
        /* Define your styles here */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>{{ trans('general.sales_reporting') }}</h2>
    <table>
        <thead>
            <tr>
                <th>{{ trans('general.order_number') }}</th>
                <th>{{ trans('general.order_status') }}</th>
                <th>{{ trans('general.order_amount') }}</th>
                <th>{{ trans('general.assigned_to') }}</th>
                <th>{{ trans('general.created_at') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $order)
            <tr>
                <td>{{ $order->order_number }}</td>
                <td>{{ \App\Models\Order::STATUS[$order->status] }}</td>
                <td>
                    @php
                    $totalPrice = 0;
                    if(isset($order->orderDetails))
                    {
                        foreach($order->orderDetails as $detail)
                        {
                            $totalPrice += $detail->total_price;
                        }
                    }
                    echo 'MAD '. number_format($totalPrice,2);
                    @endphp
                </td>
                <td>{{ isset($order->assignedTo->full_name) ? $order->assignedTo->full_name : '-' }}</td>
                <td>{{ $order->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
