<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt -({{ $sales->order_number }})</title>
    <style>
        table, td, th {
            border: 1px solid;
            float: left;
            padding: 5px;
            white-space: normal;
            box-sizing: border-box; /* Ensure border width is included in element's total width */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        div {
            width: 100%;
            clear: both; /* Ensure div starts on a new line */
            margin-bottom: 30px; /* Add space between divs */
        }

    </style>
</head>
<body>
    <div>
        <img src="{{ 'data:image/png;base64,'.base64_encode(file_get_contents(asset('assets/images/logo.jpg'))) }}" alt="" style="width:80px !important;">
    </div>
    <h2><span>Order Receipt</span><span style="float:right;">Order ID # {{ $sales->order_number }}</span></h2>
    <h3></h3>
    <div>
        <table>
            <tbody>
                <tr>
                    <td colspan="2"><strong>Delivery Information</strong></td>
                </tr>
                <tr>
                    <td><strong>Name</strong></td>
                    <td>{{ $sales->first_name }} {{ $sales->last_name }}</td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td>{{ $sales->email }}</td>
                </tr>
                <tr>
                    <td><strong>Mobile</strong></td>
                    <td>{{ $sales->phone }}</td>
                </tr>
                <tr>
                    <td><strong>Address</strong></td>
                    <td>{{ $sales->street_address }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <table style="margin-top:30px;">
            <tbody>
                <tr>
                    <td colspan="4"><strong>Order Details</strong></td>
                </tr>
                <tr>
                    <td><strong>Product Name</strong></td>
                    <td><strong>Quantity</strong></td>
                    <td><strong>Actual Price</strong></td>
                    <td><strong>Total</strong></td>
                </tr>
                @if(!empty($sales->orderDetails))
                    @foreach($sales->orderDetails as $detail)
                        <tr>
                            <td>{{ $detail->product->product_name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>MAD {{ number_format($detail->price,2) }}</td>
                            <td>MAD {{ number_format($detail->price, 2) }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div>
        <table style="margin-top:30px;">
            <tbody>
                <tr>
                    <td colspan="2"><strong>Order Amount</strong></td>
                </tr>
                <tr>
                    <td><strong>SubTotal</strong></td>
                    <td>MAD {{ number_format($sales->amount, 2) }}</td>
                </tr>
                <tr>
                    <td><strong>SubTotal</strong></td>
                    <td>MAD {{ number_format($sales->amount, 2) }}</td>
                </tr>
                <tr>
                    <td><strong>Grand Total</strong></td>
                    <td><strong>MAD {{ number_format($sales->amount, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
