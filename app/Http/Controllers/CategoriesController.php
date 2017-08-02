<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoriesRef;
use Validator;

class CategoriesController extends Controller
{
    public function show() {
    	$categories = CategoriesRef::all();
    	return view('products.categories.index')->with([
    		'categories' => $categories
    	]);
    }

    public function add() {
    	return view('products.categories.add');
    }

    public function create(Request $request) {
    	$validator = Validator::make($request->all(), [
            'username' => 'required|string|min:4|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'email|max:255',
            'phone' => 'required|numeric',
            'birthdate' => 'required|date',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'username' => $request['username'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'birthdate' => Carbon::createFromFormat('d/m/Y', $request['birthdate']),
            'address' => $request['address'],
            'is_admin' => $request['is_admin'] == null ? false : true,
            'password' => Hash::make($request['password'])
        ]);

        return redirect()->back()->with('notification', 'The user has been added.');
    }

    public function edit($id) {
    	$user = User::find($id);
    	return view('staff.edit')->with([
    		'user' => $user
    	]);
    }

    public function update(Request $request, $id) {
    	$validator = Validator::make($request->all(), [
            'username' => 'required|string|min:4|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'email|max:255',
            'phone' => 'required|numeric',
            'birthdate' => 'required|date',
            'address' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($id);
        $user->username = $request['username'];
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->birthdate = Carbon::createFromFormat('d/m/Y', $request['birthdate'])->format('d/m/Y');
        $user->address = $request['address'];
        $user->is_admin = $request['is_admin'] == null ? false : true;
        $user->save();

        return redirect()->back()->with('notification', 'The user has been updated.');
    }
}
