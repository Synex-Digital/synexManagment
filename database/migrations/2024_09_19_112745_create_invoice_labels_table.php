<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoice_labels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->string('bill_to_label');
            $table->string('date_label');
            $table->string('payment_terms_label');
            $table->string('due_data_label');
            $table->string('item_amount_label');
            $table->string('item_rate_label');
            $table->string('item_qty_label');
            $table->string('item_desc_label');
            $table->string('note_label');
            $table->string('term_label');
            $table->string('subtotal_label');
            $table->string('discount_label');
            $table->string('tax_label');
            $table->string('total_label');
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_labels');
    }
};
