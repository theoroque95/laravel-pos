<?php

use Illuminate\Database\Seeder;
use App\ReceiptLog;

class ReceiptLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReceiptLog::create([
    		'receipt_no' => '00000001'
    	]);
    }
}
