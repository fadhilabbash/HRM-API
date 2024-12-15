<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    // app/Models/Position.php

    protected $fillable = [
        'title', // Position title (e.g., Manager, Developer)
        'description', // Position description
    ];

    // Define the relationship to Employee (one-to-many)
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
