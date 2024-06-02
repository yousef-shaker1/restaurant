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
     //
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
        $prodects = prodect::get();
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
        } else {
            session()->flash('login', 'يرجي تسجيل الدخول اولا');
            return redirect()->back();    
        }
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
