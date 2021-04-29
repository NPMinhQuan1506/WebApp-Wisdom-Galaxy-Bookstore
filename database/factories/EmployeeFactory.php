<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->name,
            'date_of_birth' => date("Y-m-d"),
            'gender_id' => \App\Models\Gender::all()->random()->id,
            'image_id' => \App\Models\Image::factory()->create()->id,
            'department_id' => \App\Models\Department::all()->random()->id,
            'account_id' => \App\Models\EmpAccount::factory()->create()->id,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->unique()->phoneNumber,
            'address' => '12 Hồ Tùng Mậu, Phường 12, Quân 1, Tp.HCM',
            'salary' => $this->faker->randomNumber($nbDigits = NULL, $strict = false),
            'hire_date' => $this->faker->date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
    }
}
