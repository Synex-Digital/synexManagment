<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceGenerateController extends Controller
{
    public function index(){
        $clients = Client::all();
        $projects = Project::all();
        return view('dashboard.invoice.index', [
            'clients' => $clients,
            'projects' => $projects

        ]);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'header'                    => 'required|string|max:255',
            'bill_to_label'             => 'required|string|max:255',
            'bill_to_value'             => 'required|string|max:255',
            'date_label'                => 'required|string|max:255',
            'date_value'                => 'required|date',
            'payment_terms_label'       => 'required|string|max:255',
            'payment_terms_value'       => 'required|date',
            'due_data_label'            => 'required|string|max:255',
            'due_date_value'            => 'required|date',
            'itemAmountLabel'           => 'required|string|max:255',
            'itemRatelabel'             => 'required|string|max:255',
            'itemQtyLabel'              => 'required|string|max:255',
            'itemDescLabel'             => 'required|string|max:255',
            'itemAmount.*'              => 'required|numeric',
            'itemRate.*'                => 'required|numeric',
            'itemQty.*'                 => 'required|integer',
            'itemDesc.*'                => 'required|string|max:255',
            'subtotal_label'            => 'required|string|max:255',
            'total_label'               => 'required|string|max:255',
            'total_value'               => 'required|numeric',

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
        //store

    }
}
