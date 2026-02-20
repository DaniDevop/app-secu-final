<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Éditer les Écoles - ASP Stages</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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

<div class="main-content">
    <header class="main-header">
        <div>
            <h1><i class="fas fa-university"></i> Éditer les Écoles</h1>
            <p>Gestion et modification des établissements partenaires</p>
        </div>
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Rechercher une école...">
        </div>
    </header>

    <div style="display:flex; justify-content:flex-end; margin-bottom:20px;">
        <button class="btn-add" data-bs-toggle="modal" data-bs-target="#editSchoolModal">
            <i class="fas fa-pen-to-square"></i> Modifier le service
        </button>
    </div>

    <div class="table-container">
        <table class="table table-hover align-middle" id="schoolsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom du service</th>
                    <th>Date création</th>
                    <th>Date modification</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$service->id}}</td>
                    <td>{{$service->nom_services}}</td>
                    <td>{{$service->created_at}}</td>
                    <td>{{$service->updated_at}}</td>
                   
                </tr>
            </tbody>
        </table>
    </div>

    <!-- MODAL EDIT -->
    <div class="modal fade asp-modal" id="editSchoolModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-pen-to-square me-2"></i> Modifier le service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{route('admin.service.editServicesPost')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nom du service</label>
                            <input type="text" name="nom_services" class="form-control" value="{{$service->nom_services}}" required>
                        </div>
                        <input type="hidden" name="id" value="{{$service->id}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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
        if (result.isConfirmed) {
            window.location.href = '/admin/ecole/delete/' + id;
        }
    });
}

document.getElementById('searchInput').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    document.querySelectorAll('#schoolsTable tbody tr').forEach(function(row){
        row.style.display = row.innerText.toLowerCase().includes(filter) ? '' : 'none';
    });
});
</script>

</body>
</html>
