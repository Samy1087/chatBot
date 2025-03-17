<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matiere extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'enseignant_id'];

    /**
     * Relation avec l'enseignant (une matière appartient à un enseignant).
     */
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }
}