<?php

namespace Database\Factories;

use App\Models\CusAccount;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class CusAccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CusAccount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'username' => $this->faker->username,
            'password' => bcrypt('user123'),
            'remember_token' => Str::random(10),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
    }
}
