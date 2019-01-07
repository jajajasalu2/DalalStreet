<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\CompanyDividend;
use App\CompanyBonus;
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
            $error_code = ControllerScopes::buy_share($request->input('team_id'),
                                $request->input('company_id'),
                                $request->input('amount'));
        }
        else if ($request->input('buy_sell') == 2){
            $sell = ControllerScopes::sell_share($request->input('team_id'),
                                $request->input('company_id'),
                                $request->input('amount'));
        }
        else if ($request->input('buy_sell') == 3) {
            $error_code = ControllerScopes::buy_back($request->input('team_id'),
                                $request->input('company_id'),
                                $request->input('amount'));
        }
        else {
            $error_code = ControllerScopes::short_sell($request->input('team_id'),
                                $request->input('company_id'),
                                $request->input('amount'));
        }
        if ($error_code) {
            return back()->with('error',ControllerScopes::error($sell));
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

    public function session_end() {
        $company_dividends = CompanyDividend::all();
        $company_bonuses = CompanyBonus::all();
        foreach($company_dividends as $company_dividend) {
            $shares = Share::where('company_id','=',$company_dividend->company_id)
                            ->get();
            foreach($shares as $share) {
                if ($share->amount >= $company_dividend->shares_per_dividend) {
                    $team = Team::where('id','=',$share->team_id)
                        ->first();
                    $dividend_factor = intval($share->amount/$company_dividend->shares_per_dividend);
                    $team->balance += $company_dividend->dividend * $dividend_factor;
                    $team->save();
                }
            }
        }
        foreach($company_bonuses as $company_bonus) {
            $shares = Share::where('company_id','=',$company_bonus->company_id)
                            ->get();
            foreach ($shares as $share) {
                if ($share->amount >= $company_bonus->shares_per_dividend) {
                    $team = Team::where('id','=',$share->team_id)
                        ->first();
                    $bonus_factor = intval($share->amount/$company_bonus->shares_per_bonus);
                    $team->balance += $company_bonus->bonus * $bonus_factor;
                    $team->save();
                }
            }
        }
        return back()->with('success','Session Ended.');
    }
}
