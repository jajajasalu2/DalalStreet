<?php

namespace App\Traits;
use App\Share;
use App\Company;
use App\Team;
use App\Transaction;
use App\ShortsoldShare;
use Auth;
use DB;

trait ControllerScopes {
    
    /*
    * Function: sell_share
    * Input: team_id: the unique id number of the team
             company_id: the unique id number of the company
             amount: the amount of shares pertaining to the transaction
    * Output: 0 for successful execution, else an error code
    * Description: The transaction is verified before execution, ie, the team id has 
    *              the a share in the company, it has the required amount of shares
                   and the amount of shares to be bought is not lesser than or equal to zero. 
                   The rate of the company multiplied by the amount of shares to be sold is 
                   deducted from the team's balance. If the team does not hold anymore shares
                   in the company and it has not shortsold any shares of the company in the 
                   current session, the team's share is deleted.
    * Example: For team number 1 selling 1 share in company number 1,
                sell_share(1,1,1);
                To call the function from a controller,
                ControllerScopes::sell_share(1,1,1);
   */
    public static function sell_share($team_id,$company_id,$amount) {
        $team = Team::where('id','=',$team_id)->first();
        $share = Share::where('team_id','=',$team_id)
                            ->where('company_id','=',$company_id)
                            ->first();
        $company = Company::where('id','=',$company_id)->first();
//<<<<<<< HEAD
        $team = Team::where('id','=',$team_id)->first();
	if (empty($team)) return 25;
//=======
	if (empty($company)) return 26;
//>>>>>>> 13f4051606af47232fae5dcd232754c2548f6d2a
        if (empty($share)) {
            return 10;
        }
        //$shortsold_share = ShortsoldShare::where('share_id','=',$share->id)->first();
        if ($amount == 0 || $share->amount == 0 || $amount < 0) {
            return 12;
        }
        if ($share->amount < $amount) {
            return 11;
        }
        else {
            $share->amount -= $amount;
            if ($share->amount == 0) {
                $share->delete();
            }
            else {
                $share->save();
            }
        }
        //$team->balance += $company->rate * $amount;
        $team->balance += 0.98 * $company->rate * $amount;  //2% brokerage fees
        $team->save();
        return 0;
    }

    /*
    * Function: buy_share
    * Input: team_id: the unique id number of the team
    *         company_id: the unique id number of the company
    *         amount: the amount of shares pertaining to the transaction
    * Output: 0 for successful execution, else an error code
    * Description: The transaction is verified before execution, ie, the team id has 
    *              the required amount of balance and the amount of shares to be bought 
    *               is not lesser than or equal to zero. The rate of the company multiplied
    *               by the amount of shares to be bought is added to the team's balance.
    *               If the team does not have an existing share in the company, a new share for
    *               the team is created.
    * Example: For team number 1 buying 1 share in company number 1,
    *            buy_share(1,1,1);
    *            To call the function from a controller,
    *            ControllerScopes::buy_share(1,1,1);
    */
    public static function buy_share($team_id,$company_id,$amount) {
        $share = Share::where('team_id','=',$team_id)
                            ->where('company_id','=',$company_id)
                           ->first();
        $company = Company::where('id','=',$company_id)->first();
        $team = Team::where('id','=',$team_id)->first();
	if (empty($team)) return 25;
//<<<<<<< HEAD
//=======
	if (empty($company)) return 26;
//>>>>>>> 13f4051606af47232fae5dcd232754c2548f6d2a
		if ($amount == 0 || $amount < 0) {
            return 12;
        }
		if ($team->balance < ($company->rate * $amount)) {
            return 13;
        }
		if (!empty($share)) {
			if ($share->amount + $amount > 2000) {
				return 20;
			}
			else {
				$share->amount += $amount;
			}
        }
        else if ($amount >= 2000) {
            return 20;
        }
		else {
            $share = new Share;
            $share->team_id = $team_id;
            $share->company_id = $company_id;
            $share->amount = $amount;
        }
        //if ($company->no_of_shares < $amount) {
        //    return 14;
        //}
        $share->save();
        $team->balance -= $company->rate * $amount;
	if ($team->balance < 100) $team->balance = 100;
        $team->save();
        //$company->no_of_shares -= $amount;
        //$company->save();
        return 0;
    }

    public static function random_in_range($min,$max) {
        return ($min + lcg_value()*(abs($max - $min)));
    }

	public static function rate_factor($num) {
		$tens_unit = 0;
		$temp = 0;
		while (1) {
			$temp = $num % 10;
			$num/=10;
			$num = intval($num);
			$tens_unit++;
			if ($num == 0) break;
		}
		return ($temp * pow(10,$tens_unit) / 10);
	}

    /*
    * Function: adjust_rate
    * Input: amount: the amount of shares pertaining to the transaction
    *         company_id: the unique id number of the company
    *         buy_or_sell: the type of transaction
    * Output: 0 for successful execution
    * Description: After each transaction which involves the buying and selling of shares
    *               the rate of the company whose shares have been transacted must be adjusted
    *               With respect to the amount of shares transacted, a suitable constant 
    *               to change the rate is determined. If shares were bought, the current
    *               rate of the company is multiplied by 1 + (the constant / 100).
    *               If share were sold, the rate of the company is multiplied by
    *               1 - (the constant / 100).
    * Example: For 2 shares of company number 3 that have been bought,
    *            adjust_rate(2,3,1);
    *            For the same case if the shares have been sold,
    *            adjust_rate(2,3,2);
    */
    public static function adjust_rate($amount,$company_id,$buy_or_sell) {
        $company = Company::where('id','=',$company_id)->first();
        /*$transactions = Transaction::where('company_id','=',$company_id)->get();
        $bought = 0;
        $sold = 0;
        foreach($transactions as $transaction) {
            if ($transaction->buy_sell == 1) {
                $bought+=$transaction->amount;
            }
            else if ($transaction->buy_sell == 2) {
                $sold+=$transaction->amount;
            }
	    }*/
        if ($amount <= 100) {
            $changeRate = ControllerScopes::random_in_range(1,2); // 1 to 2 
        }
        else if ($amount <= 500) {
            $changeRate = ControllerScopes::random_in_range(2,5);  // 2 to 5
        }
        else if ($amount <= 1000) {
            $changeRate = ControllerScopes::random_in_range(5,10); // 5 to 10
        }
        else {
            $changeRate = ControllerScopes::random_in_range(10,20); // 10 to 20
        }
	$rate_factor = ControllerScopes::rate_factor($company->rate);
        if ($buy_or_sell == 1) {
            //$company->rate += $bought*mt_rand()/mt_getrandmax();
		$company->rate = $company->rate *(1+$changeRate/$rate_factor);
		    //$company->rate = $company->rate * (1+$changeRate / 100);
        }
        else if ($buy_or_sell == 2) {
		    $company->rate = $company->rate * (1-$changeRate/$rate_factor);
            //$company->rate -= $sold*mt_rand()/mt_getrandmax();
        }
	if ($company->rate < $rate_factor) $company->rate = $rate_factor;
        $company->save();
        return 0;
    }


    /*
    * Function: short_sell
    * Input: team_id: the unique id number of the team
    *         company_id: the unique id number of the company
    *         amount: the amount of shares pertaining to the transaction
    * Output: 0 for successful execution, else an error code
    * Description: The transaction is verified before execution, ie, the team id has 
    *               the required amount of shares, the amount of shares to be short sold 
    *               is not lesser than or equal to zero and the team has not already short
    *               sold shares of the company in the same session. The amount of shares the
    *                team short sells is deducted from the amount of shares the team owns.
    * Example: For team number 1 short selling 1 share in company number 1,
    *            short_sell(1,1,1);
    *            To call the function from a controller,
    *            ControllerScopes::short_sell(1,1,1);
    */
    public static function short_sell($team_id,$company_id,$amount) {
        //$share = Share::where('team_id','=',$team_id)
        //                ->where('company_id','=',$company_id)
        //                ->first();
        //if (empty($share)) {
        //    return 10;
        //}
	$team = Team::where('id','=',$team_id)->first();
        $company = Company::where('id','=',$company_id)->first();
	if (empty($team)) return 25;
	if (empty($company)) return 26;
    	$shortsold_share = ShortsoldShare::where('team_id','=',$team_id)
		    				->where('company_id','=',$company_id)
						->first();
        $company = Company::where('id','=',$company_id)->first();
	if (empty($team)) return 25;
        if ($amount == 0 || $amount < 0) {
            return 12;
        }
        if (!empty($shortsold_share)) {
		if ($shortsold_share->amount + $amount > 2000)
            		return 22;
		else {
			$total_amount = $shortsold_share->amount + $amount;
			DB::statement("UPDATE shortsold_shares set rate=$company->rate,amount=$total_amount where team_id=$team_id and company_id=$company_id;");
			return 0;
		}
        }
//<<<<<<< HEAD
//=======
	else if ($amount > 2000) return 22;
//>>>>>>> 13f4051606af47232fae5dcd232754c2548f6d2a
        //if ($share->amount < $amount) {
        //    return 11;
        //}
        DB::insert("INSERT INTO shortsold_shares (team_id,company_id,amount,rate) 
        values($team_id,$company_id,$amount,$company->rate);");
        //$share->amount -= $amount;
        //$share->save();
        return 0;
    }

    /*
    * Function: buy_back
    * Input: team_id: the unique id number of the team
    *         company_id: the unique id number of the company
    *         amount: the amount of shares pertaining to the transaction
    * Output: 0 for successful execution, else an error code
    * Description: The transaction is verified before execution, ie, the team id has 
                    short sold shares of the company, the amount of shares to be bought back
                    is not more than the amount of shares the team has short sold and the amount
                    of shares to be bought back is not lesser than or equal to zero. It is then
                    determined if the team has made a profit or a loss in their transaction- 
                    if the rate at which the share(s) were/was short sold was lesser than that at which
                    it is being bought back, the team has made a loss, and the amount is deducted from 
                    their balance. If the team does not possess the necessary balance, 10% of their balance is
                    deducted from their existing balance.
                    Else the team has made a profit and the necessary amount is added to the team's balance.
    *               by the amount of shares to be bought is added to the team's balance.
    * Example: For team number 1 buying back 1 share in company number 1,
    *            buy_back(1,1,1);
    *            To call the function from a controller,
    *            ControllerScopes::buy_back(1,1,1);
    */
    public static function buy_back($team_id,$company_id,$amount) {
        // $share = Share::where('team_id','=',$team_id)
        //                 ->where('company_id','=',$company_id)
        //                 ->first();
        // if (empty($share)) {
        //    return 10;
        //}
	$team = Team::where('id','=',$team_id)->first();
    $company = Company::where('id','=',$company_id)->first();
	if (empty($team)) return 25;
	if (empty($company)) return 26;
	$shortsold_share = ShortsoldShare::where('team_id','=',$team_id)
		    ->where('company_id','=',$company_id)
		    ->first();
	if (empty($team)) return 25;
        if (empty($shortsold_share)) {
            return 16;
        }
        if ($amount == 0 || $amount < 0) {
            return 12;
        }
        if ($amount > $shortsold_share->amount) {
            return 17;
        }
        $buy_back_factor = ($shortsold_share->rate - $company->rate) * $amount;
        if ($buy_back_factor < 0 && $team->balance < $buy_back_factor) {
            $team->balance -= 0.1 * $team->balance;
	    if ($team->balance < 100) $team->balance = 100;
        }
        else {
            $team->balance += $buy_back_factor;
        }
        $shortsold_share->amount -= $amount;
        //$share->amount += $amount;
        if ($shortsold_share->amount == 0) {
            DB::delete("DELETE FROM shortsold_shares 
	    WHERE team_id = $team_id
		and company_id=$company_id;");
        }
        else {
            DB::statement("UPDATE shortsold_shares
            SET amount=$shortsold_share->amount
	    WHERE team_id=$team_id
		and company_id=$company_id;");
        }
	//        $share->save();
        $team->save();
        return 0;
    }

    public static function delete_shares($request) {
        if ($request->input('delete_company')) {
            $shares = Share::where('company_id','=',$request->input('company_id'));
            //$shortsold_shares = ShortsoldShare::where('company_id','=',$request->input('company_id'));
        }
        else if($request->input('delete_team')) {
            $shares = Share::where('team_id','=',$request->input('team_id'));
            //$shortsold_shares = ShortsoldShare::where('team_id','=',$request->input('team_id'));
        }
        /*if (!empty($shortsold_shares)) {
            $shortsold_shares = $shortsold_shares->get();
            foreach ($shortsold_shares as $shortsold_share) {
                $shortsold_share->delete();
            }
        }*/
        if (!empty($shares)) {
            $shares = $shares->get();
            foreach ($shares as $share) {
                $error_code = ControllerScopes::sell_share($share->team_id,$share->company_id,$share->amount);
            }
        }
        return 0;
    }

    public static function security_check($team_id) {
    	$user = Auth::user();
	if ($user->role == 1 || $user->role == 2) return 0;
	else if ($user->role == 3) {
		$user_team = DB::table('user_teams')
			->where('team_id','=',$team_id)
			->first();
		if (empty($user_team)) return 21;
		else {
			$user_id = $user_team->user_id;
			if ($user_id != auth()->id()) return 21;
		}
	}
	return 0;
    }


    public static function counter_security_check($company_id) {
    	$user = Auth::user();
	if ($user->role == 1) return 0;
	else if ($user->role == 2) {
		$user_companies = DB::table('user_company')
			->where('company_id','=',$company_id)
			->get();
		if (empty($user_companies)) return 27;
		$flag = 1;
		foreach ($user_companies as $user_company) {
			if ($user_company->user_id == $user->id){
				$flag = 0;
				break;
			}
		}
		if ($flag) return 27;
	}
	else if ($user->role == 3) return 21;
	return 0;
    }

    public static function error($error_code) {
        $errors = [
            10 => 'You don\'t have a share in this company',
            11 => 'You don\'t have enough shares in this company',
            12 => 'Cant sell 0 shares',
            13 => 'Not enough balance',
            14 => 'This company does not have enough shares',
            15 => 'You have already short sold shares of this company',
            16 => 'You haven\'t short sold shares of this company',
	    17 => 'You haven\'t short sold enough shares of this company',
	    20 => 'You can\'t have more than 2000 shares of a company at a time',
	    21 => 'Permission Denied',
//<<<<<<< HEAD
	    22 => 'You can\'t short sell more than 2000 shares of a company in one session',	
//=======
	    25 => 'This team does not exist',
	    26 => 'Company does not exist',
	    27 => 'Hey counter! You seem to be trading in the wrong company. Please trade from the company page assigned to you.'
//>>>>>>> 13f4051606af47232fae5dcd232754c2548f6d2a
        ];
        return $errors[$error_code];
    }

}
