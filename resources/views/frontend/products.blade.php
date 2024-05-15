@extends('frontend.layouts.app')
@section('content')
<div class="validtheme-shop-area default-padding">
    <div class="container">
        <div class="shop-listing-contentes">

            <div class="row item-flex center">

                <div class="col-lg-7">
                    <div class="content">
                        <!-- Tab Nav -->
                        <h2><strong>{{ trans('general.products') }}</strong></h2>
                        <!-- End Tab Nav -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Start Tab Content -->
                <div class="tab-content tab-content-info text-center" id="shop-tabContent">

                    <!-- Strt Product Grid Vies -->
                    <div class="tab-pane fade show active" id="grid-tab" role="tabpanel" aria-labelledby="grid-tab-control">
                        @if(!empty($categories))
                            @foreach ($categories as $category)
                            <h4 class="font-weight-bold">{{ $category->name }}</h4>
                            <ul class="vt-products columns-4">

                                <!-- Single product -->
                                @if(!empty($category->products))
                                 @foreach ($category->products as $product)
                                    <li class="product">
                                        <div class="product-contents">
                                            <div class="product-image">
                                                <a href="javascript:void(0);">
                                                    <img style="height:150px !important;" src="{{ isset($product->primaryImage->image) ? asset($product->primaryImage->image) : asset('assets/images/placeholder.jpg') }}" alt="Product">
                                                </a>
                                            </div>
                                            <div class="product-caption text-center">
                                                <div class="product-tags">
                                                    {{-- <a href="javascript:void(0);">{{ \App\Models\Products::$categories[$product->category_id] }}</a> --}}
                                                </div>
                                                <h4 class="product-title">
                                                    <a href="javascript:void(0);">{{ ucwords($product->name) }}</a>
                                                </h4>
                                                <div class="price text-center">
                                                    <span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">MAD</span> {{ $product->price }}</span></span>
                                                </div>
                                                <a href="{{ route('product.details', $product->id) }}" class="btn btn-theme secondary btn-sm radius animation ajax_add_to_cart add_to_cart_button" data-product_id="2068" data-product_sku="woo-bell-pepper"><i class="fas fa-shopping-cart"></i><span>View Product</span></a>
                                            </div>
                                        </div>
                                    </li>
                                 @endforeach
                                @endif


                            </ul>
                            @endforeach
                        @endif
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

@endsection
