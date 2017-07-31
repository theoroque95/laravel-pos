<?php

use Illuminate\Database\Seeder;
use App\CategoriesRef;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoriesRef::create([
        	'name' => 'coffee',
        	'description' => 'Coffee-based products'
        ]);

        CategoriesRef::create([
        	'name' => 'frappe',
        	'description' => 'Frappe-based products'
        ]);

        CategoriesRef::create([
        	'name' => 'tea',
        	'description' => 'Tea-based products'
        ]);

        CategoriesRef::create([
        	'name' => 'soda',
        	'description' => 'Soda-based products'
        ]);
    }
}
