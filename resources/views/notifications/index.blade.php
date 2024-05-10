<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="All Notifications"></x-page-heading>
        <x-alert></x-alert>
        <div class="container-fluid card mt-3">
            <div class="row card-body">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    @foreach ($notifications as $notification)
                        <div>
                            <div class="alert alert-success" role="alert">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-10 col-sm-12 col-md-10">
                                            <a href="{{ $notification->data['link'] }}" target="_blank" class="text-dark font-weight-bold">
                                                {{ $notification->data['message'] }}
                                            </a>
                                        </div>
                                        <div class="col-lg-2 col-sm-12 col-md-2 text-right">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
