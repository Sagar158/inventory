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
        <x-page-heading title="{{ __('Sales Details') }}"></x-page-heading>
        <x-back-button></x-back-button>

        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>
                                <span>Order ID:</span>
                                <span class="font-weight-bold">#{{ $sales->order_number }}</span>
                                <span class="ml-2 badge {{ \App\Models\Order::LABELS[$sales->status]['badge'] }}">{{ \App\Models\Order::LABELS[$sales->status]['label'] }}</span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12 col-md-6">
                                        <div class="mt-1"><i data-feather="calendar"></i> {{ date('F j, Y h:i:s a', strtotime($sales->created_at)) }}</div>
                                        <div class="mt-1">Order Status : {{ \App\Models\Order::LABELS[$sales->status]['label'] }}</div>
                                        @if(isset($sales->assignedTo->fullname))
                                            <div class="mt-1">Assigned To : {{ $sales->assignedTo->fullname }}</div>
                                        @endif
                                        <div class="mt-1 text-danger">Special Instructions : {{ $sales->order_notes }}</div>
                                    </div>
                                    @if($sales->status != \App\Models\Order::CANCELLED)
                                        <div class="col-lg-2 col-sm-12 col-md-2">
                                            <x-select-box id="assigned_to" name="assigned_to" value="{{ old('assigned_to', $sales->assigned_to) }}" :values="\App\Helpers\Helper::fetchEmployees()" autocomplete="off" placeholder="Assigned To" required/>
                                        </div>
                                        <div class="col-lg-2 col-sm-12 col-md-2">
                                            <input type="hidden" value="{{ $sales->id }}" name="order_id">
                                            <x-select-box id="status" name="status" value="{{ old('status', $sales->status) }}" :values="\App\Models\Order::STATUS" autocomplete="off" placeholder="Status" required/>
                                        </div>
                                    @endif
                                    <div class="col-lg-2 col-sm-12 col-md-2">
                                        <a class="btn btn-primary mt-4" target="_blank" href="{{ route('sales.downloadReceipt', $sales->id) }}">
                                            <i data-feather="printer"></i> Print Receipt
                                        </a>
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
                        <div class="card-header">Order Details</div>
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
                                        <span class="float-right font-weight-bold">${{ number_format($detail->price, 2) }}</span>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-header">Order Amount</div>
                        <div class="card-body">
                            <div>
                                <span>Subtotal</span>
                                <span class="float-right font-weight-bold">MAD {{ number_format($sales->amount, 2) }}</span>
                            </div>
                            <div>
                                <span>Tax</span>
                                <span class="float-right font-weight-bold">MAD 0.00</span>
                            </div>
                            <hr>
                            <div>
                                <span>Grand Total</span>
                                <span class="float-right font-weight-bold">MAD {{ number_format($sales->amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Delivery Information
                        </div>
                        <div class="card-body">
                            <div>
                                <span>Name :</span>
                                <span>{{ $sales->first_name }} {{ $sales->last_name }}</span>
                            </div>
                            <div>
                                <span>Email :</span>
                                <span>{{ $sales->email }}</span>
                            </div>
                            <div>
                                <span>Mobile :</span>
                                <span>{{ $sales->phone }}</span>
                            </div>
                            <div>
                                <span>Country</span>
                                <span>{{ $sales->country->name }}</span>
                            </div>
                            <div>
                                <span>City</span>
                                <span>{{ $sales->city }}</span>
                            </div>
                            <div>
                                <span>State</span>
                                <span>{{ $sales->state }}</span>
                            </div>
                            <div>
                                <span>Address :</span>
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
                if(selectedStatus != '')
                {
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
    </script>
@endpush
</x-app-layout>
