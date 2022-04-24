<?php

namespace Database\Seeders;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class DiscountDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $product = \App\Models\Product::all();

        // Populate the pivot table
        \App\Models\Discount::all()->each(function ($discount) use ($product) {
            $faker = \Faker\Factory::create();
            $discount->product()->attach(
                $product->random(rand(1, 3))->pluck('sku')->toArray(),
                [
                    'product_discount' => $faker->numberBetween($min = 1, $max = 100),
                    'unit_discount' => '%',
                    'note' => $faker->sentence(10),
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]
            );
        });
    }
}
