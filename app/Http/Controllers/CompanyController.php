<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
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
        return response()->view('cms.companies.index',['companies'=>$companies]);
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
        return view('cms.companies.add');

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
            'email' => 'required|email|unique:companies,email,',
            'phone' => 'required|string|unique:companies,phone,',
            'address' => 'required|string',
        ]);
        if(!$validator->fails()){
            $company = new Company();
            $company->name = $request->name;
            $company->email = $request->email;
            $company->phone = $request->phone;
            $company->address = $request->address;
            $isSaved = $company->save();

            return response()->json(['message'=>$isSaved ? 'Company succsess Created' : 'Faield']
                ,$isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST );
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return response()->view('cms.companies.edit',['company'=>$company]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Company $company)
    {
        $validator = Validator($request->all(),[
            'name' => 'required|string',
            'email' => 'required|email|unique:companies,email,'.$company->id,
            'phone' => 'required|string|unique:companies,phone,'.$company->id,
            'address' => 'required|string',
        ]);
        if(!$validator->fails()){
            $company->name = $request->name;
            $company->email = $request->email;
            $company->phone = $request->phone;
            $company->address = $request->address;
            $isSaved = $company->save();

            return response()->json(['message'=>$isSaved ? 'Company succsess Updated' : 'Faield']
                ,$isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST );
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
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
