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
        Schema::create('address', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->string('cep', 9);
            $table->string('street', 255);
            $table->string('complement', 150);
            $table->string('neighborhood', 255);
            $table->string('number', 15);
            $table->string('locality', 255);
            $table->string('uf', 2);
            $table->string('ibge', 20);
            $table->string('gia', 20);
            $table->string('ddd', 2);
            $table->string('siafi', 20);

            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
