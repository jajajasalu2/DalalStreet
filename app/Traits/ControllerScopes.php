<?php

namespace App\Traits;
use App\Share;
use App\Company;
use App\Team;
use App\Transaction;
use App\ShortsoldShare;
use DB;

trait ControllerScopes {
    
    public static function sell_share($team_id,$company_id,$amount) {
        $share = Share::where('team_id','=',$team_id)
                            ->where('company_id','=',$company_id)
                            ->first();
        $company = Company::where('id','=',$company_id)->first();
        $team = Team::where('id','=',$team_id)->first();
        if (empty($share)) {
            return 10;
        }
        $shortsold_share = ShortsoldShare::where('share_id','=',$share->id)->first();
        if ($amount == 0 || $share->amount == 0 || $amount < 0) {
            return 12;
        }
        if ($share->amount < $amount) {
            return 11;
        }
        else {
            $share->amount -= $amount;
            if ($share->amount == 0 && empty($shortsold_share)) {
                $share->delete();
            }
            else {
                $share->save();
            }
        }
        $company->no_of_shares += $amount;
        $company->save();
        $team->balance += $company->rate * $amount;
        $team->save();
        return 0;
    }

    public static function buy_share($team_id,$company_id,$amount) {
        $share = Share::where('team_id','=',$team_id)
                            ->where('company_id','=',$company_id)
                            ->first();
        $company = Company::where('id','=',$company_id)->first();
        $team = Team::where('id','=',$team_id)->first();
        if ($amount == 0 || $amount < 0) {
            return 12;
        }
        if ($company->no_of_shares < $amount) {
            return 14;
        }
        if ($team->balance < ($company->rate * $amount)) {
            return 13;
        }
        if (empty($share)) {
            $share = new Share;
            $share->team_id = $team_id;
            $share->company_id = $company_id;
            $share->amount = $amount;
        }
        else {
            $share->amount += $amount;
        }
        $share->save();
        $team->balance -= $company->rate * $amount;
        $team->save();
        $company->no_of_shares -= $amount;
        $company->save();
        return 0;
    }

    public static function adjust_rate($amount,$company_id,$buy_or_sell) {
        $company = Company::where('id','=',$company_id)->first();
        $transactions = Transaction::where('company_id','=',$company_id)->get();
        //$bought = 0;
 /*       $sold = 0;
        foreach($transactions as $transaction) {
            if ($transaction->buy_sell == 1) {
                $bought+=$transaction->amount;
            }
            else if ($transaction->buy_sell == 2) {
                $sold+=$transaction->amount;
            }
	}*/
        if ($amount <= 100)
            {
                $changeRate = 0.75; // 1 to 2 
            }
            else if ($amount <= 500)
            {
                $changeRate = 1;  // 2 to 5
            }
            else if ($amount <= 1000)
            {
                $changeRate = 1.5; // 5 to 10
            }
            else
            {
                $changeRate = 2; // 10 to 20
            }

        if ($buy_or_sell == 1) {
            //$company->rate += $bought*mt_rand()/mt_getrandmax();
	$company->rate = $company->rate *( 1+ (mt_rand()/mt_getrandmax())/100);
		//$company->rate = $company->rate * (1+$changeRate / 100);
        }
        else if ($buy_or_sell == 2) {

		$company->rate = $company->rate * (1-$changeRate / 100);
            //$company->rate -= $sold*mt_rand()/mt_getrandmax();
        }
        $company->save();
        return 0;
    }

    public static function short_sell($team_id,$company_id,$amount) {
        $share = Share::where('team_id','=',$team_id)
                        ->where('company_id','=',$company_id)
                        ->first();
        if (empty($share)) {
            return 10;
        }
        $shortsold_share = ShortsoldShare::where('share_id','=',$share->id)->first();
        if (!empty($shortsold_share)) {
            return 15;
        }
        if ($amount == 0 || $amount < 0) {
            return 12;
        }
        if ($share->amount < $amount) {
            return 11;
        }
        $company = Company::where('id','=',$share->company_id)->first();
        DB::insert("INSERT INTO shortsold_shares (share_id,amount,rate) 
        values($share->id,$amount,$company->rate);");
        $share->amount -= $amount;
        $share->save();
        return 0;
    }

    public static function buy_back($team_id,$company_id,$amount) {
        $share = Share::where('team_id','=',$team_id)
                        ->where('company_id','=',$company_id)
                        ->first();
        if (empty($share)) {
            return 10;
        }
        $shortsold_share = ShortsoldShare::where('share_id','=',$share->id)->first();
        if (empty($shortsold_share)) {
            return 16;
        }
        if ($amount == 0 || $amount < 0) {
            return 12;
        }
        if ($amount > $shortsold_share->amount) {
            return 17;
        }
        $company = Company::where('id','=',$share->company_id)->first();
        $team = Team::where('id','=',$team_id)->first();
        $buy_back_factor = ($shortsold_share->rate - $company->rate) * $amount;
        if ($buy_back_factor < 0 && $team->balance < $buy_back_factor) {
            $team->balance -= 0.1 * $team->balance;
        }
        else {
            $team->balance += $buy_back_factor;
        }
        $shortsold_share->amount -= $amount;
        $share->amount += $amount;
        if ($shortsold_share->amount == 0) {
            DB::delete("DELETE FROM shortsold_shares 
            WHERE share_id = $share->id;");
        }
        else {
            DB::statement("UPDATE shortsold_shares
            SET amount=$shortsold_share->amount
            WHERE share_id=$share->id;");
        }
        $share->save();
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

    public static function error($error_code) {
        $errors = [
            10 => 'You don\'t have a share in this company',
            11 => 'You don\'t have enough shares in this company',
            12 => 'Cant sell 0 shares',
            13 => 'Not enough balance',
            14 => 'This company does not have enough shares',
            15 => 'You have already short sold shares of this company',
            16 => 'You haven\'t short sold shares of this company',
            17 => 'You haven\'t short sold enough shares of this company'
        ];
        return $errors[$error_code];
    }

}
