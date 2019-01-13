<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Company;
use App\Team;

class Share extends Model
{
    protected $table = 'shares';
    public function company_name() {
        $company = Company::where('id','=',$this->company_id)->first();
        return $company->name;
    }
}
