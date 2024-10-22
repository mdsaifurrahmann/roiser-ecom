@extends('layouts.panel')

@section('title', 'Manage Size Guides')

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

    <x-panel.breadcrumb title="Manage Size Guides" page="Manage Size Guides">
        @can('create_guide')
            <x-panel.breadcrumb-action title="Add Size Guide" icon="add-circle-outline"
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
                <h5 class="mb-0">List of Size Guides</h5>
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
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="groupTableBody">

                        @foreach ($guides as $key => $guide)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $guide->name }}
                                </td>
                                
                                <td>
                                    @if ($guide->image)
                                        <img src="{{ $guide->image ? Storage::url('products/size-guides/' . $guide->image) : '' }}"
                                            alt="{{ $guide->name }}" class="object-fit-cover" width="100" height="100">
                                    @else
                                        No Guide
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        @can('update_color')
                                            <a href="javascript:void(0)" class="text-warning" data-bs-toggle="modal"
                                                data-bs-placement="bottom" title="" data-bs-original-title="Edit"
                                                aria-label="Edit" data-bs-target="#editModal"
                                                onclick="edit({{ $guide->id }})">
                                                <ion-icon name="create-outline"></ion-icon>
                                            </a>
                                        @endcan
                                        @can('delete_color')
                                            <form method="POST" action="{{ route('attributes.size.guide.delete') }}"
                                                class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" id="groupDelete"
                                                    value="{{ $guide->id }}">

                                                <button type="submit" class="text-danger bg-transparent border-0"><ion-icon
                                                        name="trash-outline"></ion-icon></button>
                                            </form>
                                        @endcan

                                        @if (auth()->user()->cannot('update_guide') && auth()->user()->cannot('delete_guide'))
                                            Actions unavailable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if ($guides->count() == 0)
                            <tr>
                                <td colspan="5" class="text-center">No Size Guides found</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <x-panel.modal id="addModal" title="Add Size Guide">

        <form action="{{ route('attributes.size.guide.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="add_name" class="form-label">Name</label>
            <input class="form-control mb-3" id="add_name" name="name" type="text" placeholder="Ex: Shirt Size Guide"
                aria-label="Guide" required>

            <label for="add_image" class="form-label">Size Guide Image</label>
            <input type="file" name="image" id="add_image" class="form-control mb-3" required>

            <div class="mt-3">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </x-panel.modal>


    <x-panel.modal id="editModal" title="Edit Size Guide">
        <form method="POST" id="guideUpdate" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" id="id">

            <label for="name" class="form-label">Name</label>
            <input class="form-control mb-3" name="name" id="name" type="text" placeholder="Ex: Purple"
                aria-label="Color" required>

            <label for="image" class="form-label">Size Guide Image</label>
            <input type="file" name="image" id="image" class="form-control mb-3" required>

            <div class="mt-3">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </x-panel.modal>

@stop


@section('scripts')

    <script>
        const guides = {!! json_encode($guides) !!};

        function edit(id) {
            // set the name value to the input
            const name = document.getElementById('name');
            const gId = document.getElementById('id');

            const form = document.getElementById('guideUpdate');

            gId.setAttribute('value', id);
            name.setAttribute('value', guides.find(guide => guide.id === id).name);

            form.setAttribute('action', "{{ route('attributes.size.guide.update', ':id') }}".replace(':id', id));

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
