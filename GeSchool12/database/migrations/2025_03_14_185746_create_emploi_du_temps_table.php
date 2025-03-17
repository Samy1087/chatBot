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
        Schema::create('emplois_du_temps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classe_id')->constrained('classes')->onDelete('cascade'); // Lien avec l'étudiant
            $table->string('jour'); // Jour de la semaine (ex: Lundi)
            $table->time('heure_debut'); // Heure de début
            $table->time('heure_fin'); // Heure de fin
            $table->string('matiere'); // Matière du cours
            $table->string('salle'); // Salle où se déroule le cours
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emploi_du_temps');
    }
};
