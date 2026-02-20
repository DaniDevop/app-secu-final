<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestion des Stagiaires - ASP</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

<style>

/* ===== GLOBAL ===== */
body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:linear-gradient(135deg,#f1f3f5,#dee2e6);
    display:flex;
    min-height:100vh;
}

/* ===== SIDEBAR ===== */
.sidebar{
    width:260px;
    background:linear-gradient(180deg,#081C15,#1B4332);
    color:white;
    padding:30px 20px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    box-shadow:5px 0 30px rgba(0,0,0,0.2);
    position:fixed;
    height:100%;
}

.logo{
    text-align:center;
    margin-bottom:40px;
}

.logo h2{
    color:#D4AF37;
    font-size:18px;
    letter-spacing:2px;
}

.menu{
    list-style:none;
    padding:0;
}

.menu li{
    margin:12px 0;
}

.menu a{
    text-decoration:none;
    color:white;
    padding:12px 15px;
    border-radius:10px;
    display:flex;
    align-items:center;
    gap:10px;
    transition:.3s;
}

.menu a:hover,
.menu a.active{
    background:#2D6A4F;
    transform:translateX(5px);
}

.sidebar-footer{
    font-size:12px;
    text-align:center;
    opacity:.7;
}

/* ===== MAIN CONTENT ===== */
.main-content{
    margin-left:260px;
    flex:1;
    padding:30px 40px;
}

/* ===== HEADER ===== */
.main-header{
    background:linear-gradient(135deg,#081C15,#1B4332);
    color:white;
    padding:25px 30px;
    border-radius:15px;
    margin-bottom:30px;
    box-shadow:0 15px 35px rgba(0,0,0,0.15);
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.search-box{
    background:rgba(255,255,255,0.15);
    padding:10px 15px;
    border-radius:30px;
    display:flex;
    align-items:center;
}

.search-box input{
    border:none;
    background:transparent;
    color:white;
    outline:none;
    margin-left:10px;
}

/* ===== BUTTONS ===== */
.btn-add{
    background:#D4AF37;
    color:#081C15;
    font-weight:600;
    border-radius:30px;
    padding:10px 20px;
    border:none;
    transition:.3s;
}

.btn-add:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 20px rgba(0,0,0,0.2);
}

.dt-buttons{
    display:flex;
    gap:10px;
}

.btn-export{
    border-radius:30px !important;
    padding:8px 18px !important;
    font-weight:600 !important;
}

.btn-excel{
    background:#198754 !important;
    border:none !important;
}

/* ===== TABLE ===== */
.table-container{
    background:white;
    padding:25px;
    border-radius:18px;
    box-shadow:0 15px 40px rgba(0,0,0,0.08);
}

table.dataTable thead{
    background:#1B4332;
    color:white;
}

table.dataTable tbody tr:hover{
    background:#f8f9fa;
    transform:scale(1.01);
}

.badge{
    border-radius:20px;
    padding:6px 12px;
}

.btn-action{
    width:35px;
    height:35px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#f1f3f5;
    transition:.3s;
}

.btn-action:hover{
    background:#1B4332;
    color:white;
}

/* ===== MODAL ===== */
.modal-header{
    background:linear-gradient(135deg,#081C15,#1B4332);
    color:white;
}

.form-control, .form-select{
    border-radius:12px;
}

.form-control:focus, .form-select:focus{
    border-color:#D4AF37;
    box-shadow:0 0 0 3px rgba(212,175,55,.2);
}

/* ===== RESPONSIVE ===== */
@media(max-width:900px){
    .sidebar{
        position:absolute;
        left:-260px;
        transition:.3s;
    }
    .sidebar.active{
        left:0;
    }
    .main-content{
        margin-left:0;
    }
}

</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div>
        <div class="logo">
            <h2>SÉCURITÉ<br>PÉNITENTIAIRE</h2>
        </div>

        <ul class="menu">
            <li><a href="{{route('admin.dashboard')}}">🏠 Acceuil</a></li>
            <li><a href="{{route('users.agent.index')}}">👮 Agents</a></li>
            <li><a href="{{route('admin.ecole.index')}}">🏫 Écoles</a></li>
            <li><a href="{{route('admin.service.index')}}">👜Services</a></li>
            <li><a href="{{route('admin.listes.Admin')}}">Administrations</a></li>
            <li><a href="{{route('users.affectation.agent')}}">📚 Stages / Affectations</a></li>
            <li><a href="#">📊 Rapports</a></li>



            
        </ul>
    </div>

    <div class="sidebar-footer">
        Application interne sécurisée
    </div>
</div>

<!-- MAIN -->
<div class="main-content">

<header class="main-header">
    <div>
        <h1><i class="fas fa-user-graduate me-2"></i>Gestion des Stagiaires</h1>
        <small>Administration interne ASP</small>
    </div>
    <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" id="searchInput" placeholder="Rechercher...">
    </div>
</header>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div id="exportButtonsContainer"></div>
    <button class="btn-add" data-bs-toggle="modal" data-bs-target="#addStagiareModal">
        <i class="fas fa-plus me-2"></i>Ajouter
    </button>
</div>

<div class="table-container">
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
<td class="fw-bold text-primary">{{$stagiare->matricule}}</td>
<td>{{$stagiare->name}}</td>
<td>{{$stagiare->prenom}}</td>
<td><span class="badge bg-light border text-dark">{{$stagiare->grade}}</span></td>
<td>{{$stagiare->services->nom_services}}</td>
<td>{{$stagiare->tel}}</td>
<td class="no-export">
<a class="btn-action" href="{{ route('users.editAgentStagiare', $stagiare->id) }}">
<i class="fas fa-edit"></i>
</a>
</td>
</tr>
@endforeach
</tbody>
</table>
  {{ $stagiares->links() }}
</div>

</div>


<!-- MODAL -->
<div class="modal fade" id="addStagiareModal">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">

<div class="modal-header text-white">
<h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Nouveau Stagiaire</h5>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>

<form action="{{route('users.addAgent.Stagiare')}}" method="POST">
@csrf
<div class="modal-body p-4">

<div class="row g-3 mb-3">
<div class="col-md-6">
<label class="form-label fw-bold">Matricule</label>
<input type="text" name="matricule" class="form-control" required>
</div>
<div class="col-md-6">
<label class="form-label fw-bold">Service</label>
<select name="service_id" class="form-select" required>
<option disabled selected>Choisir un service...</option>
@foreach($servicesAll as $service)
<option value="{{$service->id}}">{{$service->nom_services}}</option>
@endforeach
</select>
</div>
</div>

<div class="row g-3 mb-3">
<div class="col-md-6">
<label class="form-label fw-bold">Nom</label>
<input type="text" name="name" class="form-control" required>
</div>
<div class="col-md-6">
<label class="form-label fw-bold">Prénom</label>
<input type="text" name="prenom" class="form-control" required>
</div>
</div>

<div class="row g-3">
<div class="col-md-6">
<label class="form-label fw-bold">Grade</label>
<select name="grade" class="form-select" required>
<option disabled selected>Sélectionner</option>
<option>Caporal</option>
<option>Sergent</option>
<option>Lieutenant</option>
<option>Capitaine</option>
<option>Colonel</option>
</select>
</div>
<div class="col-md-6">
<label class="form-label fw-bold">Téléphone</label>
<input type="text" name="tel" class="form-control" required>
</div>
</div>

</div>

<div class="modal-footer bg-light">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
<button type="submit" class="btn btn-primary">Enregistrer</button>
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
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function(){
var table=$('#schoolsTable').DataTable({
language:{url:"//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json"},
dom:'Brtip',
buttons:[
{
extend:'excelHtml5',
text:'<i class="fas fa-file-excel me-2"></i>Excel',
className:'btn-export btn-excel',
exportOptions:{columns:':not(.no-export)',modifier:{page:'current'}}
}
],
pageLength:10,
responsive:true,
paginate:false
});
table.buttons().container().appendTo('#exportButtonsContainer');
$('#searchInput').on('keyup',function(){table.search(this.value).draw();});
});
</script>

</body>
</html>
