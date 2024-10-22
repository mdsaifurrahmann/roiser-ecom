<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products\ProductColor;
use App\Services\Permission;
use App\Services\FileUpload;
use Mews\Purifier\Facades\Purifier;

class ProductColorController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {

        // check permission
        if ($response = Permission::check('view_color')) {
            return $response;
        }

        $colors = ProductColor::all();

        return view('panel.products.attributes.colors.index', [
            'colors' => $colors
        ]);
    }

    public function store(Request $request)
    {
        // check permission
        if ($response = Permission::check('create_color')) {
            return $response;
        }

        try {
            $request->validate([
                'name' => 'required|unique:product_colors,name',
                'code' => 'nullable|unique:product_colors,code',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:512',
            ]);

            $color = new ProductColor();

            $color->name = Purifier::clean($request->name);
            $color->code = Purifier::clean(strtoupper($request->code));

            $color->image = FileUpload::upload('image', 'products/colors');

            $color->save();

            return back()->with('success', 'Color created successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function update(Request $request)
    {
        // check permission
        if ($response = Permission::check('update_color')) {
            return $response;
        }

        try {
            $request->validate([
                'name' => 'required|unique:product_colors,name,' . $request->id,
                'code' => 'nullable|unique:product_colors,code,' . $request->id,
                'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:512',
            ]);

            $color = ProductColor::where('id', $request->id)->first();

            $color->name = Purifier::clean($request->name);
            $color->code = Purifier::clean(strtoupper($request->code));

            $color->image = FileUpload::update('image', $color, 'image', 'products/colors');

            if ($request->remove_image) {
                FileUpload::delete($color, 'image', 'products/colors');

                $color->image = null;
            }

            $color->save();

            return back()->with('success', 'Color updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function destroy(Request $request)
    {
        // check permission
        if ($response = Permission::check('delete_color')) {
            return $response;
        }

        try {
            $color = ProductColor::where('id', $request->id)->first();

            FileUpload::delete($color, 'image', 'products/colors');

            $color->delete();

            return back()->with('success', 'Color deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
