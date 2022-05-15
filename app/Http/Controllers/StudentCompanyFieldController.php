<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyField;
use App\Models\Field;
use App\Models\StudentCompanyField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $item = StudentCompanyField::where('student_no', '=', $student->student_no)->first();

        return response()->view('cms.students.show_student_company', ['item' => $item]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $companies = Company::all();
//        $fields = Field::all();
//        $student = Auth::guard('student')->user();
//        return response()->view('cms.students.add_student_company',
//            ['companies' => $companies,
//                'fields' => $fields,
//                'student' => $student]);
    }

    public function create_company_field(Request $request, $student_no)
    {

        $guard = Auth::guard('student')->check() ? 'student' : 'supervisor';
        if ($guard == 'student') {
            $student_no = Auth::guard('student')->user()->student_no;
        }


        $request->merge(['company_id' => $request->company_id]);
        $request->merge(['student_no' => $student_no]);
//Validate -------------

        if ($request->company_id != null) {
            $company_id = $request->input('company_id');
        } else {
            $company_id = Company::first()->id;
        }


        $companies = Company::all();
        $fields = Field::whereHas('companies', function ($query) use ($company_id) {
            $query->where('company_id', '=', $company_id);
        })->get();
//        $student = Auth::guard('student')->user();
        return response()->view('cms.students.add_student_company',
            ['companies' => $companies,
                'fields' => $fields, 'company_id' => $company_id,
                'student_no' => $student_no,
                'guard' => $guard]);
    }

    public function edit_company_field(StudentCompanyField $studentCompanyField, $company_id = 2)
    {
        $companies = Company::all();
        $fields = Field::whereHas('companies', function ($query) use ($company_id) {
            $query->where('company_id', '=', $company_id);
        })->get();
        $student = Auth::guard('student')->user();

        return response()->view('cms.students.edit_student_company',
            ['companies' => $companies,
                'fields' => $fields,
                'student' => $student,
                'studentCompanyField' => $studentCompanyField,
                'company_id' => $company_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {


        $validator = Validator($request->all(), [
            'student_no' => 'required|numeric|unique:students_company_field,student_no,',
            //'student_no' => 'required|numeric|exists:register_students_course,student_no,',
            'company_id' => 'required|numeric|exists:companies,id',
            'field_id' => 'required|numeric|exists:fields,id',
        ],
            [
                'student_no.unique' => 'The company already registered'
            ]
        );

        if (!$validator->fails()) {
            $company_id = $request->company_id;
            $field_id = $request->field_id;
            $company_field = CompanyField::where([
                ['company_id', '=', $company_id],
                ['field_id', '=', $field_id]])->first();

            if (Auth::guard('student')->check() == 'student')
                $student_no = Auth::guard('student')->user()->student_no;
            else
                $student_no = $request->student_no;


            $item = new StudentCompanyField();
            $item->student_no = $student_no;
            $item->company_field_id = $company_field->id;

            $item->status_company = 0;
            $item->status_supervisor = 0;
            $item->notes = $request->notes;
            $isSaved = $item->save();
            return response()->json(['message' => $isSaved ? ' succsess Registered' : 'Faield']
                , $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
//            if (Auth::guard('student')->check()){
//
//            }
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

            $item->status_company = $request->status;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $studentCompanyField)
    {
//        dd($studentCompanyField);
        $studentCompanyField = StudentCompanyField::findOrFail($studentCompanyField);
        $student = Auth::guard('student')->user();

        $request->merge(['student_no' => $student->student_no]);
        $validator = Validator($request->all(), [
                'student_no' => 'required|numeric|unique:students_company_field,student_no,' . $studentCompanyField->id,
                'company_id' => 'required|numeric|exists:companies,id',
                'field_id' => 'required|numeric|exists:fields,id',
            ]
        );

        if (!$validator->fails()) {
            $company_id = $request->company_id;
            $field_id = $request->field_id;
            $company_field = CompanyField::where([
                ['company_id', '=', $company_id],
                ['field_id', '=', $field_id]])->first();
//            $company_field_id = $company_field->id;
//            dd();

            $studentCompanyField->student_no = $student->student_no;
            $studentCompanyField->company_field_id = $company_field->id;

            $studentCompanyField->status_company = 0;
            $studentCompanyField->status_supervisor = 0;
            $studentCompanyField->notes = $request->notes;
            $isSaved = $studentCompanyField->save();
            return response()->json(['message' => $isSaved ? ' succsess Edited' : 'Faield']
                , $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\StudentCompanyField $studentCompanyField
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($studentCompanyField)
    {
//        dd($studentCompanyField);
        $isDeleted = StudentCompanyField::destroy([$studentCompanyField]);
//        $isDeleted = $studentCompanyField->delete();
        return response()->json(
            ['message' => $isDeleted > 0 ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted > 0 ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
