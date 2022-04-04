<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function studentCompanyField()
    {
        return $this->hasMany(StudentCompanyField::class, 'company_id', 'id');
    }
    public function students()
    {
        return $this->belongsTo(Student::class, StudentCompanyField::class, 'student_no', 'company_id');
    }
}
