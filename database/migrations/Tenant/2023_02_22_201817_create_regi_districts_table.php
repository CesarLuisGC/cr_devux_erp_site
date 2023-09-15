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
        Schema::create('regi_districts', function (Blueprint $table) {
            $table->unsignedSmallInteger('country_id');
            $table->unsignedSmallInteger('state_id');
            $table->unsignedSmallInteger('cities_id');
            $table->unsignedSmallInteger('id');
            $table->string('name');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign(['country_id', 'state_id', 'cities_id'])->references(['country_id', 'state_id', 'id'])->on('regi_cities')->onDelete('cascade');
            $table->primary(['country_id', 'state_id', 'cities_id', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regi_districts');
    }
};
