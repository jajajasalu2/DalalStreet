<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Company;

class ShortsoldShare extends Model
{
    protected $table = 'shortsold_shares';

    public function company_name() {
    	$company = Company::where('id','=',$this->company_id)->first();
	return $company->name;
    }
}
