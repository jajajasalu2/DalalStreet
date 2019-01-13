<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\CompanyDividend;
use App\CompanyBonus;
use App\Transaction;
use App\Traits\ControllerScopes;
use DB;

class CompanyController extends Controller
{
    use ControllerScopes;
    public function create() {
        return view('create_company');
    }

    public function store(Request $request) {
        $this->validate($request,[
            'name'=>'required',
            'rate'=>'required',
            'value'=>'required',
            'no_of_shares'=>'required',
            'type'=>'required',
            'bonus_exists'=>'required',
            'dividend_exists'=>'required'
        ]);
        $company = new Company;
        $company->name = $request->input('name');
        $company->rate = $request->input('rate');
        $company->value = $request->input('value');
        $company->no_of_shares = $request->input('no_of_shares');
        $company->type = $request->input('type');
        $company->save();
        if ($request->input('dividend_exists')) {
            $dividend = new CompanyDividend;
            $dividend->company_id = $request->input('company_id');
            $dividend->shares_per_dividend = $request->input('shares_per_dividend');
            $dividend->dividend = $request->input('dividend');
            DB::insert("INSERT into company_dividends 
            values($dividend->company_id,$dividend->shares_per_bonus,$dividend->bonus);");
        }
        if ($request->input('bonus_exists')) {
            $bonus = new CompanyBonus;
            $bonus->company_id = $request->input('company_id');
            $bonus->shares_per_bonus = $request->input('shares_per_bonus');
            $bonus->bonus = $request->input('bonus');
            DB::insert("INSERT into company_bonuses 
            values($bonus->company_id,$bonus->shares_per_bonus,$bonus->bonus);");
        }
        return back()->with('success','Company/Forex created successfully');
    }
    
    public function edit($company_id) {
        $company = Company::where('id','=',$company_id)->first();
        $company_dividend = CompanyDividend::where('company_id','=',$company->id)->first();
        $company_bonus = CompanyBonus::where('company_id','=',$company->id)->first();

        return view('edit_company')->with('company',$company)
                                    ->with('company_dividend',$company_dividend)
                                    ->with('company_bonus',$company_bonus);
    }

    public function update(Request $request) {
        $this->validate($request,[
            'company_id'=>'required',
            'name'=>'required',
            'rate'=>'required',
            'value'=>'required',
            'no_of_shares'=>'required',
            'type'=>'required',
            'bonus_exists'=>'required',
            'dividend_exists'=>'required'
        ]);
        $company = Company::where('id','=',$request->input('company_id'))->first();
        $company->name = $request->input('name');
        $company->rate = $request->input('rate');
        $company->value = $request->input('value');
        $company->no_of_shares = $request->input('no_of_shares');
        $company->type = $request->input('type');
        $company->save();
        if ($request->input('dividend_exists')) {
            $dividend = CompanyDividend::where('company_id','=',$request->input('company_id'))
                                        ->first();
            if (empty($dividend)) {
                $dividend = new CompanyDividend;
                $dividend->company_id = $request->input('company_id');
                DB::insert("INSERT INTO company_dividends
                values($dividend->company_id,0,0);");
            }
            $dividend->shares_per_dividend = $request->input('shares_per_dividend');
            $dividend->dividend = $request->input('dividend');
            DB::statement("UPDATE company_dividends
            SET shares_per_dividend=$dividend->shares_per_dividend
            ,dividend=$dividend->dividend WHERE company_id=$dividend->company_id;");
        }
        if ($request->input('bonus_exists')) {
            $bonus = CompanyBonus::where('company_id','=',$request->input('company_id'))
                                ->first();
            if (empty($bonus)) {
                $bonus = new CompanyBonus;
                $bonus->company_id = $request->input('company_id');
                DB::insert("INSERT INTO company_bonuses
                values($bonus->company_id,0,0);");
            }   
            $bonus->shares_per_bonus = $request->input('shares_per_bonus');
            $bonus->bonus = $request->input('bonus');
            //$bonus->save();
            DB::statement("UPDATE company_bonuses
            SET shares_per_bonus=$bonus->shares_per_bonus
            ,bonus=$bonus->bonus WHERE company_id=$bonus->company_id;");
        }
        //return 1;
        return back()->with('success','Company/Forex details updated successfully');
    }


    public function delete(Request $request) {
        $company_id = $request->input('company_id');
        $dividend = CompanyDividend::where('company_id','=',$request->input('company_id'))
                                    ->first();
        //return empty($dividend);
        $bonus = CompanyBonus::where('company_id','=',$request->input('company_id'))
                            ->first();
        $transactions = Transaction::where('company_id','=',$request->input('company_id'))
                                    ->get();
        $company = Company::where('id','=',$request->input('company_id'))->first();
        if ($dividend) {
            DB::delete("delete from company_dividends 
            where company_id=$dividend->company_id;");
        }
        if ($bonus) {
            DB::delete("delete from company_bonuses
            where company_id=$bonus->company_id;");
        }
        $del_shares = ControllerScopes::delete_shares($request);
        DB::delete("delete from transactions where company_id=$company_id;");
        $company->delete();
        return back()->with('success','Company/Forex deleted successfully');
    }

}
