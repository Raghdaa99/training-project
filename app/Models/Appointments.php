<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;
    public function student()
    {
        return $this->belongsTo(StudentCompanyField::class, 'student_company_id', 'id');
    }

    public function getSaturdayStatusAttribute()
    {
        return $this->Saturday ? 'Saturday' : '';
    }
    public function getSundayStatusAttribute()
    {
        return $this->Sunday ? 'Sunday' : '';
    }
    public function getMondayStatusAttribute()
    {
        return $this->Monday ? 'Monday' : '';
    }
    public function getTuesdayStatusAttribute()
    {
        return $this->Tuesday ? 'Tuesday' : '';
    }
    public function getWednesdayStatusAttribute()
    {
        return $this->Wednesday ? 'Wednesday' : '';
    }
    public function getThursdayStatusAttribute()
    {
        return $this->Thursday ? 'Thursday' : '';
    }
}
