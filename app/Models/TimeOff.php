<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeOff extends Model
{
    
    protected $fillable = [
        'employee_id',
        'start_date',
        'start_hour',
        'end_hour',
        'total_hours',
        'type',
        'status'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
