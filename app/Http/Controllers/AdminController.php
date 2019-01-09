<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class AdminController extends Controller
{
    public function dashboard() {
        $companies = Company::all();
        return view('admin')->with('companies',$companies);
    }
}
