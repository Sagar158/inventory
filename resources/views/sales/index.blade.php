<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Sales') }}"></x-page-heading>
        <x-alert></x-alert>
        <div class="container-fluid card mt-3">
            <div class="row card-body">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="table-responsive">
                        <table id="dataTable" class="table">
                          <thead>
                            <tr>
                              <th>Order Number</th>
                              <th>Person Name</th>
                              <th>Mobile</th>
                              <th>Email</th>
                              <th>Country</th>
                              <th>Amount</th>
                              <th>Status</th>
                              <th>Action</th>
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

    <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route("sales.getSalesData") }}',
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
