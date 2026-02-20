<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
<title>Gestion des Services - ASP Stages</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
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

/* ================== BREADCRUMB ================== */
.breadcrumb-mini {
    font-size: 14px;
    color: var(--gray);
}
.breadcrumb-mini strong {
    color: var(--primary);
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
    padding: 20px;
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

.icon-box {
    width: 35px;
    height: 35px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
}

tr:hover .icon-box {
    background: var(--primary) !important;
    color: white !important;
}

/* ================== PAGINATION ================== */
.pagination {
    flex-wrap: wrap;
    justify-content: center;
    gap: 5px;
}

.page-link {
    border-radius: 8px !important;
    margin: 0 2px;
    color: var(--primary);
}

.page-item.active .page-link {
    background: var(--primary);
    border-color: var(--primary);
    color: white;
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
        align-items: flex-start !important;
    }
    
    .btn-add {
        width: 100%;
        justify-content: center;
    }
    
    .table-container {
        padding: 15px;
        border-radius: 15px;
    }
    
    .table th, 
    .table td {
        padding: 12px 8px;
        font-size: 14px;
    }
    
    .icon-box {
        width: 30px;
        height: 30px;
        margin-right: 10px !important;
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
    
    .breadcrumb-mini {
        font-size: 13px;
    }
    
    .btn-add {
        padding: 10px 20px;
        font-size: 14px;
    }
    
    .table th, 
    .table td {
        padding: 10px 6px;
        font-size: 13px;
    }
    
    .icon-box {
        width: 25px;
        height: 25px;
        font-size: 12px;
        margin-right: 8px !important;
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
    
    .form-control {
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
    .page-link,
    .btn-sm {
        padding: 15px 20px;
        font-size: 16px;
    }
    
    .table td {
        padding: 15px 10px;
    }
    
    .icon-box {
        width: 40px;
        height: 40px;
        font-size: 16px;
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

<!-- MAIN CONTENT -->
<div class="main-content">
    <header class="main-header">
        <div class="header-text">
            <h1><i class="fas fa-sitemap"></i> Gestion des Services</h1>
            <p>Organisation interne et départements</p>
        </div>
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Rechercher un service...">
        </div>
    </header>

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div class="breadcrumb-mini">
            <span class="text-muted">Administration</span> / <strong>Services</strong>
        </div>
        <button class="btn-add" type="button" data-bs-toggle="modal" data-bs-target="#addServiceModal">
            <i class="fas fa-plus-circle me-1"></i> Nouveau Service
        </button>
    </div>

    <div class="table-container shadow-sm border-0">
        <table id="servicesTable" class="table table-hover align-middle">
            <thead>
                <tr>
                    <th width="15%"><i class="fas fa-hashtag me-2"></i>Numéro</th>
                    <th width="70%"><i class="fas fa-building me-2"></i>Nom du Service</th>
                    <th width="15%" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                <tr>
                    <td><span class="badge bg-light text-dark p-2">#{{$service->id}}</span></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="icon-box me-3 bg-light text-primary d-flex align-items-center justify-content-center">
                                <i class="fas fa-door-open"></i>
                            </div>
                            <span class="fw-medium">{{$service->nom_services}}</span>
                        </div>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.service.edit', $service->id) }}" title="Modifier">
                            <i class="fas fa-pen-to-square"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete({{$service->id}}, '{{$service->nom_services}}')" title="Supprimer">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">{{ $services->links() }}</div>
    </div>
</div>

<!-- MODAL ADD SERVICE -->
<div class="modal fade asp-modal" id="addServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus-square me-2"></i> Ajouter un Service</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('admin.service.addService')}}" method="POST" id="addServiceForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold" for="serviceName">
                            <i class="fas fa-pencil-alt me-1 text-primary"></i> Libellé du service
                        </label>
                        <input type="text" id="serviceName" name="nom_services" class="form-control" 
                               placeholder="Ex: Direction des Ressources Humaines" required>
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#servicesTable').DataTable({
        language: { 
            url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json",
            search: "",
            searchPlaceholder: "Rechercher..."
        },
        dom: 'rtip',
        pageLength: 10,
        responsive: true,
        ordering: true,
        paging: true,
        lengthChange: false,
        info: false
    });

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
    @if($errors->any())
        Swal.fire({ 
            icon: 'error', 
            title: 'Erreur de validation', 
            html: '{!! implode("<br>", $errors->all()) !!}',
            confirmButtonColor: '#0B3D2E'
        });
    @endif

    // Form validation
    $('#addServiceForm').on('submit', function(e) {
        let serviceName = $('#serviceName').val().trim();
        
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

    // Reset form when modal is closed
    $('#addServiceModal').on('hidden.bs.modal', function() {
        $('#addServiceForm')[0].reset();
    });
});

// Delete confirmation function
function confirmDelete(id, name) {
    Swal.fire({
        title: 'Supprimer le service ?',
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
            window.location.href = "/admin/service/delete/" + id;
        }
    });
}
</script>

</body>
</html>