<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['etudiant_id', 'matiere_id', 'note'];

    /**
     * Relation avec l'étudiant (une note appartient à un étudiant).
     */
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    /**
     * Relation avec la matière (une note est attribuée à une matière).
     */
    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }
}
