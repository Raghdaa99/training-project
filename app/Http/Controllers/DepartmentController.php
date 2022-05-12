<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        return response()->view('cms.departments.index',['departments'=>$departments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.departments.add');

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
            'department_no' => 'required|string|unique:departments,department_no',
            'department_name' => 'required|string',
        ]);
        if(!$validator->fails()){
            $department = new Department();
            $department->name = $request->department_name;
            $department->department_no = $request->department_no;
            $isSaved = $department->save();

          return response()->json(['message'=>$isSaved ? 'Department succsess Created' : 'Faield']
          ,$isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST );
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
      }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return response()->view('cms.departments.edit',['department'=>$department]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Department $department)
    {
        $validator = Validator($request->all(),[
            'name' => 'required|string',
            
            // 'department_no' => 'required|unique:departments,department_no'
            // 'department_no' => 'required|unique:departments,department_no,'.$department->department_no,
            'department_no' => ['required', 'numeric', Rule::unique('departments')->ignore($department->department_no, 'department_no')],
        ]);
        if(!$validator->fails()){
            $department->name = $request->name;
            $department->department_no = $request->department_no;
            $isSaved = $department->save();

            return response()->json(['message'=>$isSaved ? 'Department succsess Updated' : 'Faield']
                ,$isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST );
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Department $department)
    {
        $isDeleted = $department->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
