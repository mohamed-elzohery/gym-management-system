<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CityManager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class CityManagerController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cityManager = CityManager::with('user')->get();
            return Datatables::of($cityManager)->addIndexColumn()->make(true);
        }
        return view('cityManager.index');
    }

    public function create()
    {
        $cities = City::leftJoin('city_managers', 'cities.id', '=', 'city_managers.city_id')->where('user_id', null)->get();
        return view('cityManager.create', compact('cities'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $cities = City::leftJoin('city_managers', 'cities.id', '=', 'city_managers.city_id')->where('user_id', null)->get();
        return view('cityManager.edit', compact('user', 'cities'));
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('cityManager.show', compact('user'));
    }
}
