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
        Schema::create('service_projects', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail_image');
            $table->string('company_name');
            $table->string('title');
            $table->text('short_description');
            $table->string('slug')->unique()->nullable();
            $table->string('project_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->bigInteger('service_category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_projects');
    }
};
