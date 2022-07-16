<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\StudentCompanyField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function create_report($id)
    {
        $student_company = StudentCompanyField::findBySlugOrFail($id);

        $reports = Report::where('student_company_id', $student_company->id)->get();
        return response()->view('cms.students.create_report', ['id' => $student_company->id, 'reports' => $reports]);
    }

    public function download($file)
    {

        return response()->download(storage_path('app\reports\\' . $file));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'student_company_id' => 'required|numeric|exists:students_company_field,id',
            'file' => 'required|mimes:pdf,txt,xlx,csv,docx,jpg,pptx,zip,rar,png,jpeg|max:2048',
        ]);

        if (!$validator->fails()) {
            $name = $request->file('file')->getClientOriginalName();
            $request->file->storeAs('reports', $name);
            $report = new Report();
            $report->url = $name;
            $report->student_company_id = $request->student_company_id;
            $isSaved = $report->save();

            return redirect()->back()->with('status', 'File Has been uploaded successfully');
        } else {
            session()->flash('error', $validator->getMessageBag()->first());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Report $report)
    {

        if (Storage::exists('reports/' . $report->url)) {
            Storage::delete('reports/' . $report->url);
            $isDeleted = $report->delete();
            return response()->json(
                ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
                $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                [
                    'message' => 'Deleted Failed', Response::HTTP_BAD_REQUEST
                ]);
        }

    }
}
