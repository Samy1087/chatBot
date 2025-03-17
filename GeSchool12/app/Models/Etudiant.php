<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'date_naissance']; // Ajoute les champs que tu veux pour l'étudiant

    /**
     * Relation avec les notes (un étudiant peut avoir plusieurs notes).
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
