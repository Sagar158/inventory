@extends('frontend.layouts.app')
@section('content')
<div class="validtheme-shop-single-area default-padding">
    <div class="container">
        <div class="product-details">
            <div class="row">

                <div class="col-lg-12 col-sm-12 col-md-12">
                    <h1 class="font-weight-bold">Track Order</h1>

                    <form action="{{ route('order.track') }}" method="GET">
                        {{ @csrf_field() }}
                        <x-text-input id="tracking_number" type="text" name="tracking_number" :value="old('tracking_number', request()->get('tracking_number'))" required autofocus autocomplete="off" placeholder="Tracking Number" />
                        <button class="btn btn-success ml-2 mt-2 mb-2" type="submit">Track</button>
                    </form>

                    @if(isset($order->id))
                        <div class="card">
                            <div class="card-header p-1">
                                <h4 class="font-weight-bold">Order Details</h4>
                            </div>
                            <div class="card-body p-1">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Order Status</th>
                                        <th>{{ \App\Models\Order::LABELS[$order->status]['label'] }}</th>
                                    </tr>
                                    <tr>
                                        <th>Order Price</th>
                                        <td>MAD {{ number_format($order->amount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Notes</th>
                                        <td>{!! $order->order_notes !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Created At</th>
                                        <td>{{ date('F j, Y h:i:s a', strtotime($order->created_at)) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    @elseif(request()->get('tracking_number') && !isset($order->id))
                        <h1 class="color-theme">No Order Found</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
