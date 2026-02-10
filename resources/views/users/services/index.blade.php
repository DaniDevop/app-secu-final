<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Services - ASP Stages</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    @include('users.ecole.style')
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <div class="mobile-toggle" id="mobileToggle">
        <i class="fas fa-bars"></i>
    </div>

    @include('style.sidebar')

    <div class="main-content" id="mainContent">
        <header class="main-header">
            <div class="header-left">
                <h1><i class="fas fa-sitemap"></i> Gestion des Services</h1>
                <p>Organisation interne et départements</p>
            </div>
            <div class="header-right">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Rechercher un service...">
                </div>
                
            </div>
        </header>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="breadcrumb-mini">
                <span class="text-muted">Administration</span> / <strong>Services</strong>
            </div>
            <button class="btn-add" id="addSchoolBtn" type="button" data-bs-toggle="modal" data-bs-target="#addSchoolModal">
                <i class="fas fa-plus-circle me-1"></i>
                Nouveau Service
            </button>
        </div>

        <div class="table-container shadow-sm border-0">
            <table id="schoolsTable" class="table table-hover align-middle">
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
                        <td>
                            <span class="fw-bold text-secondary">#{{$service->id}}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="icon-box me-3 bg-light text-primary d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; border-radius: 8px;">
                                    <i class="fas fa-door-open"></i>
                                </div>
                                <span class="fw-semibold">{{$service->nom_services}}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a class="btn btn-sm btn-outline-primary" title="Modifier" href="{{ route('admin.service.edit', $service->id) }}">
                                    <i class="fas fa-pen-to-square"></i>
                                </a>
                               
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">
        {{ $services->links() }}
    </div>
        </div>
    </div>

    <div class="modal fade asp-modal" id="addSchoolModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-plus-square me-2"></i> Ajouter un Service
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="schoolForm" action="{{route('admin.service.addService')}}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold" for="schoolName">
                                <i class="fas fa-pencil-alt me-1 text-primary"></i> Libellé du service
                            </label>
                            <input type="text" 
                                   id="schoolName" 
                                   name="nom_services"
                                   class="form-control form-control-lg shadow-sm" 
                                   placeholder="Ex: Direction des Ressources Humaines"
                                   required>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary px-4 shadow">
                            <i class="fas fa-save me-1"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Initialisation de DataTable
            var table = $('#schoolsTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json"
                },
                "dom": 'rtip',
                "pageLength": 10,
                "ordering": true,
                "responsive": true,
                "paginate":false
            });

            // Barre de recherche personnalisée
            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Notifications SweetAlert2
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Opération réussie',
                    text: "{{ session('success') }}",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur de validation',
                    html: '{!! implode("<br>", $errors->all()) !!}',
                });
            @endif
        });

        // Fonction de suppression (contextuelle)
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Supprimer le service ?',
                text: "Êtes-vous sûr de vouloir supprimer : " + name,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Ajoutez ici votre logique de redirection ou d'appel AJAX pour la suppression
                    window.location.href = "/admin/service/delete/" + id;
                }
            });
        }
    </script>
</body>
</html>