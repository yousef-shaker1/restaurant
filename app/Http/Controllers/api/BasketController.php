<?php

namespace App\Http\Controllers\api;

use App\Models\basket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BasketResource;

class BasketController extends Controller
{
    use ApirequestTrait;
    public function index() {
        $basket = BasketResource::collection(basket::all());
        return $this->apiResponse($basket, 'ok', 200);
    }

    public function show($id) {
        // $basket = basket::where('customer_id', $id)->get();
        $basket =  BasketResource::collection(basket::where('customer_id', $id)->get());
        if ($basket->isEmpty()) {
            return $this->apiResponse(null, 'customer_id not found product', 404);
        }
        return $this->apiResponse($basket, 'ok', 200);
    }
}
