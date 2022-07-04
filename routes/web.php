<?php

use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentsSupervisorsController;
use App\Http\Controllers\StudentCompanyFieldController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PermissionController;

use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\TrainerController;
use App\Mail\CompanyEmail;
use App\Models\StudentSupervisor;
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
    return view('index');
})->name('home');
Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::prefix('cms')->middleware('guest:student,admin,supervisor,trainer')->group(function () {
        Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('cms.login');
        Route::get('{guard}/register', [AuthController::class, 'showRegister'])->name('cms.register');
        Route::get('{guard}/check', [AuthController::class, 'showCheckCredentials'])->name('cms.check.credentials');
        Route::post('login', [AuthController::class, 'login']);
        Route::put('register', [AuthController::class, 'register']);
        Route::post('check', [AuthController::class, 'checkCredential']);

    });
    Route::prefix('cms')->middleware('auth:student,admin,supervisor,trainer')->group(function () {

        Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');

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
        Route::post('update-companies-fields', [CompanyController::class, 'updateCompanyFields']);
        Route::resource('registerStudentCourse', StudentsSupervisorsController::class);
        Route::resource('questions', QuestionController::class);
        Route::resource('students', StudentController::class);
    });


    Route::prefix('cms/supervisor')->middleware('auth:supervisor')->group(function () {
        Route::get('show/Students', [SupervisorController::class, 'show_students'])->name('supervisor.show.students');
        Route::get('show/Student/{id}', [SupervisorController::class, 'show_students_details'])->name('supervisor.show.students.details');
        Route::post('search/Students', [SupervisorController::class, 'search_students'])->name('supervisor.search.students');
        Route::post('update-supervisor-status', [SupervisorController::class, 'updateSupervisorStatus']);
//        Route::get('registerCompany/{student_no}', [StudentCompanyFieldController::class, 'create_company_field_supervisor'])->name('register.Student.Company');
        Route::get('registerCompany', [StudentCompanyFieldController::class, 'create_company_field_supervisor'])->name('register.Student.Company');
        Route::get('personal-data', [SupervisorController::class, 'personal_data'])->name('supervisor.personal.data');
        Route::get('notifications', [SupervisorController::class, 'getNotifications'])->name('notifications');
        Route::get('markAsRead/{id}', [SupervisorController::class, 'markAsRead'])->name('markAsRead');
    });

    Route::prefix('cms/student')->middleware('auth:student,supervisor')->group(function () {
        Route::resource('registerStudentCompany', StudentCompanyFieldController::class);
        Route::get('registerCompany', [StudentCompanyFieldController::class, 'create_company_field_student'])->name('register.Student.Company');
//        Route::get('registerCompany/{student_no}', [StudentCompanyFieldController::class, 'create_company_field'])->name('register.Student.Company');
        Route::get('registerCompany/{studentCompanyField}/edit/{company_id?}', [StudentCompanyFieldController::class, 'edit_company_field'])->name('edit.Student.Company');
        Route::get('reports/{id}', [ReportController::class, 'create_report'])->name('create.report');
        Route::resource('reports', ReportController::class);
        Route::get('download/{file}', [ReportController::class, 'download'])->name('download.report');
        Route::get('show/Student/personal-data', [StudentController::class, 'show_students_personal_data'])->name('student.personal.data');

    });

    Route::prefix('cms/trainer')->middleware('auth:trainer')->group(function () {
        Route::resource('trainers', TrainerController::class);
        Route::get('show/trainer-personal-data', [TrainerController::class, 'show_trainer_personal_data'])->name('trainer.personal.data');


    });

    Route::get('show/company/{id}/show', [StudentCompanyFieldController::class, 'show'])->name('company.send.email');
    Route::put('show/company/{id}/update', [StudentCompanyFieldController::class, 'update_status']);
//    Route::put('show/company/{id}/update_cancel', [StudentCompanyFieldController::class, 'update_status_cancel']);
    Route::get('show/company/trainers/{id}', [TrainerController::class, 'show_trainers_company'])->name('show.trainers.company');
    Route::post('trainer/store', [TrainerController::class, 'create_trainer_to_company']);
    Route::get('trainer/create/{company_student_id}', [TrainerController::class, 'create_trainer'])->name('trainer.create');
    Route::post('trainer/store/new', [TrainerController::class, 'store'])->name('trainer.store.new');


    Route::prefix('cms')->middleware('auth:trainer,student,supervisor,admin')->group(function () {
        Route::resource('appointments', AppointmentsController::class);
        Route::get('student/appointment/{id}', [AppointmentsController::class, 'show_student_appointment'])->name('show.student.appointment');
        Route::get('student/appointment/{student_company_id}/create', [AppointmentsController::class, 'create_student_appointment'])->name('create.student.appointment');
        Route::get('update-password', [AuthController::class, 'update_pass_show'])->name('cms.update.password');
        Route::post('update-password', [AuthController::class, 'update_password']);
        Route::resource('attendances', AttendanceController::class);
        Route::get('trainer/show_attendances_student/{student_company_id}', [TrainerController::class, 'show_attendances_students'])->name('show.student.attendances');

    });


    Route::prefix('cms')->middleware('auth:supervisor,trainer')->group(function () {
        Route::resource('evaluations', EvaluationController::class);
        Route::get('student/evaluation/{id}/show', [EvaluationController::class, 'show_student_evaluation'])->name('show.student.evaluation');
        Route::get('supervisor/evaluation-trainer/{id}/show', [EvaluationController::class, 'show_supervisor_evaluation_trainer'])->name('show.supervisor.evaluation.trainer');
        Route::get('student/evaluation/{student_company_id}/create', [EvaluationController::class, 'create_student_evaluation'])->name('create.student.evaluation');
        Route::get('student/evaluation/{student_company_id}/edit', [EvaluationController::class, 'edit_student_evaluation'])->name('edit.student.evaluation');
        Route::put('student/evaluation/update', [EvaluationController::class, 'update'])->name('update.student.evaluation');


    });

    Route::post('send/email/company', [SupervisorController::class, 'send_email'])->name('company.email');
});


