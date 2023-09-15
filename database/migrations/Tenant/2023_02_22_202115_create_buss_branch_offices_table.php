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
        Schema::create('buss_branch_offices', function (Blueprint $table) {
            $table->unsignedSmallInteger('country_id');
            $table->unsignedSmallInteger('company_id');
            $table->unsignedSmallInteger('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('address', 200)->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('cellphone', 20)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign(['country_id', 'company_id'], 'buss_branch_offices_has_buss_companies_foreign')->references(['country_id', 'id'])->on('buss_companies')->onDelete('cascade');
            $table->primary(['country_id', 'company_id', 'id'], 'buss_branch_offices_primary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buss_branch_offices');
    }
};
