<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class StudentSupervisor extends Model
{
    use HasFactory,Notifiable;

    protected $table = 'register_students_course';
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_no', 'student_no');
    }
    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_no', 'supervisor_no');
    }
    public function studentCompany()
    {
        return $this->hasOne(StudentCompanyField::class, 'student_no', 'student_no');
    }
//    public function department()
//    {
//        return $this->belongsTo(Department::class, 'department_no', 'department_no');
//    }

}
