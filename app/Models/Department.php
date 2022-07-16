<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $primaryKey = 'department_no';

    public $incrementing = false;

    public function students()
    {
        return $this->hasMany(Student::class, 'department_no', 'department_no');
    }
    public function supervisors()
    {
        return $this->hasMany(Supervisor::class, 'department_no', 'department_no');
    }
}
