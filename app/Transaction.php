<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    public function company() {
        $company = Company::where('id','=',$this->company_id)->first();
        return $company->name;
    }
    public function time_of_transaction() {
        
    }
}
