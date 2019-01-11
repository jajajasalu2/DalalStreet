<?php

namespace App\Traits;
use App\Share;
use App\Company;
use App\Team;
use App\Transaction;

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
        if ($amount == 0 || $share->amount == 0) {
            return 12;
        }
        if ($share->amount < $amount) {
            return 11;
        }
        else {
            $share->amount -= $amount;
            if ($share->amount == 0 && $share->short_sold == 0) {
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
        $bought = 0;
        $sold = 0;
        foreach($transactions as $transaction) {
            if ($transaction->buy_sell == 1) {
                $bought++;
            }
            else {
                $sold++;
            }
        }
        if ($buy_or_sell == 1) {
            $company->rate = $amount*$bought*mt_rand()/mt_getrandmax();
            //$company->rate += $amount*$bought*mt_rand()/mt_getrandmax();
        }
        else if ($buy_or_sell == 2){
            $company->rate -= $amount*$sold*mt_rand()/mt_getrandmax();
        }
        $company->save();
        return 0;
    }

    /*public function short_sell($amount,$team_id,$company_id) {
        $share = Share::where('team_id','=',$team_id)
                        ->where('company_id','=',$company_id)
                        ->first();
        $team = Team::where('id','=',$team_id)->first();
        $company = Company::where('id','=',$company_id)->first();
        if (empty($share)) {
            return 10;
        }
        if ($amount == 0) {
            return 12;
        }
        if ($share->amount < $amount) {
            return 11;
        }
        $share->amount -= $amount;
        $share->short_sold += $amount;
        $share->save();
        return 0;
    }

    public function buy_back($amount,$team_id,$company_id) {
        $share = Share::where('team_id','=',$team_id)
                        ->where('company_id','=',$company_id)
                        ->first();
        $team = Team::where('id','=',$team_id)->first();
        $company = Company::where('id','=',$company_id)->first();
        if (empty($share)) {
            return 10;
        }
        if ($share->short_sold < $amount) {
            return 15;
        }
        $share->short_sold -= $amount;
        $share->amount += $amount;
        $team->balance -= 
    }*/

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
            15 => 'Haven\'t short sold enough shares'
        ];
        return $errors[$error_code];
    }

}