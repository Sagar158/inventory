@php
    define('DOMPDF_ENABLE_PHP', true);
    define('DOMPDF_LOG_OUTPUT_FILE', storage_path('logs/dompdf.log'));
@endphp
<x-app-layout title="{{ $title }}">
    @push('css')
        <style>
            .image-thumbnail{
                width: 60px !important;
                height: 60px !important;
                border-radius: 20% !important;
            }
            .badge-quantity{
                position: relative;
                top: -22px;
                right: 70px;
            }
        </style>
    @endpush
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ trans('general.sales_details') }}"></x-page-heading>
        <x-back-button></x-back-button>
        <x-alert></x-alert>
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>
                                <span>{{ trans('general.order_id') }}:</span>
                                <span class="font-weight-bold">#{{ $sales->order_number }}</span>
                                <span class="ml-2 badge {{ \App\Models\Order::LABELS[$sales->status]['badge'] }}">{{ \App\Models\Order::LABELS[$sales->status]['label'] }}</span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12 col-md-6">
                                        <div class="mt-1"><i data-feather="calendar"></i> {{ date('F j, Y h:i:s a', strtotime($sales->created_at)) }}</div>
                                        <div class="mt-1">{{ trans('general.order_status') }} : {{ \App\Models\Order::LABELS[$sales->status]['label'] }}</div>
                                        @if(isset($sales->assignedTo->fullname))
                                            <div class="mt-1">{{ trans('general.assigned_to') }} : {{ $sales->assignedTo->fullname }}</div>
                                        @endif
                                        <div class="mt-1 text-danger">{{ trans('general.special_instructions') }} : {{ $sales->order_notes }}</div>
                                        @if(isset($sales->returned_reason))
                                            <div class="mt-1 text-danger"> : {{ $sales->order_notes }}</div>
                                        @endif
                                    </div>
                                    <input type="hidden" value="{{ $sales->id }}" name="order_id">
                                    @if($sales->status != \App\Models\Order::CANCELLED && (auth()->user()->user_type_id == \App\Models\User::ADMIN))
                                        <div class="col-lg-2 col-sm-12 col-md-2">
                                            <x-select-box id="assigned_to" name="assigned_to" value="{{ old('assigned_to', $sales->assigned_to) }}" :values="\App\Helpers\Helper::fetchEmployees()" autocomplete="off" placeholder="Assigned To" required/>
                                        </div>
                                        <div class="col-lg-2 col-sm-12 col-md-2">
                                            <x-select-box id="status" name="status" value="{{ old('status', $sales->status) }}" :values="\App\Models\Order::STATUS" autocomplete="off" placeholder="Status" required/>
                                        </div>
                                    @elseif($sales->status == \App\Models\Order::PACKING && $sales->assigned_to == auth()->user()->id)
                                    <div class="col-lg-2 col-sm-12 col-md-2 text-center">
                                        <input type="checkbox" name="mark_as_complete" class="form-control">
                                        <div class="mt-2">Mark as complete</div>
                                    </div>
                                    @endif
                                    <div class="col-lg-2 col-sm-12 col-md-2">
                                        <a class="btn btn-primary mt-4" target="_blank" href="{{ route('sales.downloadReceipt', $sales->id) }}">
                                            <i data-feather="printer"></i> {{ trans('general.print_receipt') }}
                                        </a>
                                    </div>
                                    <div class="col-lg-12 col-sm-12 col-md-12 cancellation-reason-div" style="display: none;">
                                        <form action="{{ route('sales.cancel', $sales->id) }}" method="POST">
                                            {{ @csrf_field() }}
                                            <x-text-input id="rejection_status" type="hidden" name="rejection_status" :value="old('rejection_status')"/>
                                            <x-text-area id="cancellation_reason" name="cancellation_reason" :value="old('cancellation_reason')" required autofocus autocomplete="off" min="1" placeholder="{{ trans('general.cancellation_reason') }}" />
                                            <x-primary-button class="btn btn-primary">
                                                {{ __('Submit') }}
                                            </x-primary-button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-header">{{ trans('general.order_details') }}</div>
                        <div class="card-body">
                            @if(!empty($sales->orderDetails))
                                @foreach($sales->orderDetails as $detail)
                                    <div class="mt-2">
                                        @if(isset($detail->product->primaryImage->image))
                                            <span><img src="{{ asset($detail->product->primaryImage->image) }}" class="image-thumbnail" alt=""></span>
                                        @else
                                                <img src="{{ asset('assets/images/placeholder.jpg') }}" alt="" class="image-thumbnail">
                                        @endif
                                        <span class="badge badge-dark badge-quantity">{{ $detail->quantity }}</span>
                                        <span>
                                            {{ $detail->product->product_name }} - #{{ $detail->product->product_number }}
                                        </span>
                                        <span class="float-right font-weight-bold">MAD {{ number_format($detail->price, 2) }}</span>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-header">{{ trans('general.order_amount') }}</div>
                        <div class="card-body">
                            <div>
                                <span>{{ trans('general.subtotal') }}</span>
                                <span class="float-right font-weight-bold">MAD {{ number_format($sales->amount, 2) }}</span>
                            </div>
                            <div>
                                <span>{{ trans('general.tax') }}</span>
                                <span class="float-right font-weight-bold">MAD 0.00</span>
                            </div>
                            <hr>
                            <div>
                                <span>{{ trans('general.grand_total') }}</span>
                                <span class="float-right font-weight-bold">MAD {{ number_format($sales->amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            {{ trans('general.delivery_information') }}
                        </div>
                        <div class="card-body">
                            <div>
                                <span>{{ trans('general.name') }} :</span>
                                <span>{{ $sales->first_name }} {{ $sales->last_name }}</span>
                            </div>
                            <div>
                                <span>{{ trans('general.email') }} :</span>
                                <span>{{ $sales->email }}</span>
                            </div>
                            <div>
                                <span>{{ trans('general.mobile') }} :</span>
                                <span>{{ $sales->phone }}</span>
                            </div>
                            <div>
                                <span>{{ trans('general.country') }}</span>
                                <span>{{ $sales->country->name }}</span>
                            </div>
                            <div>
                                <span>{{ trans('general.city') }}</span>
                                <span>{{ $sales->city }}</span>
                            </div>
                            <div>
                                <span>{{ trans('general.state') }}</span>
                                <span>{{ $sales->state }}</span>
                            </div>
                            <div>
                                <span>{{ trans('general.address') }} :</span>
                                <span>{{ $sales->street_address}}, {{ $sales->zip_code }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('change','select[name="status"]', function(){
                var selectedStatus = $(this).val();
                var orderId = $('input[name="order_id"]').val();
                if(selectedStatus == 'cancelled' || selectedStatus == 'returned')
                {
                    $('.cancellation-reason-div').show('slow');
                    $('input[name="rejection_status"]').val(selectedStatus);
                }
                else if(selectedStatus != '')
                {
                    $('.cancellation-reason-div').hide('slow');
                    $.ajax({
                        url : '{{ route("sales.change.status") }}',
                        method : 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data : {
                            status : selectedStatus,
                            orderId : orderId
                        },
                        success : function(data) {
                            if(data.status)
                            {
                                Swal.fire({
                                        title: "Success!",
                                        text: "Order status has been changed!",
                                        icon: "success"
                                    });
                                location.reload();
                            }
                            else
                            {
                                Swal.fire({
                                        title: "OOPS!",
                                        text: "Something went wrong",
                                        icon: "error"
                                    });

                            }
                        }
                    });
                }
            });

            $(document).on('change','select[name="assigned_to"]', function(){
                var employeeId = $(this).val();
                var orderId = $('input[name="order_id"]').val();
                if(employeeId != '')
                {
                    $.ajax({
                        url : '{{ route("sales.assignedToEmployee") }}',
                        method : 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data : {
                            employeeId : employeeId,
                            orderId : orderId
                        },
                        success : function(data) {
                            if(data.status)
                            {
                                Swal.fire({
                                        title: "Success!",
                                        text: data.message,
                                        icon: "success"
                                    });
                            }
                            else
                            {
                                Swal.fire({
                                        title: "OOPS!",
                                        text: "Something went wrong",
                                        icon: "error"
                                    });

                            }
                        }
                    });
                }
            });


        });

        $(document).ready(function() {
            $(document).on('click','input[name="mark_as_complete"]',function() {
                var isChecked = $(this).is(':checked');
                var orderId = $('input[name="order_id"]').val();

                if(isChecked)
                {
                    $.ajax({
                        url : '{{ route("sales.assignedToEmployee") }}',
                        method : 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data : {
                            orderId : orderId
                        },
                        success : function(data) {
                            if(data.status)
                            {
                                Swal.fire({
                                        title: "Success!",
                                        text: data.message,
                                        icon: "success"
                                    });

                                location.reload();
                            }
                            else
                            {
                                Swal.fire({
                                        title: "OOPS!",
                                        text: "Something went wrong",
                                        icon: "error"
                                    });

                            }
                        }
                    });
                }

            });
        });
    </script>
@endpush
</x-app-layout>
