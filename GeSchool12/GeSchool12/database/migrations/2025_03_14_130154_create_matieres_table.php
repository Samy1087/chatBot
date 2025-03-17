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
        Schema::create('matieres', function (Blueprint $table) {
            $table->id();  // Création d'un identifiant unique pour chaque matière
            $table->string('name');  // Le nom de la matière
            $table->text('description')->nullable();  // Une description facultative de la matière
            //$table->foreignId('enseignant_id')->constrained('enseignants')->onDelete('cascade');  // Ajout de la clé étrangère vers la table 'enseignants'
            $table->timestamps();  // Ajout des colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matieres');
    }
};
