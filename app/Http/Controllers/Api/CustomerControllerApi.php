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
            'category' => 'required',
            'description' => 'required',
        ]);
        $customerQuery = Customer::query();
        if ($request->number) {
            $customerQuery->where('number', $request->number);
        }
        if ($request->email) {
            $customerQuery->where('email', $request->email);
        }
        $customer = $customerQuery->first();

        if($customer){
            $supports = new Support();
            $supports->customer_id = $customer->id;
            $supports->category = $request->category;
            $supports->type = $request->type;
            $supports->description = $request->description;
            $supports->save();
            return response()->json([
                'status' => 1,
                'message' => 'success1',
            ], 200);
        }else{
            $customerNew = new Customer();
            $customerNew->name = $request->name;
            $customerNew->email = $request->email ?? null;
            $customerNew->number = $request->number ?? null;
            $customerNew->save();
            //supports store
            $supports = new Support();
            $supports->customer_id = $customerNew->id;
            $supports->category = $request->category;
            $supports->type = $request->type;
            $supports->description = $request->description;
            $supports->save();
            return response()->json([
                'status' => 1,
                'message' => 'success2',
            ], 200);
        }





    }
}
