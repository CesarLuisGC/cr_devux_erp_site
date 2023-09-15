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
        Schema::create('regi_cities', function (Blueprint $table) {
            $table->unsignedSmallInteger('country_id');
            $table->unsignedSmallInteger('state_id');
            $table->unsignedSmallInteger('id');
            $table->string('name');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign(['country_id', 'state_id'])->references(['country_id', 'id'])->on('regi_states')->onDelete('cascade');
            $table->primary(['country_id', 'state_id', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regi_cities');
    }
};
