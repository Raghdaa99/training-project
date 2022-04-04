<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        $request->merge(['guard' => $request->guard]);
        //dd($request->all());
        //dd($request->guard);

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
            'number' => "required",
            'password' => 'required|string|min:3',
            'remember' => 'required|boolean',
            'guard' => 'required|string|in:student,admin,supervisor,trainer'
        ]);

        if (!$validator->fails()) {
            $guard = $request->input('guard'). "_no";
            if ($request->input('guard') == 'trainer') {
                $guard = 'email';
            }
            $credentials = ["$guard" => $request->input('number'), 'password' => $request->input('password')];
            if (Auth::guard($request->input('guard'))->attempt($credentials, $request->input('remember'))) {
                return response()->json(['message' => 'Logged in Success'], Response::HTTP_OK);
            } else {
                return response()->json(['message' => 'Login Failed , check your credentials'],
                    Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function register(Request $request)
    {

        $validator = Validator($request->all(), [
            'name' => "required|string",
            'number' => "required|integer|digits:10|unique:students,student_no",
            'phone' => "required|string",
            'password' => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:6',
            'guard' => 'required|string|in:student'
        ]);
//        $guard = $request->input('guard') . "_no";

        if (!$validator->fails()) {
            $student = new Student();
            $student->name = $request->input('name');
            $student->student_no = $request->input('number');
            $student->phone = $request->input('phone');
            $student->password = Hash::make($request->input('password'));
            $isSaved = $student->save();
            if ($isSaved) {

                $student->assignRole(Role::findById(3, 'student'));
                return response()->json(
                    [
                        'message' => $isSaved ? 'User created successfully' : 'Create failed!'
                    ],
                    $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
                );
            }

        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function showRegister(Request $request)
    {
        $request->merge(['guard' => $request->guard]);
        //dd($request->all());
        //dd($request->guard);

        $validator = Validator($request->all(), [
            'guard' => 'required|string|in:student'
        ]);
        if (!$validator->fails()) {
            return response()->view('cms.auth.register', ['guard' => $request->input('guard')]);
        } else {
            abort(Response::HTTP_NOT_FOUND);
        }
    }


    public function logout(Request $request)
    {
//        $guard = auth('web')->check() ? 'web' : 'admin';
        if (auth('student')->check()) {
            $guard = 'student';
        } elseif (auth('admin')->check()) {
            $guard = 'admin';
        } elseif (auth('trainer')->check()) {
            $guard = 'trainer';
        }else {
            $guard = 'supervisor';
        }
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('cms.login', $guard);
    }
}
