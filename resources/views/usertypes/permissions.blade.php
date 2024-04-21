@php
    $route = route('usertype.permissions.update',$userType->id);
@endphp
<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Edit Permissions') }} - ({{ $userType->name }})"></x-page-heading>
        <x-back-button></x-back-button>

        <div class="container-fluid card mt-3">
            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                {{ @csrf_field() }}
                <div class="row card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ trans('general.permission_name') }}</th>
                                <th>{{ trans('general.grant') }}</th>
                                <th>{{ trans('general.deny') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($permissions))
                                @foreach ($permissions as $permissionTitle => $permission)
                                    <tr>
                                        <td colspan="3" class="font-weight-bold">
                                            {{ $permissionTitle }}
                                        </td>
                                    </tr>
                                    @if(!empty($permission))
                                        @foreach ($permission as $permit)
                                            @include('usertypes.permission',['permit' => $permit])
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    <div class="col-lg-12 col-sm-12 col-md-12 mt-2">
                        <x-primary-button class="btn btn-primary">
                            {{ trans('general.save') }}
                        </x-primary-button>
                        <x-back-button></x-back-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
