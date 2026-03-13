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
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // infos personnelles
            $table->date('birth_date')->nullable();
            $table->string('phone')->nullable();

            // localisation
            $table->string('country')->nullable();
            $table->string('language')->nullable();
            $table->string('currency')->nullable();

            // adresse
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();

            // infos vendeur
            $table->string('iban')->nullable();
            $table->string('bic')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_infos');
    }
};
