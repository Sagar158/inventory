<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ trans('general.sales') }}"></x-page-heading>
        <x-right-side-button link="{{ route('sales.create') }}" title="Create"></x-right-side-button>
        <x-alert></x-alert>
        <div class="container-fluid card mt-3">
            <div class="row card-body">
                <div class="col-lg-3 col-sm-12 col-md-3">
                    <x-select-box id="status" name="status" value="" :values="\App\Models\Order::STATUS" autocomplete="off" placeholder="{{ trans('general.status') }}"/>
                </div>
                <div class="col-lg-3 col-sm-12 col-md-3">
                    <x-select-box id="assigned_to" name="assigned_to" value="" :values="\App\Helpers\Helper::fetchEmployees()" autocomplete="off" placeholder="{{ trans('general.assigned_to') }}" required/>
                </div>
                <div class="col-lg-2 col-sm-12 col-md-2 mt-3">
                    <button class="btn btn-primary mt-3 reset-filters-btn">{{ trans('general.reset_filter') }}</button>
                </div>

                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="table-responsive">
                        <table id="dataTable" class="table">
                          <thead>
                            <tr>
                              <th>{{ trans('general.order_number') }}</th>
                              <th>{{ trans('general.person_name') }}</th>
                              <th>{{ trans('general.mobile') }}</th>
                              <th>{{ trans('general.email') }}</th>
                              <th>{{ trans('general.country') }}</th>
                              <th>{{ trans('general.order_amount') }}</th>
                              <th>{{ trans('general.order_status') }}</th>
                              <th>{{ trans('general.assigned_to') }}</th>
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
