<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\offer;
use App\Models\order;
use App\Models\basket;
use App\Models\prodect;
use App\Models\customer;
use App\Models\orderoffer;
use App\Models\basketoffer;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Customer as Costomer;
use Illuminate\Support\Facades\Auth;
use ConsoleTVs\Charts\Facades\Charts; 

class OrderController extends Controller
{
    function __construct()
    {
    $this->middleware('permission:الطلبات', ['only' => ['index']]);
    $this->middleware('permission:الطلبات المقبولة', ['only' => ['acceptedshow']]);
    $this->middleware('permission:الطلبات المرفوضة', ['only' => ['Orderrejected']]);
    $this->middleware('permission:الطلبات اللي تمت', ['only' => ['Ordercompleted']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = order::paginate(10);
        return view('admin.orders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $prodect = prodect::where('id', $id)->first();
        return view('user.showmenu', compact('prodect'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order $order)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, order $order)
    {
        //
    }
    
    public function delbascet(Request $request,string $id)
    {
        $customer = customer::where('email' , Auth::user()->email)->first();
        $del = basketoffer::where('offer_id', $id)->where('customer_id', $customer->id)->delete();
        session()->flash('delete', 'تم حذف العرض من السلة بنجاح');
        return redirect()->back(); 
    }

    public function delbascetprodect(Request $request,string $id)
    {
        $customer = customer::where('email' , Auth::user()->email)->first();
        $del = basket::where('prodect_id', $id)->where('customer_id', $customer->id)->delete();
        session()->flash('delete', 'تم حذف العرض من السلة بنجاح');
        return redirect()->back(); 
    }

    public function Basketall()
    {
        $customer = customer::where('email' , Auth::user()->email)->first();
        $baskets = basket::where('customer_id', $customer->id)->get();
        $basketsoffer = basketoffer::where('customer_id', $customer->id)->get();
        return view('user.basketall', compact('baskets', 'basketsoffer'));
    }
    

    public function Basket(Request $request, $id)
    {
        $customer = customer::where('email' , Auth::user()->email)->first();
        basket::create([
            'customer_id' => $customer->id,
            'prodect_id' => $id,
        ]);
        session()->flash('Add', 'تم اضافة الاوردر بنجاح');
        return redirect()->back();
        
    }
    public function sendorder(Request $request, $id){
        $prodect = prodect::where('id', $id)->first();
        return view('user.sendorder', compact('prodect'));
    }
    
    
    

    
    //====================
    public function okorderoffer(Request $request){
        $customer = customer::where('email' , Auth::user()->email)->first();
        $offer = offer::where('id', $request->id)->first();
        $date = request()->input('date');
        $time = request()->input('time');
        $count = request()->input('count');

        Stripe::setApiKey(config('services.stripe.secret'));
    
        $session = Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Send me money!!',
                        ],
                        'unit_amount' => $offer->price * $count * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('successoffer'),
            'cancel_url' => route('canceloffer'),
        ]);

        orderoffer::create([
            'customer_id' => $customer->id,
            'birthdate' => $date,
            'time' => $time,
            'offer_id' => $request->id,
            'count' => $count,
        ]);
        
        return redirect()->away($session->url);
    }


    public function successoffer(Request $request)
    {
        session()->flash('Add', 'تم عمل الدفع بنجاح، يتم مراجعة الطلب الآن.');
        return redirect()->back();
    }
    
    public function canceloffer(Request $request){
        session()->flash('error', 'فشلت عملية الدفع يرجي التحقق من البيانات');
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    { 
        order::where('id', $id)->delete();
        session()->flash('delete', 'تم حذف الاوردر بنجاح');
    }
    public function status1(Request $request, $id){
        order::where('id', $id)->update([
            'status' => 'قبول',
        ]);
        return redirect()->back();
    }
    public function status2(Request $request, $id){
        order::where('id', $id)->update([
            'status' => 'رفض',
        ]);
        return redirect()->back();
    }
    public function status3(Request $request, $id){
        order::where('id', $id)->update([
            'status' => 'اتمام',
        ]);
        return redirect()->back();
    }

    public function acceptedshow(){
        $orders = order::where('status', 'قبول')->paginate(9);
        return view('admin.orderaccept', compact('orders'));
    }

    public function Orderrejected(){
        $orders = order::where('status', 'رفض')->paginate(9);
        return view('admin.Orderrejected', compact('orders'));
    }
    public function Ordercompleted(){
        $orders = order::where('status', 'اتمام')->paginate(9);
        return view('admin.Ordercompleted', compact('orders'));
    }

    public function adminpage()
    {
        $chartjs1 = app()->chartjs
            ->name('ordersPieChart')
            ->type('pie')
            ->size(['width' => 400, 'height' => 400])
            ->labels(['Order product', 'Order clothing'])
            ->datasets([
                [
                    'backgroundColor' => ['#FF6384', '#36A2EB'],
                    'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
                    'data' => [order::count(), orderoffer::count()]
                ]
            ])
            ->options([]);

        // إعداد البيانات للشارت الثاني (Bar Chart)
        $orderRejected = order::where('status', 'رفض')->count() + orderoffer::where('status', 'رفض')->count();
        $Acceptorder = order::where('status', 'قبول')->count() + orderoffer::where('status', 'قبول')->count();
        $ordercomplate = order::where('status', 'اتمام')->count() + orderoffer::where('status', 'اتمام')->count();
        
        $chartjs2 = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 400])
            ->labels(['الاوردرات المرفوضة', 'الاوردرات المقبولة', 'الاوردرات التي تمت'])
            ->datasets([
                [
                    'backgroundColor' => ['#B22222', '#4169E1', '#00FF7F'],
                    'data' => [$orderRejected, $Acceptorder, $ordercomplate]
                ]
            ])
            ->options([]);
        return view('admin.index', compact('chartjs1', 'chartjs2'));
    }
    
}
