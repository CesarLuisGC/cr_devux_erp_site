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
        Schema::create('syst_menus', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name')->unique();
            $table->unsignedSmallInteger('module_id');
            $table->string('route');
            $table->string('icon');
            $table->smallInteger('parent');
            $table->smallInteger('order');
            $table->string('permission');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('module_id')->references('id')->on('syst_modules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syst_menus');
    }
};
