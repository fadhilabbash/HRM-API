<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'name',
        'birth_date',
        'gender',
        'marital_status',
        'address',
        'mobile',
        'emergency_mobile',
        'email',
        'badge_number',
        'hiring_date',
        'department_id',
        'position_id',
        'education_grade',
        'type',
        'salary',
        'file',
    ];

 
    public function dayOffs()
    {
        return $this->hasMany(DayOff::class);
    }
    public function timeOffs()
    {
        return $this->hasMany(TimeOff::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
