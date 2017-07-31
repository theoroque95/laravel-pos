<?php

use Illuminate\Database\Seeder;
use App\QuantityTypesRef;

class QuantityTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	QuantityTypesRef::create([
    		'name' => 'liter',
    		'description' => 'liter',
    		'acronym' => 'L'
    	]);

    	QuantityTypesRef::create([
    		'name' => 'ounce',
    		'description' => 'used for beverages',
    		'acronym' => 'oz'
    	]);

    	QuantityTypesRef::create([
    		'name' => 'slice',
    		'description' => 'used for cakes',
    		'acronym' => 'slc'
    	]);

    	QuantityTypesRef::create([
    		'name' => 'serving',
    		'description' => 'used for food',
    		'acronym' => 'srv'
    	]);

    	QuantityTypesRef::create([
    		'name' => 'scoop',
    		'description' => 'for desserts and ice cream',
    		'acronym' => 'scp'
    	]);
    }
}
