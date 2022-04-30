<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
