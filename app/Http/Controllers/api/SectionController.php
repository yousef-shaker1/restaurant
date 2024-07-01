<?php

namespace App\Http\Controllers\api;

use App\Models\section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SectionResponse;
use App\Http\Controllers\api\ApirequestTrait;
use Illuminate\Validation\ValidationException;

class SectionController extends Controller
{
    use ApirequestTrait;
    public function index(){
        $sections = SectionResponse::collection(section::all());
        return $this->apiResponse($sections, 'ok', 200);
    }

    public function show($id){
        $section = section::find($id);
        if(!$section){
            return $this->apiResponse(null, 'section not found', 404);
        }
        return $this->apiResponse(new SectionResponse($section), 'ok', 200); 
    }

    public function store(Request $request){
        try{
            $validate = $request->validate([
                'name' => 'required|between:2,100',
            ]);
        } catch (ValidationException $e){
            return $this->apiResponse(null, $e->errors(), 404);
        }
        $section = section::create($validate);
        if(!$section){
            return $this->apiResponse(null, "section not found",200);
        }
        return $this->apiResponse(new SectionResponse($section), "create successfully",201);
    }
    public function edit(Request $request, $id){
        try{
            $validate = $request->validate([
                'name' => 'required|between:2,100',
            ]);
        } catch (ValidationException $e){
            return $this->apiResponse(null, $e->errors(), 404);
        }
        $section = section::find($id);
        if(!$section){
            return $this->apiResponse(null, "section not found",200);
        }
        $section->update($validate);

        return $this->apiResponse(new SectionResponse($section), "edit section successfully",200);
    }

    public function delete($id){
        $section = section::find($id);
        if(!$section){
            return $this->apiResponse(null, "section not found",200);
        }
        $section->delete();
        return $this->apiResponse(null, "delete section successfully",200);
    }
}
