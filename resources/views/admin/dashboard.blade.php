@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')
    <div class="text-lg font-bold mb-4">Bienvenue, {{ Auth::user()->name }}</div>
    <p class="text-gray-700">Ceci est votre tableau de bord administratif.</p>
@endsection
