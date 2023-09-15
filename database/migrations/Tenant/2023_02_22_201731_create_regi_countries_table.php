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
        Schema::create('regi_countries', function (Blueprint $table) {
            $table->unsignedSmallInteger('id');
            $table->string('name');
            $table->string('area_code', 5);
            $table->string('iso3', 3);
            $table->timestamps();
            $table->primary(['id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regi_countries');
    }
};
