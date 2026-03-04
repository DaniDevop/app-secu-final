<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestion des Stagiaires - ASP</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

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

body.sidebar-collapsed {
    padding-left: var(--sidebar-width-mobile);
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

.sidebar.collapsed {
    width: var(--sidebar-width-mobile);
    padding: 30px 10px;
}

.sidebar.collapsed .logo h2 {
    font-size: 12px;
    white-space: normal;
    word-break: break-word;
}

.sidebar.collapsed .menu a span {
    display: none;
}

.sidebar.collapsed .menu a {
    justify-content: center;
    padding: 12px;
}

.sidebar.collapsed .menu a i {
    font-size: 20px;
    margin: 0;
    width: auto;
}

.sidebar.collapsed .sidebar-footer {
    font-size: 10px;
    writing-mode: vertical-rl;
    transform: rotate(180deg);
    white-space: nowrap;
    height: auto;
    align-self: center;
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
    transition: all 0.3s ease;
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
    transition: all 0.3s ease;
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

/* Sidebar overlay for mobile */
.sidebar-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 999;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.sidebar-overlay.active {
    display: block;
    opacity: 1;
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
.main-header small {
    margin: 5px 0 0 0;
    opacity: .8;
    font-size: clamp(13px, 3vw, 14px);
    display: block;
}

/* ================== SEARCH BOX ================== */
#searchInput {
    border-radius: 30px;
    border: 1px solid rgba(255,255,255,0.2);
    background: rgba(255,255,255,0.15);
    color: white;
    padding: 12px 20px;
    width: 250px;
}
#searchInput::placeholder {
    color: rgba(255,255,255,0.7);
}
#searchInput:focus {
    background: rgba(255,255,255,0.25);
    outline: none;
    border-color: white;
    box-shadow: none;
}

/* ================== BUTTON ================== */
.btn-add, .btn-success {
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
.btn-add:hover, .btn-success:hover {
    background: var(--primary-light);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(11, 61, 46, 0.3);
}

/* ================== TABLE ================== */
.table-container {
    background: var(--card);
    border-radius: 20px;
    padding: 20px;
    overflow-x: auto;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    margin-bottom: 20px;
    -webkit-overflow-scrolling: touch;
}

.table {
    width: 100%;
    margin-bottom: 0;
    min-width: 800px;
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
}

/* ================== DATATABLES CUSTOM ================== */
.dataTables_wrapper .dataTables_paginate {
    float: none;
    text-align: center;
    padding-top: 1rem;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0.5rem 0.75rem;
    margin: 0 0.25rem;
    border-radius: 0.375rem;
    border: 1px solid #dee2e6;
    background-color: #fff;
    color: var(--primary) !important;
    cursor: pointer;
    transition: all 0.2s;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background-color: var(--primary);
    border-color: var(--primary);
    color: white !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background-color: var(--primary);
    border-color: var(--primary);
    color: white !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.dataTables_wrapper .dataTables_length {
    margin-bottom: 1rem;
}

.dataTables_wrapper .dataTables_length select {
    padding: 0.375rem 1.75rem 0.375rem 0.75rem;
    border-radius: 0.375rem;
    border: 1px solid #ced4da;
}

.dataTables_wrapper .dataTables_info {
    color: var(--gray);
    font-size: 0.875rem;
    padding-top: 1rem;
}

.dataTables_wrapper .dataTables_filter {
    margin-bottom: 1rem;
}

.dataTables_wrapper .dataTables_filter input {
    padding: 0.375rem 0.75rem;
    border-radius: 0.375rem;
    border: 1px solid #ced4da;
}

/* Export buttons container */
#exportButtonsContainer {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.dt-buttons .btn {
    border-radius: 30px !important;
    padding: 10px 20px !important;
    font-weight: 600 !important;
    border: none !important;
    transition: all 0.3s !important;
}

.dt-buttons .btn-success {
    background: #28a745 !important;
}
.dt-buttons .btn-success:hover {
    background: #218838 !important;
    transform: translateY(-2px);
}

.dt-buttons .btn-primary {
    background: var(--primary) !important;
}
.dt-buttons .btn-primary:hover {
    background: var(--primary-light) !important;
    transform: translateY(-2px);
}

.dt-buttons .btn-dark {
    background: #343a40 !important;
}
.dt-buttons .btn-dark:hover {
    background: #23272b !important;
    transform: translateY(-2px);
}

/* ================== MODAL ================== */
.modal-content {
    border-radius: 20px;
    border: none;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    overflow: hidden;
}
.modal-header {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: white;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
    padding: 20px 25px;
}
.modal-header .btn-close {
    filter: brightness(0) invert(1);
    opacity: 0.8;
}
.modal-header .btn-close:hover {
    opacity: 1;
}
.modal-body {
    padding: 25px;
}
.form-control, .form-select {
    border-radius: 12px;
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    transition: all 0.3s;
    font-size: 15px;
}
.form-control:focus, .form-select:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
    outline: none;
}
.form-label {
    font-weight: 600;
    color: var(--text);
    margin-bottom: 8px;
    font-size: 14px;
}
.modal-footer {
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
        padding: 30px 10px;
    }
    
    .sidebar .logo h2 {
        font-size: 12px;
        white-space: normal;
        word-break: break-word;
    }
    
    .sidebar .menu a span {
        display: none;
    }
    
    .sidebar .menu a {
        justify-content: center;
        padding: 12px;
    }
    
    .sidebar .menu a i {
        font-size: 20px;
        margin: 0;
        width: auto;
    }
    
    .sidebar .sidebar-footer {
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
    
    #searchInput {
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
    
    body, body.sidebar-collapsed {
        padding-left: 0;
    }
    
    .sidebar {
        transform: translateX(-100%);
        width: 260px;
        padding: 30px 20px;
        z-index: 1000;
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
    
    .sidebar .sidebar-footer {
        writing-mode: horizontal-tb;
        transform: none;
    }
    
    .sidebar-overlay.active {
        display: block;
    }
    
    .main-header {
        margin-top: 60px;
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
        justify-content: center;
    }
    
    .dt-buttons {
        display: flex;
        flex-direction: column;
        gap: 10px;
        width: 100%;
    }
    
    .dt-buttons .btn {
        width: 100%;
        justify-content: center;
    }
    
    .btn-add, .btn-success {
        width: 100%;
        justify-content: center;
    }
    
    .table-container {
        padding: 15px;
    }
    
    .modal-dialog {
        margin: 10px;
    }
    
    .modal-body {
        padding: 20px;
    }
    
    .modal-footer {
        flex-direction: column-reverse;
        gap: 10px;
    }
    
    .modal-footer button {
        width: 100%;
    }
    
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        text-align: left;
        float: none;
        margin: 0.5rem 0;
        width: 100%;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.375rem 0.5rem;
        margin: 0.125rem;
    }
}

@media screen and (max-width: 480px) {
    .main-header {
        padding: 15px;
    }
    
    .main-header h1 {
        font-size: 20px;
    }
    
    .main-content {
        padding: 15px 10px;
    }
    
    .btn-add, .btn-success {
        padding: 10px 20px;
        font-size: 14px;
    }
    
    .table th, 
    .table td {
        padding: 10px 6px;
        font-size: 13px;
    }
    
    .btn-sm {
        padding: 4px 8px;
    }
    
    .btn-sm i {
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
    
    .form-control, .form-select {
        padding: 10px 12px;
        font-size: 14px;
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
    .btn-success,
    .page-link,
    .btn-sm,
    .dt-buttons .btn {
        padding: 15px 20px;
        font-size: 16px;
    }
    
    .table td {
        padding: 15px 10px;
    }
}

.searchable-select-container {
    position: relative;
    width: 100%;
}

.searchable-select-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    max-height: 200px;
    overflow-y: auto;
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    z-index: 1000;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.searchable-select-dropdown .dropdown-item {
    padding: 8px 12px;
    cursor: pointer;
    border-bottom: 1px solid #f0f0f0;
}

.searchable-select-dropdown .dropdown-item:hover {
    background-color: #f8f9fa;
}

.searchable-select-dropdown .dropdown-item.selected {
    background-color: #e7f3ff;
}
</style>
</head>

<body>

<button class="menu-toggle" id="menuToggle">
    <i class="fas fa-bars"></i>
</button>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="sidebar" id="sidebar">
    <div>
        <div class="logo">
            <h2>SÉCURITÉ<br>PÉNITENTIAIRE</h2>
        </div>

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

    <div class="sidebar-footer">
        Application interne sécurisée
    </div>
</div>

<div class="main-content">

<header class="main-header d-flex justify-content-between align-items-center">
    <div>
        <h1><i class="fas fa-user-graduate me-2"></i>Gestion des Stagiaires</h1>
        <small>Administration interne ASP</small>
    </div>
    <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
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

<div class="d-flex justify-content-between align-items-center my-4">
    <div id="exportButtonsContainer"></div>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addStagiareModal">
        <i class="fas fa-plus me-2"></i>Ajouter un stagiaire
    </button>
</div>

<div class="table-container">
<table id="schoolsTable" class="table table-hover w-100">
<thead>
<tr>
    <th>Matricule</th>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Grade</th>
    <th>Service</th>
    <th>Téléphone</th>
    <th class="no-export">Details</th>
</tr>
</thead>
<tbody>
@foreach($stagiares as $stagiare)
<tr>
    <td>{{$stagiare->matricule}}</td>
    <td>{{$stagiare->name}}</td>
    <td>{{$stagiare->prenom}}</td>
    <td>{{$stagiare->grade}}</td>
    <td>{{$stagiare->services->nom_services}}</td>
    <td>{{$stagiare->tel}}</td>
    <td class="no-export">
        <a href="{{ route('users.editAgentStagiare', $stagiare->id) }}" class="btn btn-sm btn-primary">
            <i class="fas fa-edit"></i>
        </a>
       
    </td>
</tr>
@endforeach
</tbody>
</table>
</div>

</div>

<!-- MODAL AJOUT -->
<div class="modal fade" id="addStagiareModal" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
<div class="modal-content">

<div class="modal-header text-white">
    <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Nouveau Stagiaire</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<form action="{{route('users.addAgent.Stagiare')}}" method="POST" id="addStagiaireForm">
    @csrf
    <div class="modal-body">

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-bold"><i class="fas fa-id-card me-1 text-primary"></i>Matricule</label>
                <input type="text" name="matricule" class="form-control" placeholder="Ex: ASP-2024-001" required>
            </div>
           <div class="col-md-6">
    <label class="form-label fw-bold"><i class="fas fa-building me-1 text-primary"></i>Service</label>
    <div class="searchable-select-container">
        <input type="text" 
               class="form-control" 
               id="serviceSearchInput" 
               placeholder="Rechercher un service..."
               autocomplete="off">
        <div class="searchable-select-dropdown" id="serviceDropdown" style="display: none;">
            @foreach($servicesAll as $service)
            <div class="dropdown-item" data-value="{{$service->id}}" data-search="{{strtolower($service->nom_services)}}">
                {{$service->nom_services}}
            </div>
            @endforeach
        </div>
        <input type="hidden" name="service_id" id="selectedServiceId">
    </div>
</div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-bold"><i class="fas fa-user me-1 text-primary"></i>Nom</label>
                <input type="text" name="name" class="form-control" placeholder="Nom de famille" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold"><i class="fas fa-user me-1 text-primary"></i>Prénom</label>
                <input type="text" name="prenom" class="form-control" placeholder="Prénom" required>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold"><i class="fas fa-star me-1 text-primary"></i>Grade</label>
                <select name="grade" class="form-select" required>
                    <option value="" disabled selected>Sélectionner le grade</option>
                    <option>Caporal</option>
                    <option>Caporal-chef</option>
                    <option>Sergent</option>
                    <option>Sergent-chef</option>
                    <option>Sergent-chef-major   </option>
                    <option>Adjudant</option>
                     <option>Adjudant-chef</option>
                    <option>Adjudant-chef-major</option>
                    <option>Sous-lieutenant</option>
                    <option>Lieutenant</option>
                    <option>Capitaine</option>
                    <option>Commandant</option>
                    <option>Lieutenant-Colonel</option>
                    <option>Colonel</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold"><i class="fas fa-phone me-1 text-primary"></i>Téléphone</label>
                <input type="tel" name="tel" class="form-control" placeholder="06 XX XX XX XX" required>
            </div>
        </div>

    </div>

    <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
            <i class="fas fa-times me-1"></i>Annuler
        </button>
        <button type="submit" class="btn btn-primary px-4">
            <i class="fas fa-save me-1"></i>Enregistrer
        </button>
    </div>

</form>
</div>
</div> 
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
<script>






function generateOfficialPDF() {
    // Get the DataTable instance
    var table = $('#schoolsTable').DataTable();
    
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('landscape');

    const pageWidth = doc.internal.pageSize.width;
    const pageHeight = doc.internal.pageSize.height;

    // =============================
    // EN-TÊTE ADMINISTRATIF
    // =============================

    doc.setFont("helvetica", "bold");
    doc.setFontSize(16);
    doc.text("REPUBLIQUE GABONAISE", pageWidth/2, 15, { align: "center" });

    doc.setFontSize(13);
    doc.text("MINISTERE DE LA JUSTICE GARDE DES SCEAUX", pageWidth/2, 22, { align: "center" });

    doc.setFontSize(12);
    doc.text("DIRECTION DES ETUDES DU RECRUTEMENT ET DE LA FORMATION", pageWidth/2, 29, { align: "center" });

    doc.setFontSize(14);
    doc.setTextColor(11, 61, 46);
    doc.text("LISTE OFFICIELLE DES STAGIAIRES", pageWidth/2, 40, { align: "center" });

    doc.setTextColor(0,0,0);

    // =============================
    // INFOS DOCUMENT
    // =============================

    const today = new Date();
    const dateStr = today.toLocaleDateString('fr-FR');
    const refNumber = "REF-" + today.getFullYear() + "-" + Math.floor(Math.random() * 9999);

    doc.setFontSize(11);
    doc.setFont("helvetica", "normal");

    doc.text("Référence : " + refNumber, 14, 50);
    doc.text("Date : " + dateStr, pageWidth - 60, 50);

    doc.line(14, 55, pageWidth - 14, 55);

    // =============================
    // COLONNES EXPORTABLES
    // =============================

    let columns = [];
    $('#schoolsTable thead th').each(function(index) {
        if (!$(this).hasClass('no-export')) {
            columns.push($(this).text().trim());
        }
    });

    // =============================
    // DONNÉES FILTRÉES
    // =============================

    let rows = [];
    
    // Get filtered data
    table.rows({ search: 'applied' }).every(function(rowIdx, tableLoop, rowLoop) {
        let rowData = this.data();
        let cleanRow = [];

        // Loop through each cell in the row
        for (let i = 0; i < rowData.length; i++) {
            // Check if this column should be exported
            if (!$('#schoolsTable thead th').eq(i).hasClass('no-export')) {
                // Clean the HTML content
                let cellContent = rowData[i];
                
                // If it's a string with HTML, strip HTML tags
                if (typeof cellContent === 'string') {
                    cellContent = cellContent.replace(/<[^>]*>/g, '');
                }
                
                cleanRow.push(cellContent);
            }
        }

        rows.push(cleanRow);
    });

    // If no filtered data, show message
    if (rows.length === 0) {
        Swal.fire({
            icon: 'info',
            title: 'Aucune donnée',
            text: 'Aucun stagiaire trouvé avec les filtres actuels',
        });
        return;
    }

    // =============================
    // TABLEAU
    // =============================

    doc.autoTable({
        head: [columns],
        body: rows,
        startY: 65,
        theme: 'grid',
        styles: {
            fontSize: 10,
            cellPadding: 4,
            overflow: 'linebreak',
            halign: 'left'
        },
        headStyles: {
            fillColor: [11, 61, 46],
            textColor: 255,
            halign: 'center',
            fontStyle: 'bold'
        },
        alternateRowStyles: {
            fillColor: [240, 244, 248]
        },
        columnStyles: {
            0: { cellWidth: 'auto' }, // Matricule
            1: { cellWidth: 'auto' }, // Nom
            2: { cellWidth: 'auto' }, // Prénom
            3: { cellWidth: 'auto' }, // Grade
            4: { cellWidth: 'auto' }, // Service
            5: { cellWidth: 'auto' }  // Téléphone
        },
        margin: { left: 14, right: 14 },
        didDrawPage: function(data) {
            // Add header on each new page
            doc.setFont("helvetica", "bold");
            doc.setFontSize(16);
            doc.text("REPUBLIQUE GABONAISE", pageWidth/2, 15, { align: "center" });
            doc.setFontSize(13);
            doc.text("MINISTERE DE LA JUSTICE GARDE DES SCEAUX", pageWidth/2, 22, { align: "center" });
            doc.setFontSize(12);
            doc.text("DIRECTION DES ETUDES DU RECRUTEMENT ET DE LA FORMATION", pageWidth/2, 29, { align: "center" });
            doc.setFontSize(14);
            doc.setTextColor(11, 61, 46);
            doc.text("LISTE OFFICIELLE DES STAGIAIRES", pageWidth/2, 40, { align: "center" });
            doc.setTextColor(0,0,0);
        }
    });

    // =============================
    // SIGNATURE + CACHET
    // =============================

    let finalY = doc.lastAutoTable.finalY + 20;

    if (finalY > pageHeight - 40) {
        doc.addPage();
        finalY = 40;
    }

    doc.setFontSize(11);
    doc.setFont("helvetica", "normal");
    doc.text("Le Directeur de la DERF", pageWidth - 80, finalY);
    doc.text("Colonel Koumba nziengui ALbert", pageWidth - 80, finalY + 8);

    // =============================
    // FOOTER + PAGINATION
    // =============================

    let pageCount = doc.internal.getNumberOfPages();

    for (let i = 1; i <= pageCount; i++) {

        doc.setPage(i);

        doc.setFontSize(9);
        doc.text(
            "Document administratif interne - Toute reproduction non autorisée est interdite.",
            pageWidth / 2,
            pageHeight - 10,
            { align: "center" }
        );

        doc.text(
            "Page " + i + " / " + pageCount,
            pageWidth - 30,
            pageHeight - 10
        );
    }

    // =============================
    // TELECHARGEMENT
    // =============================

    doc.save("Liste_Officielle_Stagiaires.pdf");
}
$(document).ready(function(){

    // Menu toggle functionality
    $('#menuToggle').on('click', function(e) {
        e.stopPropagation();
        $('#sidebar').toggleClass('active');
        $('#sidebarOverlay').toggleClass('active');
        $(this).find('i').toggleClass('fa-bars fa-times');
    });

    // Close sidebar when clicking on overlay
    $('#sidebarOverlay').on('click', function() {
        $('#sidebar').removeClass('active');
        $('#sidebarOverlay').removeClass('active');
        $('#menuToggle i').removeClass('fa-times').addClass('fa-bars');
    });

    // Close sidebar when clicking on a menu link (mobile)
    $('.menu a').on('click', function() {
        if ($(window).width() <= 768) {
            $('#sidebar').removeClass('active');
            $('#sidebarOverlay').removeClass('active');
            $('#menuToggle i').removeClass('fa-times').addClass('fa-bars');
        }
    });

    // Handle window resize
    $(window).on('resize', function() {
        if ($(window).width() > 768) {
            $('#sidebar').removeClass('active');
            $('#sidebarOverlay').removeClass('active');
            $('#menuToggle i').removeClass('fa-times').addClass('fa-bars');
        }
    });

    // Initialize DataTable
    var table = $('#schoolsTable').DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json",
            paginate: {
                previous: "<i class='fas fa-chevron-left'></i>",
                next: "<i class='fas fa-chevron-right'></i>"
            }
        },
        dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        pageLength: 10,
        paging: true,
        searching: true,
        info: true,
        order: [[1, 'asc']],
        buttons: [
            {
                text: '<i class="fas fa-file-pdf me-2"></i>PDF Officiel',
                className: 'btn btn-info',
                action: function(e, dt, button, config) {
                    generateOfficialPDF(); // Call without parameters
                }
            }
            
            
        ]
    });

    // Move buttons to custom container
    table.buttons().container().appendTo('#exportButtonsContainer');

    // Custom search input
    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });

    // Adjust columns on window resize
    $(window).on('resize', function() {
        table.columns.adjust().draw();
    });

});

// Delete confirmation function
function confirmDelete(id, name) {
    Swal.fire({
        title: 'Supprimer ce stagiaire ?',
        text: name,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/admin/stagiaire/delete/" + id;
        }
    });
}



document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('serviceSearchInput');
    const dropdown = document.getElementById('serviceDropdown');
    const hiddenInput = document.getElementById('selectedServiceId');
    const dropdownItems = dropdown.querySelectorAll('.dropdown-item');

    // Afficher/masquer le dropdown
    searchInput.addEventListener('focus', () => {
        dropdown.style.display = 'block';
        filterItems(searchInput.value);
    });

    searchInput.addEventListener('input', function() {
        filterItems(this.value);
    });

    // Cacher le dropdown en cliquant ailleurs
    document.addEventListener('click', (e) => {
        if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.style.display = 'none';
        }
    });

    // Sélection d'un item
    dropdownItems.forEach(item => {
        item.addEventListener('click', function() {
            const value = this.getAttribute('data-value');
            const text = this.textContent.trim();
            
            searchInput.value = text;
            hiddenInput.value = value;
            dropdown.style.display = 'none';
            
            // Retirer la classe selected de tous les items
            dropdownItems.forEach(i => i.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    // Fonction de filtrage
    function filterItems(searchTerm) {
        const term = searchTerm.toLowerCase().trim();
        
        dropdownItems.forEach(item => {
            const searchText = item.getAttribute('data-search') || item.textContent.toLowerCase();
            if (term === '' || searchText.includes(term)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
});




</script>

</body>
</html>