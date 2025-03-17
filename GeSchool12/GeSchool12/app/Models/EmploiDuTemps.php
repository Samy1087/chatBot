<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmploiDuTemps extends Model
{
    use HasFactory;

    protected $table = 'emplois_du_temps'; // Assure-toi que le nom est correct
    protected $fillable = ['matiere', 'jour', 'heure_debut', 'heure_fin', 'salle', 'etudiant_id'];

    // Relation avec l'étudiant
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }
}
