<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class CityManagerController extends Controller
{
    //
    #=======================================================================================#
    #			                           List Function                                	#
    #=======================================================================================#
    public function list()
    {
        $usersFromDB =  User::role('cityManager')->withoutBanned()->get();
        // $usersFromDB = User::all();
        // $usersFromDB =  User::role('cityManager')->get();
        if (count($usersFromDB) <= 0) { //for empty statement
            return view('empty');
        }
        return view("cityManager.list", ['users' => $usersFromDB]);
    }

    #=======================================================================================#
    #			                           Create Function                              	#
    #=======================================================================================#
    public function create()
    {
        return view('cityManager.create', [
            'users' => User::all(),
        ]);
    }
    #=======================================================================================#
    #			                           Store Function                                	#
    #=======================================================================================#
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:20',
            'password' => 'required |min:6',
            'email' => 'required|string|unique:users,email,',
            'national_id' => 'digits_between:10,17|required|numeric|unique:users',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg',
        ]);

        if ($request->hasFile('profile_image') == null) {
            $imageName = 'imgs/defaultImg.jpg';
        } else {
            $image = $request->file('profile_image');
            $name = time() . \Str::random(30) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/imgs');
            $image->move($destinationPath, $name);
            $imageName = 'imgs/' . $name;
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->profile_image = $imageName;
        $user->national_id = $request->national_id;
        $user->assignRole('cityManager');
        $user->save();

        return redirect()->route('cityManager.list');
    }
}
