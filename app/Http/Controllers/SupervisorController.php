<?php

namespace App\Http\Controllers;

use App\Mail\CompanyEmail;
use App\Models\RegisterStudentCourse;
use App\Models\Student;
use App\Models\StudentCompanyField;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class SupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supervisors = Supervisor::all();
        return response()->view('cms.supervisor.index', ['supervisors' => $supervisors]);
    }

    public function send_email(Request $request)
    {
        $validator = Validator($request->all(), [
            'id' => 'required|numeric|exists:students_company_field,id',
            'email' => 'required|email|exists:companies,email',
        ]);

        if (!$validator->fails()) {
            Mail::to($request->email)->send(new CompanyEmail($request->id));
            return response()->json(['message' => 'success'], Response::HTTP_OK);

        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);

        }
    }


/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public
function create()
{
    return response()->view('cms.supervisor.create');

}

public
function show_students()
{
    $supervisor = Auth::guard('supervisor')->user();

    $company_students = StudentCompanyField::whereHas('student', function ($query) use ($supervisor) {
        $query->where('supervisor_no', '=', $supervisor->supervisor_no);
    })->get();

//        dd($company_student);
//        dd($students[1]->studentCompanyField->companies->name);
    return response()->view('cms.supervisor.show_students', ['students' => $company_students]);
}

/**
 * Store a newly created resource in storage.
 *
 * @param \Illuminate\Http\Request $request
 * @return \Illuminate\Http\JsonResponse
 */
public
function store(Request $request)
{//exists:register_students_course,supervisor_no
    $validator = Validator($request->all(), [
        'name' => 'required|string|min:3|max:100',
        'number' => 'required|integer|unique:supervisors,supervisor_no',
        'email' => 'required|email|unique:supervisors,email',
        'phone' => 'required|string|unique:supervisors,phone',
        'password' => 'required|string|min:3|max:20',
    ]);

    if (!$validator->fails()) {
        $supervisor = new Supervisor();
        $supervisor->name = $request->input('name');
        $supervisor->supervisor_no = $request->input('number');
        $supervisor->email = $request->input('email');
        $supervisor->phone = $request->input('phone');
        $supervisor->password = Hash::make($request->input('password'));
        $isSaved = $supervisor->save();
        if ($isSaved) {
            $supervisor->assignRole(Role::findById(2, 'supervisor'));
            return response()->json(
                [
                    'message' => $isSaved ? 'Supervisor created successfully' : 'Create failed!'
                ],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        }

    } else {
        return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
    }
}

/**
 * Display the specified resource.
 *
 * @param \App\Models\Supervisor $supervisor
 * @return \Illuminate\Http\Response
 */
public
function show(Supervisor $supervisor)
{

}

/**
 * Show the form for editing the specified resource.
 *
 * @param \App\Models\Supervisor $supervisor
 * @return \Illuminate\Http\Response
 */
public
function edit(Supervisor $supervisor)
{
    //
}

/**
 * Update the specified resource in storage.
 *
 * @param \Illuminate\Http\Request $request
 * @param \App\Models\Supervisor $supervisor
 * @return \Illuminate\Http\Response
 */
public
function update(Request $request, Supervisor $supervisor)
{
    //
}

/**
 * Remove the specified resource from storage.
 *
 * @param \App\Models\Supervisor $supervisor
 * @return \Illuminate\Http\JsonResponse
 */
public
function destroy(Supervisor $supervisor)
{
    $isDeleted = $supervisor->delete();
    return response()->json(
        ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
        $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
    );
}
}
