<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products\ProductSize;
use App\Services\Permission;
use Mews\Purifier\Facades\Purifier;

class ProductSizeController extends Controller
{
    public function index()
    {

        // check permission
        if ($response = Permission::check('view_size')) {
            return $response;
        }

        $sizes = ProductSize::all();

        return view('panel.products.attributes.sizes.index', [
            'sizes' => $sizes
        ]);
    }

    public function store(Request $request)
    {
        // check permission
        if ($response = Permission::check('create_size')) {
            return $response;
        }

        try {
            $request->validate([
                'size' => 'required|unique:product_sizes,size'
            ]);

            $size = new ProductSize();

            $size->size = Purifier::clean(strtoupper($request->size));

            $size->save();

            return back()->with('success', 'Size created successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function update(Request $request)
    {
        // check permission
        if ($response = Permission::check('update_size')) {
            return $response;
        }

        try {
            $request->validate([
                'size' => 'required|unique:product_sizes,size,' . $request->id,
            ]);

            $size = ProductSize::where('id', $request->id)->first();

            $size->size = Purifier::clean(strtoupper($request->size));

            $size->save();

            return back()->with('success', 'Size updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function destroy(Request $request)
    {
        // check permission
        if ($response = Permission::check('delete_size')) {
            return $response;
        }

        try {
            $size = ProductSize::where('id', $request->id)->first();

            $size->delete();

            return back()->with('success', 'Size deleted successfully');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
