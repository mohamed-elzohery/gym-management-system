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
        return view('menu.city_manager.index');
    }

    public function create()
    {
        $cities = City::leftJoin('city_managers', 'cities.id', '=', 'city_managers.city_id')->where('user_id', null)->get();
        return view('menu.city_manager.create', compact('cities'));
    }
}
