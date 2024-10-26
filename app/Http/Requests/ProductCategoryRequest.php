<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'slug' => 'string|unique:products_categories,slug',
            'status' => 'required|in:0,1',
            'image' => 'nullable|image|max:1024',
            'discount' => 'nullable|numeric',
            'discount_type' => 'nullable|in:fixed,percentage',
            'visibility' => 'required|in:0,1',
            'featured' => 'nullable|in:0,1',
            'popular' => 'nullable|in:0,1',
            'new_arrival' => 'nullable|in:0,1',
            'best_seller' => 'nullable|in:0,1',
            'top_rated' => 'nullable|in:0,1',
            'menu_placement' => 'nullable|in:0,1',
            'parent_id' => 'nullable|exists:products_categories,id'
        ];
    }
}
