<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class StaffController extends Controller
{
    public function show() {
    	$users = User::all();
    	return view('staff.index')->with([
    		'users' => $users
    	]);
    }

    public function add() {
    	return view('staff.add');
    }

    public function create() {
    	//
    }

    public function edit($id) {
    	$user = User::find($id);
    	return view('staff.edit')->with([
    		'user' => $user
    	]);
    }

    public function update() {
    	//
    }
}
