<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
<title>Dossier Stagiaire - ASP</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
    box-shadow: 5px 0 30px rgba(0, 0, 0, 0.2);
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

/* ================== HEADER ================== */
.main-header {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: white;
    padding: 30px 40px;
    border-bottom-left-radius: 30px;
    border-bottom-right-radius: 30px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
    margin-bottom: 40px;
    position: relative;
    z-index: 900;
    transition: all 0.3s ease;
}

.main-header h1 {
    font-size: clamp(22px, 4vw, 26px);
    font-weight: 600;
    margin-bottom: 5px;
}

.main-header p {
    opacity: .8;
    margin: 0;
    font-size: clamp(13px, 3vw, 16px);
}

/* ================== DOSSIER CARD ================== */
.dossier-card {
    background: var(--card);
    border-radius: 25px;
    padding: 40px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
    max-width: 1200px;
    margin: auto;
    transition: all 0.3s ease;
}

.dossier-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
}

.info-box {
    background: #f9fafb;
    padding: 20px;
    border-radius: 15px;
    border-left: 5px solid var(--primary);
    transition: all 0.3s ease;
}

.info-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
}

.info-box label {
    font-size: 12px;
    text-transform: uppercase;
    color: var(--gray);
    font-weight: 600;
    letter-spacing: 0.5px;
    display: block;
    margin-bottom: 5px;
}

.info-box p {
    margin: 5px 0 0;
    font-size: 16px;
    font-weight: 600;
    color: var(--text);
    word-break: break-word;
}

/* ================== GRADE BADGE ================== */
.grade-badge {
    background: var(--gold);
    color: var(--primary);
    padding: 8px 15px;
    border-radius: 30px;
    font-weight: 600;
    display: inline-block;
    font-size: 14px;
}

/* ================== BUTTON ================== */
.btn-edit {
    background: var(--primary);
    color: white;
    padding: 12px 25px;
    border-radius: 30px;
    border: none;
    font-weight: 600;
    transition: all 0.3s;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 15px;
}

.btn-edit:hover {
    background: var(--primary-light);
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(11, 61, 46, 0.2);
}

.btn-edit i {
    font-size: 16px;
}

/* ================== MODAL ================== */
.modal-content {
    border-radius: 20px;
    border: none;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
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

.form-control,
.form-select {
    border-radius: 12px;
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    transition: all 0.3s;
    font-size: 15px;
}

.form-control:focus,
.form-select:focus {
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

.btn-submit {
    background: var(--primary);
    color: white;
    border-radius: 30px;
    padding: 10px 25px;
    border: none;
    font-weight: 600;
    transition: all 0.3s;
}

.btn-submit:hover {
    background: var(--primary-light);
    transform: translateY(-2px);
}

.btn-cancel {
    background: #dee2e6;
    border-radius: 30px;
    padding: 10px 25px;
    border: none;
    font-weight: 600;
    transition: all 0.3s;
}

.btn-cancel:hover {
    background: #ced4da;
}

.modal-footer {
    border-top: none;
    padding: 20px 25px;
    background: #f8f9fa;
}

/* ================== MEDIA QUERIES ================== */
@media screen and (max-width: 1200px) {
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
}

@media screen and (max-width: 992px) {
    .dossier-card {
        padding: 30px;
    }
    
    .dossier-grid {
        gap: 20px;
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
        padding: 20px 25px;
        margin-top: 50px;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        margin-bottom: 30px;
    }
    
    .dossier-card {
        padding: 25px 20px;
        border-radius: 20px;
        margin: 0 15px;
    }
    
    .dossier-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .info-box {
        padding: 15px;
    }
    
    .info-box p {
        font-size: 15px;
    }
    
    .btn-edit {
        width: 100%;
        justify-content: center;
    }
    
    .text-end {
        text-align: center !important;
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
}

@media screen and (max-width: 480px) {
    .main-header {
        padding: 15px 20px;
    }
    
    .main-header h1 {
        font-size: 20px;
    }
    
    .main-header p {
        font-size: 12px;
    }
    
    .dossier-card {
        padding: 20px 15px;
        margin: 0 10px;
    }
    
    .info-box {
        padding: 12px;
    }
    
    .info-box label {
        font-size: 11px;
    }
    
    .info-box p {
        font-size: 14px;
    }
    
    .grade-badge {
        padding: 6px 12px;
        font-size: 12px;
    }
    
    .btn-edit {
        padding: 10px 20px;
        font-size: 14px;
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
    
    .modal-footer {
        padding: 15px;
    }
    
    .form-control,
    .form-select {
        padding: 10px 12px;
        font-size: 14px;
    }
    
    .btn-submit,
    .btn-cancel {
        padding: 8px 20px;
        font-size: 14px;
    }
}

@media screen and (min-width: 1400px) {
    .dossier-card {
        max-width: 1400px;
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

.dossier-card {
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
    .btn-edit,
    .btn-submit,
    .btn-cancel {
        padding: 15px 20px;
        font-size: 16px;
    }
    
    .info-box {
        padding: 18px;
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
             <a href="{{route('users.historique.agent.stage')}}">
        <i class="fas fa-history"></i> Historique
    </a>
<li class="nav-item mt-auto">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="nav-link btn btn-link text-start w-100 text-danger">
            <i class="fas fa-sign-out-alt me-2"></i>
            Déconnexion
        </button>
    </form>
</li>        </ul>
    </div>

    <div class="sidebar-footer">
        Application interne sécurisée
    </div>
</div>

<!-- HEADER -->
<div class="main-header">
    <h1><i class="fas fa-user-shield me-2"></i>Dossier Administratif Stagiaire</h1>
    <p>Administration Pénitentiaire – République Gabonaise</p>
</div>

<!-- DOSSIER -->@if($errors->any())
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
<div class="dossier-card">

    <div class="dossier-grid">

        <div class="info-box">
            <label><i class="fas fa-id-card me-1"></i>Matricule</label>
            <p>{{$stagiareAgent->matricule}}</p>
        </div>

        <div class="info-box">
            <label><i class="fas fa-user me-1"></i>Nom</label>
            <p>{{$stagiareAgent->name}}</p>
        </div>

        <div class="info-box">
            <label><i class="fas fa-user me-1"></i>Prénom</label>
            <p>{{$stagiareAgent->prenom}}</p>
        </div>

        <div class="info-box">
            <label><i class="fas fa-star me-1"></i>Grade</label>
            <p><span class="grade-badge">{{$stagiareAgent->grade}}</span></p>
        </div>

        <div class="info-box">
            <label><i class="fas fa-building me-1"></i>Service</label>
            <p>{{$stagiareAgent->services->nom_services}}</p>
        </div>

        <div class="info-box">
            <label><i class="fas fa-phone me-1"></i>Téléphone</label>
            <p>{{$stagiareAgent->tel}}</p>
        </div>

    </div>

    <div class="text-end mt-4">
        <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#addStagiareModal">
            <i class="fas fa-edit me-2"></i>Modifier le dossier
        </button>
    </div>

</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="addStagiareModal" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">
<i class="fas fa-user-edit me-2"></i>Modifier le stagiaire
</h5>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<form action="{{route('users.EditgentStagiare')}}" method="POST">
@csrf

<div class="modal-body">

<div class="row g-3">

<div class="col-md-6">
<label class="form-label">
<i class="fas fa-id-card me-1 text-primary"></i>Matricule
</label>
<input type="text" name="matricule" class="form-control" value="{{$stagiareAgent->matricule}}" required>
</div>

<div class="col-md-6">
<label class="form-label">
<i class="fas fa-user me-1 text-primary"></i>Nom
</label>
<input type="text" name="name" class="form-control" value="{{$stagiareAgent->name}}" required>
</div>

<div class="col-md-6">
<label class="form-label">
<i class="fas fa-user me-1 text-primary"></i>Prénom
</label>
<input type="text" name="prenom" class="form-control" value="{{$stagiareAgent->prenom}}" required>
</div>

<div class="col-md-6">
<label class="form-label">
<i class="fas fa-star me-1 text-primary"></i>Grade
</label>
<select name="grade" class="form-select" required>
<option value="{{$stagiareAgent->grade}}">{{$stagiareAgent->grade}}</option>
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
<label class="form-label">
<i class="fas fa-phone me-1 text-primary"></i>Téléphone
</label>
<input type="text" name="tel" class="form-control" value="{{$stagiareAgent->tel}}" required>
</div>

<div class="col-md-6">
<label class="form-label">
<i class="fas fa-building me-1 text-primary"></i>Service
</label>
<select name="service_id" class="form-select" required>
<option value="{{$stagiareAgent->service_agent_id}}">
{{$stagiareAgent->services->nom_services}}
</option>
@foreach($servicesAll as $service)
<option value="{{$service->id}}">
{{$service->nom_services}}
</option>
@endforeach
</select>
</div>

</div>

<input type="hidden" name="id" value="{{$stagiareAgent->id}}">

</div>

<div class="modal-footer">
<button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Annuler</button>
<button type="submit" class="btn btn-submit">
<i class="fas fa-save me-1"></i>Enregistrer
</button>
</div>

</form>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // Mobile menu toggle
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            const icon = this.querySelector('i');
            if (icon.classList.contains('fa-bars')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    }
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
            if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                sidebar.classList.remove('active');
                const icon = menuToggle.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        }
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            sidebar.classList.remove('active');
            const icon = menuToggle.querySelector('i');
            if (icon) {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        }
    });

    // Success message
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Succès',
        text: "{{session('success')}}",
        timer: 3000,
        showConfirmButton: false,
        toast: true,
        position: 'top-end',
        timerProgressBar: true
    });
    @endif

    // Error message
    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Erreur',
        text: "{{session('error')}}",
        confirmButtonColor: '#0B3D2E'
    });
    @endif

    // Validation errors
    @if($errors->any())
    Swal.fire({
        icon: 'warning',
        title: 'Attention',
        html: '{!! implode("<br>", $errors->all()) !!}',
        confirmButtonColor: '#0B3D2E'
    });
    @endif

    // Form validation
    const form = document.querySelector('form[action="{{route('users.EditgentStagiare')}}"]');
    if (form) {
        form.addEventListener('submit', function(e) {
            const matricule = document.querySelector('input[name="matricule"]').value.trim();
            const nom = document.querySelector('input[name="name"]').value.trim();
            const prenom = document.querySelector('input[name="prenom"]').value.trim();
            const tel = document.querySelector('input[name="tel"]').value.trim();
            
            if (matricule === '' || nom === '' || prenom === '' || tel === '') {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Champs obligatoires',
                    text: 'Veuillez remplir tous les champs obligatoires.',
                    confirmButtonColor: '#0B3D2E'
                });
            }
        });
    }
});
</script>

</body>
</html>