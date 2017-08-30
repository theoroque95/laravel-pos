<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Ingredient;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredient1 = Ingredient::find(1);
        $ingredient2 = Ingredient::find(2);
        $ingredient3 = Ingredient::find(3);

    	// PRODUCT 1
    	$product1 = Product::create([
    		'name' => 'White Coffee Mocha',
    		'description' => 'White Coffee Mocha description',
    		'quantity_type_id' => 2,
    		'category_id' => 1,
    		'product_code' => 'WHCOFMCH'
    	]);

    	$productDetail1 = $product1->productDetails()->create([
    		'name' => 'Hot',
    		'quantity' => 16,
    		'price' => 130
    	]);
        $productDetail1->ingredients()->save($ingredient1, [
            'sale_quantity' => 7
        ]);

    	$productDetail1 = $product1->productDetails()->create([
    		'name' => 'Cold',
    		'quantity' => 12,
    		'price' => 120
    	]);
        $productDetail1->ingredients()->save($ingredient1, [
            'sale_quantity' => 7
        ]);

    	$productDetail1 = $product1->productDetails()->create([
    		'name' => 'Cold',
    		'quantity' => 16,
    		'price' => 140
    	]);
        $productDetail1->ingredients()->save($ingredient1, [
            'sale_quantity' => 7
        ]);

    	// PRODUCT 2
    	$product2 = Product::create([
    		'name' => 'Cafe Americano',
    		'description' => 'American\'s super strong coffee',
    		'quantity_type_id' => 2,
    		'category_id' => 1,
    		'product_code' => 'CAFAM'
    	]);

    	$productDetail2 = $product2->productDetails()->create([
    		'name' => 'Hot',
    		'quantity' => 16,
    		'price' => 100
    	]);
        $productDetail2->ingredients()->save($ingredient1, [
            'sale_quantity' => 10
        ]);
        $productDetail2->ingredients()->save($ingredient3, [
            'sale_quantity' => 10
        ]);

    	$productDetail2 = $product2->productDetails()->create([
    		'name' => 'Cold',
    		'quantity' => 12,
    		'price' => 110
    	]);
        $productDetail2->ingredients()->save($ingredient1, [
            'sale_quantity' => 7
        ]);
        $productDetail2->ingredients()->save($ingredient2, [
            'sale_quantity' => 10
        ]);
        $productDetail2->ingredients()->save($ingredient3, [
            'sale_quantity' => 10
        ]);

    	$productDetail2 = $product2->productDetails()->create([
    		'name' => 'Cold',
    		'quantity' => 16,
    		'price' => 120
    	]);
        $productDetail2->ingredients()->save($ingredient1, [
            'sale_quantity' => 10
        ]);
        $productDetail2->ingredients()->save($ingredient2, [
            'sale_quantity' => 10
        ]);

    	// PRODUCT 3
    	$product3 = Product::create([
    		'name' => 'Java Chip Frappe',
    		'description' => 'Frappe with Java chips',
    		'quantity_type_id' => 2,
    		'category_id' => 2,
    		'product_code' => 'JVCHP'
    	]);

    	$productDetail3 = $product3->productDetails()->create([
    		'name' => 'Cold',
    		'quantity' => 12,
    		'price' => 110
    	]);
        $productDetail3->ingredients()->save($ingredient1, [
            'sale_quantity' => 15
        ]);

    	$productDetail3 = $product3->productDetails()->create([
    		'name' => 'Cold',
    		'quantity' => 16,
    		'price' => 140
    	]);
        $productDetail3->ingredients()->save($ingredient2, [
            'sale_quantity' => 15
        ]);

    	// PRODUCT 4
    	$product4 = Product::create([
    		'name' => 'Blueberry Soda',
    		'description' => 'Water with shots of Italian Blueberry syrup',
    		'quantity_type_id' => 2,
    		'category_id' => 4,
    		'product_code' => 'BLBRRYSD'
    	]);

    	$productDetail4 = $product4->productDetails()->create([
    		'name' => 'Cold',
    		'quantity' => 12,
    		'price' => 70
    	]);
        $productDetail4->ingredients()->save($ingredient2, [
            'sale_quantity' => 15
        ]);

    }
}
