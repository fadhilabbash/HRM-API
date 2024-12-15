<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'image' => $this->image,
            'name' => $this->name,
            'birth_date' => $this->birth_date,
            'gender' => $this->gender,
            'marital_status' => $this->marital_status,
            'address' => $this->address,
            'mobile' => $this->mobile,
            'emergency_mobile' => $this->emergency_mobile,
            'email' => $this->email,
            'badge_number' => $this->badge_number,
            'hiring_date' => $this->hiring_date,
            'department_id' => $this->department_id,
            'position_id' => $this->position_id,
            'education_grade' => $this->education_grade,
            'type' => $this->type,
            'salary'=>$this->salary,
            'file'=>$this->file
        ];
    }
}
