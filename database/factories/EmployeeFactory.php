<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    protected $model = Employee::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image_name' => $this->faker->image(public_path('images'), 640, 480, null, false),
            'name' => $this->faker->name,
            'birth_date' => $this->faker->date('Y-m-d', '2000-01-01'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'marital_status' => $this->faker->randomElement(['single', 'married']),
            'address' => $this->faker->address,
            'mobile' => $this->faker->phoneNumber,
            'emergency_mobile' => $this->faker->phoneNumber,
            'hiring_date' => $this->faker->date('Y-m-d', '2020-01-01'),
            'department' => $this->faker->word,
            'education_grade' => $this->faker->randomElement(['high school', 'bachelor', 'master', 'PhD']),
            'type' => $this->faker->randomElement(['full-time', 'part-time', 'contract']),
            'salary' => $this->faker->numberBetween(30000, 100000),
        ];
    }
}
