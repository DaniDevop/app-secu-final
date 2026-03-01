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
            <li><a href="{{route('admin.ecole.index')}}"><i class="fas fa-university"></i><span> Écoles</span></a></li>
            <li><a href="{{route('admin.service.index')}}" class="active"><i class="fas fa-briefcase"></i><span> Services</span></a></li>
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
        info: false,
        paginate:false
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

</script>

</body>
</html>