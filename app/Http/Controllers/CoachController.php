
<!-- //coach controller / -->
<?php
namespace App\Http\Controllers;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Gym;
use App\Models\User;
use Illuminate\Support\Facades\File;

class CoachController extends Controller
{
// list function 
    public function list()
    {
        $coachesFromDB = User::role('coach')->withoutBanned()->get();
        if (count($coachesFromDB) <= 0) {
            return view('empty');
        }
        return view("coach.list", ['coaches' => $coachesFromDB]);
    }
//show fun :-
    public function show($id)
    {
        $singleCoach = User::find($id);
        return view("coach.show", ['singleCoach' => $singleCoach]);
    }
//create fun :-
public function create()
{
    $coaches = User::all();
    $cities = City::all();
    return view('coach.create', [
        'users' => $coaches,
        'cities' => $cities,
    ]);
}
//update fun :-
public function update(Request $request, $id)
    {

        $user = User::find($id);
        $validated = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|string|unique:users,email,' . $user->id,
            'profile_image' => 'mimes:jpg,jpeg',
        ]);
}