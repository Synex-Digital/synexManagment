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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->string('currency');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('header');
            $table->string('bill_to_value')->nullable();
            $table->date('date_value');
            $table->string('payment_terms_value');
            $table->date('due_date_value');
            $table->longText('note_value',);
            $table->longText('term_value');
            $table->decimal('subtotal_value', 20, 2);
            $table->decimal('discount_value', 10, 2)->nullable(); // Handling possible null values
            $table->string('discount_type')->nullable();
            $table->decimal('tax_value', 10, 2);
            $table->decimal('total_value', 20, 2);
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
