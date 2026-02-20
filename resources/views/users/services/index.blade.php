<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestion des Services - ASP Stages</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
    padding-left: 260px; /* espace pour le sidebar */
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

.logo {
    text-align: center;
    margin-bottom: 40px;
}
.logo h2 {
    color: var(--gold);
    font-size: 18px;
    letter-spacing: 2px;
}

.menu {
    list-style: none;
    padding: 0;
}
.menu li {
    margin: 12px 0;
}
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
.menu a:hover,
.menu a.active {
    background: #2D6A4F;
    transform: translateX(5px);
}

.sidebar-footer {
    font-size: 12px;
    text-align: center;
    opacity: .7;
}

/* ================== MAIN CONTENT ================== */
.main-content {
    padding: 30px 40px;
}

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

.main-header h1 {
    font-size: 24px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}
.main-header p {
    margin: 0;
    opacity: .8;
}

/* ================== SEARCH BOX ================== */
.search-box {
    position: relative;
}
.search-box i {
    position: absolute;
    top: 50%;
    left: 10px;
    transform: translateY(-50%);
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
.btn-add:hover {
    background: var(--primary-light);
}

/* ================== TABLE ================== */
.table-container {
    background: var(--card);
    border-radius: 20px;
    padding: 20px;
    overflow-x: auto;
}

.table th, .table td {
    vertical-align: middle !important;
}

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
.asp-modal .form-control {
    border-radius: 12px;
    padding: 10px 15px;
}
.asp-modal .modal-footer {
    border-top: none;
}
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
            <li><a href="{{route('admin.ecole.index')}}">🏫 Écoles</a></li>
            <li><a href="{{route('admin.service.index')}}">👜 Services</a></li>
            <li><a href="{{route('admin.listes.Admin')}}">Administrations</a></li>
            <li><a href="{{route('users.affectation.agent')}}">📚 Stages / Affectations</a></li>
        </ul>
    </div>
    <div class="sidebar-footer">Application interne sécurisée</div>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
    <header class="main-header">
        <div>
            <h1><i class="fas fa-sitemap"></i> Gestion des Services</h1>
            <p>Organisation interne et départements</p>
        </div>
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Rechercher un service...">
        </div>
    </header>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="breadcrumb-mini">
            <span class="text-muted">Administration</span> / <strong>Services</strong>
        </div>
        <button class="btn-add" type="button" data-bs-toggle="modal" data-bs-target="#addServiceModal">
            <i class="fas fa-plus-circle me-1"></i> Nouveau Service
        </button>
    </div>

    <div class="table-container shadow-sm border-0">
        <table id="servicesTable" class="table table-hover align-middle">
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
                    <td>#{{$service->id}}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="icon-box me-3 bg-light text-primary d-flex align-items-center justify-content-center" style="width:35px; height:35px; border-radius:8px;">
                                <i class="fas fa-door-open"></i>
                            </div>
                            <span>{{$service->nom_services}}</span>
                        </div>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.service.edit', $service->id) }}" title="Modifier">
                            <i class="fas fa-pen-to-square"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">{{ $services->links() }}</div>
    </div>
</div>

<!-- MODAL ADD SERVICE -->
<div class="modal fade asp-modal" id="addServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus-square me-2"></i> Ajouter un Service</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{route('admin.service.addService')}}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold" for="serviceName">
                            <i class="fas fa-pencil-alt me-1 text-primary"></i> Libellé du service
                        </label>
                        <input type="text" id="serviceName" name="nom_services" class="form-control form-control-lg shadow-sm" placeholder="Ex: Direction des Ressources Humaines" required>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary px-4 shadow"><i class="fas fa-save me-1"></i> Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    var table = $('#servicesTable').DataTable({
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

// Fonction de suppression
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
        if (result.isConfirmed) window.location.href = "/admin/service/delete/" + id;
    });
}
</script>

</body>
</html>
