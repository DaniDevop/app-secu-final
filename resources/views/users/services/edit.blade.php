<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
<title>Éditer le Service - ASP Stages</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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
    min-width: 500px;
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

/* Badge pour les dates */
.date-badge {
    background: #f0f2f5;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
    color: var(--text);
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
.asp-modal .form-control {
    border-radius: 12px;
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    transition: all 0.3s;
    font-size: 15px;
}
.asp-modal .form-control:focus {
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
    display: flex;
    gap: 10px;
    justify-content: flex-end;
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
    
    .btn-add {
        width: 100%;
        justify-content: center;
    }
    
    div[style*="display:flex; justify-content:flex-end"] {
        justify-content: stretch !important;
    }
    
    .table-container {
        padding: 20px;
        border-radius: 15px;
    }
    
    .table th, 
    .table td {
        padding: 12px 8px;
        font-size: 14px;
    }
    
    .date-badge {
        padding: 4px 8px;
        font-size: 12px;
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
    
    .btn-add {
        padding: 10px 20px;
        font-size: 14px;
    }
    
    .table-container {
        padding: 15px;
    }
    
    .table th, 
    .table td {
        padding: 10px 6px;
        font-size: 13px;
    }
    
    .date-badge {
        padding: 3px 6px;
        font-size: 11px;
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
    
    .form-control {
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
    .btn-sm {
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
            <li><a href="{{route('admin.service.index')}}" class="active"><i class="fas fa-briefcase"></i><span> Services</span></a></li>
            <li><a href="{{route('admin.listes.Admin')}}"><i class="fas fa-users-cog"></i><span> Administrations</span></a></li>
            <li><a href="{{route('users.affectation.agent')}}"><i class="fas fa-chalkboard-teacher"></i><span> Stages / Affectations</span></a></li>
        </ul>
    </div>
    <div class="sidebar-footer">Application interne sécurisée</div>
</div>

<div class="main-content">
    <header class="main-header">
        <div class="header-text">
            <h1><i class="fas fa-university"></i> Éditer le Service</h1>
            <p>Gestion et modification des services internes</p>
        </div>
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Rechercher...">
        </div>
    </header>

    <div style="display:flex; justify-content:flex-end; margin-bottom:20px;">
        <button class="btn-add" data-bs-toggle="modal" data-bs-target="#editSchoolModal">
            <i class="fas fa-pen-to-square me-2"></i> Modifier le service
        </button>
    </div>

    <div class="table-container">
        <table class="table table-hover align-middle" id="servicesTable">
            <thead>
                <tr>
                    <th><i class="fas fa-hashtag me-2"></i>#</th>
                    <th><i class="fas fa-building me-2"></i>Nom du service</th>
                    <th><i class="fas fa-calendar-plus me-2"></i>Date création</th>
                    <th><i class="fas fa-calendar-check me-2"></i>Date modification</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="badge bg-light text-dark p-2">#{{$service->id}}</span></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="icon-box me-3 bg-light text-primary d-flex align-items-center justify-content-center" 
                                 style="width:35px; height:35px; border-radius:8px;">
                                <i class="fas fa-door-open"></i>
                            </div>
                            <span class="fw-medium">{{$service->nom_services}}</span>
                        </div>
                    </td>
                    <td>
                        <span class="date-badge">
                            <i class="far fa-clock me-1"></i>
                            {{$service->created_at ? $service->created_at->format('d/m/Y H:i') : 'N/A'}}
                        </span>
                    </td>
                    <td>
                        <span class="date-badge">
                            <i class="far fa-clock me-1"></i>
                            {{$service->updated_at ? $service->updated_at->format('d/m/Y H:i') : 'N/A'}}
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- MODAL EDIT -->
    <div class="modal fade asp-modal" id="editSchoolModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-pen-to-square me-2"></i> Modifier le service</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('admin.service.editServicesPost')}}" method="POST" id="editServiceForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="serviceName">
                                <i class="fas fa-building me-1 text-primary"></i> Nom du service
                            </label>
                            <input type="text" name="nom_services" id="serviceName" class="form-control" 
                                   value="{{$service->nom_services}}" placeholder="Ex: Direction des Ressources Humaines" required>
                        </div>
                        <input type="hidden" name="id" value="{{$service->id}}">
                        
                        <!-- Informations supplémentaires (optionnel) -->
                        <div class="alert alert-light border small p-3 mt-3">
                            <i class="fas fa-info-circle me-2 text-primary"></i>
                            <span class="text-muted">ID: <strong>#{{$service->id}}</strong> • Créé le: <strong>{{$service->created_at ? $service->created_at->format('d/m/Y') : 'N/A'}}</strong></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Annuler
                        </button>
                        <button type="submit" class="btn btn-primary px-4 shadow">
                            <i class="fas fa-save me-1"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                if (icon) {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
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

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#servicesTable tbody tr');
            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    }

    // Success message
    @if(session('success'))
        Swal.fire({ 
            icon: 'success', 
            title: 'Opération réussie', 
            text: "{{session('success')}}", 
            toast: true, 
            position: 'top-end', 
            showConfirmButton: false, 
            timer: 3000,
            timerProgressBar: true
        });
    @endif

    // Error messages
    @if(session('error'))
        Swal.fire({ 
            icon: 'error', 
            title: 'Erreur', 
            text: "{{session('error')}}",
            confirmButtonColor: '#0B3D2E'
        });
    @endif

    @if($errors->any())
        Swal.fire({ 
            icon: 'error', 
            title: 'Erreur de validation', 
            html: '{!! implode("<br>", $errors->all()) !!}',
            confirmButtonColor: '#0B3D2E'
        });
    @endif

    // Form validation
    const form = document.getElementById('editServiceForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const serviceName = document.getElementById('serviceName').value.trim();
            
            if (serviceName === '') {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Champ obligatoire',
                    text: 'Veuillez saisir le nom du service.',
                    confirmButtonColor: '#0B3D2E'
                });
            }
        });
    }
});

// Delete confirmation function (conservée pour compatibilité)
function confirmDelete(id, name) {
    Swal.fire({
        title: 'Supprimer ce service ?',
        text: "Êtes-vous sûr de vouloir supprimer : " + name,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/admin/ecole/delete/' + id;
        }
    });
}
</script>

</body>
</html>