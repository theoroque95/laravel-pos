<?php

use Illuminate\Database\Seeder;
use App\Ingredient;

class IngredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // INGREDIENT 1
    	$ingredient1 = Ingredient::create([
    		'name' => 'Coffee Bean',
    		'description' => 'Coffe bean shots for coffee-based products',
    		'expected_quantity' => 1000,
    		'actual_quantity' => 200,
    		'quantity_type_id' => 1
    	]);

    	// INGREDIENT 2
    	$ingredient2 = Ingredient::create([
    		'name' => 'Soda Shot',
    		'description' => 'Soda Shots for Soda',
    		'expected_quantity' => 750,
    		'actual_quantity' => 500,
    		'quantity_type_id' => 2
    	]);

    	// INGREDIENT 2
    	$ingredient3 = Ingredient::create([
    		'name' => 'Cake',
    		'description' => 'Whole Cake',
    		'actual_quantity' => 1,
    		'expected_quantity' => 7,
    		'quantity_type_id' => 4
    	]);
        
    }
}
