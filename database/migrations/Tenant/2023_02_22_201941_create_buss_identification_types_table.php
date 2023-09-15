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
        Schema::create('buss_identification_types', function (Blueprint $table) {
            $table->unsignedSmallInteger('country_id');
            $table->unsignedSmallInteger('id');
            $table->string('name');
            $table->string('format', 30);
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('country_id')->references('id')->on('regi_countries')->onDelete('cascade');
            $table->primary(['country_id', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buss_identification_types');
    }
};
