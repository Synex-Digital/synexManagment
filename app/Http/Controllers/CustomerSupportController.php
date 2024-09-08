<?php

namespace App\Http\Controllers;

use App\Models\Support;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerSupportController extends Controller
{
    public function customer(){
        $custromers = Customer::orderBy('created_at', 'desc')->get();
        return view('dashboard.web_support.index',[
            'customers' => $custromers
        ]);
    }
    public function support($id){
      $supports = Support::where('customer_id', $id)->get();
      $customer = Customer::find($id);
      return view('dashboard.web_support.support',[
          'supports' => $supports,
          'customer' => $customer
      ]);
    }
}
