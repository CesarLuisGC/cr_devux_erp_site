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
        Schema::create('buss_cellars', function (Blueprint $table) {
            $table->unsignedSmallInteger('country_id');
            $table->unsignedSmallInteger('company_id');
            $table->unsignedSmallInteger('branch_office_id');
            $table->unsignedSmallInteger('id');
            $table->string('name');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign(['country_id', 'company_id', 'branch_office_id'], 'buss_cellars_has_buss_branch_offices_foreign')->references(['country_id', 'company_id', 'id'])->on('buss_branch_offices')->onDelete('cascade');
            $table->primary(['country_id', 'company_id', 'id'], 'buss_cellars_primary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buss_cellars');
    }
};
