<?php

namespace App\Livewire;

use App\Models\Products\ProductColor;
use Livewire\Component;
use App\Models\Products\ProductsCategory;
use App\Models\Products\ProductSize;
use App\Models\Products\ProductSizeGuide;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class ProductsStore extends Component
{

    use WithFileUploads;

    public $categories = [];
    public $subCategories = [];
    public $guides;
    public $colors;
    #[Rule('required')]
    public $sizes;

    // default values
    public $defaultPrice;
    public $defaultSalePrice;
    public $defaultStock;
    public $defaultSku;


    // variation
    public $variants = [
        []
    ];


    public $selectedParent = null; // Stores the selected parent category ID
    public $selectedSubCategory = null; // Stores the selected subcategory ID
    #[Rule('nullable|image|mimes:jpeg,png,jpg')]
    public $media = [];

    #[Rule('nullable|image|mimes:jpeg,png,jpg|max:1024')]
    public $image;

    public function mount()
    {

        $this->defaultPrice = old('variants.0.price') ?? $this->defaultPrice;
        $this->defaultSalePrice = old('variants.0.sale_price') ?? $this->defaultSalePrice;
        $this->defaultStock = old('variants.0.stock') ?? $this->defaultStock;
        $this->defaultSku = old('variants.0.sku') ?? $this->defaultSku;

        $this->categories = ProductsCategory::whereNull('parent_id')->get();
        $this->guides = ProductSizeGuide::all();
        $this->colors = ProductColor::all();
        $this->sizes = ProductSize::all();

        $this->variants = [
            [
                'price' => old('variants.0.price') ?? $this->defaultPrice,
                'sale_price' => old('variants.0.sale_price') ?? $this->defaultSalePrice,
                'stock' => old('variants.0.stock') ?? $this->defaultStock,
                'sku' => old('variants.0.sku') ?? $this->defaultSku,
                'color_id' => null,
                'size_id' => null,
                'is_price_overridden' => false,
                'is_sale_price_overridden' => false,
                'is_stock_overridden' => false,
                'is_sku_overridden' => false,
            ]
        ];
    }


    public function updatedSelectedParent()
    {
        $this->subCategories = ProductsCategory::where('parent_id', $this->selectedParent)->get();
        $this->selectedSubCategory = null;
    }

    public function addVariant()
    {
        $this->variants[] = [
            'price' => $this->defaultPrice,
            'sale_price' => $this->defaultSalePrice,
            'stock' => $this->defaultStock,
            'sku' => $this->defaultSku,
            'is_price_overridden' => false,
            'is_sale_price_overridden' => false,
            'is_stock_overridden' => false,
            'is_sku_overridden' => false,
        ];
    }

    public function updatedDefaultPrice()
    {
        foreach ($this->variants as $key => $variant) {
            if (!$variant['is_price_overridden']) {
                $this->variants[$key]['price'] = $this->defaultPrice;
            }
        }
    }

    public function updatedDefaultSalePrice()
    {
        foreach ($this->variants as $key => $variant) {
            if (!$variant['is_sale_price_overridden']) {
                $this->variants[$key]['sale_price'] = $this->defaultSalePrice;
            }
        }
    }

    public function updatedDefaultStock()
    {
        foreach ($this->variants as $key => $variant) {
            if (!$variant['is_stock_overridden']) {
                $this->variants[$key]['stock'] = $this->defaultStock;
            }
        }
    }

    public function updatedDefaultSku()
    {
        foreach ($this->variants as $key => $variant) {
            if (!$variant['is_sku_overridden']) {
                $this->variants[$key]['sku'] = $this->defaultSku;
            }
        }
    }

    public function overridePrice($key)
    {
        $this->variants[$key]['is_price_overridden'] = true;
    }

    public function overrideSalePrice($key)
    {
        $this->variants[$key]['is_sale_price_overridden'] = true;
    }

    public function overrideStock($key)
    {
        $this->variants[$key]['is_stock_overridden'] = true;
    }

    public function overrideSku($key)
    {
        $this->variants[$key]['is_sku_overridden'] = true;
    }

    public function removeVariant($index)
    {
        unset($this->variants[$index]);
        $this->variants = array_values($this->variants);
    }


    public function render()
    {
        return view('livewire.products-store');
    }
}
