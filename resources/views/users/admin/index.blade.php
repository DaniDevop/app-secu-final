<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Écoles - ASP Stages</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
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
    Ajouter un admin
</button>
        </div>

        <!-- Message de notification -->
        <div class="message" id="notificationMessage"></div>

        <!-- Tableau des écoles -->
       <div class="table-container">
<table id="schoolsTable" class="table table-hover w-100">
            <thead>
            <tr>
                <th width="35%">Numéro</th>
                <th width="50%">Nom </th>
                <th width="15%">Prenom</th>
                <th width="15%">Grade</th>
                <th width="15%">Tel</th>
                <th width="15%">Actions</th>

            </tr>
        </thead>
       <tbody>
    @foreach($stagiares as $stagiare)
    <tr>
        <td>
            <div class="school-name">
                <i class="fas fa-id-card" style="margin-right: 10px; color: var(--primary);"></i>
                {{$stagiare->id}}
            </div>
        </td>
        <td>{{$stagiare->name}}</td>
        <td>{{$stagiare->prenom}}</td>
        <td><span class="badge bg-light text-dark">{{$stagiare->grade}}</span></td>
        <td>{{ $stagiare->tel }}</td> <td>
            <div class="actions">
                <a class="btn-action btn-edit" title="Modifier" href="">
                    <i class="fas fa-edit"></i>
                </a>
                
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
    </table>
    {{$stagiares->links()}}
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
                    <i class="fas fa-user-graduate"></i> Ajouter un admin
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="stagiareForm" action="{{route('admin.add.admin')}}" method="POST">
                @csrf
                <div class="modal-body">
                   
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                
                                
                                        @error('matricule')
                        <div class="invalid-feedback d-block">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
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
                                       class="form-control" 
                                       placeholder="Nom "
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
                                       class="form-control" 
                                       placeholder="Prénom "
                                       required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="grade">
                                    <i class="fas fa-graduation-cap"></i> Grade *
                                </label>
                                <select id="grade" name="grade" class="form-control" required>
                                    <option value="">Sélectionner un grade</option>
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
                                       class="form-control" 
                                       placeholder="Phone Ex:06.... "
                                       required>
                                        @error('tel')
                        <div class="invalid-feedback d-block">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                            </div>
                        </div>
                        
                    </div>


         <div class="col-md-6">
    <div class="form-group">
        <label class="form-label" for="password">
            <i class="fas fa-lock"></i> Mot de passe *
        </label>
        <input type="password"
               id="password"
               name="password"
               class="form-control"
               placeholder="Mot de passe"
               minlength="4"
               required>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label class="form-label" for="password_confirmation">
            <i class="fas fa-lock"></i> Confirmation du mot de passe *
        </label>
        <input type="password"
               id="password_confirmation"
               name="password2"
               class="form-control"
               placeholder="Confirmer le mot de passe"
               minlength="4"
               required>
    </div>
</div>

                
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
       

        // Fonction pour afficher le modal d'ajout
        function showAddModal() {
            addSchoolModalLabel.innerHTML = '<i class="fas fa-university"></i> Ajouter une école';
            schoolForm.reset();
            schoolIdInput.value = '';
            editingSchoolId = null;
            document.getElementById('schoolName').focus();
            addSchoolModal.show();
        }

    

       $(document).ready(function() {
    // Initialisation de DataTable
    var table = $('#schoolsTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json"
        },
        "dom": 'rtip', // Cache la barre de recherche par défaut de DT pour utiliser la vôtre
        "pageLength": 10,
        "ordering": true,
        "responsive": true,
        "paginate":false
    });

    // Liaison de votre input de recherche personnalisé
    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });
});



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

    document.getElementById('stagiareForm').addEventListener('submit', function (e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('password_confirmation').value;

    // Vérification longueur minimale
    if (password.length < 4) {
        e.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: 'Mot de passe trop court',
            text: 'Le mot de passe doit contenir au moins 4 caractères'
        });
        return;
    }

    // Vérification correspondance
    if (password !== confirmPassword) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'Les mots de passe ne correspondent pas'
        });
        return;
    }
});
    </script>



</body>
</html>