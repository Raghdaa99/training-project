<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyField;
use App\Models\Field;
use App\Models\StudentCompanyField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return response()->view('cms.companies.index', ['companies' => $companies]);
    }
//    public function show_company(){
////        dd('55');
//        return response()->view('cms.companies.show_students_company');
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fields = Field::all();
        return response()->view('cms.companies.add', ['fields' => $fields]);

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
            'name' => 'required|string',
            'email' => 'required|email|unique:companies,email,',
            'phone' => 'required|string|unique:companies,phone,',
            'address' => 'required|string',
        ]);
        if (!$validator->fails()) {
            $company = new Company();
            $company->name = $request->name;
            $company->email = $request->email;
            $company->phone = $request->phone;
            $company->address = $request->address;
            $isSaved = $company->save();
            if ($isSaved) {
                $myCheckboxes = $request->input('fields_req');
                foreach ($myCheckboxes as $key => $value) {
                    DB::table('companies_fields')->insert([
                        'field_id' => $value,
                        'company_id' => $company->id,
                    ]);
                }
            }
            return response()->json(['message' => $isSaved ? 'Company succsess Created' : 'Faield']
                , $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $fields = Field::whereHas('companies', function ($query) use ($company) {
            $query->where('company_id', '=', $company->id);
        })->get();
//        $fields = Field::whereHas('companies');
//        dd($fields);
        $fields = Field::all();
        $fields_id = DB::table('companies_fields')->select(['field_id'])->where('company_id', '=', $company->id)->get();
        $fields_companies = [];
        foreach ($fields_id as $key => $value) {
            $object = Field::where('id', '=', $value->field_id)->first();
            $fields_companies[] = (object)$object;
        }

        return response()->view('cms.companies.show_fields_company', ['company' => $company, 'fields' => $fields, 'fields_companies' => $fields_companies]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $fields = Field::all();
        $fields_id = DB::table('companies_fields')->select(['field_id'])->where('company_id', '=', $company->id)->get();
        $fields_companies = [];
        foreach ($fields_id as $key => $value) {
            $object = Field::where('id', '=', $value->field_id)->first();
            $fields_companies[] = (object)$object;
        }

        return response()->view('cms.companies.edit', ['company' => $company, 'fields' => $fields,
            'fields_companies' => $fields_companies]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Company $company)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:companies,email,' . $company->id,
            'phone' => 'required|string|unique:companies,phone,' . $company->id,
            'address' => 'required|string',
        ]);
        if (!$validator->fails()) {
            $company->name = $request->name;
            $company->email = $request->email;
            $company->phone = $request->phone;
            $company->address = $request->address;
            $isSaved = $company->save();
//            if ($isSaved) {
//                $myCheckboxes = $request->input('fields_req');
//                DB::table('companies_fields')->where('company_id', '=', $company->id)
//                    ->delete();
//
//                foreach ($myCheckboxes as $key => $value) {
//
//                    DB::table('companies_fields')->insert([
//                        'field_id' => $value,
//                        'company_id' => $company->id,
//                    ]);
//                }
//            }
            return response()->json(['message' => $isSaved ? 'Company succsess Updated' : 'Faield']
                , $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function updateCompanyFields(Request $request)
    {

        $validator = Validator($request->all(), [
            'company_id' => 'required|numeric|exists:companies,id',
            'field_id' => 'required|numeric|exists:fields,id',
        ]);
        if (!$validator->fails()) {
            $company_field = CompanyField::where('company_id', $request->company_id)->where('field_id', $request->field_id)->first();
            if ($company_field == null) {

//insert
                $company_field = new CompanyField();
                $company_field->company_id = $request->company_id;
                $company_field->field_id = $request->field_id;
                $isSaved = $company_field->save();

                return response()->json(['message' => $isSaved ? 'success Updated' : 'Failed']
                    , $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
            } else {
                $student_company_field = StudentCompanyField::where('company_field_id', $company_field->id)->first();
                if ($student_company_field == null) {
//delete
                    $isDelete =$company_field->delete();
                    return response()->json(['message' => $isDelete ? 'success Deleted' : 'Failed']
                        , $isDelete ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
                } else {
                    return response()->json(['message' => 'Company with this filed has been Taken'], Response::HTTP_BAD_REQUEST);

                }
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);

        }


//        $myCheckboxes = $request->input('fields_req');
//        DB::table('companies_fields')->where('company_id', '=', $company_id)
//            ->delete();
//
//        $isSaved = false;
//        foreach ($myCheckboxes as $key => $value) {
//
//            $isSaved =DB::table('companies_fields')->insert([
//                'field_id' => $value,
//                'company_id' => $company_id,
//            ]);
//        }
//
//        return response()->json(['message' => $isSaved ? 'Company success Updated' : 'Failed']
//            , $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Company $company)
    {
        $isDeleted = $company->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
