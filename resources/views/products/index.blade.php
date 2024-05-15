<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ trans('general.products') }}"></x-page-heading>
        <x-right-side-button link="{{ route('products.create') }}" title="Create"></x-right-side-button>
        <x-alert></x-alert>
        <div class="container-fluid card mt-3">
            <div class="row card-body">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="table-responsive">
                        <table id="dataTable" class="table">
                          <thead>
                            <tr>
                              <th>{{ trans('general.product_name') }}</th>
                              <th>{{ trans('general.serial') }}</th>
                              <th>{{ trans('general.supplier') }}</th>
                              <th>{{ trans('general.category') }}</th>
                              <th>{{ trans('general.price') }}</th>
                              <th>{{ trans('general.available_quantity') }}</th>
                              <th>{{ trans('general.status') }}</th>
                              <th>{{ trans('general.action') }}</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route("products.getProductData") }}',
                    columns: [
                        { data: 'product_name', name: 'product_name' },
                        { data: 'product_number', name: 'product_number' },
                        { data: 'supplier', name: 'supplier' },
                        { data: 'category', name: 'category' },
                        { data: 'price', name: 'price' },
                        { data: 'quantity', name: 'quantity' },
                        { data: 'status', name: 'status' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>
