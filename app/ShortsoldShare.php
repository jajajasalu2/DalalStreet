<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Company;

class ShortsoldShare extends Model
{
    protected $table = 'shortsold_shares';
//<<<<<<< HEAD
	public function company_name() {
		$company_name = Company::where('id','=',$this->company_id)->first()->name;
		return $company_name;
	}
//=======

//>>>>>>> 13f4051606af47232fae5dcd232754c2548f6d2a
}
