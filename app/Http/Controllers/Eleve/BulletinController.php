<?php

namespace App\Http\Controllers\Eleve;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bulletin; // Ton modèle Bulletin

class BulletinController extends Controller
{
    public function index()
    {
        $eleve = Auth::user();

        // Supposons que tu as une relation entre Eleve et Bulletins
        // Par exemple : $eleve->bulletins() retourne ses bulletins
        $bulletins = $eleve->bulletins()->orderBy('annee', 'desc')->orderBy('periode', 'desc')->get();

        return view('eleve.bulletins.index', compact('bulletins'));
    }

    public function download(Bulletin $bulletin)
    {
        $eleve = Auth::user();

        // Sécurité : vérifier que le bulletin appartient bien à l'élève
        if ($bulletin->eleve_id !== $eleve->id) {
            abort(403, 'Accès refusé');
        }

        // Chemin du fichier PDF
        $filePath = storage_path('app/bulletins/' . $bulletin->fichier_pdf);

        if (!file_exists($filePath)) {
            abort(404, 'Fichier introuvable');
        }

        return response()->download($filePath, "bulletin_{$bulletin->annee}_{$bulletin->periode}.pdf");
    }
}
