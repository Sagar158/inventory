@extends('frontend.layouts.app')
@section('content')
<div class="validtheme-shop-single-area default-padding">
    <div class="container">
        <div class="product-details">
            <div class="row">

                <div class="col-lg-12 col-sm-12 col-md-12">
                    <h3 class="font-weight-bold">{{ trans('general.my_orders') }}</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{trans('general.order_numbers')}}</th>
                            </tr>
                        </thead>
                        <tbody class="order-data">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function(){
            fetchOrders();
        });
        function fetchOrders()
        {
            var orders = JSON.parse(localStorage.getItem('orderIds')) || {};
            var numberOfItems = Object.keys(orders).length;

            if(numberOfItems > 0)
            {
                var items = localStorage.getItem('orderIds');
                var orderObject = JSON.parse(items);
                var html = '';
                Object.entries(orderObject).forEach(([key, value]) => {
                    html += '<tr>';
                    html += '<td><a href="{{ url("order/track") }}?tracking_number='+value+'">'+value+'</a></td>';
                    html += '</tr>';
                });

                $('.order-data').html(html);

            }
        }

    </script>
@endpush
@endsection
