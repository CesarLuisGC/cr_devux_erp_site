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
        Schema::create('inve_attribute_values', function (Blueprint $table) {
            $table->unsignedSmallInteger('country_id');
            $table->unsignedSmallInteger('company_id');
            $table->unsignedSmallInteger('attribute_id');
            $table->unsignedSmallInteger('id');
            $table->string('name');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign(['country_id', 'company_id', 'attribute_id'])->references(['country_id', 'company_id', 'id'])->on('inve_attributes')->onDelete('cascade');
            $table->primary(['country_id', 'company_id', 'attribute_id', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inve_attribute_values');
    }
};
