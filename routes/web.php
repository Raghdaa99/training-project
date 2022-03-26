<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PermissionController;

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

Route::prefix('cms')->middleware('guest:student,admin,supervisor')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('cms.login');
    Route::get('{guard}/register', [AuthController::class, 'showRegister'])->name('cms.register');
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

});

Route::prefix('cms/admin')->middleware('auth:admin')->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('admins', AdminController::class);
    Route::post('role/update-permission', [RoleController::class, 'updateRolePermission']);
    Route::resource('departments', DepartmentController::class);
    Route::resource('fields', FieldController::class);
    Route::resource('companies', CompanyController::class);


});

Route::prefix('cms/admin')->middleware('auth:student,admin,supervisor')->group(function () {
    Route::resource('students', StudentController::class);
});
Route::prefix('cms/student')->middleware('auth:student')->group(function () {
    Route::get('show', [StudentController::class,'showAddCompany'])->name('student.showDataCompany');
//    Route::post('show', [StudentController::class,'showAddCompany']);
});
Route::prefix('cms/admin')->middleware('auth:student,admin,supervisor')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');
});


