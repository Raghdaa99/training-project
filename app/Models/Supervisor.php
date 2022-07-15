<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Supervisor extends Authenticatable
{
    use HasFactory, HasRoles,Notifiable;

    protected $primaryKey = 'supervisor_no';

    public $incrementing = false;

    public function registerStudentCourse()
    {
        return $this->hasMany(StudentSupervisor::class, 'supervisor_no', 'supervisor_no');
    }
    public function students()
    {
        return $this->belongsToMany(Student::class, StudentSupervisor::class, 'supervisor_no', 'student_no');
    }

    public function routeNotificationForVonage($notification)
    {
        return $this->phone;
    }
}
