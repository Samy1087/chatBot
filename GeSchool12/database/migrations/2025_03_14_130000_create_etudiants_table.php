<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("email");
            // Déclaration de la clé étrangère user_id avec le type unsignedBigInteger
            //$table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('classe_id')->nullable();  // Le type de classe_id doit être unsignedBigInteger
            $table->timestamps();

            // Définition de la contrainte de clé étrangère pour user_id
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Définition de la contrainte de clé étrangère pour classe_id
            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
