<?php

use Carbon\Carbon;
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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('payer_id'); // Peut être un parent ou un étudiant
            $table->enum('payer_type', ['parent', 'etudiant']); // Indique qui paie
            $table->decimal('montant', 10, 2);
            $table->enum('methode_paiement', ['especes'])->default('especes');
            $table->enum('statut', ['en attente', 'payé'])->default('en attente');
            $table->dateTime('date_paiement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
