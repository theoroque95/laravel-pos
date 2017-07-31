<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// PRODUCT 1
    	$product1 = Product::create([
    		'name' => 'White Coffee Mocha',
    		'description' => 'White Coffee Mocha description',
    		'actual_quantity' => 750,
    		'expected_quantity' => 750,
    		'quantity_type_id' => 2,
    		'category_id' => 1,
    		'product_code' => 'WHCOFMCH'
    	]);

    	$product1->productDetails()->create([
    		'name' => 'Hot',
    		'description' => 'Hot White Coffee Mocha',
    		'quantity' => 16,
    		'price' => 130
    	]);

    	$product1->productDetails()->create([
    		'name' => 'Cold',
    		'description' => 'Cold White Coffee Mocha',
    		'quantity' => 12,
    		'price' => 120
    	]);

    	$product1->productDetails()->create([
    		'name' => 'Cold',
    		'description' => 'Cold White Coffee Mocha',
    		'quantity' => 16,
    		'price' => 140
    	]);

    	// PRODUCT 2
    	$product2 = Product::create([
    		'name' => 'Cafe Americano',
    		'description' => 'American\'s super strong coffee',
    		'actual_quantity' => 100,
    		'expected_quantity' => 700,
    		'quantity_type_id' => 2,
    		'category_id' => 1,
    		'product_code' => 'CAFAM'
    	]);

    	$product2->productDetails()->create([
    		'name' => 'Hot',
    		'description' => 'Hot Cafe Americano',
    		'quantity' => 16,
    		'price' => 100
    	]);

    	$product2->productDetails()->create([
    		'name' => 'Cold',
    		'description' => 'Cold Cafe Americano',
    		'quantity' => 12,
    		'price' => 110
    	]);

    	$product2->productDetails()->create([
    		'name' => 'Cold',
    		'description' => 'Cold Cafe Americano',
    		'quantity' => 16,
    		'price' => 120
    	]);

    	// PRODUCT 3
    	$product3 = Product::create([
    		'name' => 'Java Chip Frappe',
    		'description' => 'Frappe with Java chips',
    		'actual_quantity' => 30,
    		'expected_quantity' => 850,
    		'quantity_type_id' => 2,
    		'category_id' => 2,
    		'product_code' => 'JVCHP'
    	]);

    	$product3->productDetails()->create([
    		'name' => 'Cold',
    		'description' => 'Cold Java Chip Frappe',
    		'quantity' => 12,
    		'price' => 110
    	]);

    	$product3->productDetails()->create([
    		'name' => 'Cold',
    		'description' => 'Cold Java Chip Frappe',
    		'quantity' => 16,
    		'price' => 140
    	]);

    	// PRODUCT 4
    	$product4 = Product::create([
    		'name' => 'Blueberry Soda',
    		'description' => 'Water with shots of Italian Blueberry syrup',
    		'actual_quantity' => 500,
    		'expected_quantity' => 750,
    		'quantity_type_id' => 2,
    		'category_id' => 4,
    		'product_code' => 'BLBRRYSD'
    	]);

    	$product3->productDetails()->create([
    		'name' => 'Cold',
    		'description' => 'Cold Blueberry Soda',
    		'quantity' => 12,
    		'price' => 70
    	]);
    }
}
