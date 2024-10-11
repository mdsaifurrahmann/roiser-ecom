@extends('layouts.panel')

@section('title', 'Product Sub Categories')

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

    <x-panel.breadcrumb title="Product Sub Categories" page="Product Sub Categories">
        {{-- @can('create_group') --}}
        <x-panel.breadcrumb-action title="Add Sub Category" icon="add-circle-outline"
                                   attr='data-bs-toggle="modal" data-bs-target="#addModal"'/>
        {{-- @endcan --}}
    </x-panel.breadcrumb>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif


    <div class="card">
        <div class="card-body">

            <div class="d-flex align-items-center">
                <h5 class="mb-0">List of Sub Categories</h5>
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
                        <th>Image</th>
                        <th>Name</th>
                        <th>Parent Category</th>
                        <th>Discount (Unit)</th>
                        <th>Visibility</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id="groupTableBody">

                    @foreach ($categories as $key => $category)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><img src="{{ $category->image ? Storage::url('products/categories/'. $category->image) : asset
                            ('assets/images/error/404.png')}}" alt="{{$category->name}}"
                                     class="rounded-circle object-fit-cover" height="50" width="50"></td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->parentCategories->name }}</td>
                            <td>{{ $category->discount }} {{ $category->discount_type == 'percentage' ? '%' : ($category->discount_type ==
                             'fixed' ? 'BDT' : '') }}</td>
                            <td>{{ $category->visibility == 1 ? 'Visible' : 'Hidden' }}</td>
                            <td>{{ $category->status == 1 ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    @can('update_sub_category')
                                        <a href="javascript:void(0)" class="text-warning" data-bs-toggle="modal"
                                           data-bs-placement="bottom" title="" data-bs-original-title="Edit"
                                           aria-label="Edit" data-bs-target="#editModal"
                                           onclick="edit({{ $category->id }})">
                                            <ion-icon name="create-outline"></ion-icon>
                                        </a>
                                    @endcan
                                    @can('delete_sub_category')
                                        <form method="POST" action="{{ route('products.category.delete') }}" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" id="groupDelete"
                                                   value="{{ $category->id }}">

                                            <button type="submit" class="text-danger bg-transparent border-0">
                                                <ion-icon
                                                        name="trash-outline"></ion-icon>
                                            </button>
                                        </form>
                                    @endcan

                                    @if (auth()->user()->cannot('update_sub_category') && auth()->user()->cannot('delete_sub_category'))
                                        Actions unavailable
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if ($categories->count() == 0)
                        <tr>
                            <td colspan="9" class="text-center">No Categories found</td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('products.sub.category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="add_name" class="form-label">Category Name</label>
                        <input class="form-control mb-3" id="add_name" name="name" type="text" placeholder="Ex: T-Shirt"
                               aria-label="Product Category" required>

                        <label for="add_parent_id" class="form-label">Parent Category</label>
                        <select name="parent_id" id="add_parent_id" class="form-select mb-3" required>
                            <option value="" selected disabled>Select Parent Category</option>
                            @foreach ($parentCategories as $parentCategory)
                                <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                            @endforeach
                        </select>

                        <label for="add_discount" class="form-label">Discount</label>
                        <input type="number" name="discount" id="add_discount" class="form-control mb-3" value="0" placeholder="10">

                        <label for="add_discount_type" class="form-label">Discount Type</label>
                        <select name="discount_type" id="add_discount_type" class="form-select mb-3">
                            <option value="percentage">Percentage</option>
                            <option value="fixed">Fixed</option>
                        </select>

                        <label for="image">Banner/Poster/Image</label>
                        <input type="file" name="image" id="add_image" class="form-control mb-3">


                        <label for="add_visibility" class="form-label">Visibility</label>
                        <select name="visibility" id="add_visibility" class="form-select mb-3">
                            <option value="" disabled selected>Select Visibility</option>
                            <option value="1">Visible</option>
                            <option value="0">Invisible</option>

                        </select>

                        <label for="add_status">Status</label>
                        <select name="status" id="add_status" class="form-select mb-3">
                            <option value="" disabled selected>Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>

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


    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Sub Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form method="POST" id="groupUpdate" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="parent_id" id="p_id">

                        <label for="name" class="form-label">Category Name</label>
                        <input class="form-control mb-3" id="name" name="name" type="text" placeholder="Ex: T-Shirt"
                               aria-label="Product Category" required>

                        <label for="parent_id" class="form-label">Parent Category</label>
                        <select name="parent_id" id="parent_id" class="form-select mb-3" required>
                            <option value="" selected disabled>Select Parent Category</option>
                            @foreach ($parentCategories as $parentCategory)
                                <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                            @endforeach
                        </select>

                        <label for="discount" class="form-label">Discount</label>
                        <input type="number" name="discount" id="discount" class="form-control mb-3" value="0" placeholder="10">

                        <label for="discount_type" class="form-label">Discount Type</label>
                        <select name="discount_type" id="discount_type" class="form-select mb-3">
                            <option value="percentage">Percentage</option>
                            <option value="fixed">Fixed</option>
                        </select>

                        <label for="image">Banner/Poster/Image</label>
                        <input type="file" name="image" id="image" class="form-control mb-3">


                        <label for="visibility" class="form-label">Visibility</label>
                        <select name="visibility" id="visibility" class="form-select mb-3">
                            <option value="">Select Visibility</option>
                            <option value="1">Visible</option>
                            <option value="0">Hidden</option>

                        </select>

                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select mb-3">
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>

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
        const categories = {!! json_encode($categories) !!};

        let i = 0;

        function edit(id) {
            // set the name value to the input
            const name = document.getElementById('name');
            const gId = document.getElementById('id');
            const discount = document.getElementById('discount');
            const discountType = document.getElementById('discount_type').options;
            const parentCat = document.getElementById('parent_id').options;
            const visibility = document.getElementById('visibility').options;
            const status = document.getElementById('status').options;

            const form = document.getElementById('groupUpdate');

            const selectedCategory = categories.find(category => category.id === id);

            const visibilityValue = selectedCategory.visibility ? 1 : 0;
            const statusValue = selectedCategory.status ? 1 : 0;

            gId.setAttribute('value', id);
            name.setAttribute('value', selectedCategory.name);
            discount.setAttribute('value', selectedCategory.discount);

            for (i; i < discountType.length; i++) {
                if (discountType[i].value === selectedCategory.discount_type) {
                    discountType[i].selected = true;
                    break;
                }
            }

            for (i; i < parentCat.length; i++) {
                if (parseInt(parentCat[i].value) === selectedCategory.parent_id) {
                    parentCat[i].selected = true;
                    break;
                }
            }


            for (i; i < visibility.length; i++) {
                if (parseInt(visibility[i].value) === visibilityValue) {
                    visibility[i].selected = true;
                    break;
                }
            }

            for (i; i < status.length; i++) {
                if (parseInt(status[i].value) === statusValue) {
                    status[i].selected = true;
                    break;
                }
            }


            form.setAttribute('action', "{{ route('products.sub.category.update', ':id') }}".replace(':id', id));

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
                var td = rows[i].getElementsByTagName('td')[2]; // Get the second column (Name)
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
