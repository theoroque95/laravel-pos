<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(DiscountsSeeder::class);
        $this->call(QuantityTypesSeeder::class);
        $this->call(IngredientsSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(ReceiptLogSeeder::class);
        $this->call(SalesSeeder::class);
        $this->call(ReportRefSeeder::class);
    }
}
