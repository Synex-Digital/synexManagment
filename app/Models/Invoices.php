<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;

    public function labels (){

        return $this->hasMany(InvoiceLabels::class, 'invoice_id', 'id');
    }
    public function items (){

        return $this->hasMany(InvoiceItems::class, 'invoice_id', 'id');
    }
    public function client (){

        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}
