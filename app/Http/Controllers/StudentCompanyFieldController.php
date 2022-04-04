<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Field;
use App\Models\StudentCompanyField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentCompanyFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Auth::guard('student')->user();
        $items = StudentCompanyField::where('student_no', '=', $student->student_no)->get();

        return response()->view('cms.students.show_student_company', ['items' => $items]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        $fields = Field::all();
        $student = Auth::guard('student')->user();
        return response()->view('cms.students.add_student_company',
            ['companies' => $companies,
                'fields' => $fields,
                'student' => $student]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $student = Auth::guard('student')->user();

        $request->merge(['student_no' => $student->student_no]);
        $validator = Validator($request->all(), [
            'student_no' => 'required|numeric|unique:students_company_field,student_no,',
            'company_id' => 'required|numeric|exists:companies,id',
            'field_id' => 'required|numeric|exists:fields,id',
        ],
            [
                'student_no.unique' => 'The company already registered'
            ]
        );
        $item = new StudentCompanyField();

        if (!$validator->fails()) {
            $item->student_no = $student->student_no;
            $item->company_id = $request->company_id;
            $item->field_id = $request->field_id;
            $item->status = 0;
            $isSaved = $item->save();
            return response()->json(['message' => $isSaved ? ' succsess Registered' : 'Faield']
                , $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\StudentCompanyField $studentCompanyField
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        dd($id);
        $studentCompanyField = StudentCompanyField::findOrFail($id);
//        dd($studentCompanyField);
        return response()->view('cms.companies.show_students_company', ['item' => $studentCompanyField]);
    }

    public function update_status(Request $request, $id)
    {
//        dd($request->all());
        $item = StudentCompanyField::findOrFail($id);
        $validator = Validator($request->all(), [
            'status' => 'required'
        ]);

        if (!$validator->fails()) {

            $item->status = $request->status;
            $isSaved = $item->save();
            return response()->json(['message' => $isSaved ? ' success' : 'Failed']
                , $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\StudentCompanyField $studentCompanyField
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentCompanyField $studentCompanyField)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\StudentCompanyField $studentCompanyField
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentCompanyField $studentCompanyField)
    {

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\StudentCompanyField $studentCompanyField
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(StudentCompanyField $studentCompanyField)
    {
        $isDeleted = $studentCompanyField->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
