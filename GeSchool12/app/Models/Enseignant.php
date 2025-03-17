<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enseignant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email']; // Ajoute les champs de l'enseignant

    /**
     * Relation avec les matières (un enseignant enseigne plusieurs matières).
     */
    public function matieres()
    {
        return $this->hasMany(Matiere::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
