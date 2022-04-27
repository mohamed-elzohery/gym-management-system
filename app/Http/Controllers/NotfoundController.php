<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotfoundController extends Controller
{
    //
    public function unAuth()
    {
        return view('500');
    }
}
