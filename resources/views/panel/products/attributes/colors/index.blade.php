@extends('layouts.panel')

@section('title', 'Manage Colors')

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

    <x-panel.breadcrumb title="Manage Colors" page="Manage Colors">
        @can('create_color')
            <x-panel.breadcrumb-action title="Add Color" icon="add-circle-outline"
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
                <h5 class="mb-0">List of Colors</h5>
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
                            <th>Code</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="groupTableBody">

                        @foreach ($colors as $key => $color)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $color->name }}
                                </td>
                                <td>
                                    @if ($color->code)
                                        <div class="d-flex align-items-center">
                                            <div class="me-2" title="{{ $color->name }}"
                                                style="background-color: {{ $color->code }}; width: 1rem; height: 1rem; border-radius: 50%;">
                                            </div>
                                            <div>
                                                {{ '(' . $color->code . ')' }}
                                            </div>
                                        </div>
                                    @else
                                        No code
                                    @endif

                                </td>
                                <td>
                                    @if ($color->image)
                                        <img src="{{ $color->image ? Storage::url('products/colors/' . $color->image) : '' }}"
                                            alt="{{ $color->name }}" class="rounded-circle object-fit-cover" height="16"
                                            width="16">
                                    @else
                                        No image
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        @can('update_color')
                                            <a href="javascript:void(0)" class="text-warning" data-bs-toggle="modal"
                                                data-bs-placement="bottom" title="" data-bs-original-title="Edit"
                                                aria-label="Edit" data-bs-target="#editModal"
                                                onclick="edit({{ $color->id }})">
                                                <ion-icon name="create-outline"></ion-icon>
                                            </a>
                                        @endcan
                                        @can('delete_color')
                                            <form method="POST" action="{{ route('attributes.color.delete') }}"
                                                class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" id="groupDelete"
                                                    value="{{ $color->id }}">

                                                <button type="submit" class="text-danger bg-transparent border-0"><ion-icon
                                                        name="trash-outline"></ion-icon></button>
                                            </form>
                                        @endcan

                                        @if (auth()->user()->cannot('update_color') && auth()->user()->cannot('delete_color'))
                                            Actions unavailable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if ($colors->count() == 0)
                            <tr>
                                <td colspan="5" class="text-center">No Colors found</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <x-panel.modal id="addModal" title="Add Color">

        <form action="{{ route('attributes.color.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="add_name" class="form-label">Name</label>
            <input class="form-control mb-3" id="add_name" name="name" type="text" placeholder="Ex: Purple"
                aria-label="Color" required>

            <label for="add_code" class="form-label">Color Code</label>
            <input type="text" name="code" id="add_code" class="form-control mb-3"
                placeholder="Ex: #000000 or rgb(0,0,0)">

            <label for="add_image" class="form-label">Image (Resolution: 16x16px)</label>
            <input type="file" name="image" id="add_image" class="form-control mb-3">

            <div class="mt-3">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </x-panel.modal>


    <x-panel.modal id="editModal" title="Edit Color">
        <form method="POST" id="colorUpdate" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" id="id">

            <label for="name" class="form-label">Name</label>
            <input class="form-control mb-3" name="name" id="name" type="text" placeholder="Ex: Purple"
                aria-label="Color" required>

            <label for="code" class="form-label">Color Code</label>
            <input type="text" name="code" id="code" class="form-control mb-3" placeholder="Ex: #000000">

            <label for="image" class="form-label">Image (Resolution: 16x16px)</label>
            <input type="file" name="image" class="form-control mb-3">

            <input type="checkbox" class="form-check-input me-2" name="remove_image" id="remove_image">
            <label for="remove_image" class="form-label">Remove Image</label>

            <div class="mt-3">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </x-panel.modal>

@stop


@section('scripts')

    <script>
        const colors = {!! json_encode($colors) !!};

        function edit(id) {
            // set the name value to the input
            const name = document.getElementById('name');
            const gId = document.getElementById('id');
            const code = document.getElementById('code');

            const form = document.getElementById('colorUpdate');

            gId.setAttribute('value', id);
            name.setAttribute('value', colors.find(color => color.id === id).name);
            code.setAttribute('value', colors.find(color => color.id === id).code);

            form.setAttribute('action', "{{ route('attributes.color.update', ':id') }}".replace(':id', id));

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
