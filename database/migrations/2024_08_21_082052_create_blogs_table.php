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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('employee_id');
            $table->string('title');
            $table->longText('content');
            $table->string('image')->nullable();
            $table->integer('view_count')->default('0');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('seo_title');
            $table->longText('seo_description');
            $table->string('seo_tags');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
