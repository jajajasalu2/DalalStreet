<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\CompanyDividend;
use App\CompanyBonus;


class CompanyController extends Controller
{

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
        $company = Company::new();
        $company->name = $request->input('name');
        $company->rate = $request->input('rate');
        $company->value = $request->input('value');
        $company->no_of_shares = $request->input('no_of_shares');
        $company->type = $request->input('type');
        $company->save();
        if ($request->input('dividend_exists')) {
            $dividend = CompanyDividend::new();
            $dividend->company_id = $request->input('company_id');
            $dividend->shares_per_dividend = $request->input('shares_per_dividend');
            $dividend->dividend = $request->input('dividend');
            $dividend->save();
        }
        if ($request->input('bonus_exists')) {
            $bonus = CompanyBonus::new();
            $bonus->company_id = $request->input('company_id');
            $bonus->shares_per_bonus = $request->input('shares_per_bonus');
            $bonus->bonus = $request->input('bonus');
            $bonus->save();
        }
        return back()->with('success','Company/Forex created successfully');
    }
    
    public function edit($company_id) {
        $company = Company::where('id','=',$company_id)->first();
        return view('edit_company')->with('company',$company);
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
            $dividend = CompanyDividend::where('company_id','=',$request->input('company_id'));
            if (empty($dividend)) {
                $dividend = CompanyDividend::new();
                $dividend->company_id = $request->input('company_id');
            }
            else {
                $dividend = $dividend->first();
            }
            $dividend->shares_per_dividend = $request->input('shares_per_dividend');
            $dividend->dividend = $request->input('dividend');
            $dividend->save();
        }
        if ($request->input('bonus_exists')) {
            $bonus = CompanyBonus::where('company_id','=',$request->input('company_id'));
            if (empty($bonus)) {
                $bonus = CompanyBonus::new();
                $bonus->company_id = $request->input('company_id');
            }
            else {
                $bonus = $bonus->first();
            }
            $bonus->shares_per_bonus = $request->input('shares_per_bonus');
            $bonus->bonus = $request->input('bonus');
            $bonus->save();
        }
        //return 1;
        return back()->with('success','Company/Forex details updated successfully');
    }


    public function delete(Request $request) {
        $dividend = CompanyDividend::where('company_id','=',$request->input('company_id'));
        $bonus = CompanyBonus::where('company_id','=',$request->input('company_id'));
        $transactions = Transaction::where('company_id','=',$request->input('company_id'))->get();
        $company = Company::where('id','=',$request->input('company_id'))->first();
        $dividend->delete();
        $bonus->delete();
        $del_shares = ControllerScopes::delete_shares($request);
        foreach ($transactions as $transaction) {
            $transaction->delete();
        }
        $company->delete();
        return back()->with('success','Company/Forex deleted successfully');
    }

}
