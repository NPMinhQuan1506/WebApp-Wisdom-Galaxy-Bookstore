<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $department = [
            ['Admin'],
            ['Thu Ngân'],
            ['Quản Lý'],
            ['Giao Hàng'],
        ];
        foreach ($department as $department) {
            \App\Models\Department::create([
                   'name' => $department[0],
                   'created_at' => date("Y-m-d H:i:s"),
                   'updated_at' => date("Y-m-d H:i:s"),
               ]);
           }
    }
}
