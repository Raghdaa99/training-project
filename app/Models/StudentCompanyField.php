<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class StudentCompanyField extends Model
{
    use HasFactory , HasRoles;
    protected $table = 'students_company_field';

    public function student()
    {
        return $this->belongsTo(RegisterStudentCourse::class, 'student_no', 'student_no');
    }
//    public function studentOne()
//    {
//        return $this->belongsToMany(Student::class, RegisterStudentCourse::class, 'student_no', 'student_no');
//    }
    public function fields()
    {
        return $this->belongsTo(Field::class, 'field_id', 'id');
    }

    public function companies()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    public function getActiveStatusAttribute()
    {
        return $this->status ? 'Active' : 'Non-Active';
    }
}
