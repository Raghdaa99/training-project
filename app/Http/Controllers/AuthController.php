<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Department;
use App\Models\StudentSupervisor;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\Trainer;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        $request->merge(['guard' => $request->guard]);
        $validator = Validator($request->all(), [
            'guard' => 'required|string|in:student,admin,supervisor,trainer'
        ]);
        if (!$validator->fails()) {

            return response()->view('cms.auth.login', ['guard' => $request->input('guard')]);
        } else {
            abort(Response::HTTP_NOT_FOUND);
        }
    }

    public function login(Request $request)
    {
        //dd($request->guard);
        $validator = Validator($request->all(), [
//            'number' => "required|exists:register_students_course,student_no",
            'number' => [
                'required',],
            'password' => 'required|string',
            'remember' => 'required|boolean',
            'guard' => 'required|string|in:student,admin,supervisor,trainer'
        ], [
            'number.required' => 'Empty Fields'
        ]);

        if (!$validator->fails()) {
            $guard = $request->input('guard') . "_no";
            if ($request->input('guard') == 'trainer') {
                $guard = 'email';
            } elseif ($request->input('guard') == 'student') {
                $student = Student::where('student_no', '=', $request->input('number'))->first();
                if ($student != null && $student->status != 0) {
                    $student = StudentSupervisor::where('student_no', '=', $request->input('number'))->first();
                    if ($student == null) {
                        return response()->json(
                            ['message' => 'Not allowed'],
                            Response::HTTP_BAD_REQUEST
                        );
                    }
                } else {
                    return response()->json(
                        ['message' => 'You dont have account'],
                        Response::HTTP_BAD_REQUEST
                    );
                }

            } elseif ($request->input('guard') == 'supervisor') {
                $supervisor = Supervisor::where('supervisor_no', '=', $request->input('number'))->first();
                if ($supervisor != null && $supervisor->status != 0) {
                    $supervisor = StudentSupervisor::where('supervisor_no', '=', $request->input('number'))->first();
                    if ($supervisor == null) {
                        return response()->json(
                            ['message' => 'Not allowed'],
                            Response::HTTP_BAD_REQUEST
                        );
                    }
                } else {
                    return response()->json(
                        ['message' => 'You dont have account'],
                        Response::HTTP_BAD_REQUEST
                    );
                }
            }


            $credentials = ["$guard" => $request->input('number'), 'password' => $request->input('password')];
            if (Auth::guard($request->input('guard'))->attempt($credentials, $request->input('remember'))) {
                return response()->json(['message' => 'Logged in Success'], Response::HTTP_OK);
            } else {
                return response()->json(
                    ['message' => 'Login Failed , check your credentials'],
                    Response::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public
    function register(Request $request)
    {

        $validator = Validator($request->all(), [
            'number' => "required|integer",
            'password' => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:6',
            'guard' => 'required|string|in:student,supervisor',
            'department_no' => 'required|exists:departments,department_no'
        ]);
        //        $guard = $request->input('guard') . "_no";

        if (!$validator->fails()) {
            if ($request->input('guard') == 'student') {
                $user = Student::where('student_no', '=', $request->input('number'))->first();
            } elseif ($request->input('guard') == 'supervisor') {
                $user = Supervisor::where('supervisor_no', '=', $request->input('number'))->first();
            }
            if ($user != null && $user->status == 0) {

                $user->password = Hash::make($request->input('password'));
                $user->department_no = $request->input('department_no');
                $user->status = 1;
                $isSaved = $user->save();
                if ($isSaved) {
                    if ($request->input('guard') == 'student') {
                        $user->assignRole(Role::findById(3, 'student'));
                    } else {
                        $user->assignRole(Role::findById(2, 'supervisor'));
                    }
                    return response()->json(
                        [
                            'message' => $isSaved ? 'User created successfully' : 'Create failed!'
                        ],
                        $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
                    );
                }
            } else {
                return response()->json(['message' => 'You already registered'], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public
    function showRegister(Request $request)
    {

        $request->merge(['guard' => $request->guard]);
        $request->merge(['academic_number' => $request->academic_number]);
        $request->merge(['id_number' => $request->id_number]);
        //        dd($request->id_number);
        //dd($request->all);
        $validator = Validator($request->all(), [
            'guard' => 'required|string|in:student,supervisor',
            // 'academic_number' => "required|numeric|exists:students,student_no",
            // 'id_number' => 'required|numeric|exists:students,id_number',
        ]);
        $departments = Department::all();
        if (!$validator->fails()) {
            $guard = $request->input('guard') . "_no";
            if ($request->input('guard') == 'student') {
                $user = Student::where($guard, '=', $request->input('academic_number'))
                    ->where('id_number', '=', $request->input('id_number'))->first();
            } else if ($request->input('guard') == 'supervisor') {
                $user = Supervisor::where($guard, '=', $request->input('academic_number'))
                    ->where('id_number', '=', $request->input('id_number'))->first();
            }
            if ($user != null) {
                return response()->view('cms.auth.register', ['guard' => $request->input('guard'),
                    'user' => $user, 'departments' => $departments]);
            } else {
                abort(Response::HTTP_NOT_FOUND);
            }
        } else {
            abort(Response::HTTP_NOT_FOUND);
        }
    }

    public
    function showCheckCredentials(Request $request)
    {
        $request->merge(['guard' => $request->guard]);
        $validator = Validator($request->all(), [
            'guard' => 'required|string|in:student,supervisor'
        ]);

        if (!$validator->fails()) {
            return response()->view('cms.auth.check-credentials', ['guard' => $request->input('guard')]);
        } else {
            abort(Response::HTTP_NOT_FOUND);
        }
    }

    public
    function checkCredential(Request $request)
    {
        $request->merge(['guard' => $request->guard]);
        $validator = Validator($request->all(), [
            'academic_number' => "required|numeric",
            'id_number' => 'required|numeric',
            'guard' => 'required|string|in:student,supervisor'
        ]);
        if (!$validator->fails()) {
            $guard = $request->input('guard') . "_no";
            if ($request->input('guard') == 'student') {
                $user = Student::where($guard, '=', $request->input('academic_number'))
                    ->where('id_number', '=', $request->input('id_number'))->first();
            } else if ($request->input('guard') == 'supervisor') {
                $user = Supervisor::where($guard, '=', $request->input('academic_number'))
                    ->where('id_number', '=', $request->input('id_number'))->first();
            }

            if ($user != null) {
                return response()->redirectToRoute('cms.register', [
                    'guard' => $request->input('guard'),
                    'academic_number' => $user->$guard, 'id_number' => $user->id_number
                ]);
            } else {
                return response()->json(
                    ['message' => 'Checked Failed , check your credentials'],
                    Response::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public
    function logout(Request $request)
    {
        //        $guard = auth('web')->check() ? 'web' : 'admin';
        if (auth('student')->check()) {
            $guard = 'student';
        } elseif (auth('admin')->check()) {
            $guard = 'admin';
        } elseif (auth('trainer')->check()) {
            $guard = 'trainer';
        } elseif (auth('supervisor')->check()) {
            $guard = 'supervisor';
        }
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('cms.login', $guard);
    }

    public
    function update_password(Request $request)
    {
        // $id = Auth::guard('supervisor')->user()->supervisor_no;
        //$user = Student::find($id);

        $validator = Validator($request->all(), [

            'oldpassword' => 'required',
            'newpassword' => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:6',
        ]);
        //$2y$10$g/XYtoCTzSFE7RWDB/Jkl.okl9Q9oX36bWX0RzI5fzlb6HZiqnnnS
        if (!$validator->fails()) {
            if (auth('student')->check()) {
                $id = Auth::guard('student')->user()->student_no;
                $user = Student::find($id);
            } elseif (auth('supervisor')->check()) {
                $id = Auth::guard('supervisor')->user()->supervisor_no;
                $user = Supervisor::find($id);
            } elseif (auth('trainer')->check()) {
                $id = Auth::guard('trainer')->user()->id;
                $user = Trainer::find($id);
            } elseif (auth('admin')->check()) {
                $id = Auth::guard('admin')->user()->admin_no;
                $user = Admin::find($id);
            }

            // $user = User::find($id);
            if ($user != null) {
                $hashedPassword = $user->password;

                if (Hash::check($request->oldpassword, $hashedPassword)) {

                    if (!Hash::check($request->newpassword, $hashedPassword)) {

                        //$users =Auth::user()->id;
                        $user->password = Hash::make($request->newpassword);
                        // User::where('id', $id)->update(array('password' =>  $user->password));
                        $isSaved = $user->save();
                        return response()->json(
                            [
                                'message' => $isSaved ? 'Password updated successfully' : 'failed!'
                            ],
                            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
                        );
                    } else {
                        return response()->json(
                            ['message' => 'new password can not be the old password!'],
                            Response::HTTP_BAD_REQUEST
                        );
                    }
                } else {

                    return response()->json(
                        ['message' => 'old password doesnt matched'],
                        Response::HTTP_BAD_REQUEST
                    );
                }
            } else {
                return response()->json(
                    ['message' => 'Error Data'],
                    Response::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public
    function update_pass_show(Request $request)
    {

        return view('cms.auth.update-password');
    }
}
