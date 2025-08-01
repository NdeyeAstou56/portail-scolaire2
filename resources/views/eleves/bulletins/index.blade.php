@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mes Bulletins</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Année scolaire</th>
                <th>Periode</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($bulletins as $bulletin)
            <tr>
                <td>{{ $bulletin->annee_scolaire->libelle ?? 'N/A' }}</td>
                <td>{{ $bulletin->periode->nom ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('eleve.bulletins.show', $bulletin->id) }}" class="btn btn-primary btn-sm">Voir</a>
                    <a href="{{ route('eleve.bulletins.download', $bulletin->id) }}" class="btn btn-success btn-sm">Télécharger PDF</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
