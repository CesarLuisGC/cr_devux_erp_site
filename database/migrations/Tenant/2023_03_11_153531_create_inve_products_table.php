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
        Schema::create('inve_products', function (Blueprint $table) {
            $table->unsignedSmallInteger('country_id');
            $table->unsignedSmallInteger('company_id');
            $table->unsignedSmallInteger('id');

            $table->string('code', 20);
            $table->string('name');
            $table->string('description', 200);

            $table->boolean('service')->default(1);
            $table->boolean('tax_exempt')->default(1);
            $table->boolean('compound')->default(1);

            $table->boolean('for_sale')->default(1);

            $table->unsignedSmallInteger('category_id');
            $table->unsignedSmallInteger('subcategory_id');

            $table->unsignedSmallInteger('unit_measurement_id');

            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign(['country_id', 'company_id'])->references(['country_id', 'id'])->on('buss_companies')->onDelete('cascade');
            $table->foreign(['country_id', 'company_id', 'category_id'])->references(['country_id', 'company_id', 'id'])->on('inve_categories')->onDelete('cascade');
            $table->foreign(['country_id', 'company_id', 'category_id', 'subcategory_id'], 'inve_products_has_inve_subcategories_foreign')->references(['country_id', 'company_id', 'category_id', 'id'])->on('inve_subcategories')->onDelete('cascade');
            $table->foreign(['unit_measurement_id'])->references(['id'])->on('buss_unit_measurements')->onDelete('cascade');
            $table->primary(['country_id', 'company_id', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inve_products');
    }
};
