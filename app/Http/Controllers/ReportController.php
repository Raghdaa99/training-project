<?php

namespace App\Http\Controllers;

use App\Models\Report;
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
        $reports = Report::where('student_company_id', $id)->get();
        return response()->view('cms.students.create_report', ['id' => $id, 'reports' => $reports]);
    }

    public function download(Request $request, $file)
    {
//        dd(public_path('uploads/') . $file);

//        return response()->download(public_path('uploads/') . $file);
//        return response()->download(storage_path('app/reports/' . $file));
//        echo public_path('reports/') . $file;
        if (file_exists(public_path(). "/reports/".$file)) {
//            return Storage::download(public_path(). "/reports/cv.pdf");
            return response()->download(public_path(). "/reports/".$file);
        } else {
            echo('File not found.dddd');
        }
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
            'file' => 'required|mimes:pdf,txt,xlx,csv,docx|max:2048',
        ]);

        if (!$validator->fails()) {
//        $name = $request->file('file')->getClientOriginalName();
//
//        $path = $request->file('file')->store('public/files');
//            $fileName = time() . '.' . $request->file->extension();

//            $request->file->move(public_path('uploads'), $fileName);
//            $request->file->storeAs('reports',$fileName);
//            Storage::put('reports', $fileName);
            $name = $request->file('file')->getClientOriginalName();

            $request->file('file')->move('reports', $name);

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
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
