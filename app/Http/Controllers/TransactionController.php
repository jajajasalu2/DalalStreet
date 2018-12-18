<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Team;
use App\Share;
use App\Transaction;
use App\Traits\ControllerScopes;

class TransactionController extends Controller
{
    use ControllerScopes;
    public function create(Request $request) {
        $this->validate($request,['company_id'=>'required',
            'team_id'=>'required',
            'amount'=>'required',
            'buy_sell'=>'required']);
        $transaction = new Transaction;
        $company = Company::where('id','=',$request->input('company_id'))->get();
        $team = Team::where('id','=',$request->input('team_id'))->get();
        if ($request->input('buy_sell') == 1) {
            $buy = ControllerScopes::buy_share($request->input('team_id'),
                                $request->input('company_id'),
                                $request->input('amount'));
            if ($buy) {
                return back()->with('error',ControllerScopes::error($buy));
            }
        }
        else {
            $sell = ControllerScopes::sell_share($request->input('team_id'),
                                $request->input('company_id'),
                                $request->input('amount'));
            if ($sell) {
                return back()->with('error',ControllerScopes::error($sell));
            }
        }
        $c = ControllerScopes::adjust_rate($request->input('amount'),
                    $request->input('company_id'),
                    $request->input('buy_sell'));
        $transaction->team_id = $request->input('team_id');
        $transaction->company_id = $request->input('company_id');
        $transaction->amount = $request->input('amount');
        $transaction->buy_sell = $request->input('buy_sell');
        $transaction->save();
        //return 'done';
        return back()->with('success','Transaction completed successfully');
    }
}
