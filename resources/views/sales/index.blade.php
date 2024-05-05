<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Sales') }}"></x-page-heading>
        <x-right-side-button link="{{ route('sales.create') }}" title="Create"></x-right-side-button>
        <x-alert></x-alert>
        <div class="container-fluid card mt-3">
            <div class="row card-body">
                <div class="col-lg-3 col-sm-12 col-md-3">
                    <x-select-box id="status" name="status" value="" :values="\App\Models\Order::STATUS" autocomplete="off" placeholder="Status"/>
                </div>
                <div class="col-lg-3 col-sm-12 col-md-3">
                    <x-select-box id="assigned_to" name="assigned_to" value="" :values="\App\Helpers\Helper::fetchEmployees()" autocomplete="off" placeholder="Assigned To" required/>
                </div>
                <div class="col-lg-2 col-sm-12 col-md-2 mt-3">
                    <button class="btn btn-primary mt-3 reset-filters-btn">Reset Filter</button>
                </div>

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
                              <th>Order Status</th>
                              <th>Assigned To</th>
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
                var table = $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                            url:'{{ route("sales.getSalesData") }}',
                            data: function(d) {
                                // Add filter values to the AJAX request
                                d.status = $('select[name="status"]').val();
                                d.assigned_to = $('select[name="assigned_to"]').val();
                            }
                    },
                    columns: [
                        { data: 'order_number', name: 'order_number' },
                        { data: 'person_name', name: 'person_name' },
                        { data: 'phone', name: 'phone' },
                        { data: 'email', name: 'email' },
                        { data: 'country', name: 'country' },
                        { data: 'amount', name: 'amount' },
                        { data: 'status', name: 'status' },
                        { data: 'assigned_to', name: 'assigned_to' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ]
                });

                // Filter action
                $('select[name="assigned_to"], select[name="status"]').on('change', function(e) {
                    e.preventDefault();
                    table.draw(); // Redraw the DataTable with the new filter values
                });

                $(document).on('click','.reset-filters-btn', function(e) {
                    e.preventDefault();
                    $('select[name="assigned_to"]').val('');
                    $('select[name="status"]').val('');
                    $('select').trigger('change');
                    table.draw();
                });
            });
        </script>
    @endpush
</x-app-layout>
