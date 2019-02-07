<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\CompanyDividend;
use App\CompanyBonus;
use App\Team;
use App\Share;
use App\Transaction;
use App\ShortsoldShare;
use App\Traits\ControllerScopes;
use App\Session;
use DB;

class TransactionController extends Controller
{
    use ControllerScopes;
    public function create(Request $request) {
        $this->validate($request,['company_id'=>'required',
            'team_id'=>'required',
            'amount'=>'required',
            'buy_sell'=>'required']);
        $transaction = new Transaction;
        if ($request->input('buy_sell') == 1) {
            $error_code = ControllerScopes::buy_share($request->input('team_id'),
                                $request->input('company_id'),
                                $request->input('amount'));
        }
        else if ($request->input('buy_sell') == 2){
            $error_code = ControllerScopes::sell_share($request->input('team_id'),
                                $request->input('company_id'),
                                $request->input('amount'));
        }
        else if ($request->input('buy_sell') == 3) {
            $error_code = ControllerScopes::buy_back($request->input('team_id'),
                                $request->input('company_id'),
                                $request->input('amount'));
        }
        else if ($request->input('buy_sell') == 4){
            $error_code = ControllerScopes::short_sell($request->input('team_id'),
                                $request->input('company_id'),
                                $request->input('amount'));
        }
        if ($error_code) {
            return back()->with('error',ControllerScopes::error($error_code));
        }
        $error_code = ControllerScopes::adjust_rate($request->input('amount'),
                    $request->input('company_id'),
                    $request->input('buy_sell'));
        $transaction->team_id = $request->input('team_id');
        $transaction->company_id = $request->input('company_id');
        $transaction->amount = $request->input('amount');
        $transaction->buy_sell = $request->input('buy_sell');
        $session = Session::orderBy('time','desc')->first();
        if (empty($session)) {
            $session = new Session;
            $session->save();
        }
        $transaction->session_id = $session->id;
        $transaction->save();
        return back()->with('success','Transaction completed successfully');
    }

    public function show($team_id) {
	$error_code = ControllerScopes::security_check($team_id);	
	if ($error_code) return back()->with('error',ControllerScopes::error($error_code));
        $transactions = Transaction::where('team_id','=',$team_id)->get();
        return view('transactions')->with('transactions',$transactions)
                                    ->with('team_id',$team_id);
    }

    public function session_end() {
        $company_dividends = CompanyDividend::all();
        $company_bonuses = CompanyBonus::all();
	$companies = Company::all();
	$shortsold_shares = ShortsoldShare::all();
        $session = Session::orderBy('time','desc')->first()->id;
/*	foreach ($companies as $company) {
		$transactions = Transaction::where('session_id','=',$session)
					->where('company_id','=',$company->id)
					->get();
		foreach ($transactions as $transaction) {
			if ($transaction->amount <= 100) {
				$changeRate = ControllerScopes::random_in_range(1,2); // 1 to 2 
			}
			else if ($transaction->amount <= 500) {
			   $changeRate = ControllerScopes::random_in_range(2,5);  // 2 to 5
			}
			else if ($transaction->amount <= 1000) {
			    $changeRate = ControllerScopes::random_in_range(5,10); // 5 to 10
			}
			else {
			    $changeRate = ControllerScopes::random_in_range(10,20); // 10 to 20
			}
			if ($transaction->buy_sell == 1) {
			    $company->rate = $company->rate *(1+$changeRate/100);
			}
			else if ($transaction->buy_sell == 2) {
			    $company->rate = $company->rate * (1-$changeRate/100);
			}	
		}
		$company->save();
	}*/
	foreach($company_dividends as $company_dividend) {
            if ($company_dividend->profit_or_loss) {
                $shares = Share::where('company_id','=',$company_dividend->company_id)
                                ->where('amount','>=',$company_dividend->shares_per_dividend)
                                ->get();
		$no_of_shares = 0;
		foreach ($shares as $share) {
			$no_of_shares += $share->amount;
		}
                foreach($shares as $share) {
                    $team = Team::where('id','=',$share->team_id)
                                ->first();
                    $dividend_factor = intval($share->amount/$company_dividend->shares_per_dividend);
                    $team->balance += ($company_dividend->dividend/$no_of_shares) * $dividend_factor; // company dividiend->dividend = profit
                    $team->save();
                }
                DB::delete("DELETE FROM company_dividends 
                WHERE company_id=$company_dividend->company_id;");
            }
        }

        foreach($company_bonuses as $company_bonus) {
            $shares = Share::where('company_id','=',$company_bonus->company_id)
                            ->where('amount','>=',$company_bonus->bonus)
                            ->get();
            foreach ($shares as $share) {
                $team = Team::where('id','=',$share->team_id)
                    ->first();
                $bonus_factor = intval($share->amount/$company_bonus->shares_per_bonus);
                $team->balance += $company_bonus->bonus * $bonus_factor;
                $team->save();
            }
        }

        foreach ($shortsold_shares as $shortsold_share) {
            $share = Share::where('id','=',$shortsold_share->share_id)->first();
            $error_code = ControllerScopes::buy_back($share->team_id,$share->company_id,$shortsold_share->amount);
        }
        $session = new Session;
        $session->save();
        return back()->with('success','Session Ended.');
    }
}
