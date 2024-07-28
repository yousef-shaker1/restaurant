<?php

namespace App\Http\Controllers;

use App\Models\offer;
use App\Models\basket;
use App\Models\customer;
use App\Models\orderoffer;
use App\Models\basketoffer;
use Illuminate\Http\Request;
use App\Http\Requests\checkoffer;
use App\Http\Requests\updateoffer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    function __construct()
    {
    $this->middleware('permission:العروض', ['only' => ['index']]);
    $this->middleware('permission:اضافةعرض', ['only' => ['create','store']]);
    $this->middleware('permission:تعديل عرض', ['only' => ['edit','update']]);
    $this->middleware('permission:حذف عرض', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offers = offer::paginate(7);
        return view('admin.offer', compact('offers'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orderoffers = orderoffer::orderBy('birthdate')->paginate(7);
        return view('admin.orderoffer', compact('orderoffers'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(checkoffer $request)
    {
        $data = $request->validated();
        $data['image'] = request()->file('image')->store('photo', 'public');
        offer::create($data);
        Session()->flash('Add', 'تم اضافة العرض بنجاح');
        return redirect()->back();
    }
    
    /**
     * Display the specified resource.
     */
    //user page
    public function show(string $id)
    {
        $offer = offer::where('id', $id)->first();
        return view('user.showoffer', compact('offer'));
    }
    
    public function Basket(Request $request, string $id)
    {
        $customer = customer::where('email' , Auth::user()->email)->first();
        basketoffer::create([
            'customer_id' => $customer->id,
            'offer_id' => $id,
        ]);
        session()->flash('Add', 'تم اضافة العرض في السلة بنجاح');
        return redirect()->back();
    }

    public function sendoffer(string $id){
        $prodect = offer::where('id', $id)->first();
        return view('user.sendoffer', compact('prodect'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    public function showuser()
    {
        $offers = offer::paginate(5);
        return view('user.offer', compact('offers'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    //admin page
    public function update(updateoffer $request, string $id)
    {
        $offer = offer::find($request->id);
        $data = $request->validated();
        if($request->hasFile('image')){
            if (!empty($offer->image) && Storage::disk('public')->exists($offer->image)) {
                Storage::disk('public')->delete($offer->image);
            }
            $data['image'] = $request->file('image')->store('photo', 'public');
        }else{
            unset($data['image']);
        }
        $offer->update($data);

        session()->flash('edit', 'تم تحديث المنتج بنجاح');
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $offer = offer::findOrFail($request->id);
        if (!empty($offer->image) && Storage::disk('public')->exists($offer->image)) 
        {
            Storage::disk('public')->delete($offer->image);
        }
        $offer->delete();
        session()->flash('delete', 'تم حذف المنتج بنجاح');
        return redirect()->back();
    }
public function status1(Request $request, $id){
    orderoffer::where('id', $id)->update([
            'status' => 'قبول',
        ]);
        return redirect()->back();
    }
    public function status2(Request $request, $id){
        orderoffer::where('id', $id)->update([
            'status' => 'رفض',
        ]);
        return redirect()->back();
    }
    public function status3(Request $request, $id){
        orderoffer::where('id', $id)->update([
            'status' => 'اتمام',
        ]);
        return redirect()->back();
    }
    public function del(Request $request, $id){
        orderoffer::where('id', $id)->delete();
        session()->flash('delete', 'تم حذف المنتج بنجاح');
        return redirect()->back();        
    }
}