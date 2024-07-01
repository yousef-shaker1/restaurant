<?php

namespace App\Http\Controllers\api;

use App\Models\orderoffer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderOfferResource;
use App\Http\Controllers\api\ApirequestTrait;

class OrderOfferController extends Controller
{
    use ApirequestTrait;

    public function index(){
        $orderoffer = OrderOfferResource::collection(orderoffer::all());
        return $this->apiResponse($orderoffer, 'ok', 200);
    }

    public function show($id)
    {
        $orderoffer = orderoffer::find($id);
        
        if(!$orderoffer){
            return $this->apiResponse($orderoffer, 'order not found',404);
        }
        return $this->apiResponse(new OrderOfferResource($orderoffer), 'ok',200);
    }

    public function success($id)
    {
        $orderoffer = orderoffer::find($id);
        if(!$orderoffer){
            return $this->apiResponse($orderoffer, 'orderoffer not found',404);
        }
        $orderoffer->update([
            'status' => 'قبول',
        ]);
        return $this->apiResponse(new OrderOfferResource($orderoffer), 'orderoffer success ok',200);
    }
    
    public function rejection($id)
    {
        $orderoffer = orderoffer::find($id);
        if(!$orderoffer){
            return $this->apiResponse($orderoffer, 'orderoffer not found',404);
        }
        $orderoffer->update([
            'status' => 'رفض',
        ]);
        return $this->apiResponse(new OrderOfferResource($orderoffer), 'orderoffer rejection ok',200);
    }

    public function completed($id)
    {
        $orderoffer = orderoffer::find($id);
        if(!$orderoffer){
            return $this->apiResponse($orderoffer, 'orderoffer not found',404);
        }
        $orderoffer->update([
            'status' => 'اتمام',
        ]);
        return $this->apiResponse(new OrderOfferResource($orderoffer), 'order completed ok',200);
    }

    public function delete($id){
        $orderoffer = orderoffer::find($id);
        if(!$orderoffer){
            return $this->apiResponse($orderoffer, 'order not found',404);
        }
        $orderoffer->delete();
        return $this->apiResponse(new OrderOfferResource($orderoffer), 'orderoffer delete ok',200);
    }
}
