<?php

namespace App\Http\Controllers\api;

use App\Models\order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Controllers\api\ApirequestTrait;

class OrderController extends Controller
{
    use ApirequestTrait;

    public function index(){
        $order = OrderResource::collection(order::all());
        return $this->apiResponse($order, 'ok', 200);
    }

    public function show($id)
    {
        $order = order::find($id);
        if(!$order){
            return $this->apiResponse($order, 'order not found',404);
        }
        return $this->apiResponse(new OrderResource($order), 'ok',200);
    }

    public function success($id)
    {
        $order = order::find($id);
        if(!$order){
            return $this->apiResponse($order, 'order not found',404);
        }
        $order->update([
            'status' => 'قبول',
        ]);
        return $this->apiResponse(new OrderResource($order), 'order success ok',200);
    }
    
    public function rejection($id)
    {
        $order = order::find($id);
        if(!$order){
            return $this->apiResponse($order, 'order not found',404);
        }
        $order->update([
            'status' => 'رفض',
        ]);
        return $this->apiResponse(new OrderResource($order), 'order rejection ok',200);
    }

    public function completed($id)
    {
        $order = order::find($id);
        if(!$order){
            return $this->apiResponse($order, 'order not found',404);
        }
        $order->update([
            'status' => 'اتمام',
        ]);
        return $this->apiResponse(new OrderResource($order), 'order completed ok',200);
    }

    public function delete($id){
        $order = order::find($id);
        if(!$order){
            return $this->apiResponse($order, 'order not found',404);
        }
        $order->delete();
        return $this->apiResponse(new OrderResource($order), 'order delete ok',200);
    }
    
}
