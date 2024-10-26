<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
            'slug' => 'nullable|string|unique:products,slug',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:products_categories,id',
            'sub_category_id' => 'nullable|exists:products_categories,id',
            'video_link' => 'nullable|url',
            'status' => 'required|in:0,1',
            'size_guide' => 'nullable|exists:product_size_guides,id',
            'thumbnail' => 'nullable|image|max:1024',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required',
            'description.required' => 'The description field is required',
            'category_id.required' => 'The category field is required',
            'video_link.url' => 'The video link must be a valid URL',
            'status.required' => 'The status field is required',
            'thumbnail.image' => 'The thumbnail must be an image',
            'thumbnail.max' => 'The thumbnail size must be less than 1MB',
        ];
    }
}
