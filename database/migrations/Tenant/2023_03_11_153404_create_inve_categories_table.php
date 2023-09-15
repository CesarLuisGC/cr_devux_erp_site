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
        Schema::create('inve_categories', function (Blueprint $table) {
            $table->unsignedSmallInteger('country_id');
            $table->unsignedSmallInteger('company_id');
            $table->unsignedSmallInteger('id');
            $table->string('name');
            $table->string('description', 120)->nullable();
            $table->binary('image')->nullable();
            $table->string('imageExt', 10)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign(['country_id', 'company_id'])->references(['country_id', 'id'])->on('buss_companies')->onDelete('cascade');
            $table->primary(['country_id', 'company_id', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inve_categories');
    }
};
