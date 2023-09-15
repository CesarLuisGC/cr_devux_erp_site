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
        Schema::create('buss_companies', function (Blueprint $table) {
            $table->unsignedSmallInteger('country_id');
            $table->unsignedSmallInteger('id');
            $table->string('name');
            $table->string('businessName', 120)->nullable();
            $table->unsignedSmallInteger('identification_type_id')->nullable();
            $table->string('identification', 30)->nullable();
            $table->string('email')->nullable();
            $table->string('address', 120)->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('cellphone', 20)->nullable();
            $table->string('website')->nullable();
            $table->binary('image')->nullable();
            $table->string('imageExt', 10)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('country_id')->references('id')->on('regi_countries')->onDelete('cascade');
            $table->foreign(['country_id', 'identification_type_id'])->references(['country_id', 'id'])->on('buss_identification_types')->onDelete('cascade');
            $table->primary(['country_id', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buss_companies');
    }
};
