<?php

namespace App\Models;

use App\Http\Controllers\AppointmentsController;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $primaryKey = 'student_no';

    public $incrementing = false;

    public function registerStudentCourse()
    {
        return $this->hasMany(StudentSupervisor::class, 'student_no', 'student_no');
    }

    public function supervisor()
    {
        return $this->belongsToMany(Supervisor::class, StudentSupervisor::class, 'student_no', 'supervisor_no');
    }
    public function studentCompanyField()
    {
        return $this->hasOne(StudentCompanyField::class, 'student_no', 'student_no');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_no', 'department_no')->withDefault();
    }

    public function appointments()
    {
        return $this->hasMany(Appointments::class, 'student_no', 'student_no');
    }
//    public function company()
//    {
//        return $this->belongsToMany(Company::class, StudentCompanyField::class, 'student_no', 'company_id');
//    }


//    public function company()
//    {
//        return $this->hasOneThrough(Company::class, StudentCompanyField::class, 'company_id', 'company_id');
//    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function routeNotificationForVonage($notification)
    {
        return $this->phone;
    }
}
