<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

               $gender = [
                   ['Nam'],
                   ['Nữ'],
                   ['Khác'],
               ];
               foreach ($gender as $gender) {
                   \App\Models\Gender::create([
                          'gender' => $gender[0],
                          'created_at' => date("Y-m-d H:i:s"),
                          'updated_at' => date("Y-m-d H:i:s"),
                      ]);
                  }
    }
}
