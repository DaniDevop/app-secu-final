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

  @include('users.services.style')

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
            <li><a href="{{route('users.affectation.agent')}}"><i class="fas fa-exchange-alt"></i><span> Stages / Affectations</span></a></li>
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

    <div class="d-flex justify-content-end mb-4">
        <button class="btn-add" id="addSchoolBtn" type="button" data-bs-toggle="modal" data-bs-target="#addSchoolModal">
            <i class="fas fa-plus-circle"></i> Ajouter une école
        </button>
    </div>

 <div class="table-container">
    <table id="schoolsTable" class="table table-hover align-middle">
        <thead>
            <tr>
                <th><i class="fas fa-school me-2"></i>Nom de l'École</th>
                <th><i class="fas fa-globe me-2"></i>Pays</th>
                <th><i class="fas fa-user-graduate me-2"></i>Stagiaires</th>
                <th class="text-center"><i class="fas fa-cogs me-2"></i>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ecoles as $ecole)
            <tr>
                <td data-label="Nom de l'École">
                    <i class="fas fa-school text-primary me-2"></i>
                    {{$ecole->nom_ecole}}
                </td>
                <td data-label="Pays">
                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                    {{$ecole->adresse}}
                </td>
                <td data-label="Stagiaires">
                    <a class="btn btn-sm btn-outline-info" title="Voir les stagiaires" href="{{route('admin.ecole.agentByEcole', $ecole->id)}}">
                        <i class="fas fa-users me-1"></i> 
                        <span>Stagiaires</span>
                    </a>
                </td>
                <td class="text-center" data-label="Actions">
                    <div class="btn-group" role="group">
                        <a class="btn btn-sm btn-outline-primary" title="Modifier l'école" href="{{route('admin.ecole.edit', $ecole->id)}}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger" title="Supprimer l'école" onclick="confirmDelete({{$ecole->id}}, '{{$ecole->nom_ecole}}')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Zone de pagination personnalisée -->
    <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
        <div class="dataTables_info" id="schoolsTable_info" role="status" aria-live="polite">
            Affichage de 1 à 10 sur X entrées
        </div>
        <div class="dataTables_paginate paging_simple_numbers" id="schoolsTable_paginate">
            <!-- La pagination sera générée automatiquement par DataTables -->
        </div>
    </div>
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
                            <label class="form-label fw-bold" for="schoolName">
                                 Pays *
                            </label>
                            <input type="text" id="schoolName" name="pays" class="form-control" placeholder="Ex: Gabon" required>
                        </div>
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