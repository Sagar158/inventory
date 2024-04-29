@extends('frontend.layouts.app')
@section('content')
<div class="validtheme-shop-area default-padding">
    <div class="container">
        <div class="shop-listing-contentes">

            <div class="row item-flex center">

                <div class="col-lg-7">
                    <div class="content">
                        <!-- Tab Nav -->
                        <h2><strong>Products</strong></h2>
                        <!-- End Tab Nav -->
                    </div>
                </div>

                <div class="col-lg-5 text-right">
                    <p>
                        Showing {{ $products->firstItem() }} – {{ $products->lastItem() }} of {{ $products->total() }} results
                    </p>
                    <select name="sort_by" id="sort_by">
                        <option value="id" {{ request()->get('sort_by') == 'id' ? 'selected' : '' }}>Short by latest</option>
                        <option value="category_id" {{ request()->get('sort_by') == 'category_id' ? 'selected' : '' }}>Short by Relevant</option>
                      </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Start Tab Content -->
                <div class="tab-content tab-content-info text-center" id="shop-tabContent">

                    <!-- Strt Product Grid Vies -->
                    <div class="tab-pane fade show active" id="grid-tab" role="tabpanel" aria-labelledby="grid-tab-control">
                        <ul class="vt-products columns-4">

                            <!-- Single product -->
                            @if(!empty($products))
                             @foreach ($products as $product)
                                <li class="product">
                                    <div class="product-contents">
                                        <div class="product-image">
                                            <a href="javascript:void(0);">
                                                <img style="height:150px !important;" src="{{ isset($product->primaryImage->image) ? asset($product->primaryImage->image) : asset('assets/images/placeholder.jpg') }}" alt="Product">
                                            </a>
                                        </div>
                                        <div class="product-caption">
                                            <div class="product-tags">
                                                <a href="javascript:void(0);">{{ \App\Models\Products::$categories[$product->category_id] }}</a>
                                            </div>
                                            <h4 class="product-title">
                                                <a href="javascript:void(0);">{{ ucwords($product->name) }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                </li>
                             @endforeach
                            @endif


                        </ul>
                    </div>
                </div>



                <!-- Pgination -->
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
