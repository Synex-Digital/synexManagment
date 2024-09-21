<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\InvoiceItems;
use App\Models\InvoiceLabels;
use App\Models\Invoices;
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
            'payment_terms_value'       => 'required',
            'due_date_label'            => 'required|string|max:255',
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
        // dd($request->all());

        $invoice = new Invoices();
        $invoice->invoice_number ='INV-'. strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
        $invoice->currency = $request->currency;
        $invoice->client_id = $request->client_id == 'none'? null : $request->client_id;
        $invoice->project_id = $request->project_id == 'none'? null : $request->project_id;
        $invoice->header = $request->header;
        $invoice->bill_to_value = $request->bill_to_value;
        $invoice->date_value = $request->date_value;
        $invoice->payment_terms_value = $request->payment_terms_value;
        $invoice->due_date_value = $request->due_date_value;
        $invoice->note_value = $request->note_value;
        $invoice->term_value = $request->term_value;
        $invoice->subtotal_value = $request->subtotal_value;
        $invoice->discount_value = $request->discount_value;
        $invoice->discount_type = $request->discount_type;
        $invoice->tax_value = $request->tax_value;
        $invoice->total_value = $request->total_value;
        $invoice->save();

        // invoice labels
        $labels = new InvoiceLabels();
        $labels->invoice_id = $invoice->id;
        $labels->bill_to_label = $request->bill_to_label;
        $labels->date_label = $request->date_label;
        $labels->payment_terms_label = $request->payment_terms_label;
        $labels->due_date_label = $request->due_date_label;
        $labels->item_amount_label = $request->itemAmountLabel;
        $labels->item_rate_label = $request->itemRatelabel;
        $labels->item_qty_label = $request->itemQtyLabel;
        $labels->item_desc_label = $request->itemDescLabel;
        $labels->note_label = $request->note_label;
        $labels->term_label = $request->term_label;
        $labels->subtotal_label = $request->subtotal_label;
        $labels->discount_label = $request->discount_label;
        $labels->tax_label = $request->tax_label;
        $labels->total_label = $request->total_label;
        $labels->save();

        // invoice items
        $itemDescs = $request->input('itemDesc');
        $itemQtys = $request->input('itemQty');
        $itemRates = $request->input('itemRate');
        $itemAmounts = $request->input('itemAmount');
        foreach ($itemDescs as $key => $desc) {
            $item = new InvoiceItems();
            $item->invoice_id = $invoice->id;
            $item->item_desc = $desc;
            $item->item_qty = $itemQtys[$key];
            $item->item_rate = $itemRates[$key];
            $item->item_amount = $itemAmounts[$key];
            $item->save();
        }



        flash()->options([
            'position' => 'bottom-right',
        ])->success('Invoice Generated successfully!');
        return back();


    }

    public function list(){
        $invoices = Invoices::latest()->get();
        return view('dashboard.invoice.list',[
            'invoices' => $invoices
        ]);
    }
    public function edit($id){
        $clients = Client::all();
        $projects = Project::all();
        $invoice = Invoices::with('items', 'labels')->where('id', $id)->first();

        return view('dashboard.invoice.edit',[
            'invoice' => $invoice,
            'clients' => $clients,
            'projects' => $projects
        ]);
    }

}
