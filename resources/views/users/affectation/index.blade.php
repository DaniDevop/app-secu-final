<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestion des Affectations - ASP Stages</title>

<!-- CSS externes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<style>
/* ================== THEME ================== */
:root {
    --primary: #0B3D2E;
    --primary-light: #1F6F5C;
    --gold: #D4AF37;
    --bg: #F1F4F8;
    --card: #ffffff;
    --text: #1f2937;
    --gray: #6b7280;
}

/* ================== GLOBAL ================== */
body {
    background: var(--bg);
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
    padding-left: 260px;
}

/* ================== SIDEBAR ================== */
.sidebar {
    width: 260px;
    background: linear-gradient(180deg, #081C15, #1B4332);
    color: white;
    padding: 30px 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 5px 0 30px rgba(0,0,0,0.2);
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    z-index: 1000;
}

.logo { text-align: center; margin-bottom: 40px; }
.logo h2 { color: var(--gold); font-size: 18px; letter-spacing: 2px; }

.menu { list-style: none; padding: 0; }
.menu li { margin: 12px 0; }
.menu a {
    text-decoration: none;
    color: white;
    padding: 12px 15px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: .3s;
}
.menu a:hover, .menu a.active { background: #2D6A4F; transform: translateX(5px); }
.sidebar-footer { font-size: 12px; text-align: center; opacity: .7; }

/* ================== MAIN CONTENT ================== */
.main-content { padding: 30px 40px; }

/* ================== HEADER ================== */
.main-header {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: white;
    padding: 25px 30px;
    border-radius: 20px;
    margin-bottom: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.main-header h1 { font-size: 24px; font-weight: 600; display: flex; align-items: center; gap: 10px; }
.main-header p { margin: 0; opacity: .8; }

/* ================== SEARCH BOX ================== */
.search-box { position: relative; }
.search-box i {
    position: absolute; top: 50%; left: 10px; transform: translateY(-50%);
    color: var(--gray);
}
.search-box input {
    padding: 8px 12px 8px 35px;
    border-radius: 20px;
    border: 1px solid #ced4da;
    width: 250px;
}

/* ================== BUTTON ================== */
.btn-add {
    background: var(--primary);
    color: white;
    border-radius: 30px;
    padding: 8px 20px;
    font-weight: 600;
    transition: .3s;
}
.btn-add:hover { background: var(--primary-light); }

/* ================== TABLE ================== */
.table-container {
    background: var(--card);
    border-radius: 20px;
    padding: 20px;
    overflow-x: auto;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
.table th, .table td { vertical-align: middle !important; }

/* ================== MODAL ================== */
.asp-modal .modal-content {
    border-radius: 20px;
    border: none;
    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
}
.asp-modal .modal-header {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: white;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}
.asp-modal .form-control { border-radius: 12px; padding: 10px 15px; }
.asp-modal .modal-footer { border-top: none; }
</style>
</head>
<body>

<div class="sidebar">
    <h2>SÉCURITÉ<br>PÉNITENTIAIRE</h2>
    <ul class="menu">
        <li><a href="{{route('admin.dashboard')}}">🏠 Accueil</a></li>
        <li><a href="{{route('users.agent.index')}}">👮 Agents</a></li>
        <li><a href="{{route('admin.ecole.index')}}" class="active">🏫 Écoles</a></li>
        <li><a href="{{route('admin.service.index')}}">👜 Services</a></li>
        <li><a href="{{route('admin.listes.Admin')}}">Administrations</a></li>
        <li><a href="{{route('users.affectation.agent')}}">📚 Stages / Affectations</a></li>
    </ul>
    <div class="sidebar-footer">Application interne sécurisée</div>
</div>

<div class="main-content">

<header class="main-header">
    <div>
        <h1><i class="fas fa-clipboard-list text-primary"></i> Suivi des Affectations</h1>
        <p class="text-muted">Gérez les statuts et exportez vos listes filtrées</p>
    </div>
    <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" id="searchInput" placeholder="Rechercher un stagiaire, une école...">
    </div>
</header>

<div class="d-flex justify-content-between mb-3">
    <div id="exportButtonsContainer"></div>
    <button class="btn-add btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSchoolModal">
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
            @php $st = strtolower($affect->status); @endphp
            <tr>
                <td class="text-primary fw-bold"><i class="fas fa-school me-1"></i>{{ $affect->agent?->matricule }}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="avatar-circle me-2 bg-light text-primary d-flex align-items-center justify-content-center" style="width:35px;height:35px;border-radius:50%"><i class="fas fa-user"></i></div>
                        <div><span class="fw-bold">{{ $affect->agent?->name }}</span><br><small class="text-muted">{{ $affect->agent?->prenom }}</small></div>
                    </div>
                </td>
                <td><span class="badge bg-light text-dark border">{{ $affect->agent?->grade }}</span><br><small class="text-muted"><i class="fas fa-building me-1"></i>{{ $affect->agent?->services?->nom_services }}</small></td>
                <td class="text-primary fw-bold"><i class="fas fa-school me-1"></i>{{ $affect->ecoles?->nom_ecole }}</td>
                <td><small><span class="text-success">Début:</span> {{ \Carbon\Carbon::parse($affect->date_debut)->format('d/m/Y') }}<br><span class="text-danger">Fin:</span> {{ \Carbon\Carbon::parse($affect->date_fin)->format('d/m/Y') }}</small></td>
                <td>
                    @php
                        $class = 'status-encours';
                        if($st=='terminé'||$st=='termine') $class='status-termine';
                        if($st=='annulé'||$st=='annule') $class='status-annule';
                    @endphp
                    <span class="badge-status {{ $class }}">{{ $affect->status ?? 'En cours' }}</span>
                </td>
                <td class="text-center no-export">
                    <div class="action-btns">
                        <a href="{{ route('users.editAffectationt.agent', $affect->id) }}" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
                        @if($st!=='terminé' && $st!=='termine')
                        <button onclick="changeStatus({{ $affect->id }},'Terminé')" class="btn btn-outline-success"><i class="fas fa-check"></i></button>
                        @endif
                        @if($st!=='annulé' && $st!=='annule')
                        <button onclick="changeStatus({{ $affect->id }},'Annulé')" class="btn btn-outline-danger"><i class="fas fa-times"></i></button>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $affectations->links() }}
</div>

</div>

<!-- Modal Nouvelle Affectation -->
<div class="modal fade asp-modal" id="addSchoolModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
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
                            <select name="agent_stagiare_id" class="form-select" required>
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
                    <button type="submit" class="btn btn-primary px-4">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {
    var table = $('#schoolsTable').DataTable({
        language: { url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json" },
        dom: 'Brtip',
        buttons: [{
            extend: 'excelHtml5',
            text: '<i class="fas fa-file-excel me-2"></i> Exporter la liste filtrée',
            className: 'btn-export-excel',
            title: 'Registre_Stages_ASP_' + new Date().toISOString().slice(0,10),
            exportOptions: { columns: "thead th:not(.no-export)", modifier: { page: 'current' } }
        }],
        pageLength: 10,
        responsive: true,
        paginate:false,
        order: [[4,"asc"]]
    });
    table.buttons().container().appendTo('#exportButtonsContainer');
    $('#searchInput').on('keyup', function() { table.search(this.value).draw(); });

    @if(session('success'))
    Swal.fire({ icon:'success', title:'Opération réussie', text:"{{ session('success') }}", toast:true, position:'top-end', showConfirmButton:false, timer:3000 });
    @endif
});

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
        if(result.isConfirmed) window.location.href = "/administration/affectation/status/" + id + "/" + newStatus;
    });
}
</script>

</body>
</html>
