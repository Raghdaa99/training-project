<?php

use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\RegisterStudentCourseController;
use App\Http\Controllers\StudentCompanyFieldController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PermissionController;

use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\TrainerController;
use App\Mail\CompanyEmail;
use App\Models\RegisterStudentCourse;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('cms')->middleware('guest:student,admin,supervisor,trainer')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('cms.login');
    Route::get('{guard}/register', [AuthController::class, 'showRegister'])->name('cms.register');
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

});

Route::prefix('cms/admin')->middleware('auth:admin')->group(function () {
    Route::get('/', [AdminController::class, 'index_dashboard'])->name('cms.admin.dashboard');
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('supervisors', SupervisorController::class);
    Route::post('role/update-permission', [RoleController::class, 'updateRolePermission']);
    Route::resource('departments', DepartmentController::class);
    Route::resource('fields', FieldController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('registerStudentCourse', RegisterStudentCourseController::class);

});

Route::prefix('cms/admin')->middleware('auth:student,admin,supervisor')->group(function () {
    Route::resource('students', StudentController::class);
});
Route::prefix('cms/supervisor')->middleware('auth:supervisor')->group(function () {
        Route::get('show/Students', [SupervisorController::class,'show_students']);
});

Route::get('show/company/{id}/show',[StudentCompanyFieldController::class,'show'])->name('company.send.email');
Route::put('show/company/{id}/update',[StudentCompanyFieldController::class,'update_status']);
Route::get('trainer/create/{company_student_id}',[TrainerController::class,'create_trainer']);
Route::post('trainer/store',[TrainerController::class,'store']);

Route::prefix('cms/student')->middleware('auth:student')->group(function () {
    Route::resource('registerStudentCompany', StudentCompanyFieldController::class);
});
Route::prefix('cms/trainer')->middleware('auth:trainer')->group(function () {
    Route::resource('trainers', TrainerController::class);

});

Route::prefix('cms')->middleware('auth:trainer,student,supervisor')->group( function () {
    Route::resource('appointments', AppointmentsController::class);
});

Route::prefix('cms/admin')->middleware('auth:student,admin,supervisor,trainer')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');
});

Route::post('send/email/company', [SupervisorController::class,'send_email'])->name('company.email');


