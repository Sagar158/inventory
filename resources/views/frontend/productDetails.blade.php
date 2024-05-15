@extends('frontend.layouts.app')
@section('content')
<div class="validtheme-shop-single-area default-padding">
    <div class="container">
        <div class="product-details">
            <div class="row">

                <div class="col-lg-6">
                    <div class="product-thumb">
                        <div id="timeline-carousel" class="carousel slide" data-bs-ride="carousel">

                            <div class="carousel-inner item-box">
                                @if(isset($product->details))
                                    @foreach($product->details as $key => $detail)
                                        <div class="carousel-item {{ $key == 0 ? 'active'  : '' }} product-item">
                                            <a href="{{ asset($detail->image) }}" class="item popup-gallery">
                                                <img src="{{ asset($detail->image) }}" alt="Thumb">
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <!-- Carousel Indicators -->
                            <div class="carousel-indicators">
                                <div class="product-gallery-carousel swiper">
                                    <!-- Additional required wrapper -->
                                    <div class="swiper-wrapper">
                                        @if(isset($product->details))
                                            @foreach($product->details as $key => $detail)
                                                <div class="swiper-slide">
                                                    <div class="item {{ $key == 0 ? 'active' : '' }}" data-bs-target="#timeline-carousel" data-bs-slide-to="{{ $key }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}">
                                                        <img src="{{ asset($detail->image) }}" alt="">
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <!-- End Carousel Content -->

                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="single-product-contents">
                        <div class="summary-top-box">
                            <div class="product-tags">
                                <a href="#">{{ $product->category->name }}</a>
                            </div>
                        </div>
                        <h2 class="product-title">
                            {{ $product->product_name }}
                        </h2>
                        <div class="price">
                            <span>MAD {{ $product->price }}</span>
                        </div>
                        <div class="product-stock {{ $product->quantity > 0 ? 'validthemes-in-stock' : 'validthemes-out-of-stock' }}">
                            <span>{{ $product->quantity > 0 ? 'In Stock' : 'Out of Stock' }}</span>
                        </div>
                        <p>
                            {!! $product->description !!}
                        </p>
                        <div class="product-purchase-list">
                            <input type="number" name="quantity" min="0" value="1" step="1" size="5" name="quantity" placeholder="1">
                            <a href="javascript::void(0);" class="btn secondary btn-theme btn-sm animation addToCart">
                                <i class="fas fa-shopping-cart"></i>
                                {{ trans('general.add_to_cart') }}
                            </a>
                        </div>
                        <div class="product-meta">
                            <span class="sku">
                                <strong>{{ trans('general.product_number') }}:</strong> {{ $product->product_number }}
                            </span>
                            <span class="posted-in">
                                <strong>{{ trans('general.category') }}:</strong>
                                <a href="#">{{ $product->category->name }}</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Bottom Info  -->
        <div class="single-product-bottom-info">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Tab Nav -->
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="description-tab-control" data-bs-toggle="tab" data-bs-target="#description-tab" type="button" role="tab" aria-controls="description-tab" aria-selected="true">
                            {{trans('general.description')}}
                        </button>

                        <button class="nav-link" id="information-tab-control" data-bs-toggle="tab" data-bs-target="#information-tab" type="button" role="tab" aria-controls="information-tab" aria-selected="false">
                            {{ trans('general.additional_information') }}
                        </button>


                    </div>
                    <!-- End Tab Nav -->
                    <!-- Start Tab Content -->
                    <div class="tab-content tab-content-info" id="myTabContent">

                        <!-- Tab Single -->
                        <div class="tab-pane fade show active" id="description-tab" role="tabpanel" aria-labelledby="description-tab-control">
                            {!! $product->description !!}
                        </div>
                        <!-- End Single -->

                        <!-- Tab Single -->
                        <div class="tab-pane fade" id="information-tab" role="tabpanel" aria-labelledby="information-tab-control">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>{{ trans('general.supplier') }}</td>
                                            <td>{{ $product->supplier->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ trans('general.category') }}</td>
                                            <td>{{ $product->category->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ trans('general.available_quantity') }}</td>
                                            <td>{{ $product->quantity }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ trans('general.price') }}</td>
                                            <td>MAD {{ $product->price }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End Tab Single -->


                    </div>
                    <!-- End Tab Content -->
                </div>
            </div>
        </div>
        <!-- End Product Bottom Info  -->

    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function() {
        $('.nav-link').click(function() {
            let product = $(this).attr('aria-controls');
            $('.nav-link').removeClass('active show');
            $(this).addClass('active show');
            $('.tab-pane').removeClass('active show');
            $('#'+product).addClass('active show');
        });


        $(document).on('click','.add-value', function(e){
            e.preventDefault();
            var quantity = parseInt($('input[name="quantity"]').val() || 0);
            quantity = quantity+ 1;
            var availableQuantity = '{{ $product->quantity }}';
            if(quantity > availableQuantity)
            {
                alert('Quantity must be less than or equal to available quantity');
            }
            else
            {
                $('input[name="quantity"]').val(quantity);
            }
        });
        $(document).on('click','.remove-value', function(e){
            e.preventDefault();
            var quantity = parseInt($('input[name="quantity"]').val() || 0);
            quantity = quantity - 1;
            if(quantity >= 1)
            {
                $('input[name="quantity"]').val(quantity);
            }
        });

        $(document).on('click','.checkout', function(e){
            $('.addToCart').trigger('click');
            window.location.href = "{{ route('checkout') }}";
        });

        $(document).on('click','.addToCart', function(e){
            e.preventDefault();
            var maxQuantity = '{{ $product->quantity }}';
            var quantity = parseInt($('input[name="quantity"]').val() || 0);
            var productId = '{{ $product->id }}';
            var productPrice = '{{ $product->price }}';
            var cart = JSON.parse(localStorage.getItem('cart')) || {};
            var productName = '{{ $product->product_name }}';

            if (cart[productId])
            {
                if (cart[productId].quantity + quantity <= maxQuantity)
                {
                    cart[productId].quantity += quantity;
                    cart[productId].calculatedPrice = productPrice * cart[productId].quantity;
                    cart[productId].productPrice = productPrice;
                    cart[productId].productName = productName;
                }
                else
                {
                    alert('Quantity must be less than or equal to available quantity');
                    return;
                }
            }
            else
            {
                cart[productId] = {
                    quantity: quantity,
                    calculatedPrice: productPrice * quantity,
                    productPrice: productPrice,
                    productName : productName,
                };
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            countCart();
        });
    });
    $(document).ready(function() {
        $('.star-rating i').on('click', function() {
            var rating = $(this).data('rating');
            $('.star-rating i').removeClass('active');
            $(this).prevAll().addBack().addClass('active');
            $('input[name="rating"]').val(rating);
        });
    });
</script>
@endpush
@endsection
