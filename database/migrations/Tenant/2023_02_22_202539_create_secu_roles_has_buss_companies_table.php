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
        Schema::create('secu_roles_has_buss_companies', function (Blueprint $table) {
            $table->unsignedSmallInteger('country_id');
            $table->unsignedSmallInteger('company_id');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();
            $table->foreign(['country_id', 'company_id'], 'secu_roles_has_buss_companies_buss_companies_foreign')->references(['country_id', 'id'])->on('buss_companies')->onDelete('cascade');
            $table->foreign(['role_id'], 'secu_roles_has_buss_companies_roles_id_foreign')->references(['id'])->on('roles')->onDelete('cascade');
            $table->primary(['country_id', 'company_id', 'role_id'], 'secu_roles_has_buss_companies_primary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secu_roles_has_buss_companies');
    }
};
