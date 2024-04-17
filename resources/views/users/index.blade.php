<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Users') }}"></x-page-heading>
        <x-right-side-button link="{{ route('users.create') }}" title="Create"></x-right-side-button>
        <x-alert></x-alert>
        <div class="container-fluid card mt-3">
            <div class="row card-body">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="table-responsive">
                        <table id="dataTable" class="table">
                          <thead>
                            <tr>
                              <th>User Name</th>
                              <th>Email</th>
                              <th>User Type</th>
                              <th>Date of Birth</th>
                              <th>Contact Number</th>
                              <th>Gender</th>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route("users.getUserData") }}',
                    columns: [
                        { data: 'username', name: 'username' },
                        { data: 'email', name: 'email' },
                        { data: 'usertype', name: 'usertype' },
                        { data: 'date_of_birth', name: 'date_of_birth' },
                        { data: 'contact_number', name: 'contact_number' },
                        { data: 'gender', name: 'gender' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>
