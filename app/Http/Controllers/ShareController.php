<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Share;
use App\Company;
use App\Team;

class ShareController extends Controller
{
    //create a new share of a team in a company
    public function create(Request $request) {
        $this->validate(['company_id'=>'requried',
        'team_id'=>'required',
        'amount'=>'requried']);
        $share = Share::new();
        $share->team_id = $request->input('team_id');
        $share->company_id = $request->input('company_id');
        $share->amount = $request->input('amount');
        $share->save();
        return back()->with('success','Share created successfully');
    }

    //show shares of a given team
    public function show($team_id) {
        $shares = Share::where('team_id','=',$team_id)->get();
        return view('shares')->with('shares',$shares);
    }

    //delete share
    public function delete(Request $request) {
        $error_code = ControllerScopes::delete_shares($request);
        if (!$error_code)
            return back()->with('success','Share deleted successfully');
        return back()->with('error',ControllerScopes::error($error_code));
    }

    //update share
    public function update(Request $request) {
        $this->validate([
            'company_id'=>'required',
            'team_id'=>'required',
            'amount'=>'required'
        ]);
        $share = Share::where('company_id','=',$request->input('company_id'))
                      ->where('team_id','=',$request->input('team_id'))->first();
        $share->amount = $request->input('amount');
        $share->save();
        return back()->with('success','Share details updated successfully');
    }

}
