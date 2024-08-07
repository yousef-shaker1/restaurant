<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\offer;
use App\Models\order;
use App\Models\tables;
use App\Models\prodect;
use App\Models\section;
use App\Models\customer;
use App\Models\orderoffer;
use App\Http\Requests\table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        ->size(['width' => 300, 'height' => 400]) 
        ->labels(['Order product', 'Order offer'])
        ->datasets([
            [
                'backgroundColor' => ['#FF6384', '#36A2EB'],
                'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
                'data' => [order::count(), orderoffer::count()]
            ]
            ])
        ->options([]);

    $orderRejected = order::where('status', 'رفض')->count() + orderoffer::where('status', 'رفض')->count(); 
    $Acceptorder = order::where('status', 'قبول')->count() + orderoffer::where('status', 'قبول')->count(); 
    $ordercomplate = order::where('status', 'اتمام')->count() + orderoffer::where('status', 'اتمام')->count(); 
    $chartjs2 = app()->chartjs
    ->name('barChartTest')
    ->type('bar')
    ->size(['width' => 1300, 'height' => 900])
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

    public function markasread()
    {
        $user = User::where('id', Auth::user()->id)->first();
        foreach($user->unreadNotifications as $notificate){
            $notificate->markAsRead();
        }
        return redirect()->back();
    }

    public function show_single_product($id)
    {
        $prodect = prodect::where('id', $id)->first();
        $get_id = DB::table('notifications')->where('data->pro_id', $id)->where('notifiable_id', Auth::user()->id)->pluck('id');
        DB::table('notifications')->where('id', $get_id)->update(['read_at' => now()]);
        return view('user.showmenu', compact('prodect'));
    }

    public function table_show(){
        $tables = tables::all();
        return view('admin.tables', compact('tables'));
    }

    public function show_users(){
        $customers = customer::all();
        return view('admin.customers', compact('customers'));
    }

    public function delete_table(Request $request,$id){
        tables::find($request->id)->delete();
        session()->flash('delete', 'delete table success');
        return redirect()->back();
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
