<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Share;
use App\Company;

class TeamController extends Controller
{
    public function profile($team_id) {
        $team = Team::where('id','=',$team_id)->first();
        if (empty($team)) {
            return back()->with('error','No such team registered');
        }
        $shares = Share::where('team_id','=',$team_id)->get();
        return view('team_profile')->with('team',$team)
                                    ->with('shares',$shares);
    }
}
