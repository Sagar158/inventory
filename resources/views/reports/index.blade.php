<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ trans('general.sales_reporting') }}"></x-page-heading>
        <x-alert></x-alert>
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-3 col-sm-12 col-md-3">
                    <x-text-input id="from" type="date" name="from" :value="old('from')" required autofocus autocomplete="off" placeholder="{{ trans('general.from') }}" />
                </div>
                <div class="col-lg-3 col-sm-12 col-md-3">
                    <x-text-input id="to" type="date" name="to" :value="old('to')" required autofocus autocomplete="off" placeholder="{{ trans('general.to') }}" />
                </div>
                <div class="col-lg-3 col-sm-12 col-md-3">
                    <x-select-box id="status" name="status" value="" :values="\App\Models\Order::STATUS" autocomplete="off" placeholder="{{ trans('general.status') }}"/>
                </div>
                <div class="col-lg-3 col-sm-12 col-md-3">
                    <x-select-box id="assigned_to" name="assigned_to" value="" :values="\App\Helpers\Helper::fetchEmployees()" autocomplete="off" placeholder="{{ trans('general.assigned_to') }}" required/>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-6">
                    <button class="btn btn-success btn-md mt-4 fetch-results">{{ trans('general.fetch_results') }}</button>
                    <button class="btn btn-info mt-4 reset-filters-btn text-white">{{ trans('general.reset_filter') }}</button>
                    {{-- <button class="btn btn-primary export-excel-btn mt-4 btn-md">{{ trans('general.export_excel') }}</button> --}}
                    <button class="btn btn-danger export-pdf-btn mt-4 btn-md">{{ trans('general.download_pdf') }}</button>
                </div>
            </div>
        </div>
        <div class="container-fluid card mt-3">
            <div class="row card-body">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="table-responsive">
                        <table id="dataTable" class="table">
                          <thead>
                            <tr>
                                <th>{{ trans('general.order_number') }}</th>
                                <th>{{ trans('general.order_status') }}</th>
                                <th>{{ trans('general.order_amount') }}</th>
                                <th>{{ trans('general.assigned_to') }}</th>
                                <th>{{ trans('general.created_at') }}</th>
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
                            url : '{{ route("reports.getReportData") }}',
                            data: function(d) {
                                // Add filter values to the AJAX request
                                d.from = $('input[name="from"]').val();
                                d.to = $('input[name="to"]').val();
                                d.status = $('select[name="status"]').val();
                                d.assigned_to = $('select[name="assigned_to"]').val();
                            }
                    },
                    columns: [
                        { data: 'order_number', name: 'order_number' },
                        { data: 'status', name: 'status' },
                        { data: 'order_amount', name: 'order_amount' },
                        { data: 'assigned_to', name: 'assigned_to' },
                        { data: 'created_at', name: 'created_at' },
                    ]
                });

                $(document).on('click','.fetch-results', function(e){
                    e.preventDefault();
                    console.log("HERE");
                    table.draw();
                });

                $(document).on('click','.reset-filters-btn', function(e) {
                    e.preventDefault();
                    $('select[name="assigned_to"]').val('');
                    $('select[name="status"]').val('');
                    $('input[name="from"]').val('');
                    $('input[name="to"]').val('');
                    $('select').trigger('change');
                    table.draw();
                });

                $(document).on('click', '.export-pdf-btn', function(e) {
                    e.preventDefault();
                    var url = '{{ route("reports.exportPDF") }}';
                    // Append filter parameters to the URL
                    url += '?from=' + $('input[name="from"]').val();
                    url += '&to=' + $('input[name="to"]').val();
                    url += '&status=' + $('select[name="status"]').val();
                    url += '&assigned_to=' + $('select[name="assigned_to"]').val();
                    window.location.href = url;
                });

                // Export to Excel
                $(document).on('click', '.export-excel-btn', function(e) {
                    e.preventDefault();
                    var url = '{{ route("reports.exportExcel") }}';
                    // Append filter parameters to the URL
                    url += '?from=' + $('input[name="from"]').val();
                    url += '&to=' + $('input[name="to"]').val();
                    url += '&status=' + $('select[name="status"]').val();
                    url += '&assigned_to=' + $('select[name="assigned_to"]').val();
                    window.location.href = url;
                });

            });
        </script>
    @endpush
</x-app-layout>
