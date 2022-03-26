<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fields = Field::all();
        return response()->view('cms.fields.index',['fields'=>$fields]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.fields.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(),[
            'name' => 'required|string',
        ]);
        if(!$validator->fails()){
            $field = new Field();
            $field->name = $request->name;
            $isSaved = $field->save();

            return response()->json(['message'=>$isSaved ? 'Field succsess Created' : 'Faield']
                ,$isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST );
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function show(Field $field)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function edit(Field $field)
    {
        return response()->view('cms.fields.edit',['field'=>$field]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Field $field)
    {
        $validator = Validator($request->all(),[
            'name' => 'required|string',
        ]);
        if(!$validator->fails()){
            $field->name = $request->name;
            $isSaved = $field->save();

            return response()->json(['message'=>$isSaved ? 'Field succsess Updated' : 'Faield']
                ,$isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST );
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Field $field)
    {
        $isDeleted = $field->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
