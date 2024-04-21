@php
    $route = (!isset($product->id) ? route('products.store') : route('products.update',$product->id));
@endphp
<x-app-layout title="{{ $title }}">
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/vendors/simplemde/simplemde.min.css') }}">
    @endpush
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ trans('general.create_update') }} {{ trans('general.products') }}"></x-page-heading>
        <x-back-button></x-back-button>

        <div class="container-fluid card mt-3">
            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                {{ @csrf_field() }}
                <div class="row card-body">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-select-box id="status" name="status" :value="old('status', $product->status)" :values="\App\Models\Products::$status" autocomplete="off" placeholder="{{ trans('general.status') }}" />
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-text-input id="product_name" type="text" name="product_name" :value="old('product_name', $product->product_name)" required autofocus autocomplete="off" placeholder="{{ trans('general.product_name') }}" />
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-select-box id="category_id" name="category_id" value="{{ old('category_id',$product->category_id) }}" autocomplete="off" placeholder="{{ trans('general.category') }}" extraClass="ajax-endpoint categories" endpoint="{{ route('categories.getData') }}" optionText="{{ isset($product->category_id) ? \App\Models\Categories::where('id',$product->category_id)->first()->name : '' }}" required/>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-select-box id="supplier_id" name="supplier_id" value="{{ old('supplier_id',$product->supplier_id) }}" autocomplete="off" placeholder="{{trans('general.suppliers') }}" extraClass="ajax-endpoint suppliers" endpoint="{{ route('suppliers.getData') }}" optionText="{{ isset($product->supplier_id) ? \App\Models\Supplier::where('id',$product->supplier_id)->first()->name : '' }}" required/>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-text-input id="price" type="number" name="price" :value="old('price', $product->price)" required autofocus autocomplete="off" placeholder="{{ trans('general.price') }}" />
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-text-input id="quantity" type="number" name="quantity" :value="old('quantity', $product->quantity)" required autofocus autocomplete="off" placeholder="{{ trans('general.quantity') }}" />
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <label for="" class="font-weight-bold">{{ trans('general.images') }} ({{ trans('general.you_can_select_multiple_images_here') }})</label>
                        <input type="file" name="images[]" class="border form-control" multiple/>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-text-area id="description" name="description" :value="old('description', $product->description)" autofocus placeholder="{{ trans('general.description') }}" />
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 mt-2">
                        <x-primary-button class="btn btn-primary">
                            {{ trans('general.save') }}
                        </x-primary-button>
                        <x-back-button></x-back-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/vendors/tinymce/tinymce.min.js') }}"></script>
        <script src="{{ asset('assets/js/tinymce.js') }}"></script>
    @endpush
</x-app-layout>
