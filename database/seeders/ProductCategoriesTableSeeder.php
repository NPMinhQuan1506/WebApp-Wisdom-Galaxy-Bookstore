<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $category = \App\Models\Category::whereRaw(' `right` = `left` +1')->get();

        // Populate the pivot table
        \App\Models\Product::all()->each(function ($product) use ($category) {
            $product->category()->attach(
                $category->random(rand(1, 3))->pluck('id')->toArray(),
                [
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]
            );
        });
    }
}
