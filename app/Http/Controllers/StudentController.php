<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Field;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{

    public function __construct()
    {
//       $this->authorizeResource(Student::class, 'student');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Student::all();
        return response()->view('cms.students.index', ['students' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.students.create');
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
            'name' => 'required|string|min:3|max:100',
            'email_address' => 'required|email|unique:students,email',
            'gender' => 'required|string|in:Male,Female',
        ]);

        if (!$validator->fails()) {
            $user = new Student();
            $user->name = $request->input('name');
            $user->email = $request->input('email_address');
            $user->password = Hash::make(12345);
            $user->gender = $request->input('gender');
            $isSaved = $user->save();

            return response()->json(
                [
                    'message' => $isSaved ? 'Student created successfully' : 'Create failed!'
                ],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Student $user
     * @return \Illuminate\Http\Response
     */
    public function show(Student $user)
    {
        //
    }

    public function show_students_personal_data()
    {
        $student_no = Auth::user()->student_no;
        $student = Student::findOrFail($student_no);
        return view('cms.students.personal-data', ['student' => $student]);
    }

//    public function showAddCompany()
//    {
//
//
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Student $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $user)
    {
        return response()->view('cms.students.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Student $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Student $user)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:100',
            'email_address' => 'required|email|unique:students,email,' . $user->id,
            'gender' => 'required|string|in:Male,Female',

        ]);

        if (!$validator->fails()) {
            $user->name = $request->input('name');
            $user->email = $request->input('email_address');
            $user->password = Hash::make(12345);
            $user->gender = $request->input('gender');
            $isSaved = $user->save();
            return response()->json(
                [
                    'message' => $isSaved ? 'Student updated successfully' : 'Create failed!'
                ],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Student $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Student $user)
    {
        $isDeleted = $user->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
