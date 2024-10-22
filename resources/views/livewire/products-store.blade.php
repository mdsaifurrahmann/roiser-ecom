<div>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div wire:ignore class="mb-3">
                            <label for="name" class="form-label">Product Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" placeholder="Product Name" required>
                        </div>
                        <div wire:ignore class="mb-3">
                            <label for="quill" class="form-label">Product Details</label>
                            <div id="quill" value="{{ old('description') }}">{{ old('description') }}</div>
                            <input type="hidden" name="description" id="description">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category <span
                                            class="text-danger">*</span></label>
                                    <select wire:model.live="selectedParent" class="form-select" name="category_id"
                                        id="category_id">
                                        <option selected value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if (old('category_id') == $category->id) selected @endif>{{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="sub_category_id" class="form-label">Sub Category</label>
                                    <select wire:model="selectedSubCategory" class="form-select" name="sub_category_id"
                                        id="sub_category_id">
                                        <option selected value="">Select Sub Category</option>
                                        @foreach ($subCategories as $subCategory)
                                            <option value="{{ $subCategory->id }}"
                                                @if (old('sub_category_id') == $subCategory->id) selected @endif>
                                                {{ $subCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label">Product Thumbnail <span
                                            class="text-danger">*</span></label>
                                    <input wire:model="image" type="file" class="form-control" id="thumbnail"
                                        name="thumbnail" accept="image/*" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div wire:ignore class="mb-3">
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
                                    <input wire:model.live="defaultPrice" type="number" class="form-control"
                                        id="default_price" value="{{ old('default_price') }}"
                                        placeholder="Default Price">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="default_sale_price" class="form-label">Default Sale Price (For All
                                        Variants)</label>
                                    <input wire:model.live="defaultSalePrice" type="number" class="form-control"
                                        id="default_sale_price" value="{{ old('default_sale_price') }}"
                                        placeholder="Default Sale Price">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="default_stock" class="form-label">Default Stock (For All
                                        Variants)</label>
                                    <input wire:model.live="defaultStock" type="number" class="form-control"
                                        id="default_stock" value="{{ old('default_stock') }}"
                                        placeholder="Default stock">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="default_sku" class="form-label">Default SKU (For All Variants)</label>
                                    <input wire:model.live="defaultSku" type="text" class="form-control"
                                        id="default_sku" value="{{ old('default_sku') }}" placeholder="Default SKU">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                        @foreach ($variants as $key => $variant)
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="color_id{{ $key }}"
                                                    class="form-label">Color</label>
                                                <select wire:model="variants.{{ $key }}.color_id"
                                                    class="form-select"
                                                    name="variants[{{ $key }}][color_id]"
                                                    id="color_id{{ $key }}">
                                                    <option value="" selected>Select Color</option>
                                                    @foreach ($colors as $color)
                                                        <option value="{{ $color->id }}"
                                                            @if (old('variants[{{ $key }}][color_id]') == $color->id) selected @endif>
                                                            {{ $color->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="size_id{{ $key }}"
                                                    class="form-label">Size</label>
                                                <select wire:model="variants.{{ $key }}.size_id"
                                                    class="form-select" name="variants[{{ $key }}][size_id]"
                                                    id="size_id{{ $key }}">
                                                    <option value="" selected>Select Size</option>
                                                    @foreach ($sizes as $size)
                                                        <option value="{{ $size->id }}"
                                                            @if (old('variants[{{ $key }}][size_id]') == $size->id) selected @endif>
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
                                                <label for="price{{ $key }}" class="form-label">Product
                                                    Price <span class="text-danger">*</span></label>
                                                <input wire:model="variants.{{ $key }}.price"
                                                    wire:debounce.200ms="overridePrice({{ $key }}, 'price')"
                                                    type="number" class="form-control"
                                                    id="price{{ $key }}"
                                                    name="variants[{{ $key }}][price]"
                                                    placeholder="Product Price"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="sale_price{{ $key }}" class="form-label">Sale
                                                    Price</label>
                                                <input wire:model="variants.{{ $key }}.sale_price"
                                                    wire:debounce.200ms="overrideSalePrice({{ $key }},'sale_price')"
                                                    type="number" class="form-control"
                                                    id="sale_price{{ $key }}"
                                                    name="variants[{{ $key }}][sale_price]" value=""
                                                    placeholder="Sale Price">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="stock{{ $key }}" class="form-label">Stock <span
                                                        class="text-danger">*</span></label>
                                                <input wire:model="variants.{{ $key }}.stock"
                                                    wire:debounce.200ms="overrideStock({{ $key }},'stock')"
                                                    type="number" class="form-control"
                                                    id="stock{{ $key }}"
                                                    name="variants[{{ $key }}][stock]" value=""
                                                    placeholder="Product Stock" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="sku{{ $key }}" class="form-label">SKU</label>
                                                <input wire:model="variants.{{ $key }}.sku"
                                                    wire:debounce.200ms="overrideSku({{ $key }},'sku')"
                                                    type="text" class="form-control" id="sku{{ $key }}"
                                                    name="variants[{{ $key }}][sku]" value=""
                                                    placeholder="SKU">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="media{{ $key }}" class="form-label">Media
                                                    (Multiple Selection
                                                    Available)
                                                </label>
                                                <input wire:model="variants.{{ $key }}.media" type="file"
                                                    class="form-control" id="media{{ $key }}"
                                                    name="variants[{{ $key }}][media][]" accept="image/*"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end" wire:ignore>
                                        <button wire:click.prevent="removeVariant({{ $key }})"
                                            type="button" class="btn btn-danger me-3"> <ion-icon
                                                name="trash-bin-outline"></ion-icon> Remove This Variant</button>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-end" wire:ignore>
                            <button wire:click.prevent="addVariant" type="button" class="btn btn-primary"> <ion-icon
                                    name="add-circle-outline"></ion-icon> Add
                                Variant</button>
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
                                    <button wire:loading.attr="disabled" type="submit"
                                        class="btn btn-primary w-100">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card oder-1">
                        <div class="card-body">
                            <h6 class="card-title">Thumbnail Preview</h6>
                            <div class="row">
                                <p wire:loading wire:target="image" class="text-center mt-3">Loading...</p>
                                @if ($image)
                                    <div class="col-12 mb-3">
                                        <img src="{{ $image->temporaryUrl() }}"
                                            alt="{{ $image->getClientOriginalName() }}}" class="w-100 rounded">
                                    </div>
                                @else
                                    <p wire:loading.remove wire:target="image" class="text-center mt-3">No Thumbnail
                                        Selected</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card order-2">
                        <div class="card-body">
                            <h6 class="card-title">Product Media</h6>
                            <div class="row">

                                {{-- @if ($variants) --}}

                                @foreach ($variants as $key => $variant)
                                    <p wire:loading wire:target="variants.{{ $key }}.media"
                                        class="text-center mt-3">Loading...
                                    </p>
                                    @if (array_key_exists('media', $variant))
                                        {{-- @dump($variant['media']) --}}
                                        @foreach ($variant['media'] as $image)
                                            {{-- @dump($image) --}}
                                            <div class="col-6 mb-3">
                                                <img src="{{ $image->temporaryUrl() }}"
                                                    alt="{{ $image->getClientOriginalName() }}}"
                                                    class="w-100 rounded">
                                            </div>
                                        @endforeach
                                    @endif
                                    @if (!array_key_exists('media', $variant))
                                        <p wire:loading.remove
                                            class="text-center mt-3 {{ $key != 0 ? 'd-none' : '' }}">
                                            No Media
                                            Selected</p>
                                    @endif
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
