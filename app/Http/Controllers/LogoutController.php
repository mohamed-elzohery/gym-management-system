<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //

    public function logout()
    {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/home');
    }
}
