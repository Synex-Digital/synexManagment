<?php

namespace App\Http\Controllers;

use App\Models\Support;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerSupportController extends Controller
{
    public function support(){
        $custromers = Support::orderBy('created_at', 'desc')->get();
        return view('dashboard.web_support.index',[
            'customers' => $custromers
        ]);
    }
}
