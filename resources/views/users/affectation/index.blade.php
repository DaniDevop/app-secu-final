<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Affectations - ASP Stages</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
    
    @include('users.ecole.style')
    
    <style>
        :root {
            --primary-color: #0c2461;
            --success-color: #198754;
            --danger-color: #dc3545;
            --warning-color: #f39c12;
        }

        .main-content { padding: 20px; }
        
        /* Bouton Excel Custom */
        .btn-export-excel {
            background-color: var(--success-color) !important;
            color: white !important;
            border: none !important;
            border-radius: 8px !important;
            padding: 10px 20px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .btn-export-excel:hover {
            background-color: #146c43 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3);
        }

        /* Badges de Statut */
        .badge-status {
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            display: inline-block;
        }
        .status-encours { background-color: #e3f2fd; color: #0d6efd; border: 1px solid #0d6efd; }
        .status-termine { background-color: #d1e7dd; color: #0f5132; border: 1px solid #0f5132; }
        .status-annule { background-color: #f8d7da; color: #842029; border: 1px solid #842029; }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .action-btns .btn {
            width: 35px;
            height: 35px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            margin: 0 2px;
        }
    </style>
</head>
<body>

    @include('style.sidebar')

    <div class="main-content" id="mainContent">
        <header class="main-header mb-4">
            <div class="header-left">
                <h1><i class="fas fa-clipboard-list text-primary"></i> Suivi des Affectations</h1>
                <p class="text-muted">Gérez les statuts et exportez vos listes filtrées</p>
            </div>
            <div class="header-right d-flex align-items-center">
                <div class="search-box me-3">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Rechercher un stagiaire, une école...">
                </div>
            </div>
        </header>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div id="exportButtonsContainer">
                </div>
            <button class="btn-add" data-bs-toggle="modal" data-bs-target="#addSchoolModal">
                <i class="fas fa-plus-circle me-2"></i>Nouvelle Affectation
            </button>
        </div>

        <div class="table-container">
            <table id="schoolsTable" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th>Matricule</th>
                        <th>Agent / Stagiaire</th>
                        <th>Service & Grade</th>
                        <th>Établissement</th>
                        <th>Période de Stage</th>
                        <th>Statut</th>
                        <th class="no-export text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($affectations as $affect)
                    <tr>
                         <td>
                            <div class="text-primary fw-bold">
                                <i class="fas fa-school me-1"></i>{{ $affect->agent?->matricule }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle me-2 bg-light text-primary d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; border-radius: 50%;">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div>
                                    <span class="fw-bold d-block">{{ $affect->agent?->name }}</span>
                                    <small class="text-muted">{{ $affect->agent?->prenom }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $affect->agent?->grade }}</span><br>
                            <small class="text-muted"><i class="fas fa-building me-1"></i>{{ $affect->agent?->services?->nom_services }}</small>
                        </td>
                        <td>
                            <div class="text-primary fw-bold">
                                <i class="fas fa-school me-1"></i>{{ $affect->ecoles?->nom_ecole }}
                            </div>
                        </td>
                        <td>
                            <div style="font-size: 0.85rem;">
                                <span class="text-success">Début:</span> {{ \Carbon\Carbon::parse($affect->date_debut)->format('d/m/Y') }}<br>
                                <span class="text-danger">Fin:</span> {{ \Carbon\Carbon::parse($affect->date_fin)->format('d/m/Y') }}
                            </div>
                        </td>
                        <td>
                            @php
                                $st = strtolower($affect->status);
                                $statusLabel = $affect->status ?? 'En cours';
                                $class = 'status-encours';
                                if($st == 'terminé' || $st == 'termine') $class = 'status-termine';
                                if($st == 'annulé' || $st == 'annule') $class = 'status-annule';
                            @endphp
                            <span class="badge-status {{ $class }}">{{ $statusLabel }}</span>
                        </td>
                        <td class="no-export text-center">
                            <div class="action-btns">
                                <a href="{{ route('users.editAffectationt.agent', $affect->id) }}" class="btn btn-outline-primary" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>

                                @if($st !== 'terminé' && $st !== 'termine')
                                <button onclick="changeStatus({{ $affect->id }}, 'Terminé')" class="btn btn-outline-success" title="Valider comme terminé">
                                    <i class="fas fa-check"></i>
                                </button>
                                @endif

                                @if($st !== 'annulé' && $st !== 'annule')
                                <button onclick="changeStatus({{ $affect->id }}, 'Annulé')" class="btn btn-outline-danger" title="Annuler le stage">
                                    <i class="fas fa-times"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">
        {{ $affectations->links() }}
    </div>
        </div>
    </div>

    <div class="modal fade asp-modal" id="addSchoolModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i>Nouvelle Affectation</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('users.affectation.addAffectation') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Date de Début</label>
                                <input type="date" name="date_debut" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Date de Fin</label>
                                <input type="date" name="date_fin" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small">Choisir l'Agent</label>
                                <select name="agent_stagiare_id" class="form-select select2" required>
                                    <option value="">Sélectionner...</option>
                                    @foreach($agentAll as $agent)
                                        <option value="{{ $agent->id }}">{{ $agent->name }} {{ $agent->prenom }} ({{ $agent->matricule }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small">École de Stage</label>
                                <select name="ecole_stage_id" class="form-select" required>
                                    <option value="">Sélectionner l'établissement...</option>
                                    @foreach($ecoleStageAll as $ecole)
                                        <option value="{{ $ecole->id }}">{{ $ecole->nom_ecole }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary px-4">Enregistrer l'affectation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialisation DataTable
            var table = $('#schoolsTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json"
                },
                "dom": 'Brtip',
                "buttons": [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel me-2"></i> Exporter la liste filtrée',
                        className: 'btn-export-excel',
                        title: 'Registre_Stages_ASP_' + new Date().toISOString().slice(0,10),
                        exportOptions: {
                            columns: "thead th:not(.no-export)", // Exclut la colonne Actions
                            modifier: {
                                page: 'current' // EXPORTE UNIQUEMENT LES DONNÉES FILTRÉES DU TABLEAU
                            }
                        }
                    }
                ],
                "pageLength": 10,
                "responsive": true,
                "paginate":false,
                "order": [[4, "asc"]] // Trie par statut par défaut
            });

            // Injection du bouton Excel dans le conteneur personnalisé
            table.buttons().container().appendTo('#exportButtonsContainer');

            // Barre de recherche personnalisée
            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Notification Success
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
        });

        // Fonction pour changer le statut via redirection (ou AJAX)
        function changeStatus(id, newStatus) {
            Swal.fire({
                title: 'Modifier le statut ?',
                text: "L'affectation passera au statut : " + newStatus,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0c2461',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, confirmer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirection vers votre route Laravel de mise à jour de statut
                    // Exemple: route('affectation.updateStatus', [id, status])
                    window.location.href = "/administration/affectation/status/" + id + "/" + newStatus;
                }
            });
        }
    </script>
</body>
</html>