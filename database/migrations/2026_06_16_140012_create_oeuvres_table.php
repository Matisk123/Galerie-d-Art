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
        Schema::create('oeuvres', function (Blueprint $table) {

            $table->id();

            /*
             | Vendeur
             | Utilisateur qui a créé l'annonce.
             */
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
             | Informations de l'œuvre
             */
            $table->string('titre');

            $table->text('description')->nullable();

            /*
             | Artiste réel de l'œuvre.
             | Ce n'est PAS un utilisateur.
             */
            $table->string('artist_name');

            /*
             | Catégorie
             */
            $table->string('categorie');

            /*
             | Dimensions
             */
            $table->decimal('largeur', 8, 2)->nullable();

            $table->decimal('hauteur', 8, 2)->nullable();

            /*
             | Prix
             */
            $table->decimal('prix', 10, 2);

            /*
             | Image principale
             */
            $table->string('image')->nullable();

            /*
             | Publication
             */
            $table->boolean('is_published')
                ->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oeuvres');
    }
};
