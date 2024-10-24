@extends('layouts.panel')

@section('title', 'Edit Stock')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/notifications/css/lobibox.min.css') }}"/>
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

    <x-panel.breadcrumb title="Edit Stocks" page="Edit Stocks">
        <x-panel.breadcrumb-action title="Back to Stocks" icon="return-up-back-outline" attr='id="manageStock"'/>
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
                <h5 class="mb-0"><span class="fw-light">Product Name:</span> {{ $product[0]->name }}</h5>
                <form class="ms-auto position-relative">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                        <ion-icon name="search-sharp"></ion-icon>
                    </div>
                    <input class="form-control ps-5" type="text" placeholder="Search" id="searchInput"
                           onkeyup="searchGroups()">
                </form>
            </div>

            <form action="{{route('products.stock.update')}}" method="POST">

                @csrf
                @method('PATCH')

                <div class="table-responsive mt-4">
                    <table class="table align-middle">
                        <thead class="table-secondary">
                        <tr>
                            <th>#</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Sale Price</th>
                        </tr>
                        </thead>
                        <tbody id="productTableBody">

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <input type="number" class="form-control" data-bs-toggle="tooltip"
                                       data-bs-placement="bottom" title="Enter stock number to update all stocks."
                                       data-bs-original-title="tooltip"
                                       aria-label="tooltip" id="default_stock" placeholder="Default Stock">
                            </td>

                            <td>
                                <input type="number" class="form-control" data-bs-toggle="tooltip"
                                       data-bs-placement="bottom" title="Enter Price to update all prices."
                                       data-bs-original-title="tooltip"
                                       aria-label="tooltip" id="default_price" placeholder="Default Price">
                            </td>
                            <td>
                                <input type="number" class="form-control" data-bs-toggle="tooltip"
                                       data-bs-placement="bottom" title="Enter Sale Price to update all Sale Prices."
                                       data-bs-original-title="tooltip"
                                       aria-label="tooltip" id="default_sale_price" placeholder="Default Sale Price">
                            </td>
                        </tr>

                        @foreach ($product[0]->variants as $key => $variant)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $variant->color->name ?? 'N/A' }}</td>
                                <td>{{ $variant->size->size ?? 'N/A' }}</td>
                                <td>
                                    <input type="hidden" name="variants[{{$variant->id}}][id]" value="{{ $variant->id }}">
                                    <input type="number" class="form-control stock-input" name="variants[{{$variant->id}}][stock]"
                                           value="{{
                                    $variant->stock
                                    }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control price-input" name="variants[{{$variant->id}}][price]"
                                           value="{{
                                    $variant->price
                                    }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control sale-price-input" name="variants[{{$variant->id}}][sale_price]"
                                           value="{{
                                    $variant->sale_price
                                    }}">
                                </td>
                            </tr>
                        @endforeach

                        @if ($product[0]->variants->count() == 0)
                            <tr>
                                <td colspan="6" class="text-center">No Variants found</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>


                <div class="mt-2 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>

            </form>
        </div>
    </div>

@stop


@section('scripts')

    <script>
        function searchGroups() {
            // Get the search input
            var input = document.getElementById('searchInput');
            var filter = input.value.toLowerCase();

            // Get the table body and all rows
            var tableBody = document.getElementById('productTableBody');
            var rows = tableBody.getElementsByTagName('tr');

            // Loop through all rows, and hide those that don't match the search query
            for (var i = 0; i < rows.length; i++) {
                var td0 = rows[i].getElementsByTagName('td')[1]; // Get the second column (Name)
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

        document.addEventListener('DOMContentLoaded', function () {
            const defaultStock = document.getElementById('default_stock');
            const defaultPrice = document.getElementById('default_price');
            const defaultSalePrice = document.getElementById('default_sale_price');

            // Update stock for all variants when the default stock changes
            defaultStock.addEventListener('input', function () {
                const stockInputs = document.querySelectorAll('.stock-input');
                stockInputs.forEach(function (input) {
                    input.value = defaultStock.value;
                });
            });

            // Update price for all variants when the default price changes
            defaultPrice.addEventListener('input', function () {
                const priceInputs = document.querySelectorAll('.price-input');
                priceInputs.forEach(function (input) {
                    input.value = defaultPrice.value;
                });
            });

            // Update sale price for all variants when the default sale price changes
            defaultSalePrice.addEventListener('input', function () {
                const salePriceInputs = document.querySelectorAll('.sale-price-input');
                salePriceInputs.forEach(function (input) {
                    input.value = defaultSalePrice.value;
                });
            });
        });

        document.getElementById('manageStock').addEventListener('click', function () {
            window.location.href = '{{ route('products.stock.index') }}';
        });
    </script>

    <script src="{{ asset('assets/plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/notifications/js/notifications.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/notifications/js/notification-custom-script.js') }}"></script>

    @if (Session::has('success'))
        <script>
            window.onload = function () {
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
