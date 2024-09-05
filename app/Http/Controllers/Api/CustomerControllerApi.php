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
            'email' => 'required_without:number|email',
            'number' => 'required_without:email|numeric',
            'category' => 'required',
            'description' => 'required',
        ]);

        //customer store
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
