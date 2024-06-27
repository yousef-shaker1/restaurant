<?php

namespace App\Http\Controllers;

use App\Models\offer;
use App\Models\order;
use App\Models\prodect;
use App\Models\section;
use App\Models\customer;
use App\Models\orderoffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserpageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodects = prodect::paginate(9);
        $sections = section::get();
        $offers = offer::get();
        return view('welcome' , compact('prodects', 'sections', 'offers'));
    }
     
    public function about()
    {
        return view('user.about');
    }
    
    // public function index()
    // {
        //     return view('user.menu');
        // }
        
        /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodects = prodect::paginate(10);
        $sections = section::get();
        return view('user.menu', compact('prodects', 'sections'));
        //
    }
    
    public function Previousrequests(){
        if (!empty(Auth::user()->id)){
            $customer = customer::where('email' , Auth::user()->email)->first();
            $orders = order::where('customer_id', $customer->id)->get();
            $offers = orderoffer::where('customer_id', $customer->id)->get();
            return view('user.Previousrequests', compact('orders', 'offers'));
        }
    }


    public function dashboard(){
        $chartjs1 = app()->chartjs
        ->name('ordersPieChart')
        ->type('pie')
        ->size(['width' => 300, 'height' => 400]) // تعديل الحجم ليكون أكبر
        ->labels(['Order product', 'Order offer'])
        ->datasets([
            [
                'backgroundColor' => ['#FF6384', '#36A2EB'],
                'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
                'data' => [order::count(), orderoffer::count()] // تعديل القيم بناءً على عدد الأوامر
            ]
            ])
        ->options([]);

    $orderRejected = order::where('status', 'رفض')->count() + orderoffer::where('status', 'رفض')->count(); 
    $Acceptorder = order::where('status', 'قبول')->count() + orderoffer::where('status', 'قبول')->count(); 
    $ordercomplate = order::where('status', 'اتمام')->count() + orderoffer::where('status', 'اتمام')->count(); 
    $chartjs2 = app()->chartjs
    ->name('barChartTest')
    ->type('bar')
    ->size(['width' => 450, 'height' => 300])
    ->labels(['الاوردرات المرفوضة', 'الاوردرات المقبولة', 'الاوردات التي تمت'])
    ->datasets([
        [
            "label" => "أحوال الطلبات",
            'backgroundColor' => ['#B22222', '#4169E1', '#00FF7F'],
            'data' => [$orderRejected, $Acceptorder, $ordercomplate]
        ]
    ])
    ->options([]);
        return view('admin.index', compact('chartjs1', 'chartjs2'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
