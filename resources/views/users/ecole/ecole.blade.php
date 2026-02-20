<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestion des Écoles - ASP Stages</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
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

<!-- SIDEBAR -->
<div class="sidebar">
    <div>
        <div class="logo"><h2>SÉCURITÉ<br>PÉNITENTIAIRE</h2></div>
        <ul class="menu">
            <li><a href="{{route('admin.dashboard')}}">🏠 Accueil</a></li>
            <li><a href="{{route('users.agent.index')}}">👮 Agents</a></li>
            <li><a href="{{route('admin.ecole.index')}}" class="active">🏫 Écoles</a></li>
            <li><a href="{{route('admin.service.index')}}">👜 Services</a></li>
            <li><a href="{{route('admin.listes.Admin')}}">Administrations</a></li>
            <li><a href="{{route('users.affectation.agent')}}">📚 Stages / Affectations</a></li>
        </ul>
    </div>
    <div class="sidebar-footer">Application interne sécurisée</div>
</div>

<div class="main-content" id="mainContent">

    <header class="main-header">
        <div>
            <h1><i class="fas fa-university"></i> Gestion des Écoles</h1>
            <p>Administration et gestion des établissements partenaires</p>
        </div>
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Rechercher une école...">
        </div>
    </header>

    <div class="d-flex justify-content-end mb-4">
        <button class="btn-add" id="addSchoolBtn" type="button" data-bs-toggle="modal" data-bs-target="#addSchoolModal">
            <i class="fas fa-plus-circle me-1"></i> Ajouter une école
        </button>
    </div>

    <div class="table-container">
        <table id="schoolsTable" class="table table-hover align-middle">
            <thead>
                <tr>
                    <th width="40%"><i class="fas fa-university me-2"></i>Nom de l'École</th>
                    <th width="40%"><i class="fas fa-map-marker-alt me-2"></i>Adresse</th>
                    <th width="20%" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ecoles as $ecole)
                <tr>
                    <td>{{$ecole->nom_ecole}}</td>
                    <td>{{$ecole->adresse}}</td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-outline-primary" title="Modifier" href="{{route('admin.ecole.edit', $ecole->id)}}">
                            <i class="fas fa-pen-to-square"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete({{$ecole->id}}, '{{$ecole->nom_ecole}}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-3">{{ $ecoles->links() }}</div>
    </div>

    <div class="empty-state" id="emptyState" style="display:none;">
        <div class="empty-icon"><i class="fas fa-university"></i></div>
        <h3>Aucune école enregistrée</h3>
        <p>Commencez par ajouter votre première école partenaire.</p>
        <button class="btn-add" id="addFirstSchoolBtn" data-bs-toggle="modal" data-bs-target="#addSchoolModal">
            <i class="fas fa-plus-circle"></i> Ajouter une école
        </button>
    </div>

    <!-- MODAL ADD / EDIT SCHOOL -->
    <div class="modal fade asp-modal" id="addSchoolModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-university me-2"></i> Ajouter / Modifier une école</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="schoolForm" action="{{route('admin.ecole.addEcole')}}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold" for="schoolName"><i class="fas fa-university me-1 text-primary"></i> Nom de l'école *</label>
                            <input type="text" id="schoolName" name="nom_ecole" class="form-control form-control-lg shadow-sm" placeholder="Ex: Université de Paris" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold" for="schoolAddress"><i class="fas fa-map-marker-alt me-1 text-primary"></i> Adresse *</label>
                            <textarea id="schoolAddress" name="adresse" class="form-control form-control-lg shadow-sm" placeholder="Ex: 12 Rue de l'Université, 75005 Paris" rows="3" required></textarea>
                        </div>
                        <input type="hidden" id="schoolId" name="id">
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary px-4 shadow"><i class="fas fa-save me-1"></i> Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    var table = $('#schoolsTable').DataTable({
        language: { url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json" },
        dom: 'rtip',
        pageLength: 10,
        responsive: true,
        ordering: true,
        paginate: false
    });

    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });

    @if(session('success'))
        Swal.fire({ icon:'success', title:'Opération réussie', text:"{{session('success')}}", toast:true, position:'top-end', showConfirmButton:false, timer:3000 });
    @endif

    @if($errors->any())
        Swal.fire({ icon:'error', title:'Erreur de validation', html:'{!! implode("<br>", $errors->all()) !!}' });
    @endif
});

function confirmDelete(id, name) {
    Swal.fire({
        title: 'Supprimer cette école ?',
        text: "Êtes-vous sûr de vouloir supprimer : " + name,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) window.location.href = "/admin/ecole/delete/" + id;
    });
}
</script>

</body>
</html>
