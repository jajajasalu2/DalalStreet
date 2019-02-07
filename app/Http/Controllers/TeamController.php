<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Share;
use App\Company;
use Auth;
use App\Traits\ControllerScopes;
use DB;

class TeamController extends Controller
{
    use ControllerScopes;
    public function profile($team_id) {
	$error_code = ControllerScopes::security_check($team_id);
	if ($error_code) return back()->with('error',ControllerScopes::error($error_code));
        $team = Team::where('id','=',$team_id)->first();
        if (empty($team)) {
            return back()->with('error','No such team registered');
        }
        $shares = Share::where('team_id','=',$team_id)->get();
        return view('team_profile')->with('team',$team)
                                    ->with('shares',$shares);
    }
}
