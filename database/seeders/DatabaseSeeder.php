<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Publisher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AuthorsTableSeeder::class); //1
        $this->call(CategoriesTableSeeder::class); //2
        $this->call(CusAccountsTableSeeder::class); //3
        $this->call(CustomerTypesTableSeeder::class); //4
        $this->call(GendersTableSeeder::class); //5
        $this->call(ImagesTableSeeder::class); //6
        $this->call(CustomersTableSeeder::class);//7
        $this->call(DepartmentsTableSeeder::class);//8
        $this->call(DiscountsTableSeeder::class);//9
        $this->call(EmpAccountsTableSeeder::class);//10
        $this->call(EmployeesTableSeeder::class);//11
        $this->call(PublishersTableSeeder::class);//12
        $this->call(SuppliersTableSeeder::class);//13
        $this->call(ProductsTableSeeder::class);//14
        $this->call(ProductDetailsTableSeeder::class);//15
        $this->call(ProductAuthorsTableSeeder::class);//16
        $this->call(ProductCategoriesTableSeeder::class);//17
        $this->call(DiscountDetailsTableSeeder::class);//18
    }
}
