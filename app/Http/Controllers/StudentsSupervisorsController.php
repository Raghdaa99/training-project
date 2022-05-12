<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\StudentSupervisor;
use App\Models\Student;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentsSupervisorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $items = StudentSupervisor::all();
        return response()->view('cms.register_students_course', ['items' => $items]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::all();
        $supervisors = Supervisor::all();
        return response()->view('cms.create-students-to-supervisor', ['students' => $students, 'supervisors' => $supervisors]);
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
            'supervisor_no' => 'required|numeric|exists:supervisors,supervisor_no',
            'student_no' => 'required|numeric|exists:students,student_no',


        ]);
        if (!$validator->fails()) {
            $register = new StudentSupervisor();
            $register->supervisor_no = $request->supervisor_no;
            $register->student_no = $request->student_no;

            $isSaved = $register->save();
            if ($isSaved) {
                return response()->json(['message' => $isSaved ? 'Company succsess Created' : 'Faield']
                    , $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);


            } else {
                return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\StudentSupervisor $registerStudentCourse
     * @return \Illuminate\Http\Response
     */
    public
    function show(StudentSupervisor $registerStudentCourse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\StudentSupervisor $registerStudentCourse
     * @return \Illuminate\Http\Response
     */
    public
    function edit(StudentSupervisor $registerStudentCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\StudentSupervisor $registerStudentCourse
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, StudentSupervisor $registerStudentCourse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\StudentSupervisor $registerStudentCourse
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(StudentSupervisor $registerStudentCourse)
    {
        //
    }
}
