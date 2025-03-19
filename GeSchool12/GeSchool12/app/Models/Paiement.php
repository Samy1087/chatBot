<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id', 'montant', 'methode_paiement', 'statut', 'date_paiement'];

    protected static function boot()
    {
        parent::boot();

        // Définir automatiquement la date du paiement lors de la création
        static::creating(function ($paiement) {
            if ($paiement->statut === 'payé') {
                $paiement->date_paiement = Carbon::now(); // Définit la date automatiquement
            }
        });
    }

    public function parent()
    {
        return $this->belongsTo(ParentModel::class, 'parent_id'); // Assure-toi que `ParentModel` est le bon nom
    }

}
