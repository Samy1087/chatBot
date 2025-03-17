@extends('layouts.app')

@section('content')
    <h2>Paiement en Espèces</h2>

    <form action="{{ route('paiement.especes') }}" method="POST">
        @csrf
        <label for="montant">Montant</label>
        <input type="number" name="montant" required>
        <button type="submit">Enregistrer le paiement</button>
    </form>
@endsection
