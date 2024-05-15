@extends('frontend.layouts.app')
@section('content')
<div class="validtheme-shop-single-area default-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12">
                <x-alert></x-alert>

                @if(isset($order->id))
                    <h3 class="font-weight-bold">{{ trans('general.order_confirmation') }}</h3>
                    <h4>{{ trans('general.track_your_order') }}<span class="font-weight-bold">{{ $order->order_number }}</span></h4>
                    <h5><a class="font-weight-bold" href="{{ route('order.track',['tracking_number' => $order->order_number]) }}">{{ trans('general.click_me_to_track_order') }}</a></h5>
                @else
                    <h1 class="font-weight-bold">{{ trans('general.no_order_found') }}</h1>
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
