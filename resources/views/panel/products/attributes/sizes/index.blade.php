@extends('layouts.panel')

@section('title', 'Manage Sizes')

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

    <x-panel.breadcrumb title="Manage Sizes" page="Manage Sizes">
        @can('create_size')
            <x-panel.breadcrumb-action title="Add Size" icon="add-circle-outline"
                attr='data-bs-toggle="modal" data-bs-target="#addModal"' />
        @endcan
    </x-panel.breadcrumb>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <div class="d-flex align-items-center">
                <h5 class="mb-0">List of Sizes</h5>
                <form class="ms-auto position-relative">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                        <ion-icon name="search-sharp"></ion-icon>
                    </div>
                    <input class="form-control ps-5" type="text" placeholder="Search" id="searchInput"
                        onkeyup="searchGroups()">
                </form>
            </div>
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="groupTableBody">

                        @foreach ($sizes as $key => $size)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $size->size }}</td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        @can('update_size')
                                            <a href="javascript:void(0)" class="text-warning" data-bs-toggle="modal"
                                                data-bs-placement="bottom" title="" data-bs-original-title="Edit"
                                                aria-label="Edit" data-bs-target="#editModal"
                                                onclick="edit({{ $size->id }})">
                                                <ion-icon name="create-outline"></ion-icon>
                                            </a>
                                        @endcan
                                        @can('delete_size')
                                            <form method="POST" action="{{ route('attributes.size.delete') }}"
                                                class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" id="groupDelete"
                                                    value="{{ $size->id }}">

                                                <button type="submit" class="text-danger bg-transparent border-0"><ion-icon
                                                        name="trash-outline"></ion-icon></button>
                                            </form>
                                        @endcan

                                        @if (auth()->user()->cannot('update_size') && auth()->user()->cannot('delete_size'))
                                            Actions unavailable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if ($sizes->count() == 0)
                            <tr>
                                <td colspan="3" class="text-center">No Size found</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <x-panel.modal id="addModal" title="Add Size">

        <form action="{{ route('attributes.size.store') }}" method="POST">
            @csrf

            <label for="add_size" class="form-label">Size</label>
            <input class="form-control mb-3" id="add_size" name="size" type="text" placeholder="Ex: 3XL"
                aria-label="Size" required>

            <div class="mt-3">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </x-panel.modal>


    <x-panel.modal id="editModal" title="Edit Size">
        <form method="POST" id="sizeUpdate">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" id="id">

            <label for="size" class="form-label">Size</label>
            <input class="form-control mb-3" name="size" id="size" type="text" placeholder="Ex: 3XL"
                aria-label="Color" required>

            <div class="mt-3">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </x-panel.modal>

@stop


@section('scripts')

    <script>
        const sizes = {!! json_encode($sizes) !!};

        function edit(id) {
            // set the name value to the input
            const size = document.getElementById('size');
            const gId = document.getElementById('id');

            const form = document.getElementById('sizeUpdate');

            gId.setAttribute('value', id);
            size.setAttribute('value', sizes.find(size => size.id === id).size);

            form.setAttribute('action', "{{ route('attributes.size.update', ':id') }}".replace(':id', id));

        }

        function searchGroups() {
            // Get the search input
            var input = document.getElementById('searchInput');
            var filter = input.value.toLowerCase();

            // Get the table body and all rows
            var tableBody = document.getElementById('groupTableBody');
            var rows = tableBody.getElementsByTagName('tr');

            // Loop through all rows, and hide those that don't match the search query
            for (var i = 0; i < rows.length; i++) {
                var td = rows[i].getElementsByTagName('td')[1]; // Get the second column (Name)
                if (td) {
                    var txtValue = td.textContent || td.innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
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

    @if (Session::has('success'))
        <script>
            window.onload = function() {
                pos1_default_noti();
            }

            function pos1_default_noti() {
                Lobibox.notify('default', {
                    rounded: true,
                    icon: 'bx bx-check-circle',
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    position: 'center top',
                    size: 'mini',
                    msg: "{{ Session::get('success') }}"
                });
            }
        </script>
    @endif

@stop
