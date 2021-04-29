<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CustomerTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $type = [
            ['Thành Viên'],
            ['Khách Vãng Lai'],
            ['Đại Lý'],
        ];
        foreach ($type as $type) {
            \App\Models\CustomerType::create([
                   'type' => $type[0],
                   'created_at' => date("Y-m-d H:i:s"),
                   'updated_at' => date("Y-m-d H:i:s"),
               ]);
           }

    }
}
