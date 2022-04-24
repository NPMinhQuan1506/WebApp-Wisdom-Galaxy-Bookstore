<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'barcode' => $this->faker->isbn10,
            'name' => $this->faker->name,
            'supplier_id' => \App\Models\Supplier::all()->random()->id,
            'image_id' => \App\Models\Image::factory()->create()->id,
            'inventory_number' => $this->faker->numberBetween($min = 1, $max = 5000),
            'unit' =>  $this->faker->randomElement(['cái' ,'quyển', 'lô', 'hộp']),
            'min_inventory_number' => $this->faker->numberBetween($min = 100, $max = 200),
            'selling_price' => $this->faker->numberBetween($min = 5000, $max = 100000000),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
    }
}
