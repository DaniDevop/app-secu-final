<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
<title>Modification Affectation - ASP Stages</title>

<!-- CSS externes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<style>
/* ================== THEME ================== */
:root {
    --primary: #0B3D2E;
    --primary-light: #1F6F5C;
    --gold: #D4AF37;
    --bg: #F1F4F8;
    --card: #ffffff;
    --text: #1f2937;
    --gray: #6b7280;
    --sidebar-width: 260px;
    --sidebar-width-mobile: 70px;
}

/* ================== GLOBAL ================== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: var(--bg);
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
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
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 5px 0 30px rgba(0,0,0,0.2);
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    z-index: 1000;
    transition: all 0.3s ease;
    overflow-y: auto;
}

.logo { 
    text-align: center; 
    margin-bottom: 40px; 
}

.logo h2 { 
    color: var(--gold); 
    font-size: 18px; 
    letter-spacing: 2px;
    word-break: break-word;
}

.menu { 
    list-style: none; 
    padding: 0; 
}

.menu li { 
    margin: 8px 0; 
}

.menu a {
    text-decoration: none;
    color: white;
    padding: 12px 15px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s;
    font-size: 15px;
    white-space: nowrap;
}

.menu a i {
    font-size: 18px;
    width: 24px;
    text-align: center;
}

.menu a:hover, 
.menu a.active { 
    background: #2D6A4F; 
    transform: translateX(5px); 
}

.sidebar-footer { 
    font-size: 12px; 
    text-align: center; 
    opacity: .7;
    margin-top: 20px;
}

/* Menu toggle button for mobile */
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
    padding: 30px 40px; 
    transition: all 0.3s ease;
    width: 100%;
    min-height: 100vh;
}

/* ================== HEADER ================== */
.main-header {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: white;
    padding: 25px 30px;
    border-radius: 20px;
    margin-bottom: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.main-header h1 { 
    font-size: clamp(20px, 4vw, 24px); 
    font-weight: 600; 
    display: flex; 
    align-items: center; 
    gap: 10px; 
    margin: 0;
}

.main-header p { 
    margin: 5px 0 0 0; 
    opacity: .8; 
    font-size: clamp(13px, 3vw, 14px);
}

.header-text {
    flex: 1;
    min-width: 250px;
}

/* ================== SEARCH BOX ================== */
.search-box { 
    position: relative; 
    min-width: 200px;
}

.search-box i {
    position: absolute; 
    top: 50%; 
    left: 15px; 
    transform: translateY(-50%);
    color: var(--gray);
    font-size: 14px;
    z-index: 1;
}

.search-box input {
    padding: 12px 15px 12px 40px;
    border-radius: 30px;
    border: 1px solid rgba(255,255,255,0.2);
    width: 100%;
    min-width: 250px;
    background: rgba(255,255,255,0.15);
    color: white;
    transition: all 0.3s;
}

.search-box input::placeholder {
    color: rgba(255,255,255,0.7);
}

.search-box input:focus {
    background: rgba(255,255,255,0.25);
    outline: none;
    border-color: white;
}

/* ================== BUTTON ================== */
.btn-add {
    background: var(--primary);
    color: white;
    border-radius: 30px;
    padding: 12px 25px;
    font-weight: 600;
    transition: all 0.3s;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 15px;
    white-space: nowrap;
    cursor: pointer;
}

.btn-add:hover { 
    background: var(--primary-light); 
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(11, 61, 46, 0.3);
}

/* Export button customization */
.btn-export-excel {
    background: #28a745 !important;
    color: white !important;
    border-radius: 30px !important;
    padding: 12px 25px !important;
    font-weight: 600 !important;
    border: none !important;
    transition: all 0.3s !important;
}

.btn-export-excel:hover {
    background: #218838 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3) !important;
}

/* ================== TABLE ================== */
.table-container {
    background: var(--card);
    border-radius: 20px;
    padding: 25px;
    overflow-x: auto;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    margin-bottom: 20px;
    -webkit-overflow-scrolling: touch;
}

.table {
    width: 100%;
    margin-bottom: 0;
    min-width: 800px; /* Table large nécessite scroll */
}

.table th, .table td { 
    vertical-align: middle !important;
    padding: 15px 12px;
}

.table th {
    background: #f8f9fa;
    font-weight: 600;
    color: var(--primary);
    white-space: nowrap;
}

.table td {
    word-break: break-word;
    font-size: 14px;
}

/* Avatar circle */
.avatar-circle {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: #f0f2f5;
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
}

tr:hover .avatar-circle {
    background: var(--primary);
    color: white;
}

/* ================== EXPORT BUTTONS CONTAINER ================== */
#exportButtonsContainer {
    display: inline-block;
}

.dt-buttons {
    display: inline-block;
}

/* ================== MODAL ================== */
.asp-modal .modal-content {
    border-radius: 20px;
    border: none;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    overflow: hidden;
}

.asp-modal .modal-header {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: white;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
    padding: 20px 25px;
}

.asp-modal .modal-header .btn-close {
    filter: brightness(0) invert(1);
    opacity: 0.8;
}

.asp-modal .modal-header .btn-close:hover {
    opacity: 1;
}

.asp-modal .modal-body {
    padding: 25px;
}

.asp-modal .form-control,
.asp-modal .form-select { 
    border-radius: 12px; 
    padding: 12px 15px; 
    border: 2px solid #e9ecef;
    transition: all 0.3s;
    font-size: 15px;
}

.asp-modal .form-control:focus,
.asp-modal .form-select:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
    outline: none;
}

.asp-modal .form-label {
    font-weight: 600;
    color: var(--text);
    margin-bottom: 8px;
    font-size: 14px;
}

.asp-modal .modal-footer { 
    border-top: none; 
    padding: 20px 25px;
    background: #f8f9fa;
}

/* ================== MEDIA QUERIES ================== */
@media screen and (max-width: 992px) {
    body {
        padding-left: var(--sidebar-width-mobile);
    }
    
    .sidebar {
        width: var(--sidebar-width-mobile);
        padding: 20px 10px;
    }
    
    .logo h2 {
        font-size: 12px;
        white-space: normal;
        word-break: break-word;
    }
    
    .menu a span {
        display: none;
    }
    
    .menu a {
        justify-content: center;
        padding: 12px;
    }
    
    .menu a i {
        font-size: 20px;
        margin: 0;
        width: auto;
    }
    
    .sidebar-footer {
        font-size: 10px;
        writing-mode: vertical-rl;
        transform: rotate(180deg);
        white-space: nowrap;
        height: auto;
        align-self: center;
    }
    
    .main-header {
        padding: 20px;
    }
    
    .search-box {
        width: 100%;
    }
    
    .search-box input {
        width: 100%;
    }
    
    .main-content {
        padding: 20px 15px;
    }
}

@media screen and (max-width: 768px) {
    .menu-toggle {
        display: flex;
    }
    
    body {
        padding-left: 0;
    }
    
    .sidebar {
        transform: translateX(-100%);
        width: 260px;
        padding: 30px 20px;
    }
    
    .sidebar.active {
        transform: translateX(0);
    }
    
    .sidebar .menu a span {
        display: inline;
    }
    
    .sidebar .menu a {
        justify-content: flex-start;
    }
    
    .sidebar .logo h2 {
        font-size: 16px;
    }
    
    .sidebar-footer {
        writing-mode: horizontal-tb;
        transform: none;
    }
    
    .main-header {
        margin-top: 50px;
        flex-direction: column;
        align-items: stretch;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 15px;
        align-items: stretch !important;
    }
    
    #exportButtonsContainer {
        width: 100%;
    }
    
    .btn-export-excel {
        width: 100%;
        justify-content: center;
    }
    
    .btn-add {
        width: 100%;
        justify-content: center;
    }
    
    .table-container {
        padding: 20px;
        border-radius: 15px;
    }
    
    .table th, 
    .table td {
        padding: 12px 8px;
        font-size: 13px;
    }
    
    .avatar-circle {
        width: 30px;
        height: 30px;
    }
    
    .modal-dialog {
        margin: 10px;
    }
    
    .modal-body {
        padding: 20px;
    }
    
    .modal-body .row {
        margin: 0;
    }
    
    .modal-body .col-md-6 {
        padding: 0 5px;
    }
    
    .modal-footer {
        flex-direction: column-reverse;
        gap: 10px;
    }
    
    .modal-footer button {
        width: 100%;
    }
}

@media screen and (max-width: 480px) {
    .main-header {
        padding: 15px;
    }
    
    .main-header h1 {
        font-size: 20px;
    }
    
    .main-header p {
        font-size: 12px;
    }
    
    .main-content {
        padding: 15px 10px;
    }
    
    .table-container {
        padding: 15px;
    }
    
    .table th, 
    .table td {
        padding: 10px 6px;
        font-size: 12px;
    }
    
    .avatar-circle {
        width: 25px;
        height: 25px;
        margin-right: 5px !important;
    }
    
    .avatar-circle i {
        font-size: 12px;
    }
    
    .modal-header {
        padding: 15px 20px;
    }
    
    .modal-header h5 {
        font-size: 16px;
    }
    
    .modal-body {
        padding: 15px;
    }
    
    .form-control,
    .form-select {
        padding: 10px 12px;
        font-size: 14px;
    }
    
    .modal-footer {
        padding: 15px;
    }
}

@media screen and (min-width: 1400px) {
    .main-content {
        max-width: 1600px;
        margin: 0 auto;
    }
}

/* ================== ANIMATIONS ================== */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.main-content {
    animation: slideIn 0.5s ease;
}

/* ================== SCROLLBAR ================== */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
    background: var(--primary);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--primary-light);
}

/* ================== TOUCH OPTIMIZATION ================== */
@media (hover: none) and (pointer: coarse) {
    .menu a,
    .btn-add,
    .btn-export-excel {
        padding: 15px 20px;
        font-size: 16px;
    }
    
    .table td {
        padding: 15px 10px;
    }
}
</style>
</head>
<body>

<!-- Menu toggle button for mobile -->
<button class="menu-toggle" id="menuToggle">
    <i class="fas fa-bars"></i>
</button>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div>
        <div class="logo"><h2>SÉCURITÉ<br>PÉNITENTIAIRE</h2></div>
        <ul class="menu">
            <li><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i><span> Accueil</span></a></li>
            <li><a href="{{route('users.agent.index')}}"><i class="fas fa-user-shield"></i><span> Agents</span></a></li>
            <li><a href="{{route('admin.ecole.index')}}"><i class="fas fa-university"></i><span> Écoles</span></a></li>
            <li><a href="{{route('admin.service.index')}}"><i class="fas fa-briefcase"></i><span> Services</span></a></li>
            <li><a href="{{route('admin.listes.Admin')}}"><i class="fas fa-users-cog"></i><span> Administrations</span></a></li>
            <li><a href="{{route('users.affectation.agent')}}"><i class="fas fa-exchange-alt"></i><span> Stages / Affectations</span></a></li>
                    <li>
    <a href="{{route('users.historique.agent.stage')}}">
        <i class="fas fa-history"></i> Historique
    </a>
</li>
            <li class="nav-item mt-auto">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="nav-link btn btn-link text-start w-100 text-danger">
            <i class="fas fa-sign-out-alt me-2"></i>
            Déconnexion
        </button>
    </form>
</li>
        </ul>
    </div>
    <div class="sidebar-footer">Application interne sécurisée</div>
</div>

<div class="main-content">

<header class="main-header">
    <div class="header-text">
        <h1><i class="fas fa-clipboard-list"></i> Modification d'Affectation</h1>
        <p>Modifier les détails de l'affectation</p>
    </div>
    <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" id="searchInput" placeholder="Rechercher...">
    </div>
</header>


@if($errors->any())
    <div style="background:red;color:white;padding:10px;">
        {{ implode('', $errors->all()) }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($affect->status !== 'Terminé')
   <div class="d-flex justify-content-between mb-3">
    <div id="exportButtonsContainer"></div>
    <button class="btn-add" data-bs-toggle="modal" data-bs-target="#editAffectationModal">
        <i class="fas fa-edit me-2"></i>Modifier l'affectation
    </button>
</div>


<p>
    <button type="button" 
        class="btn-add" 
        data-bs-toggle="modal" 
        data-bs-target="#validateStageModal"
        data-id="{{ $affect->id }}"
        data-formation="{{ $affect->type_formations }}">
    <i class="fas fa-check-circle me-1"></i> Valider le stage
</button>
    @endif

</p>
<div class="table-container">
    <table id="schoolsTable" class="table table-hover align-middle w-100">
        <thead>
            <tr>
                <th><i class="fas fa-id-card me-1"></i>Matricule</th>
                <th><i class="fas fa-user me-1"></i>Agent / Stagiaire</th>
                <th><i class="fas fa-briefcase me-1"></i>Service & Grade</th>
                <th><i class="fas fa-university me-1"></i>Établissement</th>
                <th><i class="fas fa-tag me-1"></i>Type de Formation</th>
                <th><i class="fas fa-calendar me-1"></i>Période de Stage</th>
                <th><i class="fas fa-calendar me-1"></i>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-primary fw-bold"><span class="badge bg-light text-dark p-2">#{{ $affect->agent?->matricule }}</span></td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="avatar-circle me-2">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <span class="fw-bold">{{ $affect->agent?->name }}</span>
                            <br><small class="text-muted">{{ $affect->agent?->prenom }}</small>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="badge bg-light text-dark border mb-1">{{ $affect->agent?->grade }}</span>
                    <br><small class="text-muted"><i class="fas fa-building me-1"></i>{{ $affect->agent?->services?->nom_services }}</small>
                </td>
                    <td class="text-primary fw-bold"><i class="fas fa-school me-1"></i>{{ $affect->ecoles?->nom_ecole }}</td>
                    <td class="text-primary fw-bold"><i class="fas fa-tag me-1"></i>{{ $affect->type_formations }}</td>
    
                <td>
                    <small>
                        <span class="text-success">Début:</span> {{ \Carbon\Carbon::parse($affect->date_debut)->format('d/m/Y') }}<br>
                        <span class="text-danger">Fin:</span> {{ \Carbon\Carbon::parse($affect->date_fin)->format('d/m/Y') }}
                    </small>
                </td>
                <td>
                    <small>
                        <span class="text-success">statut:</span> {{ $affect->status ?? 'En cours'  }}<br>
                    </small>
                </td>


            </tr>
        </tbody>
    </table>
</div>

</div>

<!-- Modal Modification Affectation -->
<div class="modal fade asp-modal" id="editAffectationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Modification de l'Affectation</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('users.EditAffectationAgent.editData') }}" method="POST" id="editAffectationForm">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                <i class="fas fa-calendar-plus me-1 text-primary"></i> Type de Formation
                            </label>
                            <input type="text" name="type_formations" value="{{ $affect->type_formations }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                <i class="fas fa-calendar-plus me-1 text-primary"></i> Date de Début
                            </label>
                            <input type="date" name="date_debut" value="{{ $affect->date_debut }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                <i class="fas fa-calendar-check me-1 text-primary"></i> Date de Fin
                            </label>
                            <input type="date" name="date_fin" value="{{ $affect->date_fin }}" class="form-control" required>
                        </div>

                         
                        <div class="col-12">
                            <label class="form-label fw-bold">
                                <i class="fas fa-user me-1 text-primary"></i> Agent / Stagiaire
                            </label>
                            <select name="agent_stagiare_id" class="form-select" required>
                                <option value="{{ $affect->agent?->id }}">
                                    {{ $affect->agent?->name }} {{ $affect->agent?->prenom }} ({{ $affect->agent?->matricule }})
                                </option>
                                @foreach($agentAll as $agent)
                                <option value="{{ $agent->id }}" >
                                    {{ $agent->name }} {{ $agent->prenom }} ({{ $agent->matricule }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">
                                <i class="fas fa-university me-1 text-primary"></i> École de Stage
                            </label>
                            <select name="ecole_stage_id" class="form-select" required>
                                <option value="{{ $affect->ecoles?->id }}">
                                    {{ $affect->ecoles?->nom_ecole }}
                                </option>
                                @foreach($ecoleStageAll as $ecole)
                                <option value="{{ $ecole->id }}">
                                    {{ $ecole->nom_ecole }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Hidden field for the affectation ID if needed -->
                        <input type="hidden" name="affectation_id" value="{{ $affect->id }}">
                    </div>
                    
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Annuler
                    </button>
                    <button type="submit" class="btn btn-primary px-4 shadow">
                        <i class="fas fa-save me-1"></i> Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="validateStageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="fas fa-graduation-cap me-2"></i> Clôturer et Noter le Stage maintenant ?</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('addHistorique.stage')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="number" name="affectation_id" id="val_affectation_id" value="{{$affect->id}}" hidden>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Moyenne /20</label>
                            <input type="number" step="0.01" min="0" max="20" name="moyenne" class="form-control" placeholder="15.50" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Mention</label>
                            <select name="mention" class="form-select" required>
                                <option value="Très Bien">Très Bien</option>
                                <option value="Bien">Bien</option>
                                <option value="Assez Bien">Assez Bien</option>
                                <option value="Passable">Passable</option>
                                <option value="Insuffisant">Insuffisant</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Date-final de fin de stage</label>
                            <input type="date" value="{{$affect->date_fin}}" name="date_fin" class="form-control" placeholder="Ex: Excellent travail, rigoureux">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Commentaire détaillé</label>
                            <textarea name="commentaire" class="form-control" rows="3" placeholder="Observations sur le comportement et les aptitudes..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-1"></i> Enregistrer à l'historique
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#schoolsTable').DataTable({
        language: { 
            url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json",
            search: "",
            searchPlaceholder: "Rechercher..."
        },
        dom: 'Brtip',
        buttons: [{
            extend: 'excelHtml5',
            text: '<i class="fas fa-file-excel me-2"></i> Exporter cette affectation',
            className: 'btn-export-excel',
            title: 'Affectation_' + {{ $affect->id }} + '_' + new Date().toISOString().slice(0,10),
            exportOptions: { 
                columns: "thead th:not(.no-export)", 
                modifier: { page: 'current' } 
            }
        }],
        pageLength: 10,
        responsive: true,
        paging: false,
        ordering: true,
        lengthChange: false,
        info: false,
        searching: true
    });
    
    // Move export buttons to container
    table.buttons().container().appendTo('#exportButtonsContainer');
    
    // Custom search
    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });

    // Mobile menu toggle
    $('#menuToggle').click(function() {
        $('#sidebar').toggleClass('active');
        $(this).find('i').toggleClass('fa-bars fa-times');
    });

    // Close sidebar when clicking outside on mobile
    $(document).on('click', function(e) {
        if ($(window).width() <= 768) {
            if (!$(e.target).closest('#sidebar').length && !$(e.target).closest('#menuToggle').length) {
                $('#sidebar').removeClass('active');
                $('#menuToggle i').removeClass('fa-times').addClass('fa-bars');
            }
        }
    });

    // Handle window resize
    $(window).on('resize', function() {
        if ($(window).width() > 768) {
            $('#sidebar').removeClass('active');
            $('#menuToggle i').removeClass('fa-times').addClass('fa-bars');
        }
    });

    

   

    // Form validation
    $('#editAffectationForm').on('submit', function(e) {
        let dateDebut = $('input[name="date_debut"]').val();
        let dateFin = $('input[name="date_fin"]').val();
        
        if (new Date(dateFin) < new Date(dateDebut)) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Dates invalides',
                text: 'La date de fin doit être postérieure à la date de début.',
                confirmButtonColor: '#0B3D2E'
            });
        }
    });

    
});

// Keep the changeStatus function for compatibility (though not used in this view)
function changeStatus(id, newStatus) {
    Swal.fire({
        title: 'Modifier le statut ?',
        text: "L'affectation passera au statut : " + newStatus,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#0B3D2E',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Oui, confirmer',
        cancelButtonText: 'Annuler',
        reverseButtons: true
    }).then((result) => {
        if(result.isConfirmed) {
            window.location.href = "/administration/affectation/status/" + id + "/" + newStatus;
        }
    });
}
</script>

</body>
</html>