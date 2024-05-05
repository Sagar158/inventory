@extends('frontend.layouts.app')
@section('content')
<div class="validtheme-shop-single-area default-padding">
    <form action="{{ route('product.placeOrder') }}" method="POST">
        {{ @csrf_field() }}
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <x-alert></x-alert>
                    <h3 class="font-weight-bold">{{ trans('general.billing_details') }}</h3>
                </div>
                <div class="col-lg-4 col-sm-12 col-md-4 mt-4">
                    <x-text-input id="first_name" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="off" placeholder="{{ trans('general.first_name') }}" />
                </div>
                <div class="col-lg-4 col-sm-12 col-md-4 mt-4">
                    <x-text-input id="last_name" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="off" placeholder="{{ trans('general.last_name') }}" />
                </div>
                <div class="col-lg-4 col-sm-12 col-md-4 mt-4">
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="off" placeholder="{{ trans('general.email') }}" />
                </div>
                <div class="col-lg-4 col-sm-12 col-md-4 mt-4">
                    <x-text-input id="phone" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="off" placeholder="{{ trans('general.phone') }}" />
                </div>
                <div class="col-lg-4 col-sm-12 col-md-4 mt-4">
                    <x-select-box id="country_id" extraClass="form-control" name="country_id" :value="old('country_id')" :values="$countries" autocomplete="off" placeholder="{{ trans('general.country') }}" />
                </div>
                <div class="col-lg-4 col-sm-12 col-md-4 mt-4">
                    <x-text-input id="state" type="text" name="state" :value="old('state')" required autofocus autocomplete="off" placeholder="{{ trans('general.state') }}" />
                </div>
                <div class="col-lg-4 col-sm-12 col-md-4 mt-4">
                    <x-text-input id="city" type="text" name="city" :value="old('city')" required autofocus autocomplete="off" placeholder="{{ trans('general.city') }}" />
                </div>
                <div class="col-lg-4 col-sm-12 col-md-4 mt-4">
                    <x-text-input id="zip_code" type="text" name="zip_code" :value="old('zip_code')" required autofocus autocomplete="off" placeholder="{{ trans('general.zipcode') }}" />
                </div>
                <div class="col-lg-4 col-sm-12 col-md-4 mt-4">
                    <x-text-input id="address" type="text" name="address" :value="old('address')" required autofocus autocomplete="off" placeholder="{{ trans('general.address') }}" />
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12 mt-4">
                    <x-text-area id="order_notes" type="text" name="order_notes" :value="old('order_notes')" required autofocus autocomplete="off" placeholder="{{ trans('general.special_instructions') }}" />
                </div>

                <div class="col-lg-8 col-sm-12 col-md-8 mt-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ trans('general.product') }}</th>
                                <th>{{ trans('general.subtotal') }}</th>
                            </tr>
                        </thead>
                        <tbody class="order-data"></tbody>
                    </table>
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12 order-form-elements"></div>
                <div class="col-lg-5 col-sm-12 col-md-5">
                    <button type="submit" class="btn secondary btn-theme btn-sm animation text-white text-center mt-2 place-order-button">{{ trans('general.place_order') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
@push('scripts')
    <script>
        $(document).ready(function(){
            var cart = JSON.parse(localStorage.getItem('cart')) || {};
                var numberOfItems = Object.keys(cart).length;
                var html = '';
                var inputElements = '';
                if(numberOfItems > 0)
                {
                    var items = localStorage.getItem('cart');

                    var cartObject = JSON.parse(items);
                    var totalAmount = 0;
                    var productIds = [];
                    Object.entries(cartObject).forEach(([key, value]) => {
                        productIds.push(key);
                        productPrice = parseInt(value.productPrice) * parseInt(value.quantity);
                        html += '<tr>';
                        html += '<td>'+value.productName+'</td>';
                        html += '<td>MAD '+productPrice+'</td>';
                        html += '</tr>';
                        totalAmount += parseInt(productPrice);

                        inputElements += '<input type="hidden" name="product_id[]" value='+key+'>';
                        inputElements += '<input type="hidden" name="product_price[]" value='+value.productPrice+'>';
                        inputElements += '<input type="hidden" name="quantity[]" value='+value.quantity+'>';

                    });

                    html += '<tr>';
                    html += '<th>Total</th>';
                    html += '<th>MAD '+totalAmount+'</th>';
                    html += '</tr>';
                    inputElements += '<input type="hidden" name="amount" value='+totalAmount+'>';
                }
                else
                {
                    $('.place-order-button').hide('slow');
                }

                $('.order-data').html(html);
                $('.order-form-elements').html(inputElements);
        });
    </script>
@endpush
@endsection
