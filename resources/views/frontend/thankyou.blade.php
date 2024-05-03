@extends('frontend.layouts.app')
@section('content')
<div class="validtheme-shop-single-area default-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12">
                <x-alert></x-alert>

                @if(isset($order->id))
                    <h3 class="font-weight-bold">Congratulations! Your Order has been confirmed</h3>
                    <h4>You can track your order by using this tracking number - <span class="font-weight-bold">{{ $order->order_number }}</span></h4>
                    <h5><a class="font-weight-bold" href="{{ route('order.track',['tracking_number' => $order->order_number]) }}">Click me to track order</a></h5>
                @else
                    <h1 class="font-weight-bold">No Order Found!</h1>
                @endif
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function(){
        @if($order->id)
            localStorage.removeItem("cart");
            addOrderId('{{ $order->order_number }}')
        @endif
    });

    function addOrderId(orderId)
    {
        let orderIds = JSON.parse(localStorage.getItem('orderIds')) || [];

        if (!orderIds.includes(orderId))
        {
            orderIds.push(orderId);
            localStorage.setItem('orderIds', JSON.stringify(orderIds));
        }
    }
</script>
@endpush
@endsection
