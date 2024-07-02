<?php

namespace App\Http\Controllers\api;

use App\Models\basketoffer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BasketoffersResource;
use App\Http\Controllers\api\ApirequestTrait;

class BasketoffersController extends Controller
{
    use ApirequestTrait;
    
    public function index() {
        $basket = BasketoffersResource::collection(basketoffer::all());
        return $this->apiResponse($basket, 'ok', 200);
    }

    public function show($id) {
        $basket =  BasketoffersResource::collection(basketoffer::where('customer_id', $id)->get());
        if ($basket->isEmpty()) {
            return $this->apiResponse(null, 'customer_id not found product', 404);
        }
        return $this->apiResponse($basket, 'ok', 200);
    }

    public function delete($id) {
        $basket =  BasketoffersResource::collection(basketoffer::where('customer_id', $id)->get());
        if ($basket->isEmpty()) {
            return $this->apiResponse(null, 'customer_id not found product', 404);
        }
        basketoffer::where('customer_id', $id)->delete();
        return $this->apiResponse(null, 'delete basket susseccfully', 200);
    }
}
