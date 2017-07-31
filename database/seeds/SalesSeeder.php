<?php

use Illuminate\Database\Seeder;
use App\User;
use App\ProductDetail;
use App\Sales;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// User 1
    	$user1 = User::find(1);
    	// Product 1
    	$product1 = ProductDetail::find(1);
    	// Product 2
    	$product2 = ProductDetail::find(2);

    	// Sales 1
    	$sale1 = $user1->sales()->create([
    		'receipt_no' => '00001',
    		'order_no' => '00100',
    		'total' => (($product1->price*2)+($product2->price)),
    		'tendered' => 1000
    	]);
    	// Sales 1 Products 1
    	$sale1->salesProducts()->create([
    		'product_detail_id' => $product1->id,
    		'quantity' => 2
    	]);
    	// Sales 1 Products 2
    	$sale1->salesProducts()->create([
    		'product_detail_id' => $product2->id,
    		'quantity' => 1
    	]);
    }
}
