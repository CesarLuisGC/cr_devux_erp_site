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
        Schema::create('syst_modules_has_buss_companies', function (Blueprint $table) {
            $table->unsignedSmallInteger('country_id');
            $table->unsignedSmallInteger('company_id');
            $table->unsignedSmallInteger('module_id');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign(['country_id', 'company_id'], 'buss_companies_country_id_company_id_foreign')->references(['country_id', 'id'])->on('buss_companies')->onDelete('cascade');
            $table->foreign(['module_id'], 'syst_modules_module_id_foreign')->references(['id'])->on('syst_modules')->onDelete('cascade');
            $table->primary(['country_id', 'company_id', 'module_id'], 'buss_companies_has_syst_modules_primary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syst_modules_has_buss_companies');
    }
};
