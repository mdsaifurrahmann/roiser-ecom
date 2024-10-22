<div class="row">
    <div class="col-6">
        <div class="mb-3">
            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
            <select class="form-select" name="category_id" id="category_id" wire:model.lazy="selectedCategory">
                <option selected value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-6">
        <div class="mb-3">
            <label for="sub_category_id" class="form-label">Sub Category</label>
            <select class="form-select" name="sub_category_id" id="sub_category_id"
                wire:model.defer="selectedSubCategory">
                <option selected value="">Select Sub Category</option>
                @foreach ($subCategories as $subCategory)
                    <option value="{{ $subCategory->id }}"
                        {{ old('sub_category_id') == $subCategory->id ? 'selected' : '' }}>
                        {{ $subCategory->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
