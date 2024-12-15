<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DayOff extends Model
{
    // app/Models/DayOff.php

    protected $fillable = [
        'employee_id',
        'date',
        'type',
        'paid',
    ];

    // Relationship with Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
