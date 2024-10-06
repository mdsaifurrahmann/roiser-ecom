@extends('layouts.panel')

@section('title', 'Users')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/notifications/css/lobibox.min.css') }}" />
    <style>
        html.dark-theme .table thead tr th {
            color: var(--bs-table-bg) !important;
            background-color: inherit !important;
        }

        /*.table thead tr th {*/
        /*    color: #000 !important;*/
        /*    background-color: inherit !important;*/
        /*}*/

        @media (prefers-color-scheme: dark) {
            .table thead tr th {
                color: var(--bs-table-bg) !important;
                background-color: inherit !important;
            }
        }

        @media (prefers-color-scheme: light) {
            .table thead tr th {
                color: inherit;
                background-color: inherit;
            }
        }
    </style>
@stop

@section('content')

    <x-panel.breadcrumb title="Users" page="Users">
        <x-panel.breadcrumb-action title="Add User" icon="add-circle-outline"
            attr='data-bs-toggle="modal" data-bs-target="#addModal"'>
        </x-panel.breadcrumb-action>
    </x-panel.breadcrumb>

    <div class="d-flex align-items-center">
        <h5 class="mb-0">List of Users</h5>
        <form class="ms-auto position-relative">
            <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                <ion-icon name="search-sharp"></ion-icon>
            </div>
            <input class="form-control ps-5" type="text" placeholder="Search" id="searchInput"
                onkeyup="searchPermissions()">
        </form>
    </div>

    <div class="table-responsive mt-4">
        <table class="table align-middle">
            <thead class="table-secondary">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="usersTableBody">

                @foreach ($users as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ? $user->phone : 'N/A' }}</td>
                        <td>{{ $user->getRoleNames()->first() ? $user->getRoleNames()->first() : 'N/A' }}</td>
                        <td>{{ $user->status == 1 ? 'Active' : 'Suspended' }}</td>
                        <td>
                            <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                {{-- @can('update_permission') --}}
                                <a href="javascript:void(0)" class="text-warning" data-bs-toggle="modal"
                                    data-bs-placement="bottom" title="" data-bs-original-title="Edit"
                                    aria-label="Edit" data-bs-target="#editModal" onclick="edit({{ $user->id }})">
                                    <ion-icon name="create-outline"></ion-icon>
                                </a>
                                {{-- @endcan --}}

                                {{-- @can('delete_permission') --}}
                                <form method="POST" action="{{ route('users.delete') }}" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $user->id }}">

                                    <button type="submit" class="text-danger bg-transparent border-0"><ion-icon
                                            name="trash-outline"></ion-icon></button>
                                </form>
                                {{-- @endcan --}}

                                {{-- @cannot('update_permission' || 'delete_permission')
                               Actions unavailable
                            @endcannot --}}
                            </div>
                        </td>
                    </tr>
                @endforeach

                @if ($users->count() == 0)
                    <tr>
                        <td colspan="4" class="text-center">No Users found</td>

                    </tr>
                @endif

            </tbody>
        </table>

        {{ $users->links('vendor.pagination.bootstrap-5') }}
    </div>



    {{-- add modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="name" class="form-label">Full Name</label>
                        <input class="form-control mb-2" name="name" id="name" type="text" placeholder="Alex"
                            aria-label="Alex" required>

                        <label for="email" class="form-label">Email</label>
                        <input class="form-control mb-2" name="email" id="email" type="email"
                            placeholder="example@ex.com" aria-label="Email" required>

                        <label for="password" class="form-label">Password</label>
                        <input class="form-control mb-2" name="password" id="password" type="password"
                            placeholder="**********" aria-label="Password" required>

                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input class="form-control mb-2" name="password_confirmation" id="password_confirmation"
                            type="password" placeholder="**********" aria-label="Confirm Password" required>

                        <label for="phone" class="form-label">Phone Number</label>
                        <input class="form-control mb-2" name="phone" id="phone" type="text"
                            placeholder="+8801999999999" aria-label="Phone" required>

                        <label for="profile_image" class="form-label">Profile Image (Max: 2MB)</label>
                        <input class="form-control mb-2" id="profile_image" name="profile_image" type="file">

                        <label for="role" class="form-label">User Role</label>
                        <select class="form-select mb-2" id="role" name="role" required>
                            <option selected disabled>Select User Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>

                        <label for="status" class="form-label">Status</label>
                        <select class="form-select mb-2" id="status" name="status" required>
                            <option selected disabled>Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Suspended</option>
                        </select>

                        <div class="mt-3">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')

    <script>
        function searchPermissions() {
            // Get the search input
            var input = document.getElementById('searchInput');
            var filter = input.value.toLowerCase();

            // Get the table body and all rows
            var tableBody = document.getElementById('usersTableBody');
            var rows = tableBody.getElementsByTagName('tr');

            // Loop through all rows, and hide those that don't match the search query
            for (var i = 0; i < rows.length; i++) {
                // get all columns
                var name = rows[i].getElementsByTagName('td')[1]; // Get the second column (Name)
                var email = rows[i].getElementsByTagName('td')[2]; // Get the second column (Name)
                var phone = rows[i].getElementsByTagName('td')[3]; // Get the second column (Name)
                if (name || email) {
                    var txtValue = name.textContent || name.innerText;
                    var emValue = email.textContent || email.innerText;
                    var phValue = phone.textContent || phone.innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1 || emValue.toLowerCase().indexOf(filter) > -1 || phValue
                        .toLowerCase().indexOf(filter) > -1) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            }
        }
    </script>

    <script src="{{ asset('assets/plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/notifications/js/notifications.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/notifications/js/notification-custom-script.js') }}"></script>

    @if (Session::has('success') || Session::has('error'))
        <script>
            window.onload = function() {
                pos1_default_noti();
            }

            function pos1_default_noti() {
                Lobibox.notify('default', {
                    rounded: true,
                    icon: '{{ Session::has('success') ? 'bx bx-check-circle' : 'bx bx-error' }}',
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    position: 'center top',
                    size: 'mini',
                    msg: "{{ Session::has('success') ? Session::get('success') : Session::get('error') }}"
                });
            }
        </script>
    @endif

@stop