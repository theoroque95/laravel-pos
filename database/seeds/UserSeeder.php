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
        	'username' => 'staff',
        	'first_name' => 'Shy',
        	'last_name' => 'Roque',
        	'email' => 'roqueshy@gmail.com',
        	'phone' => '09175073906',
        	'birthdate' => Carbon::createFromFormat('d/m/Y', '10/02/1996'),
        	'address' => 'San Jose Del Monte, Bulacan',
        	'is_admin' => false,
        	'password' => Hash::make('staff')
        ]);
    }
}
