<?php

namespace App\Http\Controllers\api;

use App\Models\prodect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResponse;
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
            $validatedData = $request->validate([
                'name' => 'required|between:2,100',
                'image' => 'required',
                'description' => 'required|between:10,100',
                'price' => 'required',
                'section_id' => 'required',
            ]);
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }
        
        // Create the product
        $product = prodect::create($validatedData);
        
        if (!$product) {
            return $this->apiResponse(null, 'Product not created', 500);
        }
        
        return $this->apiResponse(new ProductResponse($product), 'Product created successfully', 201);
    }
    
    public function edit(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'image' => 'nullable',
                'description' => 'nullable',
                'price' => 'nullable',
                'section_id' => 'nullable',
            ]);
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }

        
        $product = prodect::find($id);
        
        if (!$product) {
            return $this->apiResponse(null, 'Product not found', 404);
        }
        
        $product->update($validatedData);
        
        return $this->apiResponse(new ProductResponse($product), 'Product updated successfully', 200);
    }

    public function delete($id){
        $product = prodect::find($id);
        if(!$product){
            return $this->apiResponse(null, 'product not found', 404);
        }
        $product->delete();
        return $this->apiResponse(null, 'Product delete successfully', 200);
    }
}
