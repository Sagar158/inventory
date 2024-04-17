<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ isset($title) ? $title : '' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/dropify/dist/dropify.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        @if(Session::has('theme') && (Session::get('theme') == 'dark'))
            <link rel="stylesheet" href="{{ asset('assets/css/demo_2/style.css') }}">
        @else
            <link rel="stylesheet" href="{{ asset('assets/css/demo_1/style.css') }}">
        @endif
        <link rel="shortcut icon" href="{{ asset('/images/favicon.png') }}" type="image/x-icon">
        <!-- Scripts -->
        @stack('css')

    </head>
    <body class="font-sans antialiased">
        <div class="main-wrapper">
            <x-sidebar></x-sidebar>
            <x-settings-sidebar></x-settings-sidebar>
            <div class="page-wrapper">
                <x-header></x-header>
                <div class="page-content">
                    {{ $slot }}
                </div>
                <x-footer></x-footer>
            </div>
        </div>
    </body>

	<script src="{{ asset('assets/vendors/core/core.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
	<script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js">
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/vendors/dropify/dist/dropify.min.js') }}"></script>
	<script src="{{ asset('assets/js/dropify.js') }}"></script>
    @stack('scripts')

    <script>
            function refreshSelectBox()
            {
                $('.ajax-endpoint').each(function() {
                    var $this = $(this);
                    var endpoint = $this.data('endpoint');
                    var placeholder = $this.data('placeholder');
                    var field1 = $(this).attr('data-field1-id');
                    var field2 = $(this).data('field2-id');

                    $this.select2({
                        ajax: {
                            url: endpoint,
                            dataType: 'json',

                            data: function(params) {
                                var data = {
                                    search: params.term,
                                    field1: field1,
                                    field2: field2
                                };
                                return data;
                            },
                            processResults: function(response) {
                                return {
                                    results: response.data.map(function(item) {
                                        return { id: item.id, text: item.name };
                                    })
                                };
                            }
                        },
                        minimumInputLength: 0,
                        placeholder: placeholder,
                    });
                });
            }
    </script>
    <script>
        $(document).ready(function(){
            $("#alert").fadeTo(5000, 500).slideUp(1000, function(){
                $("#alert").slideUp(100);
            });

            $(document).on('click','.delete-record',function(){
                var route = $(this).attr('data-route');
                Swal.fire({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!"
                            }).then((result) => {
                            if (result.isConfirmed)
                            {
                                $.ajax({
                                        url: route,
                                        method: 'POST',
                                        headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success: function(response)
                                        {

                                            if(response.success == 1)
                                            {
                                                Swal.fire({
                                                        title: "Deleted!",
                                                        text: "Action has been taken successfully",
                                                        icon: "success"
                                                     });
                                                $('#dataTable').DataTable().ajax.reload();
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

            $(document).on('click','.change-status',function(){
                var route = $(this).attr('data-route');
                Swal.fire({
                            title: "Are you sure?",
                            text: "You want to change the status",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, changeit it!"
                            }).then((result) => {
                            if (result.isConfirmed)
                            {
                                $.ajax({
                                        url: route,
                                        method: 'POST',
                                        headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success: function(response)
                                        {

                                            if(response.success == 1)
                                            {
                                                Swal.fire({
                                                        title: "Changed!",
                                                        text: "Status has been changed successfully",
                                                        icon: "success"
                                                     });
                                                $('#dataTable').DataTable().ajax.reload();
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
            refreshSelectBox();
        });
    </script>


</html>
