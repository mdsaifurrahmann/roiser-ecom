<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products\ProductSizeGuide;
use App\Services\Permission;
use App\Services\FileUpload;
use Mews\Purifier\Facades\Purifier;

class ProductSizeGuideController extends Controller
{
    public function index()
    {

        // check permission
        if ($response = Permission::check('view_guide')) {
            return $response;
        }

        $guides = ProductSizeGuide::all();
        return view('panel.products.attributes.size-guide.index', [
            'guides' => $guides
        ]);
    }


    public function store(Request $request)
    {
        // check permission
        if ($response = Permission::check('create_guide')) {
            return $response;
        }

        try {
            $request->validate([
                'name' => 'required|unique:product_size_guides,name',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            ]);

            $guide = new ProductSizeGuide();

            $guide->name = Purifier::clean($request->name);

            $guide->image = FileUpload::upload('image', 'products/size-guides');

            $guide->save();

            return back()->with('success', 'Size Guide created successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function update(Request $request)
    {
        // check permission
        if ($response = Permission::check('update_guide')) {
            return $response;
        }

        try {
            $request->validate([
                'name' => 'required|unique:product_size_guides,name,' . $request->id,
                'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            ]);

            $guide = ProductSizeGuide::where('id', $request->id)->first();

            $guide->name = Purifier::clean($request->name);

            $guide->image = FileUpload::update('image', $guide, 'image', 'products/size-guides');

            if ($request->remove_image) {
                FileUpload::delete($guide, 'image', 'products/size-guides');

                $guide->image = null;
            }

            $guide->save();

            return back()->with('success', 'Size Guide updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function destroy(Request $request)
    {
        // check permission
        if ($response = Permission::check('delete_guide')) {
            return $response;
        }

        try {
            $guide = ProductSizeGuide::where('id', $request->id)->first();

            FileUpload::delete($guide, 'image', 'products/size-guides');

            $guide->delete();

            return back()->with('success', 'Size Guide deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
