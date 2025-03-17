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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade');  // Clé étrangère vers la table 'etudiants'
            $table->foreignId('matiere_id')->constrained('matieres')->onDelete('cascade');  // Clé étrangère vers la table 'matieres'
            $table->decimal('note', 5, 2);  // La note de l'étudiant pour cette matière
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
