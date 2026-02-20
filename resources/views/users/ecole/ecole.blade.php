<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
<title>Gestion des Écoles - ASP Stages</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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
    padding: 25px 30px; 
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
    margin-bottom: 25px;
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
    padding: 20px;
    overflow-x: auto;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    margin-bottom: 20px;
    -webkit-overflow-scrolling: touch;
}

.table {
    width: 100%;
    margin-bottom: 0;
    min-width: 600px;
}

.table th, 
.table td { 
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

/* ================== EMPTY STATE ================== */
.empty-state {
    text-align: center;
    padding: 50px 20px;
    background: white;
    border-radius: 20px;
    margin-top: 20px;
    display: none;
}

.empty-icon {
    font-size: 70px;
    color: var(--gray);
    opacity: 0.3;
    margin-bottom: 20px;
}

.empty-state h3 {
    color: var(--text);
    margin-bottom: 10px;
}

.empty-state p {
    color: var(--gray);
    margin-bottom: 20px;
}

/* ================== MODAL ================== */
.asp-modal .modal-content {
    border-radius: 20px;
    border: none;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
}

.asp-modal .modal-header {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: white;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
    padding: 20px 25px;
}

.asp-modal .modal-body {
    padding: 25px;
}

.asp-modal .form-control { 
    border-radius: 12px; 
    padding: 12px 15px; 
    border: 2px solid #e9ecef;
    transition: all 0.3s;
}

.asp-modal .form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(11, 61, 46, 0.1);
    outline: none;
}

.asp-modal .modal-footer { 
    border-top: none; 
    padding: 20px 25px;
    background: #f8f9fa;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
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
    
    .d-flex.justify-content-end {
        justify-content: stretch !important;
    }
    
    .table th, 
    .table td {
        padding: 12px 8px;
        font-size: 14px;
    }
}

@media screen and (max-width: 480px) {
    .main-header {
        padding: 15px;
    }
    
    .main-content {
        padding: 15px 10px;
    }
    
    .table-container {
        padding: 15px 10px;
        border-radius: 15px;
    }
    
    .table th, 
    .table td {
        font-size: 13px;
        padding: 10px 5px;
    }
    
    .btn-add {
        padding: 10px 15px;
        font-size: 14px;
    }
    
    .empty-icon {
        font-size: 50px;
    }
    
    .empty-state h3 {
        font-size: 18px;
    }
    
    .asp-modal .modal-dialog {
        margin: 10px;
    }
    
    .asp-modal .modal-body {
        padding: 20px 15px;
    }
}

@media screen and (min-width: 1400px) {
    .main-content {
        max-width: 1600px;
        margin: 0 auto;
    }
}

@media (hover: none) and (pointer: coarse) {
    .menu a,
    .btn-add,
    .page-link,
    .btn-sm {
        padding: 15px 20px;
        font-size: 16px;
    }
    
    .table td .btn-sm {
        padding: 8px 12px;
        margin: 2px;
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
            <li><a href="{{route('admin.ecole.index')}}" class="active"><i class="fas fa-university"></i><span> Écoles</span></a></li>
            <li><a href="{{route('admin.service.index')}}"><i class="fas fa-briefcase"></i><span> Services</span></a></li>
            <li><a href="{{route('admin.listes.Admin')}}"><i class="fas fa-users-cog"></i><span> Administrations</span></a></li>
            <li><a href="{{route('users.affectation.agent')}}"><i class="fas fa-chalkboard-teacher"></i><span> Stages / Affectations</span></a></li>
        </ul>
    </div>
    <div class="sidebar-footer">Application interne sécurisée</div>
</div>

<div class="main-content" id="mainContent">

    <header class="main-header">
        <div class="header-text">
            <h1><i class="fas fa-university"></i> Gestion des Écoles</h1>
            <p>Administration et gestion des établissements partenaires</p>
        </div>
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Rechercher une école...">
        </div>
    </header>

    <div class="d-flex justify-content-end mb-4">
        <button class="btn-add" id="addSchoolBtn" type="button" data-bs-toggle="modal" data-bs-target="#addSchoolModal">
            <i class="fas fa-plus-circle"></i> Ajouter une école
        </button>
    </div>

    <div class="table-container">
        <table id="schoolsTable" class="table table-hover align-middle">
            <thead>
                <tr>
                    <th><i class="fas fa-university me-2"></i>Nom de l'École</th>
                    <th><i class="fas fa-map-marker-alt me-2"></i>Adresse</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ecoles as $ecole)
                <tr>
                    <td data-label="Nom de l'École">{{$ecole->nom_ecole}}</td>
                    <td data-label="Adresse">{{$ecole->adresse}}</td>
                    <td class="text-center" data-label="Actions">
                        <a class="btn btn-sm btn-outline-primary" title="Modifier" href="{{route('admin.ecole.edit', $ecole->id)}}">
                            <i class="fas fa-pen-to-square"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete({{$ecole->id}}, '{{$ecole->nom_ecole}}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-3">{{ $ecoles->links() }}</div>
    </div>

    <div class="empty-state" id="emptyState">
        <div class="empty-icon"><i class="fas fa-university"></i></div>
        <h3>Aucune école enregistrée</h3>
        <p>Commencez par ajouter votre première école partenaire.</p>
        <button class="btn-add" id="addFirstSchoolBtn" data-bs-toggle="modal" data-bs-target="#addSchoolModal">
            <i class="fas fa-plus-circle"></i> Ajouter une école
        </button>
    </div>

    <!-- MODAL ADD / EDIT SCHOOL -->
    <div class="modal fade asp-modal" id="addSchoolModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-university me-2"></i> Ajouter / Modifier une école</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="schoolForm" action="{{route('admin.ecole.addEcole')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold" for="schoolName">
                                <i class="fas fa-university me-1 text-primary"></i> Nom de l'école *
                            </label>
                            <input type="text" id="schoolName" name="nom_ecole" class="form-control" placeholder="Ex: Université de Paris" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold" for="schoolAddress">
                                <i class="fas fa-map-marker-alt me-1 text-primary"></i> Adresse *
                            </label>
                            <textarea id="schoolAddress" name="adresse" class="form-control" placeholder="Ex: 12 Rue de l'Université, 75005 Paris" rows="3" required></textarea>
                        </div>
                        <input type="hidden" id="schoolId" name="id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#schoolsTable').DataTable({
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

    // Show/hide empty state based on table rows
    function toggleEmptyState() {
        if (table.rows().count() === 0) {
            $('.table-container').hide();
            $('#emptyState').show();
        } else {
            $('.table-container').show();
            $('#emptyState').hide();
        }
    }
    
    toggleEmptyState();
    table.on('draw', function() {
        toggleEmptyState();
    });

    // Form validation
    $('#schoolForm').on('submit', function(e) {
        let schoolName = $('#schoolName').val().trim();
        let schoolAddress = $('#schoolAddress').val().trim();
        
        if (schoolName === '' || schoolAddress === '') {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Champs obligatoires',
                text: 'Veuillez remplir tous les champs obligatoires.',
                confirmButtonColor: '#0B3D2E'
            });
        }
    });

    // Reset form when modal is closed
    $('#addSchoolModal').on('hidden.bs.modal', function() {
        $('#schoolForm')[0].reset();
        $('#schoolId').val('');
    });
});

// Delete confirmation function
function confirmDelete(id, name) {
    Swal.fire({
        title: 'Supprimer cette école ?',
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
            window.location.href = "/admin/ecole/delete/" + id;
        }
    });
}
</script>

</body>
</html>