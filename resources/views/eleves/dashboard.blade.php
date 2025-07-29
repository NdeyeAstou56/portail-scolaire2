<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Portail Élève</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #2d3748;
        }

        /* Header moderne avec glassmorphism */
        header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        header h1 {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(45deg, #ffffff, #e2e8f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(45deg, #4f46e5, #7c3aed);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        .logout-btn {
            background: rgba(239, 68, 68, 0.9);
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .logout-btn:hover {
            background: rgba(220, 38, 38, 1);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
        }

        /* Container principal */
        main {
            padding: 40px 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Grille responsive */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        /* Cards modernes avec glassmorphism */
        .card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 30px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .card h2 {
            color: white;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        /* Statistiques */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 25px 20px;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .stat-value {
            font-size: 32px;
            font-weight: 800;
            color: white;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Tableau moderne */
        .table-container {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            overflow: hidden;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 20px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.9);
            transition: background 0.3s ease;
        }

        tr:hover td {
            background: rgba(255, 255, 255, 0.05);
        }

        tr:last-child td {
            border-bottom: none;
        }

        /* Liste des bulletins */
        .bulletin-list {
            list-style: none;
            margin-top: 20px;
        }

        .bulletin-item {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .bulletin-item:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
        }

        .bulletin-info {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        .download-link {
            background: linear-gradient(45deg, #4f46e5, #7c3aed);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
        }

        .download-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(79, 70, 229, 0.4);
        }

        /* Info générales */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .info-item {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .info-label {
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            color: white;
            font-size: 18px;
            font-weight: 600;
        }

        /* Messages d'état */
        .empty-state {
            text-align: center;
            padding: 40px;
            color: rgba(255, 255, 255, 0.7);
            font-style: italic;
        }

        .empty-state::before {
            content: '📋';
            display: block;
            font-size: 48px;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        /* Responsive */
        @media (max-width: 768px) {
            header {
                padding: 15px 20px;
                flex-direction: column;
                gap: 15px;
            }

            header h1 {
                font-size: 24px;
            }

            main {
                padding: 20px 15px;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .card {
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            }

            .bulletin-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Animations d'entrée */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeInUp 0.6s ease forwards;
        }

        .card:nth-child(2) { animation-delay: 0.1s; }
        .card:nth-child(3) { animation-delay: 0.2s; }
        .card:nth-child(4) { animation-delay: 0.3s; }
    </style>
</head>
<body>

<header>
    <h1>Portail Élève</h1>
    <div class="user-info">
        <div class="avatar">{{ Auth::user()->name[0] ?? 'U' }}</div>
        <span>{{ Auth::user()->name ?? 'Utilisateur' }}</span>
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">Déconnexion</button>
        </form>
    </div>
</header>

<main>
    <div class="dashboard-grid">
        {{-- Statistiques --}}
        <div class="card full-width">
            <h2>
                <div class="card-icon" style="background: linear-gradient(45deg, #10b981, #34d399);">📊</div>
                Statistiques générales
            </h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value">{{ $recentNotes->count() ?? '0' }}</div>
                    <div class="stat-label">Notes reçues</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">
                         {{ $moyenne !== null ? number_format($moyenne, 1) : 'N/A' }}/20
                    </div>
                    <div class="stat-label">Moyenne générale</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">
                        {{ $recentNotes && $recentNotes->count() > 0 ? number_format($recentNotes->max('note'), 1) : 'N/A' }}/20
                    </div>
                    <div class="stat-label">Meilleure note</div>
                </div>
            </div>
        </div>

        {{-- Notes récentes --}}
        <div class="card">
            <h2>
                <div class="card-icon" style="background: linear-gradient(45deg, #3b82f6, #60a5fa);">📝</div>
                Notes récentes
            </h2>
            @if(isset($recentNotes) && !$recentNotes->isEmpty())
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Matière</th>
                                <th>Note</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($recentNotes as $note)
                            <tr>
                                <td>{{ $note->matiere->nom ?? 'Matière' }}</td>
                                <td><strong>{{ $note->note ?? '0' }}/20</strong></td>
                                <td>{{ optional($note->date_evaluation)->format('d/m/Y') ?? ($note->created_at ? $note->created_at->format('d/m/Y') : 'N/A') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    Aucune note disponible pour le moment.
                </div>
            @endif
        </div>

        {{-- Bulletins --}}
        <div class="card">
            <h2>
                <div class="card-icon" style="background: linear-gradient(45deg, #f59e0b, #fbbf24);">📄</div>
                Bulletins disponibles
            </h2>
            @if(isset($bulletins) && !$bulletins->isEmpty())
                <ul class="bulletin-list">
                @foreach($bulletins as $bulletin)
                    <li class="bulletin-item">
                        <div class="bulletin-info">
                            <strong>{{ $bulletin->annee_scolaire->nom ?? 'Année scolaire' }}</strong><br>
                            <small>{{ $bulletin->periode->nom ?? 'Période' }}</small>
                        </div>
                        <a href="{{ route('bulletins.download', $bulletin->id) }}" class="download-link" target="_blank">
                            📥 Télécharger
                        </a>
                    </li>
                @endforeach
                </ul>
            @else
                <div class="empty-state">
                    Aucun bulletin disponible pour le moment.
                </div>
            @endif
        </div>

        {{-- Infos générales --}}
        <div class="card full-width">
            <h2>
                <div class="card-icon" style="background: linear-gradient(45deg, #8b5cf6, #a78bfa);">ℹ️</div>
                Informations générales
            </h2>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Prochain cours</div>
                    <div class="info-value">{{ $nextCourse ?? 'Non disponible' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Année scolaire</div>
                    <div class="info-value">{{ $currentYear ?? 'Non renseignée' }}</div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>