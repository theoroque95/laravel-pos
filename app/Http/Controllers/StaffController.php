<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use Validator;
use Hash;

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

        return redirect('/staff/'.$user->id)->with('notification', 'The user has been added.');
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
        $user->birthdate = Carbon::createFromFormat('m/d/Y', $request['birthdate']);
        $user->address = $request['address'];
        $user->is_admin = $request['is_admin'] == null ? false : true;
        $user->save();

        return redirect()->back()->with('notification', 'The user has been updated.');
    }

    public function changePassword(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($id);
        if (Hash::check($request['current_password'], $user->password)) {
            $user->password = Hash::make($request['password']);
            $user->save();

            return redirect()->back()->with('notification', 'Password has been changed.');
        }

        return redirect()->back()->withErrors('Current password is incorrect.');
    }
}
