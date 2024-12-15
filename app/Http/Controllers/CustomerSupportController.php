<?php

namespace App\Http\Controllers;

use App\Models\Support;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomerSupportController extends Controller
{
    public function customer(){


        if(auth()->user()->hasRole('superadmin')){
            // $custromers = Customer::orderBy('created_at', 'desc')->get();
            $custromers = Customer::with('support')
            ->select('customers.*', DB::raw('(SELECT MAX(created_at) FROM supports WHERE supports.customer_id = customers.id) as last_support_request'))
            ->orderBy('last_support_request', 'desc')
            ->get()
            ->map(function ($customer) {
                $customer->name = mb_convert_encoding($customer->name, 'UTF-8', 'UTF-8');
                $customer->email = $customer->email ? mb_convert_encoding($customer->email, 'UTF-8', 'UTF-8') : null;
                $customer->number = $customer->number ? mb_convert_encoding($customer->number, 'UTF-8', 'UTF-8') : null;
                return $customer;
            });
            return view('dashboard.web_support.index',[
                'customers' => $custromers
            ]);
        }else{
            return redirect()->route('dashboard');
        }

    }
    public function support($id){
        if(auth()->user()->hasRole('superadmin')){
            $supports = Support::where('customer_id', $id)->orderBy('created_at', 'desc')->get();
            $customer = Customer::find($id);
            return view('dashboard.web_support.support',[
                'supports' => $supports,
                'customer' => $customer
            ]);
        }else{
            return redirect()->route('dashboard');
        }

    }
    public function merge(Request $request){

       $validator = Validator::make($request->all(), [
        'customer_number' => 'required',
        'customer_email'    => 'required',
       ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->messages() as  $messages) {
                foreach ($messages as $message) {
                    flash()->options([
                        'position' => 'bottom-right',
                    ])->error($message);
                }
            }
            return back()->withErrors($validator)->withInput();
        }
        $customer_email = Customer::find($request->customer_email);
        $customer_number = Customer::find($request->customer_number);

        $customer_email->number = $customer_number->number;
        $customer_email->update();
        Support::where('customer_id', $customer_number->id)->update(['customer_id' => $customer_email->id]);
        $customer_number->delete();
        flash()->options([ 'position' => 'bottom-right', ])->success('Customer merged successfully');
        return redirect()->back();
    }

    public function update(Request $request){

        if($request->email){
            $database = Customer::where('email', $request->email)->first();
            if($database){
                flash()->options([ 'position' => 'bottom-right', ])->error('Email already exists');
                return redirect()->back();
            }
        }
        if($request->phone){
            $database = Customer::where('numebr', $request->phone)->first();
            if($database){
                flash()->options([ 'position' => 'bottom-right', ])->error('Number already exists');
                return redirect()->back();
            }
        }
        $customer = Customer::find($request->customer_id);
        $customer->name = $request->name;
        $customer->email = $request->email ?? null;
        $customer->number = $request->phone ?? null;
        $customer->update();
        flash()->options([ 'position' => 'bottom-right', ])->success('Customer updated successfully');
        return redirect()->back();

    }

}
