@extends('layouts.panel')

@section('title', 'Manage Products')

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

    <x-panel.breadcrumb title="Add Product" page="Add Product">

        <x-panel.breadcrumb-action title="Add Product" icon="add-circle-outline" attr='id="addProduct"'>
        </x-panel.breadcrumb-action>
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

    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <div class="d-flex align-items-center">
                <h5 class="mb-0">List of Products</h5>
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
                            <th>Product Code</th>
                            <th>Thumbnail</th>
                            <th>Product Name</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">

                        @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ $product->product_code }}</td>
                                <td>
                                    @if ($product->thumbnail && Storage::disk('public')->exists('products/media/' . $product->thumbnail))
                                        <img src="{{ $product->thumbnail ? Storage::url('products/media/' . $product->thumbnail) : '' }}"
                                            alt="{{ $product->name }}" class="rounded-circle object-fit-cover"
                                            height="64" width="64">
                                    @else
                                        <img src="{{ asset('assets/images/error/404.png') }}" alt="{{ $product->name }}"
                                            class="rounded-circle object-fit-cover" height="64" width="64">
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->status == 1 ? 'Published' : 'Draft' }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->subCategory->name }}</td>
                                <td>{{ strtoupper($product->user->name) }} </td>


                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        @can('update_color')
                                            <a href="{{ route('products.edit', $product->product_code) }}" class="text-warning"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                                data-bs-original-title="Edit" aria-label="Edit"
                                                onclick="edit({{ $product->id }})">
                                                <ion-icon name="create-outline"></ion-icon>
                                            </a>
                                        @endcan
                                        @can('delete_color')
                                            <form method="POST" action="{{ route('products.delete') }}" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $product->id }}">

                                                <button type="submit" class="text-danger bg-transparent border-0"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                                    data-bs-original-title="Delete" aria-label="Delete"><ion-icon
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

                        @if ($products->count() == 0)
                            <tr>
                                <td colspan="8" class="text-center">No Products found</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop


@section('scripts')

    <script>
        /*
                                                                    const products = {!! json_encode($products) !!};

                                                                    console.log(products);

                                                                    */

        function searchGroups() {
            // Get the search input
            var input = document.getElementById('searchInput');
            var filter = input.value.toLowerCase();

            // Get the table body and all rows
            var tableBody = document.getElementById('productTableBody');
            var rows = tableBody.getElementsByTagName('tr');

            // Loop through all rows, and hide those that don't match the search query
            for (var i = 0; i < rows.length; i++) {
                var td0 = rows[i].getElementsByTagName('td')[0]; // Get the second column (Name)
                var td2 = rows[i].getElementsByTagName('td')[2]; // Get the second column (Name)
                // Initialize a variable to hold the combined text value
                var txtValue = '';

                // Check if both td0 and td2 exist before accessing their text
                if (td0) {
                    txtValue += td0.textContent || td0.innerText; // Add Product Code text
                }
                if (td2) {
                    txtValue += ' ' + (td2.textContent || td2.innerText); // Add Product Name text
                }

                // Show or hide the row based on the search input
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }

        document.getElementById('addProduct').addEventListener('click', function() {
            window.location.href = '{{ route('products.create') }}';
        });
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
