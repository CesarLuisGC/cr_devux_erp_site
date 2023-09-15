<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('syst_log', function (Blueprint $table) {
            $table->unsignedSmallInteger('country_id');
            $table->unsignedSmallInteger('company_id');
            $table->unsignedSmallInteger('module_id');
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('type_log_id');
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('route', 100)->nullable();
            $table->string('process');
            $table->text('message');
            $table->timestamps();
            $table->foreign(['country_id', 'company_id'])->references(['country_id', 'id'])->on('buss_companies')->onDelete('cascade');
            $table->foreign(['module_id'])->references(['id'])->on('syst_modules')->onDelete('cascade');
            $table->foreign(['user_id'], 'syst_log_has_users_foreign')->references(['id'])->on('users')->onDelete('cascade');
            $table->foreign(['type_log_id'])->references(['id'])->on('syst_type_log')->onDelete('cascade');
            $table->primary(['country_id', 'company_id', 'module_id', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syst_log');
    }
};
