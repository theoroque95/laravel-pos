<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Admin user
        User::create([
        	'username' => 'admin',
        	'first_name' => 'Theo',
        	'last_name' => 'Roque',
        	'email' => 'roquevtr@gmail.com',
        	'phone' => '09175073906',
        	'birthdate' => Carbon::createFromFormat('d/m/Y', '03/05/1995'),
        	'address' => 'Balagtas, Bulacan',
        	'is_admin' => true,
        	'password' => Hash::make('admin')
        ]);

        // Staff user
        User::create([
        	'username' => 'cashier',
        	'first_name' => 'Lei',
        	'last_name' => 'Roque',
        	'email' => '',
        	'phone' => '',
        	'birthdate' => Carbon::createFromFormat('d/m/Y', '02/02/1974'),
        	'address' => 'Balagtas, Bulacan',
        	'is_admin' => false,
        	'password' => Hash::make('cashier')
        ]);
    }
}
