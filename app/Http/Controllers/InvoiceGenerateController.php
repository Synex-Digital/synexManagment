<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;

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
}
