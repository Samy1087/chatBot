<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'enseignant_id'];

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }
}
