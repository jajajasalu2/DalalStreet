<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\Company;

class AjaxController extends Controller
{
	public function index() {
		$companies = Company::all();	
		return response()->json(array('companies'=>$companies),200);
	}
}
