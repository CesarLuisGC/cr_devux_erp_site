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
        Schema::create('regi_states', function (Blueprint $table) {
            $table->unsignedSmallInteger('country_id');
            $table->unsignedSmallInteger('id');
            $table->string('name');
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
        Schema::dropIfExists('regi_states');
    }
};
