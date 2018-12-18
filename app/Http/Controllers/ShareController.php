<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Share;
use App\Company;
use App\Team;

class ShareController extends Controller
{
    public function create(Request $request) {
        $this->validate(['company_id'=>'requried',
        'team_id'=>'required',
        'amount'=>'requried']);
        $share = Share::new();
        $share->team_id = $request->input('team_id');
        $share->company_id = $request->input('company_id');
        $share->amount = $request->input('amount');
        $share->save();
    }

}
