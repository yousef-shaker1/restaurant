<?php

namespace App\Http\Controllers\api;

use App\Models\offer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResponse;
use Illuminate\Support\Facades\Storage;
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
            $validated = $request->validate([
                'name' => 'required|between:2,100',
                'image' => 'required',
                'description' => 'required|between:10,100',
                'price' => 'required',
            ]);
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }
        
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();

                // Save the image to storage/app/public/team
                $path = $image->storeAs('photo', $imageName);
                $validated['image'] = 'photo/' . $imageName; // Path to store in the database
            }
        } catch (\Exception $e) {
            return $this->apiResponse(null, 'Image upload failed: ' . $e->getMessage(), 500);
        }

        try {
            $offer = offer::create($validated);
        } catch (\Exception $e) {
            return $this->apiResponse(null, 'offer creation failed', 500);
        }
        
        return $this->apiResponse(new OfferResponse($offer), 'Product created successfully', 201);
    }
    
    public function edit(Request $request, $id)
    {
        try {
            $validated = $request->validate([
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

        if ($request->hasFile('image')) {
            try {
                // Delete old image if it exists
                if ($offer->image) {
                    Storage::delete('photo/' . basename($offer->image));
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

        $offer->update($validated);
        
        return $this->apiResponse(new OfferResponse($offer), 'offer updated successfully', 200);
    }

    public function delete($id){
        $offer = Offer::find($id);
        if(!$offer){
            return $this->apiResponse(null, 'offer not found', 404);
        }
        if ($offer->image) {
            // Extract the file name from the path
            $imagePath = parse_url($offer->image, PHP_URL_PATH);
            $imageName = basename($imagePath);
            // Delete the image file from storage
            Storage::delete('photo/' . $imageName);
        }
        $offer->delete();
        return $this->apiResponse(null, 'offer delete successfully', 200);
    }
}
