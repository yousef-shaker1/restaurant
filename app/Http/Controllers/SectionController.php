<?php

namespace App\Http\Controllers;

use App\Models\section;
use Illuminate\Http\Request;
use App\Http\Requests\checksection;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = section::paginate(8);
        return view('admin.sections', compact('sections'));
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
    public function store(checksection $request)
    {
        section::create([
            'name' => $request->name,
        ]);
        Session()->flash('Add', 'تم اضافة قسم جديد بنجاح');
        return redirect()->back();
    }
    
    /**
     * Display the specified resource.
     */
    public function show(section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(section $section)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(checksection $request, string $id)
    {
        $sections = section::where('id', $request->id)->first();
        $sections->update([
            'name' => $request->name,
        ]);
        Session()->flash('edit', 'تم تعديل القسم بنجاح');
        return redirect()->back();
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $sections = section::where('id', $request->id)->delete();
        Session()->flash('delete', 'تم حذف القسم بنجاح');
        return redirect()->back();
    }
}
