<?php

namespace App\Http\Controllers\api;

use App\Models\prodect;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\api\ApirequestTrait;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    use ApirequestTrait;

    public function index()
    {
        $products = ProductResponse::collection(prodect::all());
        return $this->apiResponse($products, 'ok' ,200);
    }

    public function show_one($id)
    {
        $product = prodect::find($id);
        if (!$product) {
            return $this->apiResponse(null, 'Product not found', 404);
        }
        return $this->apiResponse(new ProductResponse($product), 'ok' ,200);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|between:2,100',
                'image' => 'required',
                'description' => 'required|between:10,100',
                'price' => 'required',
                'section_id' => 'required',
            ]);
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();

                $path = $image->storeAs('photo', $imageName);
                $validated['image'] = 'photo/' . $imageName; 
            }
        } catch (\Exception $e) {
            return $this->apiResponse(null, 'Image upload failed: ' . $e->getMessage(), 500);
        }

        try {
            $prodect = prodect::create($validated);
        } catch (\Exception $e) {
            return $this->apiResponse(null, 'prodect creation failed', 500);
        }
        return $this->apiResponse(new ProductResponse($prodect), 'Product created successfully', 201);
    }
    
    public function edit(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'nullable',
                'image' => 'nullable|image',
                'description' => 'nullable|between:10,100',
                'price' => 'nullable|numeric',
                'section_id' => 'nullable',
            ]);
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }

        $product = prodect::find($id);

        if (!$product) {
            return $this->apiResponse(null, 'Product not found', 404);
        }

        if ($request->hasFile('image')) {
            try {
                // Delete old image if it exists
                if ($product->image) {
                    Storage::delete('photo/' . basename($product->image));
                }

                // Store the new image
                $image = $request->file('image');
                $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('photo', $imageName);
                $validated['image'] = 'photo/' . $imageName;
            } catch (\Exception $e) {
                return $this->apiResponse(null, 'Image upload failed: ' . $e->getMessage(), 500);
            }
        }
        
        $product->update($validated);
        return $this->apiResponse(new ProductResponse($product), 'Product updated successfully', 200);
    }

    public function delete($id){
        $product = prodect::find($id);
        if(!$product){
            return $this->apiResponse(null, 'product not found', 404);
        }
        if ($product->img) {
            // Extract the file name from the path
            $imagePath = parse_url($product->image, PHP_URL_PATH);
            $imageName = basename($imagePath);
            
            // Delete the image file from storage
            Storage::delete('photo/' . $imageName);
        }
        $product->delete();
        return $this->apiResponse(null, 'Product delete successfully', 200);
    }
}
