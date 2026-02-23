<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
<title>Modifier École - ASP Stages</title>

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

<!-- Sidebar -->
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

    <!-- Bouton Modifier -->
    <div class="d-flex justify-content-end mb-4">
        <button class="btn-add" id="editSchoolBtn" data-bs-toggle="modal" data-bs-target="#editSchoolModal">
            <i class="fas fa-edit me-1"></i> Modifier les informations
        </button>
    </div>

    <!-- Tableau des informations -->
    <div class="table-container">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th width="35%"><i class="fas fa-university me-2"></i>Nom de l'École</th>
                    <th width="50%"><i class="fas fa-map-marker-alt me-2"></i>Adresse</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <i class="fas fa-university me-2" style="color: var(--primary);"></i>
                        <strong>{{$ecole->nom_ecole}}</strong>
                    </td>
                    <td>
                        <i class="fas fa-map-marker-alt me-2" style="color: var(--gray);"></i>
                        {{$ecole->adresse}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal de modification -->
    <div class="modal fade asp-modal" id="editSchoolModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i> Modifier l'école</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('admin.ecole.SaveEditEcole')}}" method="POST" id="editSchoolForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-4">
                            <label for="schoolName" class="form-label">
                                <i class="fas fa-university me-1 text-primary"></i> Nom de l'école *
                            </label>
                            <input type="text" class="form-control" id="schoolName" name="nom_ecole" 
                                   value="{{$ecole->nom_ecole}}" placeholder="Ex: Université de Paris" required>
                        </div>
                        <div class="mb-3">
                            <label for="schoolAddress" class="form-label">
                                <i class="fas fa-map-marker-alt me-1 text-primary"></i> Adresse *
                            </label>
                            <textarea class="form-control" id="schoolAddress" name="adresse" 
                                      rows="4" placeholder="Ex: 12 Rue de l'Université, 75005 Paris" required>{{$ecole->adresse}}</textarea>
                        </div>
                        <input type="hidden" name="id" value="{{$ecole->id}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Annuler
                        </button>
                        <button type="submit" class="btn-submit">
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

    // Search functionality (if you have a list, otherwise this is just decorative)
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            // This is just for UI consistency, no actual search needed here
            console.log('Search:', this.value);
        });
    }

    // Success message
    @if(session('success'))
        Swal.fire({ 
            icon: 'success', 
            title: 'Succès !', 
            text: "{{session('success')}}", 
            toast: true, 
            position: 'top-end', 
            showConfirmButton: false, 
            timer: 3000,
            timerProgressBar: true
        });
    @endif

    // Error message
    @if(session('error'))
        Swal.fire({ 
            icon: 'error', 
            title: 'Erreur !', 
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
    const form = document.getElementById('editSchoolForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const schoolName = document.getElementById('schoolName').value.trim();
            const schoolAddress = document.getElementById('schoolAddress').value.trim();
            
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
    }
});
</script>

</body>
</html>