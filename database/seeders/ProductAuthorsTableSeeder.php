<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductAuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $author = \App\Models\Author::all();

        // Populate the pivot table
        \App\Models\ProductDetail::all()->each(function ($product) use ($author) {
            $product->author()->attach(
                $author->random(rand(1, 3))->pluck('id')->toArray(),
                [
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]
            );
        });
    }
}
