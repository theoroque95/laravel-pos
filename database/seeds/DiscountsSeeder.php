<?php

use Illuminate\Database\Seeder;
use App\DiscountsRef;

class DiscountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DiscountsRef::create([
    		'name' => 'senior',
    		'description' => 'Discount for senior citizens',
    		'percentage' => 12
    	]);

    	DiscountsRef::create([
    		'name' => 'student',
    		'description' => 'Discount for students',
    		'percentage' => 10
    	]);
    }
}
