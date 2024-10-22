@extends('layouts.panel')

@section('title', 'Add Product')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ Vite::asset('resources/assets/scss/products/products.scss') }}">
@stop

@section('content')

    <x-panel.breadcrumb title="Add Product" page="Add Product">
        {{-- @can('create_group') --}}
        <x-panel.breadcrumb-action title="Back to Products" icon="return-up-back-outline"
            attr='data-bs-toggle="modal" data-bs-target="#addModal"' />
        {{-- @endcan --}}
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


    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" placeholder="Product Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Details</label>
                            <div id="quill" value="{{ old('description') }}">{{ old('description') }}</div>
                            <input type="hidden" name="description" id="description">
                        </div>


                        @livewire('products.products-categories', ['product_code' => null])


                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label">Product Thumbnail <span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="thumbnail" name="thumbnail"
                                        accept="image/*" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="video_link" class="form-label">Product Video URL</label>
                                    <input type="url" class="form-control" id="video_link" name="video_link"
                                        value="{{ old('video_link') }}" placeholder="https://youtube.com/xxxx">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="default_price" class="form-label">Default Price (For All
                                        Variants)</label>
                                    <input type="number" class="form-control" id="default_price"
                                        value="{{ old('default_price') }}" name="default_price" placeholder="Default Price">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="default_sale_price" class="form-label">Default Sale Price (For All
                                        Variants)</label>
                                    <input type="number" class="form-control" id="default_sale_price"
                                        value="{{ old('default_sale_price') }}" name="default_sale_price"
                                        placeholder="Default Sale Price">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="default_stock" class="form-label">Default Stock (For All
                                        Variants)</label>
                                    <input type="number" class="form-control" id="default_stock"
                                        value="{{ old('default_stock') }}" name="default_stock"
                                        placeholder="Default stock">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="default_sku" class="form-label">Default SKU (For All Variants)</label>
                                    <input type="text" class="form-control" id="default_sku"
                                        value="{{ old('default_sku') }}" name="default_sku" placeholder="Default SKU">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body" id="variants-container">

                        @if (old('variants'))
                            @foreach (old('variants') as $index => $variant)
                                <div class="card variant" data-index="{{ $index }}">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="mb-3">
                                                    <label for="color_id_{{ $index }}"
                                                        class="form-label">Color</label>
                                                    <select class="form-select"
                                                        name="variants[{{ $index }}][color_id]"
                                                        id="color_id_{{ $index }}">
                                                        <option value="" selected>Select Color</option>
                                                        @foreach ($colors as $color)
                                                            <option value="{{ $color->id }}"
                                                                {{ $variant['color_id'] == $color->id ? 'selected' : '' }}>
                                                                {{ $color->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="mb-3">
                                                    <label for="size_id_{{ $index }}"
                                                        class="form-label">Size</label>
                                                    <select class="form-select"
                                                        name="variants[{{ $index }}][size_id]"
                                                        id="size_id_{{ $index }}">
                                                        <option value="" selected>Select Size</option>
                                                        @foreach ($sizes as $size)
                                                            <option value="{{ $size->id }}"
                                                                {{ $variant['size_id'] == $size->id ? 'selected' : '' }}>
                                                                {{ $size->size }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="mb-3">
                                                    <label for="price_{{ $index }}" class="form-label">Product
                                                        Price <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control"
                                                        name="variants[{{ $index }}][price]"
                                                        id="price_{{ $index }}" value="{{ $variant['price'] }}"
                                                        placeholder="Product Price" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="mb-3">
                                                    <label for="sale_price_{{ $index }}" class="form-label">Sale
                                                        Price</label>
                                                    <input type="number" class="form-control"
                                                        name="variants[{{ $index }}][sale_price]"
                                                        id="sale_price_{{ $index }}"
                                                        value="{{ $variant['sale_price'] }}" placeholder="Sale Price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="mb-3">
                                                    <label for="stock_{{ $index }}" class="form-label">Stock <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" class="form-control"
                                                        name="variants[{{ $index }}][stock]"
                                                        id="stock_{{ $index }}" value="{{ $variant['stock'] }}"
                                                        placeholder="Product Stock" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="mb-3">
                                                    <label for="sku_{{ $index }}" class="form-label">SKU</label>
                                                    <input type="text" class="form-control"
                                                        name="variants[{{ $index }}][sku]"
                                                        id="sku_{{ $index }}" value="{{ $variant['sku'] }}"
                                                        placeholder="SKU">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="media_{{ $index }}" class="form-label">Media (Max:
                                                        3 Files)</label>
                                                    <input type="file" class="form-control filepond media-input"
                                                        id="media_{{ $index }}"
                                                        name="variants[{{ $index }}][media][]" accept="image/*"
                                                        data-allow-reorder="true" data-max-files="3" multiple>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-danger me-3 remove-variant">
                                                <ion-icon name="trash-bin-outline"></ion-icon> Remove This Variant
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Template for a variant item -->
                            <div class="card variant" data-index="0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="color_id_0" class="form-label">Color</label>
                                                <select class="form-select color-select" name="variants[0][color_id]"
                                                    id="color_id_0">
                                                    <option value="" selected>Select Color</option>
                                                    @foreach ($colors as $color)
                                                        <option value="{{ $color->id }}"
                                                            {{ old('variants[0][color_id]') == $color->id ? 'selected' : '' }}>
                                                            {{ $color->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="size_id_0" class="form-label">Size</label>
                                                <select class="form-select size-select" name="variants[0][size_id]"
                                                    id="size_id_0">
                                                    <option value="" selected>Select Size</option>
                                                    @foreach ($sizes as $size)
                                                        <option value="{{ $size->id }}"
                                                            {{ old('size_id') == $size->id ? 'selected' : '' }}>
                                                            {{ $size->size }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="price_0" class="form-label">Product Price <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" class="form-control price-input"
                                                    name="variants[0][price]" id="price_0" placeholder="Product Price"
                                                    value="{{ old('[price]') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="sale_price_0" class="form-label">Sale Price</label>
                                                <input type="number" class="form-control sale-price-input"
                                                    name="variants[0][sale_price]" id="sale_price_0"
                                                    placeholder="Sale Price">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="stock_0" class="form-label">Stock <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" class="form-control stock-input"
                                                    name="variants[0][stock]" id="stock_0" placeholder="Product Stock"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="sku_0" class="form-label">SKU</label>
                                                <input type="text" class="form-control sku-input"
                                                    name="variants[0][sku]" id="sku_0" placeholder="SKU">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="media_0" class="form-label">Media (Max: 3 Files)</label>
                                                <input type="file" class="form-control media-input"
                                                    id="media_0" name="variants[0][media][]" accept="image/*"
                                                     multiple>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-danger me-3 remove-variant">
                                            <ion-icon name="trash-bin-outline"></ion-icon> Remove This Variant
                                        </button>
                                    </div>
                                </div>
                            </div>

                        @endif

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary add-variant">
                                <ion-icon name="add-circle-outline"></ion-icon> Add Variant
                            </button>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-12 col-md-4">
                <div class="d-flex flex-column">
                    <div class="card order-md-0 order-last">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    {{-- <h6 class="card-title">Product Status</h6> --}}
                                    <label class="form-label" for="status">Status <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select mb-3" name="status" id="status">
                                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Draft
                                        </option>
                                        <option value="1" selected>Publish</option>
                                    </select>

                                    <label class="form-label" for="size_guide">Select Size Guide</label>
                                    <select class="form-select mb-3" name="size_guide" id="size_guide">
                                        <option value="" selected>Select Size Guide</option>
                                        @foreach ($guides as $guide)
                                            <option value="{{ $guide->id }}"
                                                {{ old('size_guide') == $guide->id ? 'selected' : '' }}>
                                                {{ $guide->name }}</option>
                                        @endforeach
                                    </select>


                                    <label class="form-label mb-3">
                                        Creating by: <span class="fw-bold text-info">
                                            {{ strtoupper(Auth::user()->name) }} </span>
                                    </label>

                                    <label class="form-label mb-3">
                                        Creating at: <span class="fw-bold text-info"> {{ Carbon\Carbon::now() }}
                                        </span>
                                    </label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <button type="reset" class="btn btn-outline-secondary w-100">Reset</button>
                                </div>
                                <div class="col-12 col-md-6 mt-3 mt-md-0">
                                    <button type="submit" class="btn btn-primary w-100">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card oder-1">
                        <div class="card-body">
                            <h6 class="card-title">Thumbnail Preview</h6>
                            <div class="row">
                                {{-- <p class="text-center mt-3">Loading...</p> --}}

                                <div class="col-12 mb-3">
                                    <img id="thumbnail_img" src="" alt="" class="w-100 rounded">
                                </div>

                                <p id="no_thumbnail_text" class="text-center mt-3">No Thumbnail
                                    Selected</p>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </form>


    {{-- @livewire('products-store') --}}

    @livewireScripts

@stop


@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="{{ Vite::asset('resources/assets/js/products.js') }}"></script>

@stop
