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
</head>>
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
                <h1><i class="fas fa-university"></i> Gestion des stages</h1>
                <p>Administration et gestion des établissements partenaires</p>
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
            <button class="btn-add" id="addSchoolBtn" type="button" data-bs-toggle="modal" data-bs-target="#addSchoolModal">
                <i class="fas fa-plus-circle"></i>
                Modifier l'affectation
            </button>
        </div>

        <!-- Message de notification -->
        <div class="message" id="notificationMessage"></div>

        <!-- Tableau des écoles -->
       <div class="table-container">
  <table id="schoolsTable">
    <thead>
        <tr>
            <th>Numéro</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Grade</th>
            <th>Service</th>
            <th>École</th>
        </tr>
    </thead>

    <tbody>
    
        <tr>
            <!-- Numéro -->
            <td>
                <i class="fas fa-hashtag text-primary me-2"></i>
                {{ $affect->id }}
            </td>

            <!-- Nom -->
            <td>
                <i class="fas fa-user text-secondary me-2"></i>
                {{ $affect->agent?->name }}
            </td>

            <!-- Prénom -->
            <td>
                <i class="fas fa-user text-secondary me-2"></i>
                {{ $affect->agent?->prenom }}
            </td>

            <!-- Grade -->
            <td>
                <i class="fas fa-id-badge text-info me-2"></i>
                {{ $affect->agent?->grade }}
            </td>

            <!-- Service -->
            <td>
                <i class="fas fa-building text-warning me-2"></i>
                {{ $affect->agent?->services?->nom_services }}
            </td>

            <!-- École -->
            <td>
                <i class="fas fa-school text-success me-2"></i>
                {{ $affect->ecoles?->nom_ecole }}
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
    <div class="modal fade asp-modal" id="addSchoolModal" tabindex="-1" aria-labelledby="addSchoolModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSchoolModalLabel">
                        <i class="fas fa-university"></i> Modifier l'affectation
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
               <form id="schoolForm" action="{{ route('users.EditAffectation.Agent') }}" method="POST">
    @csrf

    <!-- Dates -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="date_debut">
                    <i class="fas fa-calendar-alt"></i> Date de début
                </label>
                <input type="date"
                       id="date_debut"
                       name="date_debut"
                       class="form-control"
                       value="{{ $affect->date_debut }}"
                       required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="date_fin">
                    <i class="fas fa-calendar-check"></i> Date de fin
                </label>
                <input type="date"
                       id="date_fin"
                       value="{{ $affect->date_fin }}"
                       name="date_fin"
                       class="form-control"
                       required>
            </div>
        </div>
    </div>

    <!-- Agent -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="agent_stagiare_id">
                    <i class="fas fa-user"></i> Agent
                </label>
                <select id="agent_stagiare_id"
                        name="agent_stagiare_id"
                        class="form-control"
                        required>
                    <option value="{{ $affect->agent_stagiare_id }}">{{ $affect->agent->name }}</option>
                    @foreach($agentAll as $agent)
                        <option value="{{ $agent->id }}">
                            Nom : {{ $agent->name }} | Matricule : {{ $agent->matricule }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- École -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="ecole_stage_id">
                    <i class="fas fa-school"></i> École de stage
                </label>
                <select id="ecole_stage_id"
                        name="ecole_stage_id"
                        class="form-control"
                        required>
                    <option value="{{ $affect->ecole_stage_id}}">{{ $affect->ecoles->nom_ecole }}</option>
                    @foreach($ecoleStageAll as $ecole)
                        <option value="{{ $ecole->id }}">
                            {{ $ecole->nom_ecole }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Footer -->
     <input type="hidden" value="{{$affect->id}}" name="id">
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Annuler
        </button>
        <button type="submit" class="btn btn-primary">
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
        "responsive": true
    });

    // Liaison de votre input de recherche personnalisé
    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });
});
    </script>

</body>
</html>