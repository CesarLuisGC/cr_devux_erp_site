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
        Schema::create('secu_users_has_buss_companies', function (Blueprint $table) {
            $table->unsignedSmallInteger('country_id');
            $table->unsignedSmallInteger('company_id');
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->boolean('main');
            $table->timestamps();
            $table->foreign(['country_id', 'company_id'], 'secu_users_has_buss_companies_buss_companies_foreign')->references(['country_id', 'id'])->on('buss_companies')->onDelete('cascade');
            $table->foreign(['user_id'], 'secu_users_has_buss_companies_users_foreign')->references(['id'])->on('users')->onDelete('cascade');
            $table->primary(['country_id', 'company_id', 'user_id'], 'secu_users_has_buss_companies_primary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secu_users_has_buss_companies');
    }
};
