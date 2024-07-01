<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\order;
use App\Models\basket;
use App\Models\prodect;
use App\Models\customer;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Customer as Costomer;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function getstripe(Request $request)
    {
        return view('paypal');
    }

    public function poststripe(Request $request)
    {
        $customer = customer::where('email', Auth::user()->email)->first();
        $product = prodect::where('id', $request->id)->first();    
        
        $date = $request->input('date');
        $time = $request->input('time');
        $count = $request->input('count');
        
        Stripe::setApiKey(config('services.stripe.secret'));
    
        $session = Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Send me money!!',
                        ],
                        'unit_amount' => $product->price * $count * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);

    //Create order:
    Order::create([
        'customer_id' => $customer->id,
        'birthdate' => $date,
        'time' => $time,
        'prodect_id' => $request->id,
        'count' => $count,
    ]);
    basket::where('prodect_id', $request->id)->where('customer_id', $customer->id)->delete();
    
    return redirect()->away($session->url);

}
    public function successtransaction(Request $request)
    {
        session()->flash('Add', 'تم عمل الدفع بنجاح، يتم مراجعة الطلب الآن');
        return redirect()->back();
    }
    
    public function canceltransaction(Request $request){
        session()->flash('error', 'فشلت عملية الدفع يرجي التحقق من البيانات');
        return redirect()->back();
    }
}
 