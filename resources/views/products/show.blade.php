<x-app-layout title="{{ $title }}">
    @push('css')
        <style>
            .nav-pills .nav-link.active, .nav-pills .show > .nav-link
            {
                color: #fff !important;
                background-color: #f1f5fa !important;
            }
        </style>
    @endpush
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ trans('general.product_details') }}"></x-page-heading>
        <x-back-button></x-back-button>

        <div class="container-fluid card mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6">
                       <div class="product-detai-imgs">
                          <div class="row">
                             <div class="col-md-2 col-sm-3 col-4">
                                <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    @if(isset($product->details))
                                        @foreach ($product->details as $key => $image)
                                            <a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="product-{{ $key }}-tab" data-bs-toggle="pill" href="javascript:void(0);" role="tab" aria-controls="product-{{ $key }}" aria-selected="true">
                                                <img src="{{ asset($image->image) }}" alt="" class="img-fluid mx-auto d-block rounded">
                                            </a>
                                        @endforeach
                                    @else
                                        <a class="nav-link active" id="product-0-tab" data-bs-toggle="pill" href="#product-0" role="tab" aria-controls="product-0" aria-selected="true">
                                            <img src="{{ asset('assets/images/placeholder.jpg') }}" alt="" class="img-fluid mx-auto d-block rounded">
                                        </a>
                                    @endif
                                </div>
                             </div>
                             <div class="col-md-7 offset-md-1 col-sm-9 col-8">
                                <div class="tab-content" id="v-pills-tabContent">
                                    @if(isset($product->details))
                                        @foreach ($product->details as $key => $image)
                                        <div class="tab-pane fade {{ $key == 0 ? 'active show' : '' }}" id="product-{{ $key }}" role="tabpanel" aria-labelledby="product-{{ $key }}-tab">
                                                <div>
                                                    <img src="{{ asset($image->image) }}" alt="" class="mx-auto d-block product-show-image">
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="tab-pane fade active show" id="product-0" role="tabpanel" aria-labelledby="product-0-tab">
                                            <div>
                                                <img src="{{ asset('assets/images/placeholder.jpg') }}" alt="" class="mx-auto d-block product-show-image">
                                            </div>
                                        </div>
                                    @endif
                                </div>

                             </div>
                          </div>
                       </div>
                    </div>
                    <div class="col-xl-6">
                       <div class="mt-4 mt-xl-3">
                          <h5><a href="javascript: void(0);" class="text-primary">{{ $product->category->name }}</a></h5>
                          <h5 class="mt-1 mb-3">{{ $product->product_name }}</h5>
                          <h5 class="mb-4">{{ trans('general.price') }} : <span class="text-muted me-2">{{ \App\Models\Products::$currency }} {{ number_format($product->price) }}</span></h5>
                          <p class="text-muted mb-4 mt-5">{!! $product->description !!}</p>
                       </div>
                    </div>
                </div>
                <div class="mt-5">
                    <h5 class="mb-3">{{ trans('general.specifications') }} :</h5>
                    <div class="table-responsive">
                       <table class="table mb-0 table-bordered">
                          <tbody>
                             <tr>
                                <th scope="row">{{ trans('general.status') }}</th>
                                <td><span class="{{ $product->status == 'available' ? 'text-success' : 'text-danger' }}">{{ \App\Models\Products::$status[$product->status] }}</span></td>
                             </tr>
                             <tr>
                                <th scope="row">{{ trans('general.product_number') }}</th>
                                <td><span class="">{{ $product->product_number }}</span></td>
                             </tr>
                             <tr>
                                <th scope="row">{{ trans('general.category') }}</th>
                                <td><span class="">{{ $product->category->name }}</span></td>
                             </tr>
                             <tr>
                                <th scope="row">{{ trans('general.supplier') }}</th>
                                <td><span class="">{{ $product->supplier->name }}</span></td>
                             </tr>
                             <tr>
                                <th scope="row">{{ trans('general.quantity') }}</th>
                                <td><span class="">{{ $product->quantity }}</span></td>
                             </tr>
                          </tbody>
                       </table>
                    </div>
                 </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                   <div>
                      <h5 class="mb-3">{{ trans('general.related_product') }} :</h5>
                      <div class="row">
                        @if(!empty($product->relatedProducts))
                         @foreach($product->relatedProducts as $recent)
                         <div class="col-xl-4 col-sm-6">
                            <div class="card mt-2">
                               <div class="card-body">
                                  <div class="row align-items-center">
                                     <div class="col-md-4">
                                        @if(isset($recent->primaryImage->image))
                                            <img src="{{ $recent->primaryImage->image }}" alt="" class="img-fluid mx-auto d-block img-thumbnail">
                                        @else
                                            <img src="{{ asset('assets/images/placeholder.jpg') }}" alt="" class="img-fluid mx-auto d-block img-thumbnail">
                                        @endif
                                     </div>
                                     <div class="col-md-8">
                                        <div class="text-center text-md-start pt-3 pt-md-0">

                                           <h5 class="text-truncate"><a href="{{ route('products.show', $recent->id) }}" class="text-dark">{{ $recent->title }}</a></h5>
                                           <h5 class="my-0"><span class="text-muted me-2">{{ trans('general.status') }} : </span> <span class="{{ $recent->status == 'available' ? 'text-success' : 'text-danger' }}">{{ \App\Models\Products::$status[$recent->status] }}</span></h5>
                                           <h5 class="my-0"><span class="text-muted me-2">{{ trans('general.quantity') }} : </span> <span> {{ ucfirst($recent->quantity) }}</span></h5>
                                           <h5 class="my-0"><span class="text-muted me-2">{{ trans('general.category') }} : </span> <span> {{ ucfirst($recent->category->name) }}</span></h5>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                         @endforeach
                        @endif
                      </div>
                      <!-- end row -->
                   </div>
                </div>
             </div>
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
        });
    </script>
@endpush
</x-app-layout>
