<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Écoles - ASP Stages</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        @include('users.ecole.style')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
   

    <div class="mobile-toggle" id="mobileToggle">
        <i class="fas fa-bars"></i>
    </div>

    <!-- Sidebar -->
    @include('style.sidebar')

    <!-- Contenu principal -->
    <div class="main-content" id="mainContent">
        <!-- Header -->
        <header class="main-header">
            <div class="header-left">
                <h1><i class="fas fa-university"></i> Gestion des Écoles</h1>
                <p>Administration et gestion des établissements partenaires</p>
            </div>
            <div class="header-right">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Rechercher une école...">
                </div>
                <div class="notification-bell">
                    <i class="fas fa-bell"></i>
                    <div class="notification-badge">3</div>
                </div>
            </div>
        </header>

        <!-- Bouton Ajouter -->
        <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
            <button class="btn-add" id="addSchoolBtn" type="button" data-bs-toggle="modal" data-bs-target="#addSchoolModal">
                <i class="fas fa-plus-circle"></i>
                Modifier les informations
            </button>
        </div>

        <!-- Message de notification -->
        <div class="message" id="notificationMessage">

          <!-- Message de notification -->
<div class="notification-container">
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif
    
    @if(session('message'))
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            {{ session('message') }}
        </div>
    @endif
</div>
        </div>

        <!-- Tableau des écoles -->
       <div class="table-container">
    <table id="schoolsTable">
        <thead>
            <tr>
                <th width="35%">Nom de l'École</th>
                <th width="50%">Adresse</th>    
            </tr>
        </thead>
        <tbody>
            
            <tr>
                <!-- Ici il faut utiliser td, pas th -->
                <td width="35%">
                    <div class="school-name">
                        <i class="fas fa-university" style="margin-right: 10px; color: var(--primary);"></i>
                        {{$ecole->nom_ecole}}
                    </div>
                </td>
                <td width="50%">
                    <div class="school-address">
                        <i class="fas fa-map-marker-alt" style="margin-right: 10px; color: var(--gray-500);"></i>
                        {{$ecole->adresse}}
                    </div>
                </td>
                
            </tr>
        
        </tbody>
    </table>
</div>

        <!-- Pagination -->
        <div class="pagination" id="pagination" style="display: none;">
            <!-- Les boutons de pagination seront générés ici -->
        </div>

        <!-- État vide -->
        <div class="empty-state" id="emptyState" style="display: none;">
            <div class="empty-icon">
                <i class="fas fa-university"></i>
            </div>
            <h3>Aucune école enregistrée</h3>
            <p>Commencez par ajouter votre première école partenaire.</p>
            <button class="btn-add" id="addFirstSchoolBtn" type="button" data-bs-toggle="modal" data-bs-target="#addSchoolModal">
                <i class="fas fa-plus-circle"></i>
                Modifier l'école
            </button>
        </div>
    </div>

    <!-- Modal d'ajout/modification Bootstrap -->
    <div class="modal fade asp-modal" id="addSchoolModal" tabindex="-1" aria-labelledby="addSchoolModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSchoolModalLabel">
                        <i class="fas fa-university"></i>                 Modifier l'école

                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="schoolForm"  action="{{route('admin.ecole.SaveEditEcole')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="schoolName">
                                <i class="fas fa-university"></i> Nom de l'école *
                            </label>
                            <input type="text" 
                                   id="schoolName" 
                                   name="nom_ecole"
                                   class="form-control" 
                                   placeholder="Ex: Université de Paris"

                                   value="{{$ecole->nom_ecole}}"
                                   required>
                            <div class="error-message" id="nameError">Le nom de l'école est requis</div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="schoolAddress">
                                <i class="fas fa-map-marker-alt"></i> Adresse complète *
                            </label>
                            <textarea id="schoolAddress" 
                                      class="form-control" 
                                      placeholder="Ex: 12 Rue de l'Université, 75005 Paris, France"
                                      rows="3"
                                      name="adresse"
                                      value="{{$ecole->adresse}}"
                                      required></textarea>
                            <div class="error-message" id="addressError">L'adresse est requise</div>
                        </div>

                        <!-- Champ caché pour l'ID (modification) -->
                        <input type="hidden" id="schoolId">
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                            Annuler
                        </button>
                        <button type="submit" class="btn btn-submit" id="submitBtn">
                            Enregistrer
                        </button>
                    </div>
                    <input type="hidden" value="{{$ecole->id}}" name="id">
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade delete-modal" id="deleteSchoolModal" tabindex="-1" aria-labelledby="deleteSchoolModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSchoolModalLabel">
                        <i class="fas fa-exclamation-triangle"></i> Confirmation
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer cette école ?</p>
                    <div class="school-name" id="schoolToDeleteName"></div>
                    <p style="font-size: 14px; color: var(--gray-600); margin-top: 10px;">
                        Cette action est irréversible.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                        Annuler
                    </button>
                    <button type="button" class="btn btn-delete" id="confirmDeleteBtn">
                        Supprimer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Variables globales
        let schools = [];
        let currentPage = 1;
        const itemsPerPage = 10;
        let editingSchoolId = null;
        let schoolToDeleteId = null;

        // Éléments DOM
        const schoolsTableBody = document.getElementById('schoolsTableBody');
        const emptyState = document.getElementById('emptyState');
        const pagination = document.getElementById('pagination');
        const loadingRow = document.getElementById('loadingRow');
        const notificationMessage = document.getElementById('notificationMessage');
        const searchInput = document.getElementById('searchInput');
        const schoolForm = document.getElementById('schoolForm');
        const addSchoolModal = new bootstrap.Modal(document.getElementById('addSchoolModal'));
        const deleteSchoolModal = new bootstrap.Modal(document.getElementById('deleteSchoolModal'));
        const addSchoolModalLabel = document.getElementById('addSchoolModalLabel');
        const schoolIdInput = document.getElementById('schoolId');

        // Fonction pour afficher le modal d'ajout
        function showAddModal() {
            addSchoolModalLabel.innerHTML = '<i class="fas fa-university"></i> Ajouter une école';
            schoolForm.reset();
            schoolIdInput.value = '';
            editingSchoolId = null;
            document.getElementById('schoolName').focus();
            addSchoolModal.show();
        }

    

       document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Succès !',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: "{{ session('error') }}",
                confirmButtonColor: '#0c2461'
            });
        @endif
        
        // Affichage des erreurs de validation (ex: nom_ecole requis)
        @if($errors->any())
            Swal.fire({
                icon: 'warning',
                title: 'Attention',
                html: '{!! implode("<br>", $errors->all()) !!}',
                confirmButtonColor: '#0c2461'
            });
        @endif
    });
    </script>

</body>
</html>