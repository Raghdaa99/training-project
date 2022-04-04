<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\RegisterStudentCourse;
use App\Models\Student;
use Illuminate\Http\Request;

class RegisterStudentCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $items = RegisterStudentCourse::all();
        return response()->view('cms.register_students_course', ['items' => $items]);

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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\RegisterStudentCourse $registerStudentCourse
     * @return \Illuminate\Http\Response
     */
    public function show(RegisterStudentCourse $registerStudentCourse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\RegisterStudentCourse $registerStudentCourse
     * @return \Illuminate\Http\Response
     */
    public function edit(RegisterStudentCourse $registerStudentCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\RegisterStudentCourse $registerStudentCourse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegisterStudentCourse $registerStudentCourse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\RegisterStudentCourse $registerStudentCourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegisterStudentCourse $registerStudentCourse)
    {
        //
    }
}
