<?php

namespace App\Http\Controllers\api;

use App\Models\offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResponse;
use App\Http\Controllers\api\ApirequestTrait;
use Illuminate\Validation\ValidationException;

class OfferController extends Controller
{
    use ApirequestTrait;

    public function index()
    {
        $offers = OfferResponse::collection(offer::all());
        return $this->apiResponse($offers, 'ok' ,200);
    }

    public function show($id)
    {
        $offer = offer::find($id);
        if (!$offer) {
            return $this->apiResponse(null, 'offer not found', 404);
        }
        return $this->apiResponse(new OfferResponse($offer), 'ok' ,200);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|between:2,100',
                'image' => 'required',
                'description' => 'required|between:10,100',
                'price' => 'required',
            ]);
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }
        
        // Create the product
        $offer = offer::create($validatedData);
        
        if (!$offer) {
            return $this->apiResponse(null, 'offer not created', 500);
        }
        
        return $this->apiResponse(new OfferResponse($offer), 'Product created successfully', 201);
    }
    
    public function edit(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|between:2,100',
                'image' => 'nullable',
                'description' => 'nullable|between:10,100',
                'price' => 'nullable',
            ]);
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }

        
        $offer = offer::find($id);
        
        if (!$offer) {
            return $this->apiResponse(null, 'offer not found', 404);
        }
        
        $offer->update($validatedData);
        
        return $this->apiResponse(new OfferResponse($offer), 'offer updated successfully', 200);
    }

    public function delete($id){
        $offer = Offer::find($id);
        if(!$offer){
            return $this->apiResponse(null, 'offer not found', 404);
        }
        $offer->delete();
        return $this->apiResponse(null, 'offer delete successfully', 200);
    }
}
