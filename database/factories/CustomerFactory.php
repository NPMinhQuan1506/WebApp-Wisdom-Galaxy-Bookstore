<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

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
            'customer_type_id' => \App\Models\CustomerType::all()->random()->id,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->unique()->phoneNumber,
            'address' => '12 Hồ Tùng Mậu, Phường 12, Quân 1, Tp.HCM',
            'account_id' => \App\Models\CusAccount::factory()->create()->id,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
    }
}
