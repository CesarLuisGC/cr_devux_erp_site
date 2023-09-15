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
        Schema::create('inve_products_has_buss_cellars_has_buss_price_levels', function (Blueprint $table) {
            $table->unsignedSmallInteger('country_id');
            $table->unsignedSmallInteger('company_id');
            $table->unsignedSmallInteger('branch_office_id');
            $table->unsignedSmallInteger('cellar_id');
            $table->unsignedSmallInteger('product_id');
            $table->unsignedSmallInteger('pricelevel_id');
            $table->decimal('utility', 8, 5);
            $table->decimal('price', 18, 5);

            $table->timestamps();
            //$table->foreign(['country_id', 'company_id', 'branch_office_id', 'cellar_id', 'product_id'], 'inve_products_has_buss_cellars_has_buss_cellars_foreign')->references(['country_id', 'company_id', 'branch_office_id', 'cellar_id', 'product_id'])->on('inve_products_has_buss_cellars')->onDelete('cascade');
            $table->foreign(['country_id', 'company_id', 'pricelevel_id'], 'inv_products_has_buss_cellar_has_buss_price_levels_foreign')->references(['country_id', 'company_id', 'id'])->on('buss_price_levels')->onDelete('cascade');
            $table->primary(['country_id', 'company_id', 'branch_office_id', 'cellar_id', 'product_id', 'pricelevel_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inve_products_has_buss_cellars_has_buss_price_levels');
    }
};
