@php
    $route = route('sales.store');
@endphp
<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Create Order') }}"></x-page-heading>
        <x-back-button></x-back-button>

        <div class="container-fluid card mt-3">
            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                {{ @csrf_field() }}
                <div class="row card-body">
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="first_name" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="off" placeholder="{{ trans('general.first_name') }}" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="last_name" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="off" placeholder="{{ trans('general.last_name') }}" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="off" placeholder="{{ trans('general.email') }}" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="phone" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="off" placeholder="{{ trans('general.phone') }}" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="country_id" extraClass="form-control" name="country_id" :value="old('country_id')" :values="$countries" autocomplete="off" placeholder="{{ trans('general.country') }}" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="state" type="text" name="state" :value="old('state')" required autofocus autocomplete="off" placeholder="{{ trans('general.state') }}" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="city" type="text" name="city" :value="old('city')" required autofocus autocomplete="off" placeholder="{{ trans('general.city') }}" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="zip_code" type="text" name="zip_code" :value="old('zip_code')" required autofocus autocomplete="off" placeholder="{{ trans('general.zipcode') }}" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="address" type="text" name="address" :value="old('address')" required autofocus autocomplete="off" placeholder="{{ trans('general.address') }}" />
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-text-area id="order_notes" type="text" name="order_notes" :value="old('order_notes')" required autofocus autocomplete="off" placeholder="{{ trans('general.special_instructions') }}" />
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="products-table">
                                <td>
                                    <x-select-box id="product_id[]" name="product_id[]" value="" autocomplete="off" placeholder="Products" extraClass="ajax-endpoint products" endpoint="{{ route('products.fetchData') }}" extraLabelClass="d-none" required/>
                                </td>
                                <td>
                                    <x-text-input id="quantity[]" type="number" name="quantity[]" :value="old('quantity[]',1)" required autofocus autocomplete="off" extraLabelClass="d-none" min="1" placeholder="{{ trans('general.quantity') }}" />
                                </td>
                                <td class="price-td">
                                    <x-text-input id="price[]" type="hidden" readonly="true" name="price[]" :value="old('price[]')" required autofocus autocomplete="off" extraLabelClass="d-none" placeholder="" />
                                    <x-text-input id="total_price[]" type="number" readonly="true" name="total_price[]" :value="old('total_price[]')" required autofocus autocomplete="off" extraLabelClass="d-none" placeholder="{{ trans('general.price') }}" />
                                </td>
                                <td>
                                    <button class="btn btn-success addRow"><i data-feather="plus"></i></button>
                                    <button class="btn btn-danger deleteRow"><i data-feather="minus"></i></button>
                                </td>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 mt-2">
                        <x-primary-button class="btn btn-primary">
                            {{ __('Submit') }}
                        </x-primary-button>
                        <x-back-button></x-back-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function(){
                $(document).on('click', '.addRow', function(e) {
                    e.preventDefault();
                    var $row = $(this).closest('tr'); // Find the row
                    var $clone = $row.clone(); // Clone the row

                    $clone.find('input').val('');
                    $clone.find('select').val('').trigger('change');
                    $clone.find('.select2-container').remove();
                    $clone.find('select').select2();
                    $row.after($clone);
                    refreshSelectBox();
                });

                // Delete Row functionality
                $(document).on('click', '.deleteRow', function(e) {
                    e.preventDefault();
                    var $row = $(this).closest('tr');
                    if ($('table tbody tr').length > 1)
                    {
                          $row.remove();
                    } else
                    {
                        alert('You cannot delete the last row.');
                    }
                });
                $(document).on('change','select[name="product_id[]"]', function(e){
                    var route = '{{ route("sales.fetchProductAmount") }}';
                    var product = $(this);
                    var productId = product.val();
                    $.ajax({
                            url: route,
                            method: 'GET',
                            headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data : {
                                productId: productId
                            },
                            success: function(response)
                            {

                                var price = 0;
                                if(response.price)
                                {
                                    price = response.price;
                                }

                                var quantity = parseInt(product.parent().parent().parent().find('input[name="quantity[]"]').val());
                                var totalPrice = quantity * price;
                                product.parent().parent().parent().find('input[name="price[]"]').val(price);
                                product.parent().parent().parent().find('input[name="total_price[]"]').val(totalPrice);
                            }
                        });
                });

                $(document).on('keyup','input[name="quantity[]"]',function(){
                    var selectedElement = $(this);
                    var quantity = selectedElement.val();

                    var price = selectedElement.parent().parent().parent().find('input[name="price[]"]').val();
                    console.log(price);
                    var totalPrice = parseInt(quantity) * parseFloat(price);
                    selectedElement.parent().parent().parent().find('input[name="total_price[]"]').val(totalPrice.toFixed(2));
                });

            });
        </script>
    @endpush
</x-app-layout>
