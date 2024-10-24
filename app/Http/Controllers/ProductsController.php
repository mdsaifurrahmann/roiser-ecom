<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsRequest;
use App\Http\Requests\ProductVariantsRequest;
use App\Models\Products\ProductColor;
use App\Models\Products\Products;
use App\Models\Products\ProductSize;
use App\Models\Products\ProductSizeGuide;
use App\Models\Products\ProductVariants;
use App\Services\FileUpload;
use App\Services\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{

    public static function generateProductCode()
    {
        // Get the last product's code, or default to CP-01-87506 if none exist
        $getLastProduct = Products::select('product_code')->orderBy('id', 'desc')->first();

        if (!$getLastProduct) {
            $lastProductCode = 'CP-01-87506'; // Initial code if no product found
        } else {
            $lastProductCode = $getLastProduct->product_code;
        }

        // Split the code into its components (CP-01-87506)
        $codeParts = explode('-', $lastProductCode);

        // Increment the last numeric part of the code
        $lastNumericPart = (int)$codeParts[2];
        $newNumericPart = str_pad($lastNumericPart + 1, 5, '0', STR_PAD_LEFT); // Pad to keep 5 digits

        // Rebuild the code with the incremented number
        $newCode = $codeParts[0] . '-' . $codeParts[1] . '-' . $newNumericPart;

        return $newCode;
    }


    public function index()
    {
        // check permission
        if ($response = Permission::check('view_product')) {
            return $response;
        }

        $products = Products::select('id', 'product_code', 'thumbnail', 'name', 'status', 'category_id', 'sub_category_id', 'user_id')
            ->with([
                'category:id,name',
                'subCategory:id,name',
                'user:id,name',
            ])
            ->get();

        // dd($products);

        // dump($products);
        return view('panel.products.index', [
            'products' => $products
        ]);
    }


    public function create()
    {
        // check permission
        if ($response = Permission::check('create_product')) {
            return $response;
        }

        $guides = ProductSizeGuide::all();
        $colors = ProductColor::all();
        $sizes = ProductSize::all();



        return view('panel.products.create', [
            // 'categories' => $categories,
            'guides' => $guides,
            'colors' => $colors,
            'sizes' => $sizes,
            // 'subCategories' => $subCategories
        ]);
    }

    public function store(ProductsRequest $productsRequest, ProductVariantsRequest $variantRequest)
    {
        // check permission
        if ($response = Permission::check('create_product')) {
            return $response;
        }

        try {

            DB::beginTransaction();

            // validate requests
            $productsRequest->validated();
            $validateVariants = $variantRequest->validated();

            // create product & product variant
            $product = new Products();

            $product->product_code = self::generateProductCode();
            $product->name = $productsRequest->name;
            $product->description = $productsRequest->description;
            $product->category_id = $productsRequest->category_id;
            $product->sub_category_id = $productsRequest->sub_category_id;
            $product->video_link = $productsRequest->video_link;
            $product->status = $productsRequest->status;
            $product->size_guide = $productsRequest->size_guide;
            $product->user_id = auth()->user()->id;
            $product->thumbnail = FileUpload::upload('thumbnail', 'products/media');
            $product->save();

            // create product variant

            foreach ($validateVariants['variants'] as $key => $variantData) {

                $variant = new ProductVariants();

                $variant->product_id = $product->id;
                $variant->color_id = $variantData['color_id'];
                $variant->size_id = $variantData['size_id'];
                $variant->price = $variantData['price'];
                $variant->sale_price = $variantData['sale_price'];
                $variant->stock = $variantData['stock'];
                $variant->sku = $variantData['sku'];

                if (array_key_exists('media', $variantData)) {
                    $variant->media = json_encode(FileUpload::bulkUpload($variantData['media'], 'products/media'));
                }

                $variant->save();

                DB::commit();
            }

            DB::commit();

            return redirect()->route('products.index')->with('success', 'Product created successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($product_code)
    {
        // check permission
        if ($response = Permission::check('update_product')) {
            return $response;
        }


        $guides = ProductSizeGuide::all();
        $colors = ProductColor::all();
        $sizes = ProductSize::all();


        $product = Products::where('product_code', $product_code)->with('variants')->first();

        // dd(json_decode($product));

        return view('panel.products.edit', [
            'product' => $product,
            'guides' => $guides,
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }



    public function update(Request $request)
    {

        // check permission
        if ($response = Permission::check('update_product')) {
            return $response;
        }

        // Start a DB transaction
        DB::beginTransaction();

        try {
            // Find the product
            $product = Products::findOrFail($request->id);

            // Update only modified product data
            $product->update($request->only([
                'name',
                'description',
                'category_id',
                'sub_category_id',
                'video_link',
                'size_guide',
                'status'
            ]));

            // Handle thumbnail update
            // if ($request->hasFile('thumbnail')) {
            $thumbnail = FileUpload::update('thumbnail', $product, 'thumbnail', 'products/media');
            $product->thumbnail = $thumbnail;
            $product->save();

            // Process the variants
            $existingVariants = $product->variants->pluck('id')->toArray();

            $updatedVariants = $request->input('variants', []);


            foreach ($updatedVariants as $index => $variantData) {
                // Check if media files are attached to the current variant
                if (isset($variantData['id'])) {
                    $variant = ProductVariants::findOrFail($variantData['id']);

                    // Remove the media from the data array before updating
                    $mediaFiles = $request->file("variants.{$index}.media") ?? null;
                    unset($variantData['media']);

                    // Update other fields of the variant
                    $variant->update($variantData);

                    // Handle media file uploads if media files are provided
                    if ($mediaFiles) {
                        // Upload new media files
                        $newMedia = FileUpload::bulkUpload($mediaFiles, 'products/media');

                        // Merge with existing media only if it's not null or empty
                        $existingMedia = $variant->media ?? [];
                        if (!empty($existingMedia)) {
                            $variant->media = array_merge($existingMedia, $newMedia);
                        } else {
                            $variant->media = $newMedia;
                        }
                    }

                    // Save the updated variant
                    $variant->save();
                } else {
                    // Add new variant
                    $newVariant = new ProductVariants($variantData);
                    $product->variants()->save($newVariant);

                    // Handle media file uploads for new variant
                    if ($request->hasFile("variants.{$index}.media")) {
                        $mediaFiles = $request->file("variants.{$index}.media");
                        $newMedia = FileUpload::bulkUpload($mediaFiles, 'products/media');
                        $newVariant->media = $newMedia;
                        $newVariant->save();
                    }
                }
            }

            // Delete variants that were removed
            $variantIdsToDelete = array_diff($existingVariants, array_column($updatedVariants, 'id'));

            // dd($variantIdsToDelete);

            foreach ($variantIdsToDelete as $variantId) {
                $variantToDelete = ProductVariants::findOrFail($variantId);

                // Delete associated media files
                if ($variantToDelete->media) {
                    foreach ($variantToDelete->media as $mediaFile) {
                        Storage::disk('public')->delete('products/media/' . $mediaFile);
                    }
                }

                // Delete the variant
                $variantToDelete->delete();
            }

            // Commit the transaction
            DB::commit();

            return redirect()->back()->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();

            return redirect()->back()->withErrors('Error updating the product: ' . $e->getMessage());
        }
    }


    public function deleteVariantMedia(Request $request, $productId)
    {

        // check permission
        if ($response = Permission::check('update_product')) {
            return $response;
        }

        // Find the product by ID
        $product = Products::findOrFail($productId);

        // Get the variant index from the request
        $variantIndex = $request->input('variant_index');

        // Find the variant (assuming it's based on index; adjust if using ID)
        $variant = $product->variants[$variantIndex];

        // Decode the existing media JSON
        $media = $variant->media;

        // Get the media key to be deleted
        $mediaKey = $request->input('media_key');

        // Get the media filename
        $filename = $media[$mediaKey];

        // Remove the file from storage
        Storage::disk('public')->delete('products/media/' . $filename);

        // Remove the media entry from the array
        unset($media[$mediaKey]);

        // Reindex the array
        $media = array_values($media);

        // Re-encode the media and update the variant
        $variant->media = $media; // reindex array after removing

        // Save the updated variant
        $variant->save();

        // Optionally, you can return a response (e.g., JSON for AJAX requests)
        return back()->with('success', 'Media deleted successfully');
    }


    public function destroy(Request $request)
    {

        // check permission
        if ($response = Permission::check('delete_product')) {
            return $response;
        }

        try {
            DB::beginTransaction();


            // Find the product by ID
            $product = Products::with('variants')->findOrFail($request->id);

            // Delete media associated with the product
            // if ($product->thumbnail && Storage::disk('public')->exists('products/media/' . $product->thumbnail)) {
            //     Storage::disk('public')->delete('products/media/' . $product->thumbnail);
            // }

            FileUpload::delete($product, 'thumbnail', 'products/media');

            // Loop through each variant to delete its media and the variant itself
            foreach ($product->variants as $variant) {
                // Delete media associated with the variant
                if ($variant->media) {
                    foreach ($variant->media as $mediaFile) {
                        if (Storage::disk('public')->exists('products/media/' . $mediaFile)) {
                            Storage::disk('public')->delete('products/media/' . $mediaFile);
                        }
                    }
                }

                // Delete the variant
                $variant->delete();
            }

            // Finally, delete the product
            $product->delete();

            DB::commit();

            // Redirect or respond with success message
            return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }


    // stock management
    public function stockIndex()
    {

        // check permission
        if ($response = Permission::check('view_stock')) {
            return $response;
        }

        $products = Products::select('id', 'product_code', 'name')->with('variants')->get();

        return view('panel.products.stock.index', [
            'products' => $products
        ]);
    }

    public function stockEdit(Request $request, $product_code)
    {
        // check permission
        if ($response = Permission::check('update_stock')) {
            return $response;
        }

        $product = Products::where('product_code', $product_code)->select('id', 'product_code', 'name')->with([
            'variants:id,product_id,stock,price,sale_price,color_id,size_id',
            'variants.color:id,name',
            'variants.size:id,size',
        ])->get();

//        dd(json_decode($product));

        return view('panel.products.stock.edit', [
            'product' => $product
        ]);
    }

    public function updateStock(Request $request)
    {


        try {

            DB::beginTransaction();

            // Validate the input data
            $request->validate([
                'variants.*.id' => 'required|exists:product_variants,id',
                'variants.*.stock' => 'nullable|integer|min:0',
                'variants.*.price' => 'nullable|numeric|min:0',
                'variants.*.sale_price' => 'nullable|numeric|min:0',
            ]);


            // Get all variants from the form
            $variantsData = $request->input('variants');


            foreach ($variantsData as $variant) {
                // Retrieve the variant ID from the array
                $variantId = $variant['id'];


                // Find the corresponding variant
                $productVariant = ProductVariants::findOrFail($variantId);

                // Update the stock, price, and sale price
                $productVariant->stock = $variant['stock'];
                $productVariant->price = $variant['price'];
                $productVariant->sale_price = $variant['sale_price'];

                // Save the updated variant
                $productVariant->save();
            }

            // Commit the transaction if all updates succeed
            DB::commit();

            // Return a success message or redirect to another page
            return redirect()->route('products.stock.index')->with('success', 'Product Stocks updated successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if any error occurs
            DB::rollBack();

            // Handle the error (you can log it and show a friendly message)
            return redirect()->back()->with('error', 'There was an error updating the product Stocks.');
        }
    }
}
