<?php

namespace App\Http\Controllers;

use App\Models\Products\ProductsCategory;
use Illuminate\Http\Request;
use App\Http\Requests\ProductCategoryRequest;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Str;
use App\Services\FileUpload;
use App\Services\Permission;


class ProductsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // check permission

         if ($response = Permission::check('view_category')) {
             return $response;
         }

        // parent categories
        $categories = ProductsCategory::whereNull('parent_id')->get();

        return view('panel.products.categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryRequest $request)
    {

         if ($response = Permission::check('create_category')) {
             return $response;
         }

        try{

            // validate the ProductCategoryRequest
            $request->validated();

            // create the ProductCategory
            $category = new ProductsCategory();

            // set attributes
            $category->name = Purifier::clean($request->name);
            $category->discount = Purifier::clean($request->discount);
            $category->slug = Str::slug($request->name, '-');
            $category->discount_type = Purifier::clean($request->discount_type);
            $category->visibility = Purifier::clean($request->visibility);
            $category->status = Purifier::clean($request->status);
            $category->parent_id = $request->parent_id ? Purifier::clean($request->parent_id) : null;

            // check image
            $category->image = FileUpload::upload('image', 'products/categories');

            $category->save();

            return redirect()->back()->with('success', 'Category created successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(ProductsCategory $productsCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductsCategory $productsCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductsCategory $productsCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductsCategory $productsCategory, Request $request)
    {
        // check permission
         if ($response = Permission::check('delete_category')) {
             return $response;
         }

         $category = $productsCategory->where('id', $request->id)->first();

         FileUpload::delete($category, 'image', 'products/categories');

         $category->delete();

         return redirect()->back()->with('success', 'Category deleted successfully');


    }
}
