<?php

use Illuminate\Database\Seeder;
use App\ReportRef;

class ReportRefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReportRef::create([
    		'name' => 'xread',
    		'description' => 'Report for xread'
    	]);

    	ReportRef::create([
    		'name' => 'yread',
    		'description' => 'Report for y-read'
    	]);

    	ReportRef::create([
    		'name' => 'cread',
    		'description' => 'Report for month and week sale'
    	]);
    }
}
