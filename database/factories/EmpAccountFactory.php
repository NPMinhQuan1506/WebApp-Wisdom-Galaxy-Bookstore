<?php

namespace Database\Factories;

use App\Models\EmpAccount;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class EmpAccountFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmpAccount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->username,
            'password' => bcrypt('admin'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            // 'remember_token' => Str::random(10),
        ];
    }
}
