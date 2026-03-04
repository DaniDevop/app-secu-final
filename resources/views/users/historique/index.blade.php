<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
<title>Historique des Stages - ASP</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- FontAwesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<!-- SweetAlert2 -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<!-- PDF Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>

<style>
:root {
    --primary: #0B3D2E;
    --primary-light: #1F6F5C;
    --gold: #D4AF37;
    --bg: #F1F4F8;
    --sidebar-width: 260px;
    --sidebar-width-mobile: 70px;
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    background: var(--bg);
    font-family: 'Segoe UI', sans-serif;
    padding-left: var(--sidebar-width);
    transition: padding-left 0.3s ease;
    min-height: 100vh;
    overflow-x: hidden;
}

/* ================== SIDEBAR ================== */
.sidebar {
    width: var(--sidebar-width);
    background: linear-gradient(180deg, #081C15, #1B4332);
    color: white;
    padding: 30px 20px;
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    z-index: 1000;
    transition: transform 0.3s ease;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.logo { text-align: center; margin-bottom: 40px; }
.logo h2 { color: var(--gold); font-size: 18px; letter-spacing: 2px; }

.menu { list-style: none; padding: 0; }
.menu li { margin: 8px 0; }
.menu a {
    text-decoration: none;
    color: white;
    padding: 12px 15px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s;
}
.menu a:hover, .menu a.active { background: #2D6A4F; transform: translateX(5px); }

.sidebar-footer { font-size: 12px; text-align: center; opacity: .7; margin-top: 20px; }

/* Menu toggle mobile */
.menu-toggle {
    display: none;
    position: fixed;
    top: 15px;
    left: 15px;
    z-index: 1001;
    background: var(--primary);
    color: white;
    border: none;
    border-radius: 50%;
    width: 45px;
    height: 45px;
    font-size: 20px;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    align-items: center;
    justify-content: center;
}

/* ================== MAIN CONTENT ================== */
.main-content { 
    padding: 20px; 
    transition: all 0.3s ease; 
    width: 100%;
    min-height: 100vh;
}

/* ================== HEADER ================== */
.main-header {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: white;
    padding: 20px;
    border-radius: 15px;
    margin-bottom: 20px;
}

.main-header h1 { 
    font-size: 22px; 
    font-weight: 600; 
    display: flex; 
    align-items: center; 
    gap: 10px; 
    margin: 0 0 15px 0;
}
.main-header p { 
    margin: 0; 
    opacity: .8; 
    font-size: 14px;
}

/* ================== SEARCH BOX ================== */
.search-box { 
    position: relative; 
    width: 100%;
    margin-top: 15px;
}
.search-box i {
    position: absolute; 
    top: 50%; 
    left: 15px;
    transform: translateY(-50%);
    color: #aaa;
    z-index: 1;
}
.search-box input {
    padding: 12px 15px 12px 40px;
    border-radius: 30px;
    border: 1px solid rgba(255,255,255,0.2);
    width: 100%;
    background: rgba(255,255,255,0.15);
    color: white;
    transition: all 0.3s;
    font-size: 15px;
}
.search-box input::placeholder { color: rgba(255,255,255,0.7); }
.search-box input:focus {
    background: rgba(255,255,255,0.25);
    outline: none;
    border-color: white;
}

/* ================== BUTTONS ================== */
.action-container {
    margin-bottom: 20px;
}

.btn-pdf {
    background: #dc3545;
    color: white;
    border-radius: 30px;
    padding: 12px 20px;
    font-weight: 600;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.3s;
}
.btn-pdf:hover {
    background: #c82333;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
}

.btn-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    background: white;
    color: var(--primary);
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    cursor: pointer;
    transition: all 0.3s;
}
.btn-icon:hover {
    background: var(--primary);
    color: white;
    transform: translateY(-2px);
}

/* ================== CARTES (mobile) ================== */
.history-cards {
    display: none;
    flex-direction: column;
    gap: 15px;
}

.history-card {
    background: white;
    border-radius: 15px;
    padding: 15px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    border-left: 4px solid var(--primary);
    transition: all 0.3s;
}
.history-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    padding-bottom: 10px;
    border-bottom: 1px solid #eee;
}

.card-agent {
    display: flex;
    align-items: center;
    gap: 10px;
}

.card-agent .avatar-circle {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: #f0f2f5;
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 16px;
}

.card-agent-info h4 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    color: #333;
}
.card-agent-info .matricule {
    font-size: 13px;
    color: #666;
    display: flex;
    align-items: center;
    gap: 5px;
    margin-top: 3px;
}

.card-badges {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 5px;
}

.card-badge {
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}
.card-badge.ecole {
    background: #e7f3ff;
    color: #0066cc;
}
.card-badge.date {
    background: #fff3cd;
    color: #856404;
}

.card-body {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 15px;
}

.card-info-item {
    flex: 1 1 calc(50% - 5px);
    background: #f8f9fa;
    padding: 8px 10px;
    border-radius: 10px;
    font-size: 13px;
}
.card-info-item .label {
    color: #666;
    font-size: 11px;
    margin-bottom: 2px;
}
.card-info-item .value {
    font-weight: 600;
    color: #333;
}
.card-info-item .value i { margin-right: 5px; }

.card-footer {
    display: flex;
    justify-content: flex-end;
    gap: 8px;
    padding-top: 10px;
    border-top: 1px solid #eee;
}

/* ================== TABLEAU (desktop) ================== */
.table-container {
    background: white;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    overflow-x: auto;
    display: block;
}

.table {
    width: 100%;
    min-width: 700px;
    margin-bottom: 0;
}

.table th {
    background: #f8f9fa;
    font-weight: 600;
    color: var(--primary);
    padding: 15px 12px;
    font-size: 14px;
    white-space: nowrap;
}
.table td { 
    vertical-align: middle; 
    padding: 12px;
    font-size: 13px;
}

/* ================== AVATAR ================== */
.avatar-circle {
    width: 35px; 
    height: 35px;
    border-radius: 50%;
    background: #f0f2f5;
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.initials { font-size: 14px; font-weight: bold; color: #0d6efd; }
tr:hover .avatar-circle { background: var(--primary); color: white; }
tr:hover .initials { color: white; }

/* ================== BADGES ================== */
.badge {
    font-size: 12px;
    padding: 5px 10px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}
.badge i { font-size: 11px; }

/* ================== EMPTY STATE ================== */
.empty-state {
    padding: 40px 20px;
    background: #f8f9fa;
    border-radius: 10px;
    text-align: center;
}
.empty-state i { font-size: 48px; color: #adb5bd; margin-bottom: 15px; }
.empty-state h5 { color: #495057; margin-bottom: 10px; }
.empty-state p { color: #6c757d; margin-bottom: 20px; }

/* ================== LOADING ================== */
.loading-spinner {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 3px solid rgba(255,255,255,.3);
    border-radius: 50%;
    border-top-color: white;
    animation: spin 1s ease-in-out infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }

/* ================== RESPONSIVE BREAKPOINTS ================== */

/* Tablettes (768px - 991px) */
@media screen and (max-width: 991px) {
    body { padding-left: var(--sidebar-width-mobile); }
    
    .sidebar {
        width: var(--sidebar-width-mobile);
        padding: 20px 10px;
    }
    
    .sidebar .menu a span { display: none; }
    .sidebar .menu a { justify-content: center; padding: 12px; }
    .sidebar .menu a i { font-size: 20px; margin: 0; }
    .sidebar-footer { 
        font-size: 10px; 
        writing-mode: vertical-rl; 
        transform: rotate(180deg);
        white-space: nowrap;
        align-self: center;
    }
    
    .main-header h1 { font-size: 20px; }
    
    /* Adaptation du tableau pour tablette */
    .table { min-width: 600px; }
    .table th, .table td { 
        padding: 10px 8px;
        font-size: 12px;
    }
}

/* Mobiles (< 768px) */
@media screen and (max-width: 767px) {
    .menu-toggle { display: flex; }
    
    body { padding-left: 0; }
    
    .sidebar {
        transform: translateX(-100%);
        width: 260px;
        padding: 30px 20px;
        box-shadow: none;
    }
    
    .sidebar.active { 
        transform: translateX(0);
        box-shadow: 5px 0 30px rgba(0,0,0,0.2);
    }
    
    .sidebar .menu a span { display: inline; }
    .sidebar .menu a { justify-content: flex-start; }
    .sidebar-footer { writing-mode: horizontal-tb; transform: none; }
    
    .main-header { margin-top: 50px; }
    
    /* Cacher le tableau, afficher les cartes */
    .table-container { display: none; }
    .history-cards { display: flex; }
    
    .btn-pdf { width: 100%; }
    
    .action-container {
        display: flex;
        gap: 10px;
    }
    
    .action-container .btn-pdf {
        flex: 1;
    }
}

/* Petits mobiles (< 480px) */
@media screen and (max-width: 479px) {
    .main-content { padding: 15px 10px; }
    .main-header { padding: 15px; }
    .main-header h1 { font-size: 18px; }
    
    .history-card { padding: 12px; }
    .card-agent .avatar-circle { width: 40px; height: 40px; font-size: 14px; }
    .card-agent-info h4 { font-size: 15px; }
    .card-info-item { flex: 1 1 100%; }
    .card-footer .btn-icon { width: 40px; height: 40px; }
}

/* Très grands écrans */
@media screen and (min-width: 1400px) {
    .main-content { 
        max-width: 1600px; 
        margin: 0 auto;
        padding: 30px 40px;
    }
}

/* Optimisation tactile */
@media (hover: none) and (pointer: coarse) {
    .btn-icon, .menu a, .btn-pdf {
        min-height: 44px;
    }
    
    .history-card {
        cursor: pointer;
    }
}
</style>
</head>
<body>

<!-- Menu toggle mobile -->
<button class="menu-toggle" id="menuToggle">
    <i class="fas fa-bars"></i>
</button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div>
        <div class="logo"><h2>SÉCURITÉ<br>PÉNITENTIAIRE</h2></div>
        <ul class="menu">
            <li><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i><span> Accueil</span></a></li>
            <li><a href="{{route('users.agent.index')}}"><i class="fas fa-user-shield"></i><span> Agents</span></a></li>
            <li><a href="{{route('admin.ecole.index')}}"><i class="fas fa-university"></i><span> Écoles</span></a></li>
            <li><a href="{{route('admin.service.index')}}"><i class="fas fa-briefcase"></i><span> Services</span></a></li>
            <li><a href="{{route('admin.listes.Admin')}}"><i class="fas fa-users-cog"></i><span> Administrations</span></a></li>
            <li><a href="{{route('users.affectation.agent')}}"><i class="fas fa-exchange-alt"></i><span> Stages</span></a></li>
            <li>
                <a href="{{route('users.historique.agent.stage')}}" class="active">
                    <i class="fas fa-history"></i><span> Historique</span>
                </a>
            </li>
            <li class="nav-item mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link text-start w-100" style="color: white; padding: 12px 15px;">
                        <i class="fas fa-sign-out-alt me-2"></i><span> Déconnexion</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
    <div class="sidebar-footer">Application interne sécurisée</div>
</div>

<!-- Main Content -->
<div class="main-content">
    <header class="main-header">
        <h1><i class="fas fa-history"></i> Historique des Stages</h1>
        <p>Consultez l'historique des stages terminés</p>
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Rechercher un agent, une école...">
        </div>
    </header>

    <div class="action-container">
        <button class="btn-pdf" onclick="generateHistoriquePDF()">
            <i class="fas fa-file-pdf me-2"></i>Exporter en PDF
        </button>
    </div>

    <!-- VERSION CARTES (mobile) -->
    <div class="history-cards" id="historyCards">
        @forelse($historiques as $hist)
        <div class="history-card" data-search="{{ strtolower($hist->agent_nom ?? '') }} {{ strtolower($hist->agent_prenom ?? '') }} {{ strtolower($hist->ecole_nom ?? '') }} {{ $hist->agent_matricule ?? '' }}">
            <div class="card-header">
                <div class="card-agent">
                    <div class="avatar-circle">
                        {{ substr($hist->agent_prenom ?? '', 0, 1) }}{{ substr($hist->agent_nom ?? '', 0, 1) }}
                    </div>
                    <div class="card-agent-info">
                        <h4>{{ $hist->agent_nom ?? '' }} {{ $hist->agent_prenom ?? '' }}</h4>
                        <div class="matricule">
                            <i class="fas fa-id-card"></i>
                            {{ $hist->agent_matricule ?? 'N/A' }}
                        </div>
                    </div>
                </div>
                <div class="card-badges">
                    @if($hist->mention)
                    <span class="card-badge" style="background: 
                        @if(str_contains(strtolower($hist->mention), 'très')) #d4edda; color:#155724
                        @elseif(str_contains(strtolower($hist->mention), 'bien')) #cce5ff; color:#004085
                        @elseif(str_contains(strtolower($hist->mention), 'assez')) #d1ecf1; color:#0c5460
                        @elseif(str_contains(strtolower($hist->mention), 'passable')) #fff3cd; color:#856404
                        @elseif(str_contains(strtolower($hist->mention), 'insuffisant')) #f8d7da; color:#721c24
                        @else #e2e3e5; color:#383d41
                        @endif">
                        <i class="fas fa-award"></i> {{ $hist->mention }}
                    </span>
                    @endif
                </div>
            </div>

            <div class="card-body">
                <div class="card-info-item">
                    <div class="label">Établissement</div>
                    <div class="value"><i class="fas fa-university"></i> {{ $hist->ecole_nom ?? 'Non assigné' }}</div>
                </div>
                <div class="card-info-item">
                    <div class="label">Date de fin</div>
                    <div class="value">
                        <i class="far fa-calendar-alt"></i> 
                        @if($hist->date_de_fin)
                            {{ \Carbon\Carbon::parse($hist->date_de_fin)->format('d/m/Y') }}
                        @else
                            En cours
                        @endif
                    </div>
                </div>
                @if(isset($hist->moyenne) && $hist->moyenne)
                <div class="card-info-item">
                    <div class="label">Moyenne</div>
                    <div class="value">
                        <i class="fas fa-star"></i> 
                        <span style="color: 
                            @if($hist->moyenne >= 16) #28a745
                            @elseif($hist->moyenne >= 12) #17a2b8
                            @elseif($hist->moyenne >= 10) #ffc107
                            @else #dc3545
                            @endif">
                            {{ number_format($hist->moyenne, 2) }}/20
                        </span>
                    </div>
                </div>
                @endif
                @if(isset($hist->agent_grade))
                <div class="card-info-item">
                    <div class="label">Grade</div>
                    <div class="value"><i class="fas fa-star"></i> {{ $hist->agent_grade }}</div>
                </div>
                @endif
            </div>

            <div class="card-footer">
                <button class="btn-icon" title="Voir détails" onclick="viewDetails({{ $hist->id ?? 0 }})">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="btn-icon" title="Modifier" onclick="editHistorique({{ $hist->id ?? 0 }})">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn-icon" title="PDF" onclick="generateSinglePDF({{ $hist->id ?? 0 }})">
                    <i class="fas fa-file-pdf"></i>
                </button>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <i class="fas fa-history"></i>
            <h5>Aucun historique disponible</h5>
            <p>Les stages terminés apparaîtront ici</p>
            <button class="btn btn-primary" onclick="window.location.href='{{ route('users.affectation.agent') }}'">
                <i class="fas fa-plus-circle me-2"></i>Nouvelle affectation
            </button>
        </div>
        @endforelse
    </div>

    <!-- VERSION TABLEAU (desktop) -->
    <div class="table-container">
        <table id="historiqueTable" class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Matricule</th>
                    <th>Agent</th>
                    <th>Établissement</th>
                    <th>Date de fin</th>
                    <th>Moyenne</th>
                    <th>Mention</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($historiques as $hist)
                <tr>
                    <td>{{ $hist->agent_matricule ?? 'N/A' }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar-circle">
                                {{ substr($hist->agent_prenom ?? '', 0, 1) }}{{ substr($hist->agent_nom ?? '', 0, 1) }}
                            </div>
                            <div>
                                <strong>{{ $hist->agent_nom ?? '' }} {{ $hist->agent_prenom ?? '' }}</strong>
                                @if(isset($hist->agent_grade))
                                <br><small>{{ $hist->agent_grade }}</small>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>{{ $hist->ecole_nom ?? 'Non assigné' }}</td>
                    <td>
                        @if($hist->date_de_fin)
                        <span class="badge bg-info bg-opacity-10">
                            {{ \Carbon\Carbon::parse($hist->date_de_fin)->format('d/m/Y') }}
                        </span>
                        @else
                        <span class="badge bg-warning">En cours</span>
                        @endif
                    </td>
                    <td>
                        @if(isset($hist->moyenne) && $hist->moyenne)
                        @php
                            $moyenneClass = $hist->moyenne >= 16 ? 'success' : ($hist->moyenne >= 12 ? 'info' : ($hist->moyenne >= 10 ? 'warning' : 'danger'));
                        @endphp
                        <span class="badge bg-{{ $moyenneClass }}">
                            {{ number_format($hist->moyenne, 2) }}/20
                        </span>
                        @else
                        -
                        @endif
                    </td>
                    <td>
                        @if($hist->mention)
                        @php
                            $mentionClass = match(true) {
                                str_contains(strtolower($hist->mention), 'très') => 'success',
                                str_contains(strtolower($hist->mention), 'bien') => 'primary',
                                str_contains(strtolower($hist->mention), 'assez') => 'info',
                                str_contains(strtolower($hist->mention), 'passable') => 'warning',
                                str_contains(strtolower($hist->mention), 'insuffisant') => 'danger',
                                default => 'secondary'
                            };
                        @endphp
                        <span class="badge bg-{{ $mentionClass }}">
                            <i class="fas fa-award me-1"></i>{{ $hist->mention }}
                        </span>
                        @else
                        -
                        @endif
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-outline-primary" title="Voir" onclick="viewDetails({{ $hist->id ?? 0 }})">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-outline-warning" title="Modifier" onclick="editHistorique({{ $hist->id ?? 0 }})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-outline-danger" title="PDF" onclick="generateSinglePDF({{ $hist->id ?? 0 }})">
                                <i class="fas fa-file-pdf"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-history fa-3x text-muted mb-3"></i>
                            <h5>Aucun historique disponible</h5>
                            <p class="text-muted">Les stages terminés apparaîtront ici</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Menu toggle mobile
    $('#menuToggle').on('click', function(e) {
        e.stopPropagation();
        $('#sidebar').toggleClass('active');
        $(this).find('i').toggleClass('fa-bars fa-times');
    });

    // Fermer sidebar en cliquant à l'extérieur
    $(document).on('click', function(e) {
        if ($(window).width() <= 767) {
            if (!$(e.target).closest('#sidebar').length && !$(e.target).closest('#menuToggle').length) {
                $('#sidebar').removeClass('active');
                $('#menuToggle i').removeClass('fa-times').addClass('fa-bars');
            }
        }
    });

    // Recherche en temps réel pour les cartes (mobile)
    $('#searchInput').on('keyup', function() {
        let searchTerm = $(this).val().toLowerCase().trim();
        
        $('.history-card').each(function() {
            let cardText = $(this).data('search')?.toLowerCase() || '';
            if (searchTerm === '' || cardText.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Ajuster l'affichage au redimensionnement
    $(window).on('resize', function() {
        if ($(window).width() > 767) {
            $('#sidebar').removeClass('active');
            $('#menuToggle i').removeClass('fa-times').addClass('fa-bars');
        }
    });
});

// Fonction de génération PDF
function generateHistoriquePDF() {
    Swal.fire({
        title: 'Génération du PDF...',
        text: 'Veuillez patienter',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });

    setTimeout(() => {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('landscape');
        const pageWidth = doc.internal.pageSize.width;
        const margin = 20;

        // En-tête
        doc.setFontSize(14);
        doc.setTextColor(11, 61, 46);
        doc.text("HISTORIQUE DES STAGES", pageWidth/2, 20, { align: "center" });
        
        doc.setFontSize(10);
        doc.text("Direction Générale de l'Administration Pénitentiaire", pageWidth/2, 28, { align: "center" });
        
        const today = new Date();
        doc.text(`Édité le ${today.toLocaleDateString('fr-FR')}`, margin, 38);

        // Récupération des données
        let data = [];
        $('.history-card').each(function() {
            let row = [];
            let card = $(this);
            
            let matricule = card.find('.matricule').text().trim().replace('N/A', '');
            let agent = card.find('.card-agent-info h4').text().trim();
            let ecole = card.find('.card-info-item:contains("Établissement") .value').text().trim().replace('', '').trim();
            let date = card.find('.card-info-item:contains("Date") .value').text().trim().replace('', '').trim();
            let moyenne = card.find('.card-info-item:contains("Moyenne") .value').text().trim().replace('', '').trim();
            let mention = card.find('.card-badge').text().trim();
            
            row.push(matricule || 'N/A');
            row.push(agent || 'N/A');
            row.push(ecole || 'N/A');
            row.push(date || 'N/A');
            row.push(moyenne || '-');
            row.push(mention || '-');
            
            if (row.some(cell => cell !== 'N/A' && cell !== '-')) {
                data.push(row);
            }
        });

        if (!data.length) {
            Swal.fire('Info', 'Aucune donnée à exporter', 'info');
            return;
        }

        // Tableau
        doc.autoTable({
            head: [['Matricule', 'Agent', 'Établissement', 'Date fin', 'Moyenne', 'Mention']],
            body: data,
            startY: 45,
            styles: { fontSize: 8, cellPadding: 3 },
            headStyles: { fillColor: [11, 61, 46], textColor: 255 },
            alternateRowStyles: { fillColor: [245, 248, 250] },
            margin: { left: margin, right: margin }
        });

        // Total
        let finalY = doc.lastAutoTable.finalY + 10;
        doc.setFontSize(10);
        doc.text(`Total des stages : ${data.length}`, margin, finalY);

        // Footer
        doc.setFontSize(8);
        doc.setTextColor(100,100,100);
        doc.text("Document officiel - ASP", pageWidth/2, doc.internal.pageSize.height-10, { align: "center" });

        doc.save(`historique_stages_${today.toISOString().slice(0,10)}.pdf`);
        
        Swal.close();
        Swal.fire({
            icon: 'success',
            title: 'PDF généré',
            text: `${data.length} stages exportés`,
            toast: true,
            position: 'top-end',
            timer: 3000
        });
    }, 500);
}

// Fonctions placeholder
function viewDetails(id) {
    Swal.fire('Info', `Détails du stage #${id}`, 'info');
}

function editHistorique(id) {
    Swal.fire('Info', `Modification du stage #${id}`, 'info');
}

function generateSinglePDF(id) {
    Swal.fire('Info', `Génération PDF pour le stage #${id}`, 'info');
}
</script>

</body>
</html>