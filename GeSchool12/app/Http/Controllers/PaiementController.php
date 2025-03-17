<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paiement;
use App\Models\ParentModel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PaiementController extends Controller
{ public function payerEspeces(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric|min:100',
        ]);

        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Vérifier si c'est un parent ou un étudiant
        if ($user->parent) {
            $payerId = $user->parent->id;
            $typePayer = 'parent';
        } elseif ($user->etudiant) {
            $payerId = $user->etudiant->id;
            $typePayer = 'etudiant';
        } else {
            return back()->withErrors(['error' => 'Seuls les parents ou les étudiants peuvent effectuer un paiement.']);
        }

        // Enregistrer le paiement
        Paiement::create([
            'payer_id' => $payerId,
            'payer_type' => $typePayer, // Pour savoir si c'est un parent ou un étudiant
            'montant' => $request->montant,
            'statut' => 'payé',
            'date_paiement' => Carbon::now(), // Remplit automatiquement la date
        ]);

        return back()->with('success', 'Paiement en espèces enregistré avec succès.');
    }
}