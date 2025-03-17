<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParentModel extends Model
{
    use HasFactory;

    protected $fillable =['name','user_id'];  // Ajoute 'user_id' ici

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function enfants()
    {
        return $this->hasMany(Etudiant::class, 'parent_id');
    }
    
}
