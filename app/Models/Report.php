<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    public function student()
    {
        return $this->belongsTo(StudentCompanyField::class, 'student_company_id', 'id');
    }
}
