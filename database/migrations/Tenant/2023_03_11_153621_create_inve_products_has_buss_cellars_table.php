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
        Schema::create('inve_products_has_buss_cellars', function (Blueprint $table) {
            $table->unsignedSmallInteger('country_id');
            $table->unsignedSmallInteger('company_id');
            $table->unsignedSmallInteger('branch_office_id');
            $table->unsignedSmallInteger('cellar_id');
            $table->unsignedSmallInteger('product_id');

            $table->decimal('cost', 18, 5);
            $table->decimal('balance', 18, 5);
            $table->decimal('min_balance', 18, 5);
            $table->decimal('max_balance', 18, 5);

            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign(['country_id', 'company_id', 'branch_office_id', 'cellar_id'], 'inve_products_has_buss_cellars_foreign')->references(['country_id', 'company_id', 'branch_office_id', 'id'])->on('buss_cellars')->onDelete('cascade');
            $table->primary(['country_id', 'company_id', 'branch_office_id', 'cellar_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inve_products_has_buss_cellars');
    }
};
