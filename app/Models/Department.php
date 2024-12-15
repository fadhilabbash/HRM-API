<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    // app/Models/Department.php

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
