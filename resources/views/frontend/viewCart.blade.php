@extends('frontend.layouts.app')
@section('content')
<div class="validtheme-shop-single-area default-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="product-remove"><span class="screen-reader-text">{{ trans('general.remove_item') }}</span></th>
                            <th class="product-name">{{ trans('general.product') }}</th>
                            <th class="product-price">{{ trans('general.price') }}</th>
                            <th class="product-quantity">{{ trans('general.quantity') }}</th>
                            <th class="product-subtotal">{{ trans('general.subtotal') }}</th>
                        </tr>
                    </thead>
                    <tbody class="cart-data">

                    </tbody>
                </table>
                <a href="{{ route("checkout") }}" class="btn secondary btn-theme btn-sm animation text-white text-center mt-2 checkout-button">{{ trans('general.checkout') }}</a>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function(){
            function updateItemList(){
                var cart = JSON.parse(localStorage.getItem('cart')) || {};
                var numberOfItems = Object.keys(cart).length;
                var html = '';
                if(numberOfItems > 0)
                {
                    var items = localStorage.getItem('cart');

                    var cartObject = JSON.parse(items);
                    var totalAmount = 0;
                    var productIds = [];
                    Object.entries(cartObject).forEach(([key, value]) => {
                        productIds.push(key);
                        productPrice = parseInt(value.productPrice) * parseInt(value.quantity);
                        html += '<tr class="text-center">';
                        html += '<td><i class="fa fa-trash fa-lg cursor-pointer text-danger delete-cart-item" data-id="'+key+'"></i></td>';
                        html += '<td>'+value.productName+'</td>';
                        html += '<td>MAD '+parseInt(value.productPrice)+'</td>';
                        html += '<td>'+value.quantity+'</td>';
                        html += '<td>MAD '+productPrice+'</td>';
                        html += '</tr>';
                        totalAmount += parseInt(productPrice);
                    });

                    html += '<tr class="text-center">';
                    html += '<th>Total</th>';
                    html += '<th colspan="4">MAD '+totalAmount+'</th>';
                    html += '</tr>';

                }
                else
                {
                    $('.checkout-button').hide('slow');
                }

                $('.cart-data').html(html);

            }

            updateItemList();

            $(document).on('click','.delete-cart-item', function(){
                var itemId = $(this).attr('data-id');
                var cartData = localStorage.getItem('cart');
                var cartItems = JSON.parse(cartData);

                delete cartItems[itemId];
                localStorage.setItem('cart', JSON.stringify(cartItems));
                updateItemList();
                countCart();

            });

        });
    </script>
@endpush
@endsection
