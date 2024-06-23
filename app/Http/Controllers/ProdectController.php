<?php

namespace App\Http\Controllers;

use App\Models\prodect;
use App\Models\section;
use Illuminate\Http\Request;
use App\Http\Requests\checkprodect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProdectController extends Controller
{
    function __construct()
    {
    $this->middleware('permission:المنتجات', ['only' => ['index']]);
    $this->middleware('permission:اضافةالمنتجات', ['only' => ['create','store']]);
    $this->middleware('permission:تعديل المنتجات', ['only' => ['edit','update']]);
    $this->middleware('permission:حذف المنتجات', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodects = prodect::paginate(10);
        $sections = section::get();
        return view('admin.prodect', compact('prodects', 'sections'));
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
    public function store(checkprodect $request)
    {
        $data = $request->validated();
        $data['image'] = request()->file('image')->store('photo', 'public');
        $prodect = prodect::create($data);

        Session()->flash('Add', 'تم اضافة المنتج بنجاح');
        return redirect()->back();
    }
    
    /**
     * Display the specified resource.
     */
    public function show(prodect $prodect)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(prodect $prodect)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     */
    
    public function update(checkprodect $request, string $id)
    {
    $prodect = prodect::find($request->id);
    $data = $request->validated();
    if($request->hasFile('image')){
        if (!empty($prodect->image) && Storage::disk('public')->exists($prodect->image)) {
            Storage::disk('public')->delete($prodect->image);
        }
        $data['image'] = $request->file('image')->store('photo', 'public');
    }else{
        unset($data['image']);
    }
    $prodect->update($data);

    session()->flash('edit', 'تم تحديث المنتج بنجاح');
    return redirect()->back();
    //  الحصول على المنتج باستخدام ID
    
}
/**
 * Remove the specified resource from storage.
 */
public function destroy(Request $request, string $id)
{   
    $prodect = prodect::findOrFail($request->id);
    if (!empty($prodect->image) && Storage::disk('public')->exists($prodect->image)) {
        Storage::disk('public')->delete($prodect->image);
    }
    $prodect->delete();

    // Flash a success message and redirect back
    session()->flash('delete', 'تم حذف المنتج بنجاح');
    return redirect()->back();
    
}
}