<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCategoryRequest;
use App\Models\Products\ProductsCategory;
use App\Services\FileUpload;
use App\Services\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;


class ProductsCategoryController extends Controller
{
    /**
     * @param ProductCategoryRequest $request
     * @return void
     */
    public static function storeCategory(ProductCategoryRequest $request): void
    {
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
    }


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
     * Display a listing of the resource for sub Category.
     */
    public function subCategoriesIndex()
    {

        if ($response = Permission::check('view_sub_category')) {
            return $response;
        }

        $parentCategories = ProductsCategory::whereNull('parent_id')->select('id', 'name')->get();

        // sub categories with parent category name
        $categories = ProductsCategory::with('parentCategories')->whereNotNull('parent_id')->get();

        return view('panel.products.categories.sub', [
            'parentCategories' => $parentCategories,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryRequest $request)
    {

        if ($response = Permission::check('create_category')) {
            return $response;
        }

        try {

            self::storeCategory($request);

            return redirect()->back()->with('success', 'Category created successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }


    }

    /**
     * Store a newly created resource in storage.
     */
    public function subCategoryStore(ProductCategoryRequest $request)
    {
        if ($response = Permission::check('create_sub_category')) {
            return $response;
        }

        try {

            self::storeCategory($request);

            return redirect()->back()->with('success', 'Sub-Category created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductCategoryRequest $request)
    {
        // check permission
        if ($response = Permission::check('update_category')) {
            return $response;
        }

        try {

            // validate the ProductCategoryRequest
            $request->validated();

            // create the ProductCategory
            $category = ProductsCategory::where('id', $request->id)->first();

            // set attributes
            $category->name = Purifier::clean($request->name);
            $category->discount = Purifier::clean($request->discount);
            $category->slug = Str::slug($request->name, '-');
            $category->discount_type = Purifier::clean($request->discount_type);
            $category->visibility = Purifier::clean($request->visibility);
            $category->status = Purifier::clean($request->status);

            $category->parent_id = null;

            // check image
            $category->image = FileUpload::update('image', $category, 'image', 'products/categories');

            $category->save();

            return redirect()->back()->with('success', 'Category updated successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSubCategory(ProductCategoryRequest $request)
    {
        // check permission
        if ($response = Permission::check('update_category')) {
            return $response;
        }

        try {

            // validate the ProductCategoryRequest
            $request->validated([
                'parent_id' => 'required|exists:products_categories,id'
            ]);

            // create the ProductCategory
            $category = ProductsCategory::where('id', $request->id)->first();

            // set attributes
            $category->name = Purifier::clean($request->name);
            $category->discount = Purifier::clean($request->discount);
            $category->slug = Str::slug($request->name, '-');
            $category->discount_type = Purifier::clean($request->discount_type);
            $category->visibility = Purifier::clean($request->visibility);
            $category->status = Purifier::clean($request->status);

            $category->parent_id = $request->parent_id ? Purifier::clean($request->parent_id) : null;

            // check image
            $category->image = FileUpload::update('image', $category, 'image', 'products/categories');

            $category->save();

            return redirect()->back()->with('success', 'Sub-Category updated successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

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


//    /**
//     * Remove the specified resource from storage.
//     */
//    public function subCategoryDelete(ProductsCategory $productsCategory, Request $request)
//    {
//        // check permission
//        if ($response = Permission::check('delete_category')) {
//            return $response;
//        }
//
//        $category = $productsCategory->where('id', $request->id)->first();
//
//        FileUpload::delete($category, 'image', 'products/categories');
//
//        $category->delete();
//
//        return redirect()->back()->with('success', 'Category deleted successfully');
//
//    }
}
