<x-app-layout title="{{ $title }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contact Us') }}
        </h2>
    </x-slot>
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">

        <div class="container-fluid card mt-3 min-h-500">
            <div class="row card-body">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="d-flex align-items-center justify-content-between p-3 border-bottom tx-16">
                       <div class="">
                          <h4 class="font-weight-bold">Query Details</h4>
                          <div><strong>Name : </strong>{{ $contactus->name }}</div>
                          <div><strong>Email : </strong>{{ $contactus->email }}</div>
                          <div><strong>Phone : </strong>{{ $contactus->phone }}</div>
                          {{-- <div><strong>Status : </strong><span class="font-weight-bold {{ $contactus->status == 'pending' ? 'text-danger' : 'text-success' }}">{{ ucwords($contactus->status) }}</span></div> --}}
                       </div>
                       <div class="tx-13 text-muted mt-1 mt-sm-0">
                        {{ date('F j, Y H:i',strtotime($contactus->created_at)) }}
                       </div>
                    </div>
                    <div class="p-4">
                        <p>
                            {{ $contactus->description }}
                        </p>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</x-app-layout>
