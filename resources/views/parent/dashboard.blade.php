@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="welcome-card">
                <div class="welcome-content">
                    <div class="welcome-text">
                        <h1 class="welcome-title">
                            <i class="fas fa-home me-3"></i>Bienvenue, {{ $parent->name }}
                        </h1>
                        <p class="welcome-subtitle">Tableau de bord du parent</p>
                        <div class="date-badge">
                            <i class="fas fa-calendar-alt me-2"></i>{{ date('d M Y') }}
                        </div>
                    </div>
                    <div class="welcome-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            @if(isset($message))
                <!-- Alert Message -->
                <div class="custom-alert">
                    <div class="alert-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="alert-content">
                        <h4>Information</h4>
                        <p>{{ $message }}</p>
                    </div>
                </div>
            @else
                <!-- Students Grid -->
                <div class="students-grid">
                    @foreach($eleves as $eleve)
                        <div class="student-card">
                            <!-- Student Header -->
                            <div class="student-header">
                                <div class="student-info">
                                    <div class="student-avatar">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="student-details">
                                        <h3 class="student-name">{{ $eleve->nom }} {{ $eleve->prenom }}</h3>
                                        <p class="student-class">
                                            <i class="fas fa-school me-2"></i>
                                            Classe : {{ $eleve->classe->nom ?? 'Non définie' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="student-status">
                                    <span class="status-badge active">
                                        <i class="fas fa-circle me-1"></i>Actif
                                    </span>
                                </div>
                            </div>

                            <!-- Student Body -->
                            <div class="student-body">
                                <!-- Grades Section -->
                                <div class="section grades-section">
                                    <div class="section-header">
                                        <h4 class="section-title">
                                            <i class="fas fa-chart-line me-2"></i>Notes récentes
                                        </h4>
                                        <span class="section-badge">{{ $eleve->notes->count() }} notes</span>
                                    </div>

                                    @if($eleve->notes->isEmpty())
                                        <div class="empty-state">
                                            <div class="empty-icon">
                                                <i class="fas fa-clipboard-list"></i>
                                            </div>
                                            <p class="empty-text">Aucune note disponible</p>
                                        </div>
                                    @else
                                        <div class="grades-list">
                                            @foreach($eleve->notes->take(5) as $note)
                                                <div class="grade-item">
                                                    <div class="grade-subject">
                                                        <i class="fas fa-book me-2"></i>
                                                        {{ $note->matiere->nom ?? 'Matière inconnue' }}
                                                    </div>
                                                    <div class="grade-score grade-{{ $note->note >= 16 ? 'excellent' : ($note->note >= 14 ? 'good' : ($note->note >= 10 ? 'average' : 'poor')) }}">
                                                        {{ $note->note }}/20
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="average-card">
                                            <div class="average-label">Moyenne générale</div>
                                            <div class="average-value">{{ number_format($eleve->notes->avg('note'), 2) }}/20</div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Bulletins Section -->
                                <div class="section bulletins-section">
                                    <div class="section-header">
                                        <h4 class="section-title">
                                            <i class="fas fa-file-alt me-2"></i>Bulletins
                                        </h4>
                                        <span class="section-badge">{{ $eleve->bulletins->count() }} bulletins</span>
                                    </div>

                                    @if($eleve->bulletins->isEmpty())
                                        <div class="empty-state">
                                            <div class="empty-icon">
                                                <i class="fas fa-file-invoice"></i>
                                            </div>
                                            <p class="empty-text">Aucun bulletin disponible</p>
                                        </div>
                                    @else
                                        <div class="bulletins-table">
                                            <div class="table-header">
                                                <div class="header-cell">Année scolaire</div>
                                                <div class="header-cell">Période</div>
                                                <div class="header-cell">Actions</div>
                                            </div>
                                            @foreach($eleve->bulletins as $bulletin)
                                                <div class="table-row">
                                                    <div class="table-cell">
                                                        <i class="fas fa-calendar me-2"></i>
                                                        {{ $bulletin->annee_scolaire->libelle ?? '-' }}
                                                    </div>
                                                    <div class="table-cell">
                                                        <span class="period-badge">
                                                            {{ $bulletin->periode->nom ?? '-' }}
                                                        </span>
                                                    </div>
                                                    <div class="table-cell">
                                                        <a href="{{ route('bulletins.show', $bulletin->id) }}" class="btn-view">
                                                            <i class="fas fa-eye me-1"></i>Voir le bulletin
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Global Styles */
:root {
    --primary-color: #6366f1;
    --primary-dark: #4f46e5;
    --primary-light: #a5b4fc;
    --secondary-color: #f1f5f9;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --info-color: #3b82f6;
    --gray-50: #f8fafc;
    --gray-100: #f1f5f9;
    --gray-200: #e2e8f0;
    --gray-300: #cbd5e1;
    --gray-400: #94a3b8;
    --gray-500: #64748b;
    --gray-600: #475569;
    --gray-700: #334155;
    --gray-800: #1e293b;
    --gray-900: #0f172a;
    --white: #ffffff;
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
    --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
    --border-radius: 16px;
    --border-radius-lg: 20px;
}

* {
    box-sizing: border-box;
}

body {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
    margin: 0;
    padding: 0;
    min-height: 100vh;
}

.dashboard-container {
    min-height: 100vh;
    padding-bottom: 2rem;
}

/* Hero Section */
.hero-section {
    padding: 2rem 0 1rem;
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
}

.welcome-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: var(--border-radius-lg);
    padding: 2rem;
    box-shadow: var(--shadow-xl);
    border: 1px solid rgba(255, 255, 255, 0.2);
    margin-bottom: 1rem;
}

.welcome-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

.welcome-title {
    color: var(--gray-800);
    font-size: 2rem;
    font-weight: 700;
    margin: 0 0 0.5rem 0;
    display: flex;
    align-items: center;
}

.welcome-subtitle {
    color: var(--gray-600);
    font-size: 1.125rem;
    margin: 0 0 1rem 0;
}

.date-badge {
    display: inline-flex;
    align-items: center;
    background: var(--primary-color);
    color: var(--white);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.875rem;
    font-weight: 500;
}

.welcome-icon {
    font-size: 4rem;
    color: var(--primary-color);
    opacity: 0.8;
}

/* Main Content */
.main-content {
    padding: 1rem 0;
}

/* Custom Alert */
.custom-alert {
    background: linear-gradient(135deg, #fef3c7, #fed7aa);
    border-radius: var(--border-radius);
    padding: 1.5rem;
    margin-bottom: 2rem;
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    border-left: 4px solid var(--warning-color);
    box-shadow: var(--shadow-md);
}

.alert-icon {
    font-size: 1.5rem;
    color: var(--warning-color);
    margin-top: 0.25rem;
}

.alert-content h4 {
    color: var(--gray-800);
    margin: 0 0 0.5rem 0;
    font-weight: 600;
}

.alert-content p {
    color: var(--gray-700);
    margin: 0;
}

/* Students Grid */
.students-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(600px, 1fr));
    gap: 2rem;
}

@media (max-width: 768px) {
    .students-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
}

/* Student Card */
.student-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-xl);
    border: 1px solid rgba(255, 255, 255, 0.2);
    overflow: hidden;
    transition: all 0.3s ease;
}

.student-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

/* Student Header */
.student-header {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    color: var(--white);
    padding: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.student-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.student-avatar {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    backdrop-filter: blur(10px);
}

.student-name {
    margin: 0 0 0.25rem 0;
    font-size: 1.25rem;
    font-weight: 600;
}

.student-class {
    margin: 0;
    opacity: 0.9;
    font-size: 0.9rem;
}

.status-badge {
    background: rgba(16, 185, 129, 0.2);
    color: #10b981;
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 500;
    display: flex;
    align-items: center;
}

/* Student Body */
.student-body {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

/* Section */
.section {
    background: var(--gray-50);
    border-radius: var(--border-radius);
    padding: 1.5rem;
    border: 1px solid var(--gray-200);
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.section-title {
    color: var(--gray-700);
    font-size: 1.125rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
}

.section-badge {
    background: var(--primary-color);
    color: var(--white);
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 500;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 2rem 1rem;
    color: var(--gray-500);
}

.empty-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

.empty-text {
    margin: 0;
    font-size: 1rem;
}

/* Grades */
.grades-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.grade-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    background: var(--white);
    border-radius: 12px;
    border: 1px solid var(--gray-200);
    transition: all 0.2s ease;
}

.grade-item:hover {
    transform: translateX(5px);
    box-shadow: var(--shadow-md);
}

.grade-subject {
    color: var(--gray-700);
    font-weight: 500;
    display: flex;
    align-items: center;
}

.grade-score {
    font-weight: 700;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.9rem;
    min-width: 70px;
    text-align: center;
}

.grade-excellent {
    background: #dcfce7;
    color: #166534;
}

.grade-good {
    background: #dbeafe;
    color: #1e40af;
}

.grade-average {
    background: #fef3c7;
    color: #92400e;
}

.grade-poor {
    background: #fee2e2;
    color: #991b1b;
}

/* Average Card */
.average-card {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: var(--white);
    padding: 1rem 1.5rem;
    border-radius: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.average-label {
    font-weight: 500;
}

.average-value {
    font-size: 1.5rem;
    font-weight: 700;
}

/* Bulletins Table */
.bulletins-table {
    background: var(--white);
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid var(--gray-200);
}

.table-header {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    background: var(--gray-100);
    padding: 0.75rem 1rem;
    font-weight: 600;
    color: var(--gray-700);
    font-size: 0.875rem;
}

.table-row {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    padding: 1rem;
    border-top: 1px solid var(--gray-200);
    align-items: center;
    transition: background-color 0.2s ease;
}

.table-row:hover {
    background: var(--gray-50);
}

.table-cell {
    display: flex;
    align-items: center;
}

.period-badge {
    background: var(--info-color);
    color: var(--white);
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 500;
}

.btn-view {
    background: var(--primary-color);
    color: var(--white);
    padding: 0.5rem 1rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
}

.btn-view:hover {
    background: var(--primary-dark);
    color: var(--white);
    text-decoration: none;
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-section {
        padding: 1rem 0;
    }
    
    .welcome-card {
        padding: 1.5rem;
        margin: 1rem;
    }
    
    .welcome-content {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .welcome-title {
        font-size: 1.5rem;
    }
    
    .main-content {
        padding: 0.5rem 0;
    }
    
    .container {
        padding: 0 1rem;
    }
    
    .students-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .student-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .student-body {
        padding: 1rem;
    }
    
    .table-header,
    .table-row {
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }
    
    .table-row {
        padding: 1rem;
    }
    
    .header-cell {
        display: none;
    }
    
    .table-cell {
        padding: 0.25rem 0;
        justify-content: space-between;
    }
    
    .table-cell:before {
        content: attr(data-label);
        font-weight: 600;
        color: var(--gray-600);
        margin-right: 1rem;
    }
}

/* Animations */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.student-card {
    animation: slideIn 0.6s ease-out;
}

.student-card:nth-child(2) {
    animation-delay: 0.1s;
}

.student-card:nth-child(3) {
    animation-delay: 0.2s;
}

.student-card:nth-child(4) {
    animation-delay: 0.3s;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.5);
}
</style>

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection