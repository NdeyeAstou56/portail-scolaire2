<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eleve;
use App\Models\Enseignant;
use App\Models\Classe;
use App\Models\Bulletin;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'totalEleves' => Eleve::count(),
            'totalEnseignants' => Enseignant::count(),
            'totalClasses' => Classe::count(),
            'totalBulletins' => Bulletin::count(),
        ]);
    }
}

