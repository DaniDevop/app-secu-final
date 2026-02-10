<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Écoles - ASP Stages</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        @include('users.ecole.style')

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
                <h1><i class="fas fa-university"></i> Gestion des Stages</h1>
                <p>Administration de gestions des stages</p>
            </div>
            <div class="header-right">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Rechercher une école...">
                </div>
               
            </div>
        </header>

        <!-- Bouton Ajouter -->
        <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
           <button class="btn-add" id="addSchoolBtn" type="button" data-bs-toggle="modal" data-bs-target="#addStagiareModal">
    <i class="fas fa-plus-circle"></i>
    Modifier Le stagiaire
</button>
        </div>

        <!-- Message de notification -->
        <div class="message" id="notificationMessage"></div>

        <!-- Tableau des écoles -->
       <div class="table-container">
    <table id="schoolsTable">
        <thead>
            <tr>
                <th width="35%">Matricule</th>
                <th width="50%">Nom </th>
                <th width="15%">Prenom</th>
                <th width="15%">Grade</th>
                <th width="15%">Services</th>
                <th width="15%">Tel</th>
            </tr>
        </thead>
        <tbody>
            
            <tr>
                <!-- Ici il faut utiliser td, pas th -->
                <td width="35%">
                    <div class="school-name">
                        <i class="fas fa-university" style="margin-right: 10px; color: var(--primary);"></i>
                        {{$stagiareAgent->matricule}}
                    </div>
                </td>
                <td width="50%">
                    <div class="school-address">
                        <i class="fas fa-map-marker-alt" style="margin-right: 10px; color: var(--gray-500);"></i>
                        {{$stagiareAgent->name}}
                    </div>
                </td>

                <td width="50%">
                    <div class="school-address">
                        <i class="fas fa-map-marker-alt" style="margin-right: 10px; color: var(--gray-500);"></i>
                        {{$stagiareAgent->prenom}}
                    </div>
                </td>
                <td width="50%">
                    <div class="school-address">
                        <i class="fas fa-map-marker-alt" style="margin-right: 10px; color: var(--gray-500);"></i>
                        {{$stagiareAgent->grade}}
                    </div>
                </td>

                <td width="50%">
                    <div class="school-address">
                        <i class="fas fa-map-marker-alt" style="margin-right: 10px; color: var(--gray-500);"></i>
                    {{ $stagiareAgent->services->nom_services }}
                    </div>
                </td>
                <td width="50%">
                    <div class="school-address">
                        <i class="fas fa-map-marker-alt" style="margin-right: 10px; color: var(--gray-500);"></i>
                    {{ $stagiareAgent->tel }}
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
                Ajouter une école
            </button>
        </div>
    </div>

    <!-- Modal d'ajout/modification Bootstrap -->
  <div class="modal fade asp-modal" id="addStagiareModal" tabindex="-1" aria-labelledby="addStagiareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStagiareModalLabel">
                    <i class="fas fa-user-graduate"></i> Ajouter un stagiaire
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="stagiareForm" action="{{route('users.EditgentStagiare')}}" method="POST">
                @csrf
                <div class="modal-body">
                   
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="matricule">
                                    <i class="fas fa-id-card"></i> Matricule *
                                </label>
                                <input type="text" 
                                       id="matricule" 
                                       name="matricule"
                                       class="form-control" 
                                       placeholder="Ex: STG2024001"
                                       value="{{$stagiareAgent->matricule}}"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="nom">
                                    <i class="fas fa-user"></i> Nom *
                                </label>
                                <input type="text" 
                                       id="nom" 
                                       name="name"
                                       value="{{$stagiareAgent->name}}"
                                       class="form-control" 
                                       placeholder="Nom du stagiaire"
                                       required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="prenom">
                                    <i class="fas fa-user"></i> Prénom *
                                </label>
                                <input type="text" 
                                       id="prenom" 
                                       name="prenom"
                                       value="{{$stagiareAgent->prenom}}"
                                       class="form-control" 
                                       placeholder="Prénom du stagiaire"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="grade">
                                    <i class="fas fa-graduation-cap"></i> Grade *
                                </label>
                                <select id="grade" name="grade" class="form-control" required>
                                    <option  value="{{$stagiareAgent->grade}}">{{$stagiareAgent->grade}}  </option>
                                    <option value="caporal">Caporal</option>
                                    <option value="Caporal-chef">Caporal chef</option>
                                    <option value="sergent">Sergent</option>
                                    <option value="sergent-cheft">Sergent chef</option>
                                    <option value="sergent-chef-major">Sergent chef major</option>
                                    <option value="Adjudant">Adjudant</option>
                                     <option value="Adjudant-chef">Adjudant chef</option>
                                    <option value="Adjudant-chef-major">Adjudant chef major</option>
                                    <option value="Sous-lieutenant">Sous-lieutenant</option>
                                    <option value="Lieutenant">Lieutenant</option>
                                    <option value="Capitaine">Capitaine</option>
                                    <option value="Commandant">Commandant</option>
                                    <option value="Lieutenant-colonel">Lieutenant colonel</option>
                                    <option value="Colonel">Colonel</option>
                                </select>
                            </div>
                        </div>
                    </div>




                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="prenom">
                                    <i class="fas fa-user"></i> Telephone *
                                </label>
                                <input type="text" 
                                       id="prenom" 
                                       name="tel"
                                        value="{{$stagiareAgent->tel}}"
                                       class="form-control" 
                                       placeholder="Phone Ex:06.... "
                                       required>
                            </div>
                        </div>
                        
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="service_id">
                                    <i class="fas fa-building"></i> Service *
                                </label>
                                <select id="service_id" name="service_id"  value="{{$stagiareAgent->service_agent_id}}" class="form-control" required>
                                    <option value="{{$stagiareAgent->service_agent_id}}">{{$stagiareAgent->services->nom_services}}</option>
                                    @foreach($servicesAll as $service)
                                        <option value="{{ $service->id }}">{{ $service->nom_services }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    

                </div>
                  <input type="hidden" name="id" value="{{$stagiareAgent->id}}">
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-submit" id="submitBtn">
                        Enregistrer
                    </button>
                </div>
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