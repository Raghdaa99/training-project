<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Evaluation;
use App\Models\Question;
use App\Models\StudentCompanyField;
use App\Models\StudentSupervisor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinalReportsController extends Controller
{
    public function reportSupervisorStudents()
    {
//        $supervisor_no = Auth::user()->supervisor_no;
        $supervisor = Auth::user();
        $students = $supervisor->registerStudentCourse;
//        $students = StudentSupervisor::where('supervisor_no', $supervisor_no)->get();
        return response()->view('cms.reports.show-supervisor-students', ['students' => $students]);
    }

    public function reportSupervisorStudentsNames()
    {
        $supervisor = Auth::user();
        $students = $supervisor->registerStudentCourse;
        return response()->view('cms.reports.show-supervisor-students-names', ['students' => $students]);
    }
    public function reportCompanyStudents()
    {
//        $search_company_id = $request->input('company_id');

        $supervisor_no = Auth::user()->supervisor_no;


    }

    public function reportTrainerStudents()
    {

    }

    public function reportResultsEvaluationCompanyStudents()
    {
        $supervisor = Auth::guard('supervisor')->user();
        $company_students = StudentSupervisor::query();
        $company_students = $company_students->whereHas('supervisor', function ($query) use ($supervisor) {
            $query->where('supervisor_no', '=', $supervisor->supervisor_no);
        });

        $company_students = $company_students->get();

        return response()->view('cms.reports.show-company-students', ['company_students' => $company_students,]);

    }

    public function reportCompanyStudentsNames()
    {
        $supervisor = Auth::guard('supervisor')->user();
        $company_students = StudentSupervisor::query();
        $company_students = $company_students->whereHas('supervisor', function ($query) use ($supervisor) {
            $query->where('supervisor_no', '=', $supervisor->supervisor_no);
        });

        $company_students = $company_students->get();

        return response()->view('cms.reports.show-company-students-names', ['company_students' => $company_students,]);
    }

    public function reportResultEvaluationStudent($slug)
    {
        $student_company = StudentCompanyField::findBySlugOrFail($slug);

        $evaluationsTrainer = Evaluation::whereHas('question', function ($query) {
            $query->where('guard', 'trainer');
        })->where('student_company_id', '=', $student_company->id)->get();

        $evaluationsSupervisor = Evaluation::whereHas('question', function ($query) {
            $query->where('guard', 'supervisor');
        })->where('student_company_id', '=', $student_company->id)->get();

        $trainerMark = $student_company->getTrainerMark();
        $supervisorMark = $student_company->getSupervisorMark();
        $finalMark = $student_company->getFinalMark();
        $student_name = $student_company->student->student->name;

        return response()->view('cms.reports.show-evaluations-student', [
            'evaluationsTrainer' => $evaluationsTrainer,
            'evaluationsSupervisor' => $evaluationsSupervisor,
            'trainerMark' => $trainerMark,
            'supervisorMark' => $supervisorMark,
            'finalMark' => $finalMark,
            'student_name' => $student_name,

        ]);
    }
}
