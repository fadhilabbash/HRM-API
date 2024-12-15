<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    // app/Models/Attendance.php

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
