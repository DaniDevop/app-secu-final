<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
<title>Gestion des Stagiaires - ASP</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

<style>

/* ===== GLOBAL ===== */
body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:linear-gradient(135deg,#f1f3f5,#dee2e6);
    display:flex;
    min-height:100vh;
    overflow-x: hidden;
}

/* ===== SIDEBAR ===== */
.sidebar{
    width:260px;
    background:linear-gradient(180deg,#081C15,#1B4332);
    color:white;
    padding:30px 20px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    box-shadow:5px 0 30px rgba(0,0,0,0.2);
    position:fixed;
    height:100%;
    z-index: 1000;
    transition: all 0.3s ease;
}

.logo{
    text-align:center;
    margin-bottom:40px;
}

.logo h2{
    color:#D4AF37;
    font-size:18px;
    letter-spacing:2px;
}

.menu{
    list-style:none;
    padding:0;
}

.menu li{
    margin:12px 0;
}

.menu a{
    text-decoration:none;
    color:white;
    padding:12px 15px;
    border-radius:10px;
    display:flex;
    align-items:center;
    gap:10px;
    transition:.3s;
    font-size: 14px;
}

.menu a i {
    width: 20px;
    text-align: center;
}

.menu a:hover,
.menu a.active{
    background:#2D6A4F;
    transform:translateX(5px);
}

.sidebar-footer{
    font-size:12px;
    text-align:center;
    opacity:.7;
}

/* Menu toggle pour mobile (hamburger) */
.menu-toggle {
    display: none;
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 1100;
    background: #081C15;
    color: white;
    border: none;
    border-radius: 8px;
    width: 45px;
    height: 45px;
    font-size: 20px;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

/* ===== MAIN CONTENT ===== */
.main-content{
    margin-left:260px;
    flex:1;
    padding:30px 40px;
    width: calc(100% - 260px);
    transition: all 0.3s ease;
}

/* ===== HEADER ===== */
.main-header{
    background:linear-gradient(135deg,#081C15,#1B4332);
    color:white;
    padding:25px 30px;
    border-radius:15px;
    margin-bottom:30px;
    box-shadow:0 15px 35px rgba(0,0,0,0.15);
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap: wrap;
    gap: 15px;
}

.main-header h1 {
    font-size: clamp(1.2rem, 4vw, 2rem);
    margin-bottom: 5px;
}

.main-header small {
    font-size: clamp(0.7rem, 3vw, 0.9rem);
    opacity: 0.9;
}

.search-box{
    background:rgba(255,255,255,0.15);
    padding:8px 15px;
    border-radius:30px;
    display:flex;
    align-items:center;
    min-width: 200px;
    max-width: 100%;
    border: 1px solid rgba(255,255,255,0.2);
}

.search-box i {
    color: rgba(255,255,255,0.7);
    font-size: 14px;
}

.search-box input{
    border:none;
    background:transparent;
    color:white;
    outline:none;
    margin-left:10px;
    width: 100%;
}

.search-box input::placeholder {
    color: rgba(255,255,255,0.7);
}

/* ===== BUTTONS ===== */
.btn-add{
    background:#D4AF37;
    color:#081C15;
    font-weight:600;
    border-radius:30px;
    padding:10px 20px;
    border:none;
    transition:.3s;
    white-space: nowrap;
    cursor: pointer;
}

.btn-add:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 20px rgba(0,0,0,0.2);
}

.dt-buttons{
    display:flex;
    gap:10px;
    flex-wrap: wrap;
}

.btn-export{
    border-radius:30px !important;
    padding:10px 20px !important;
    font-weight:600 !important;
    white-space: nowrap;
    border: none !important;
    cursor: pointer !important;
}

.btn-excel{
    background:#198754 !important;
    color: white !important;
}

.btn-excel:hover {
    background:#157347 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3) !important;
}

/* ===== TABLE ===== */
.table-container{
    background:white;
    padding:25px;
    border-radius:18px;
    box-shadow:0 15px 40px rgba(0,0,0,0.08);
    overflow-x: auto;
    width: 100%;
}

.table-container table {
    min-width: 800px;
    width: 100%;
}

table.dataTable thead{
    background:#1B4332;
    color:white;
}

table.dataTable thead th {
    color: white;
    font-weight: 600;
    border-bottom: none;
}

table.dataTable tbody tr:hover{
    background:#f8f9fa;
}

.badge{
    border-radius:20px;
    padding:6px 12px;
    white-space: nowrap;
    font-weight: 500;
}

.btn-action{
    width:35px;
    height:35px;
    border-radius:50%;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    background:#f1f3f5;
    transition:.3s;
    text-decoration: none;
    color: #333;
    border: none;
    cursor: pointer;
}

.btn-action:hover{
    background:#1B4332;
    color:white;
    transform: translateY(-2px);
}

/* ===== PAGINATION LARAVEL ===== */
.pagination {
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 20px;
}

.pagination .page-link {
    border-radius: 8px;
    margin: 0 3px;
    color: #081C15;
    border: 1px solid #dee2e6;
    padding: 8px 12px;
}

.pagination .page-item.active .page-link {
    background: #1B4332;
    border-color: #1B4332;
    color: white;
}

.pagination .page-link:hover {
    background: #2D6A4F;
    color: white;
}

/* ===== MODAL ===== */
.modal-header{
    background:linear-gradient(135deg,#081C15,#1B4332);
    color:white;
}

.modal-header .btn-close {
    filter: brightness(0) invert(1);
    opacity: 0.8;
}

.modal-header .btn-close:hover {
    opacity: 1;
}

.modal-content {
    border-radius: 18px;
    overflow: hidden;
    border: none;
}

.modal-body {
    padding: 25px;
}

.modal-footer {
    padding: 20px 25px;
}

.form-control, .form-select{
    border-radius:12px;
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    transition: all 0.3s;
}

.form-control:focus, .form-select:focus{
    border-color:#D4AF37;
    box-shadow:0 0 0 3px rgba(212,175,55,.2);
    outline: none;
}

.form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

/* Overlay pour mobile quand sidebar est ouverte */
.sidebar-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 999;
}

.sidebar-overlay.active {
    display: block;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .main-content {
        padding: 20px;
    }
    
    .main-header {
        padding: 20px;
    }
    
    .table-container {
        padding: 20px;
    }
}

@media (max-width: 768px) {
    body {
        flex-direction: column;
    }
    
    .menu-toggle {
        display: block;
        z-index: 1100;
    }
    
    .sidebar {
        left: -260px;
        z-index: 1050;
    }
    
    .sidebar.active {
        left: 0;
    }
    
    .main-content {
        margin-left: 0;
        width: 100%;
        padding: 70px 15px 20px;
    }
    
    .main-header {
        flex-direction: column;
        align-items: stretch;
        text-align: center;
        padding: 15px;
    }
    
    .search-box {
        width: 100%;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 15px;
        align-items: stretch !important;
    }
    
    #exportButtonsContainer {
        width: 100%;
    }
    
    .dt-buttons {
        justify-content: center;
        width: 100%;
    }
    
    .btn-export {
        flex: 1;
        text-align: center;
        width: 100%;
    }
    
    .btn-add {
        width: 100%;
    }
    
    .table-container {
        padding: 15px;
    }
    
    .modal-dialog {
        margin: 10px;
    }
    
    .modal-body {
        padding: 15px;
    }
    
    .row.g-3 > [class*="col-"] {
        margin-bottom: 10px;
    }
}

@media (max-width: 480px) {
    .main-header h1 {
        font-size: 1.2rem;
    }
    
    .main-header i {
        font-size: 1.2rem;
    }
    
    .main-header small {
        font-size: 0.8rem;
    }
    
    .badge {
        font-size: 0.7rem;
        padding: 4px 8px;
    }
    
    .btn-action {
        width: 30px;
        height: 30px;
    }
    
    .btn-action i {
        font-size: 12px;
    }
    
    .modal-body .row.g-3 > .col-md-6 {
        width: 100%;
    }
    
    .pagination .page-link {
        padding: 5px 10px;
        font-size: 12px;
    }
}

@media (max-width: 350px) {
    .main-content {
        padding: 70px 10px 10px;
    }
    
    .table-container {
        padding: 10px;
    }
    
    .btn-export {
        font-size: 0.8rem;
        padding: 8px 10px !important;
    }
}

/* DataTables customisation */
.dataTables_wrapper .row {
    margin: 0;
}

.dataTables_length,
.dataTables_filter {
    display: none; /* Cacher les contrôles par défaut */
}

table.dataTable {
    margin-top: 0 !important;
    margin-bottom: 0 !important;
}

/* Animation */
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

/* Scrollbar personnalisée */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
    background: #1B4332;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: #2D6A4F;
}
</style>
</head>
<body>

<!-- Menu Toggle Button pour mobile -->
<button class="menu-toggle" id="menuToggle">
    <i class="fas fa-bars"></i>
</button>

<!-- Overlay pour fermer la sidebar sur mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div>
        <div class="logo">
            <h2>SÉCURITÉ<br>PÉNITENTIAIRE</h2>
        </div>

        <ul class="menu">
            <li><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i> Accueil</a></li>
            <li><a href="{{route('users.agent.index')}}"><i class="fas fa-users"></i> Agents</a></li>
            <li><a href="{{route('admin.ecole.index')}}"><i class="fas fa-school"></i> Écoles</a></li>
            <li><a href="{{route('admin.service.index')}}"><i class="fas fa-briefcase"></i> Services</a></li>
            <li><a href="{{route('admin.listes.Admin')}}"><i class="fas fa-user-tie"></i> Administrations</a></li>
            <li><a href="{{route('users.affectation.agent')}}"><i class="fas fa-exchange-alt"></i> Stages / Affectations</a></li>
            <li><a href="#"><i class="fas fa-chart-bar"></i> Rapports</a></li>
        </ul>
    </div>

    <div class="sidebar-footer">
        Application interne sécurisée
    </div>
</div>

<!-- MAIN -->
<div class="main-content">

<header class="main-header">
    <div>
        <h1><i class="fas fa-user-graduate me-2"></i>Gestion des Stagiaires</h1>
        <small>Administration interne ASP</small>
    </div>
    <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" id="searchInput" placeholder="Rechercher (matricule, nom, prénom, grade...)" autocomplete="off">
    </div>
</header>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div id="exportButtonsContainer"></div>
    <button class="btn-add" data-bs-toggle="modal" data-bs-target="#addStagiareModal">
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
<th class="no-export">Actions</th>
</tr>
</thead>
<tbody>
@foreach($stagiares as $stagiare)
<tr>
<td class="fw-bold text-primary">{{$stagiare->matricule}}</td>
<td>{{$stagiare->name}}</td>
<td>{{$stagiare->prenom}}</td>
<td><span class="badge bg-light border text-dark">{{$stagiare->grade}}</span></td>
<td>{{$stagiare->services->nom_services}}</td>
<td>{{$stagiare->tel}}</td>
<td class="no-export">
<div class="d-flex gap-2 justify-content-center">
    <a class="btn-action" href="{{ route('users.editAgentStagiare', $stagiare->id) }}" title="Modifier">
        <i class="fas fa-edit"></i>
    </a>
    <button class="btn-action" onclick="confirmDelete({{$stagiare->id}}, '{{$stagiare->name}} {{$stagiare->prenom}}')" title="Supprimer" style="background: #fee2e2; color: #dc2626;">
        <i class="fas fa-trash"></i>
    </button>
</div>
</td>
</tr>
@endforeach
</tbody>
</table>
  
<!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
    {{ $stagiares->links() }}
</div>
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
<select name="service_id" class="form-select" required>
<option value="" disabled selected>Choisir un service...</option>
@foreach($servicesAll as $service)
<option value="{{$service->id}}">{{$service->nom_services}}</option>
@endforeach
</select>
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
<option>Adjudant</option>
<option>Lieutenant</option>
<option>Capitaine</option>
<option>Commandant</option>
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

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function(){
    // Initialisation de DataTable avec recherche ACTIVÉE
    var table = $('#schoolsTable').DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json",
            search: "Rechercher :",
            searchPlaceholder: "Rechercher..."
        },
        dom: 'Brtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel me-2"></i>Exporter en Excel',
                className: 'btn-export btn-excel',
                title: 'Stagiaires_ASP_' + new Date().toISOString().slice(0,10),
                exportOptions: {
                    columns: ':not(.no-export)',
                    modifier: { page: 'current' }
                }
            }
        ],
        pageLength: 10,
        paging: false, // Désactivé car tu utilises Laravel pagination
        searching: true, // ACTIVÉ - Permet la recherche
        info: false,
        lengthChange: false,
        order: [[1, 'asc']] // Tri par nom par défaut
    });
    
    // Placer les boutons d'export
    table.buttons().container().appendTo('#exportButtonsContainer');
    
    // Recherche personnalisée liée à l'input
    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });
    
    // Effacer la recherche si l'input est vide
    $('#searchInput').on('search', function() {
        table.search('').draw();
    });

    // Messages de notification
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Succès !',
            text: "{{ session('success') }}",
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Erreur !',
            text: "{{ session('error') }}",
            confirmButtonColor: '#081C15'
        });
    @endif

    @if($errors->any())
        Swal.fire({
            icon: 'warning',
            title: 'Validation',
            html: '{!! implode("<br>", $errors->all()) !!}',
            confirmButtonColor: '#081C15'
        });
    @endif

    // Validation du formulaire
    $('#addStagiaireForm').on('submit', function(e) {
        let matricule = $('input[name="matricule"]').val().trim();
        let nom = $('input[name="name"]').val().trim();
        let prenom = $('input[name="prenom"]').val().trim();
        let tel = $('input[name="tel"]').val().trim();
        
        if (!matricule || !nom || !prenom || !tel) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Champs obligatoires',
                text: 'Veuillez remplir tous les champs.',
                confirmButtonColor: '#081C15'
            });
        }
    });
});

// Fonction pour toggle la sidebar sur mobile
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('active');
    document.getElementById('sidebarOverlay').classList.toggle('active');
}

// Event listeners pour la sidebar
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (menuToggle) {
        menuToggle.addEventListener('click', toggleSidebar);
    }
    
    if (overlay) {
        overlay.addEventListener('click', toggleSidebar);
    }
    
    // Fermer la sidebar si on clique sur un lien (mobile)
    document.querySelectorAll('.sidebar .menu a').forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                toggleSidebar();
            }
        });
    });
    
    // Réinitialiser l'affichage si redimensionnement
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        }
    });
});

// Fonction de confirmation de suppression
function confirmDelete(id, name) {
    Swal.fire({
        title: 'Supprimer ce stagiaire ?',
        text: "Êtes-vous sûr de vouloir supprimer : " + name,
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
</script>

</body>
</html>