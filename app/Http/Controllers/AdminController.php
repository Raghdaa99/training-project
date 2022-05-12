<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{

    public function __construct()
    {
        //        $this->authorizeResource(Admin::class, 'admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        return response()->view('cms.admins.index', ['admins' => $admins]);
    }

    public function index_dashboard()
    {
        //        $admins = Admin::all();
        $count_companies = DB::table('companies')->count();
        $count_trainers = DB::table('trainers')->count();
        $count_students = DB::table('students')->count();
        $count_supervisors = DB::table('supervisors')->count();
        return response()->view('cms.admins.index_dashboard', [
            'count_companies' => $count_companies,
            'count_trainers' => $count_trainers,
            'count_students' => $count_students,
            'count_supervisors' => $count_supervisors,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('guard_name', '=', 'admin')->get();
        return response()->view('cms.admins.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:100',
            'number' => 'required|integer|unique:admins,admin_no',
            'role_id' => 'required|numeric|exists:roles,id',
            'password' => 'required|string|min:6|max:100',
        ]);

        if (!$validator->fails()) {
            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->admin_no = $request->input('number');
            $admin->password = Hash::make($request->input('password'));
            $isSaved = $admin->save();
            if ($isSaved) {
                $admin->assignRole(Role::findById($request->input('role_id'), 'admin'));
            }
            return response()->json(
                [
                    'message' => $isSaved ? 'Admin created successfully' : 'Create failed!'
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $roles = Role::where('guard_name', '=', 'admin')->get();
        $adminRole = $admin->roles()->first();
        return response()->view('cms.admins.edit', [
            'admin' => $admin,
            'adminRole' => $adminRole,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Admin $admin)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:100',
            'admin_no' => ['required', 'numeric', Rule::unique('admins')->ignore($admin->admin_no, 'admin_no')],
            'role_id' => 'required|numeric|exists:roles,id',
        ]);

        if (!$validator->fails()) {
            $admin->name = $request->input('name');
            $admin->admin_no = $request->input('admin_no');
            $isSaved = $admin->save();
            if ($isSaved) {
                $admin->syncRoles(Role::findById($request->input('role_id'), 'admin'));
            }
            return response()->json(
                [
                    'message' => $isSaved ? 'Admin updated successfully' : 'Update failed!'
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $isDeleted = $admin->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
