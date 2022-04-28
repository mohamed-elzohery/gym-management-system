<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\Models\User;

use DataTables;


class UserController extends Controller
{
    //
    // public function index(UserDataTable $dataTable)
    // {
    //     return $dataTable->render('user.index');
    // }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="/home" class="edit btn btn-primary btn-sm">View</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('user.index');
    }
}
