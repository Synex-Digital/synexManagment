<?php

namespace App\Http\Controllers\Api;

use App\Models\Support;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerControllerApi extends Controller
{
    public function store(Request $request){
        $request->validate([
           'name' => 'required',
            'email' => $request->number ? '' : 'required|email',
            'number' => $request->email ? '' : 'required|numeric',
            'category' => 'required',
            'description' => 'required',
        ]);

        //customer store
        $customer = Customer::where('email', $request->email)->orWhere('number', $request->number)->first();
        if($customer->number == $request->number || $customer->email == $request->email){
            $supports = new Support();
            $supports->customer_id = $customer->id;
            $supports->category = $request->category;
            $supports->type = $request->type;
            $supports->description = $request->description;
            $supports->save();
            return response()->json([
                'status' => 1,
                'message' => 'success',
            ], 200);
        }else{
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email ?? null;
            $customer->number = $request->number ?? null;
            $customer->save();
            //supports store
            $supports = new Support();
            $supports->customer_id = $customer->id;
            $supports->category = $request->category;
            $supports->type = $request->type;
            $supports->description = $request->description;
            $supports->save();
            return response()->json([
                'status' => 1,
                'message' => 'success',
            ], 200);
        }





    }
}
