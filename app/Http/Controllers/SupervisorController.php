<?php

namespace App\Http\Controllers;

use App\Mail\CompanyEmail;
use App\Models\Company;
use App\Models\Department;
use App\Models\StudentSupervisor;
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
//            'id' => 'required|numeric|exists:students_company_field,id',
            'email' => 'required|email|exists:companies,email',
        ]);
        $slug = StudentCompanyField::findBySlugOrFail($request->id);
        if (!$validator->fails()) {
            Mail::to($request->email)->send(new CompanyEmail($slug));
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

    public function create()
    {
        $departments = Department::all();
        return response()->view('cms.supervisor.create', ['departments' => $departments]);

    }

    public function search_students(Request $request)
    {
//        dd('5555');
        $search_student_no = $request->input('student_no');
        $search_student_name = $request->input('student_name');
        $search_company_id = $request->input('company_id');
        $supervisor = Auth::guard('supervisor')->user();
        $company_students = StudentSupervisor::query();
        $company_students = $company_students->whereHas('supervisor', function ($query) use ($search_student_name, $search_student_no, $supervisor) {
            $query->where('supervisor_no', '=', $supervisor->supervisor_no);
//                ->OrWhere('student_no', '=', $search_student_no);
        });

        $student_name = '';
        $student_no = '';
        if ($search_student_no != null) {
            $company_students = $company_students->where('student_no', '=', $search_student_no);
            $student_no = 'student_no=' . $search_student_no;
        }
        if ($search_student_name != null) {
            $company_students = $company_students->whereHas('student', function ($query_student_name) use ($search_student_name) {
                $query_student_name->where('name', 'like', '%' . $search_student_name . '%');
                $student_name = 'student_name=' . $search_student_name;
            });
        }
        $company_students = $company_students->get();
        $companies = Company::all();
//dd($company_students);

        return redirect()->route('supervisor.show.students', $student_no . $student_name)
            ->with(
                [
                    'company_students' => $company_students,
                    'companies' => $companies,
                ]
            );

//        return response()->view('cms.supervisor.show_students', ['company_students' => $company_students,
//            'search_student_no' => $search_student_no,
//            'search_student_name' => $search_student_name,
//            'companies' => $companies]);


    }

    public function personal_data()
    {
        $supervisor_no = Auth::user()->supervisor_no;
        $supervisor = Supervisor::findOrFail($supervisor_no);
        return view('cms.supervisor.personal-data', ['supervisor' => $supervisor]);
    }
    public function getNotifications()
    {
        return response()->view('cms.supervisor.notifications');
    }

    public function markAsRead($id)
    {
        if ($id) {
            \auth()->user()->notifications->where('id', $id)->markAsRead();

        }
        return back();
    }

    public function show_students(Request $request)
    {
        $search_student_no = $request->input('student_no');
        $search_student_name = $request->input('student_name');
        $search_company_id = $request->input('company_id');
        $supervisor = Auth::guard('supervisor')->user();
        $company_students = StudentSupervisor::query();
        $company_students = $company_students->whereHas('supervisor', function ($query) use ($search_student_name, $search_student_no, $supervisor) {
            $query->where('supervisor_no', '=', $supervisor->supervisor_no);
//                ->OrWhere('student_no', '=', $search_student_no);
        });


        if ($search_student_no != null) {
            $company_students = $company_students->where('student_no', '=', $search_student_no);
        }
        if ($search_student_name != null) {
            $company_students = $company_students->whereHas('student', function ($query_student_name) use ($search_student_name) {
                $query_student_name->where('name', 'like', '%' . $search_student_name . '%');
            });
        }
        $companies = Company::all();
        if ($search_company_id != null) {
            $company_students = $company_students->whereHas('studentCompany', function ($query) use ($search_company_id) {
                $query->whereHas('companyField', function ($query_company) use ($search_company_id) {
                    $query_company->whereHas('company', function ($query_inner_company) use ($search_company_id) {
                        $query_inner_company->where('id', $search_company_id);
                    });
                });
            });

        }

        $company_students = $company_students->get();

//        dd($company_students);

        return response()->view('cms.supervisor.show_students', ['company_students' => $company_students,
            'search_student_no' => $search_student_no,
            'search_student_name' => $search_student_name,
            'search_company_id' => $search_company_id,
            'companies' => $companies]);

    }

    public function show_students_details($id)
    {
        $company_student = StudentCompanyField::findBySlugOrFail($id);
        $student_no = $company_student->student_no;
        $supervisor_no = Auth::guard('supervisor')->user()->supervisor_no;
        $student = StudentSupervisor::where('student_no', $student_no)->where('supervisor_no', $supervisor_no)->first();
        $response = [];
        if ($student == null) {
            $response = ['error' => 'you cannot see details '];
        }
        return response()->view('cms.supervisor.show-details-student', ['company_student' => $company_student, 'error' => $response]);
    }

    public function updateSupervisorStatus(Request $request)
    {
        $validator = Validator($request->all(), [
            'id' => 'required|numeric|exists:students_company_field,id',
        ]);
        if (!$validator->fails()) {
            $studentCompanyField = StudentCompanyField::findOrFail($request->id);
            if ($studentCompanyField->status_supervisor == 1) {
                $studentCompanyField->status_supervisor = 0;
            } else {
                $studentCompanyField->status_supervisor = 1;
            }
            $isSaved = $studentCompanyField->save();
            return response()->json(['message' => $isSaved ? 'Updated successfully' : 'Updated failed!'],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);

        }
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
            'department_no' => 'required|numeric|exists:departments,department_no',

        ]);

        if (!$validator->fails()) {
            $supervisor = new Supervisor();
            $supervisor->name = $request->input('name');
            $supervisor->supervisor_no = $request->input('number');
            $supervisor->email = $request->input('email');
            $supervisor->phone = $request->input('phone');
            $supervisor->department_no = $request->input('department_no');
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
