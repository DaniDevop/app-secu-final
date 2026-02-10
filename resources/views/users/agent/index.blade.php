<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Stagiaires - ASP Stages</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
    
    @include('users.ecole.style')
    
    <style>
        /* Style pour harmoniser les boutons d'exportation */
        .dt-buttons {
            margin-bottom: 20px;
            gap: 5px;
            display: flex;
        }
        .btn-export {
            border-radius: 8px !important;
            font-weight: 600 !important;
            padding: 8px 16px !important;
            transition: all 0.3s ease;
        }
        .btn-print { background-color: #6c757d !important; color: white !important; border: none !important; }
        .btn-excel { background-color: #198754 !important; color: white !important; border: none !important; }
        .btn-pdf { background-color: #dc3545 !important; color: white !important; border: none !important; }
        
        .btn-export:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.1); opacity: 0.9; }
    </style>
</head>
<body>

    <div class="mobile-toggle" id="mobileToggle">
        <i class="fas fa-bars"></i>
    </div>

    @include('style.sidebar')

    <div class="main-content" id="mainContent">
        <header class="main-header">
            <div class="header-left">
                <h1><i class="fas fa-user-graduate"></i> Gestion des Stagiaires</h1>
                <p>Liste des agents et stagiaires enregistrés</p>
            </div>
            <div class="header-right">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Rechercher par nom, matricule, service...">
                </div>
            </div>
        </header>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div id="exportButtonsContainer"></div>
            <button class="btn-add" id="addSchoolBtn" type="button" data-bs-toggle="modal" data-bs-target="#addStagiareModal">
                <i class="fas fa-plus-circle"></i> Ajouter un stagiaire
            </button>
        </div>

        <div class="table-container shadow-sm">
            <table id="schoolsTable" class="table table-hover w-100">
                <thead>
                    <tr>
                        <th>Matricule</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Grade</th>
                        <th>Service</th>
                        <th>Tel</th>
                        <th class="no-export">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stagiares as $stagiare)
                    <tr>
                        <td>
                            <div class="fw-bold text-primary">
                                <i class="fas fa-id-card me-2"></i>{{$stagiare->matricule}}
                            </div>
                        </td>
                        <td>{{$stagiare->name}}</td>
                        <td>{{$stagiare->prenom}}</td>
                        <td><span class="badge bg-light text-dark border">{{$stagiare->grade}}</span></td>
                        <td>{{ $stagiare->services->nom_services }}</td>
                        <td>{{ $stagiare->tel }}</td>
                        <td class="no-export">
                            <div class="actions">
                                <a class="btn-action btn-edit" title="Modifier" href="{{ route('users.editAgentStagiare', $stagiare->id) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">
        {{ $stagiares->links() }}
    </div>
        </div>
    </div>

  <div class="modal fade" id="addStagiareModal" tabindex="-1" aria-labelledby="addStagiareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addStagiareModalLabel">
                    <i class="fas fa-user-plus me-2"></i> Nouveau Stagiaire
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="stagiareForm" action="{{route('users.addAgent.Stagiare')}}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold"><i class="fas fa-id-card text-primary me-1"></i> Matricule *</label>
                            <input type="text" name="matricule" class="form-control @error('matricule') is-invalid @enderror" placeholder="Ex: STG-2026" required value="{{ old('matricule') }}">
                            @error('matricule') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold"><i class="fas fa-building text-primary me-1"></i> Service *</label>
                            <select name="service_id" class="form-select" required>
                                <option value="" selected disabled>Choisir un service...</option>
                                @foreach($servicesAll as $service)
                                    <option value="{{ $service->id }}">{{ $service->nom_services }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold"><i class="fas fa-user text-primary me-1"></i> Nom *</label>
                            <input type="text" name="name" class="form-control" placeholder="Nom de famille" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold"><i class="fas fa-user text-primary me-1"></i> Prénom *</label>
                            <input type="text" name="prenom" class="form-control" placeholder="Prénoms" required>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold"><i class="fas fa-medal text-primary me-1"></i> Grade *</label>
                            <select name="grade" class="form-select" required>
                                <option value="" selected disabled>Sélectionner le grade</option>
                                <optgroup label="Sous-Officiers">
                                    <option value="caporal">Caporal</option>
                                    <option value="Caporal-chef">Caporal chef</option>
                                    <option value="sergent">Sergent</option>
                                    <option value="sergent-chef">Sergent chef</option>
                                </optgroup>
                                <optgroup label="Officiers">
                                    <option value="Sous-lieutenant">Sous-lieutenant</option>
                                    <option value="Lieutenant">Lieutenant</option>
                                    <option value="Capitaine">Capitaine</option>
                                    <option value="Colonel">Colonel</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold"><i class="fas fa-phone text-primary me-1"></i> Téléphone *</label>
                            <input type="text" name="tel" class="form-control @error('tel') is-invalid @enderror" placeholder="Ex: 06 00 00 00" required>
                            @error('tel') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light border-0 px-4">
                    <button type="button" class="btn btn-secondary px-4 shadow-sm" data-bs-dismiss="modal text-uppercase fw-bold" style="font-size: 13px;">Annuler</button>
                    <button type="submit" class="btn btn-primary px-4 shadow-sm text-uppercase fw-bold" style="font-size: 13px;">
                        <i class="fas fa-save me-2"></i> Enregistrer l'agent
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
    
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            var table = $('#schoolsTable').DataTable({
                "language": { "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json" },
                "dom": 'Brtip', // 'B' active les boutons
                "buttons": [
                   
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel me-2"></i> Excel',
                        className: 'btn-export btn-excel',
                        exportOptions: {
                            columns: ':not(.no-export)',
                            modifier: { page: 'current' } // EXPORTE UNIQUEMENT CE QUI EST FILTRÉ
                        }
                    }
                ],
                "pageLength": 10,
                "responsive": true,
                "paginate":false
            });

            // Déplace les boutons vers notre conteneur pour un meilleur design
            table.buttons().container().appendTo('#exportButtonsContainer');

            // Recherche personnalisée liée à votre input
            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });

            // SweetAlerts
            @if(session('success'))
                Swal.fire({ icon: 'success', title: 'Succès', text: "{{ session('success') }}", timer: 3000, showConfirmButton: false, toast: true, position: 'top-end' });
            @endif
        });
    </script>

</body>
</html>