<?php

namespace App\Livewire\Products;

use Livewire\Component;
use App\Models\Products\ProductsCategory;
use App\Models\Products\Products;

class ProductsCategories extends Component
{

    public $product;
    public $categories;
    public $subCategories = [];
    public $selectedCategory = null;
    public $selectedSubCategory = null;

    public function mount($product_code)
    {

        // Load the product from the database using the given product ID
        $this->product = Products::where('product_code', $product_code)->first();

        // Check if the product exists before proceeding
        if ($this->product) {
            // Assign the product's category_id and sub_category_id to the respective variables
            $this->selectedCategory = $this->product->category_id;
            $this->selectedSubCategory = $this->product->sub_category_id;
        }

        // Load all parent categories
        $this->categories = ProductsCategory::whereNull('parent_id')->get();

        // Set old values if present
        $this->selectedCategory = old('category_id', $this->selectedCategory);
        $this->selectedSubCategory = old('sub_category_id', $this->selectedSubCategory);

        // Load subcategories if an old category is selected
        if ($this->selectedCategory) {
            $this->subCategories = ProductsCategory::where('parent_id', $this->selectedCategory)->get();
        }
    }

    public function updatedSelectedCategory($categoryId)
    {
        // Fetch subcategories for the selected category
        $this->subCategories = ProductsCategory::where('parent_id', $categoryId)->get();
        // Reset the selected subcategory when category changes
        $this->selectedSubCategory = null;
    }

    public function render()
    {
        // If a category is selected and subcategories exist, make sure they remain in sync
        if ($this->selectedCategory) {
            $this->subCategories = ProductsCategory::where('parent_id', $this->selectedCategory)->get();
        }
        return view('livewire.products.products-categories');
    }
}
