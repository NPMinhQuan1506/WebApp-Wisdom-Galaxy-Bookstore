<?php

namespace Database\Factories;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Discount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'tittle' => $this->faker->sentence,
            'start_time' => $this->faker->date("Y-m-d H:i:s"),
            'end_time' => $this->faker->date("Y-m-d H:i:s"),
            'payment_discount' => $this->faker->numberBetween($min = 1, $max = 50),
            'note' => $this->faker->sentence(10),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'unit_discount' => '%',
        ];
    }
}
