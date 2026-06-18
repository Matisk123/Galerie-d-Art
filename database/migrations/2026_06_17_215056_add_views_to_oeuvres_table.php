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
        Schema::table('oeuvres', function (Blueprint $table) {

            if (!Schema::hasColumn('oeuvres', 'total_views')) {
                $table->unsignedBigInteger('total_views')->default(0);
            }

            if (!Schema::hasColumn('oeuvres', 'unique_views')) {
                $table->unsignedBigInteger('unique_views')->default(0);
            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('oeuvres', function (Blueprint $table) {
            //
        });
    }
};
