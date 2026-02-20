<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dossier Stagiaire - ASP</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
    box-shadow: 5px 0 30px rgba(0, 0, 0, 0.2);
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

/* ================== HEADER ================== */
.main-header {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: white;
    padding: 30px 40px;
    border-bottom-left-radius: 30px;
    border-bottom-right-radius: 30px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
    margin-bottom: 40px;
    position: relative;
    z-index: 900;
}

.main-header h1 {
    font-size: 26px;
    font-weight: 600;
}

.main-header p {
    opacity: .8;
    margin: 0;
}

/* ================== DOSSIER CARD ================== */
.dossier-card {
    background: var(--card);
    border-radius: 25px;
    padding: 40px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
    max-width: 1200px;
    margin: auto;
}

.dossier-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
}

.info-box {
    background: #f9fafb;
    padding: 20px;
    border-radius: 15px;
    border-left: 5px solid var(--primary);
    transition: .3s;
}

.info-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
}

.info-box label {
    font-size: 12px;
    text-transform: uppercase;
    color: var(--gray);
    font-weight: 600;
}

.info-box p {
    margin: 5px 0 0;
    font-size: 16px;
    font-weight: 600;
    color: var(--text);
}

/* ================== GRADE BADGE ================== */
.grade-badge {
    background: var(--gold);
    color: var(--primary);
    padding: 8px 15px;
    border-radius: 30px;
    font-weight: 600;
    display: inline-block;
}

/* ================== BUTTON ================== */
.btn-edit {
    background: var(--primary);
    color: white;
    padding: 12px 25px;
    border-radius: 30px;
    border: none;
    font-weight: 600;
    transition: .3s;
}

.btn-edit:hover {
    background: var(--primary-light);
    transform: translateY(-3px);
}

/* ================== MODAL ================== */
.modal-content {
    border-radius: 20px;
    border: none;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
}

.modal-header {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: white;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}

.form-control,
.form-select {
    border-radius: 12px;
    padding: 10px 15px;
}

.form-control:focus,
.form-select:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
}

.btn-submit {
    background: var(--primary);
    color: white;
    border-radius: 30px;
    padding: 10px 20px;
}

.btn-cancel {
    background: #dee2e6;
    border-radius: 30px;
}

/* ================== RESPONSIVE ================== */
@media (max-width: 1200px) {
    body {
        padding-left: 0;
    }
    .sidebar {
        position: relative;
        width: 100%;
        height: auto;
        box-shadow: none;
    }
}

@media (max-width: 768px) {
    .dossier-card {
        padding: 25px;
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

<!-- HEADER -->
<div class="main-header">
    <h1><i class="fas fa-user-shield me-2"></i>Dossier Administratif Stagiaire</h1>
    <p>Administration Pénitentiaire – République Gabonaise</p>
</div>

<!-- DOSSIER -->
<div class="dossier-card">

    <div class="dossier-grid">

        <div class="info-box">
            <label>Matricule</label>
            <p>{{$stagiareAgent->matricule}}</p>
        </div>

        <div class="info-box">
            <label>Nom</label>
            <p>{{$stagiareAgent->name}}</p>
        </div>

        <div class="info-box">
            <label>Prénom</label>
            <p>{{$stagiareAgent->prenom}}</p>
        </div>

        <div class="info-box">
            <label>Grade</label>
            <p><span class="grade-badge">{{$stagiareAgent->grade}}</span></p>
        </div>

        <div class="info-box">
            <label>Service</label>
            <p>{{$stagiareAgent->services->nom_services}}</p>
        </div>

        <div class="info-box">
            <label>Téléphone</label>
            <p>{{$stagiareAgent->tel}}</p>
        </div>

    </div>

    <div class="text-end mt-4">
        <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#addStagiareModal">
            <i class="fas fa-edit me-2"></i>Modifier le dossier
        </button>
    </div>

</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="addStagiareModal" tabindex="-1">
<div class="modal-dialog modal-dialog-centered modal-lg">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">
<i class="fas fa-user-edit me-2"></i>Modifier le stagiaire
</h5>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>

<form action="{{route('users.EditgentStagiare')}}" method="POST">
@csrf

<div class="modal-body">

<div class="row g-3">

<div class="col-md-6">
<label class="form-label">Matricule</label>
<input type="text" name="matricule" class="form-control" value="{{$stagiareAgent->matricule}}" required>
</div>

<div class="col-md-6">
<label class="form-label">Nom</label>
<input type="text" name="name" class="form-control" value="{{$stagiareAgent->name}}" required>
</div>

<div class="col-md-6">
<label class="form-label">Prénom</label>
<input type="text" name="prenom" class="form-control" value="{{$stagiareAgent->prenom}}" required>
</div>

<div class="col-md-6">
<label class="form-label">Grade</label>
<select name="grade" class="form-select" required>
<option value="{{$stagiareAgent->grade}}">{{$stagiareAgent->grade}}</option>
<option>Caporal</option>
<option>Caporal-chef</option>
<option>Sergent</option>
<option>Sergent-chef</option>
<option>Adjudant</option>
<option>Lieutenant</option>
<option>Capitaine</option>
<option>Commandant</option>
<option>Colonel</option>
</select>
</div>

<div class="col-md-6">
<label class="form-label">Téléphone</label>
<input type="text" name="tel" class="form-control" value="{{$stagiareAgent->tel}}" required>
</div>

<div class="col-md-6">
<label class="form-label">Service</label>
<select name="service_id" class="form-select" required>
<option value="{{$stagiareAgent->service_agent_id}}">
{{$stagiareAgent->services->nom_services}}
</option>
@foreach($servicesAll as $service)
<option value="{{$service->id}}">
{{$service->nom_services}}
</option>
@endforeach
</select>
</div>

</div>

<input type="hidden" name="id" value="{{$stagiareAgent->id}}">

</div>

<div class="modal-footer">
<button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Annuler</button>
<button type="submit" class="btn btn-submit">Enregistrer</button>
</div>

</form>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

@if(session('success'))
Swal.fire({
icon:'success',
title:'Succès',
text:"{{session('success')}}",
timer:3000,
showConfirmButton:false,
toast:true,
position:'top-end'
});
@endif

@if(session('error'))
Swal.fire({
icon:'error',
title:'Erreur',
text:"{{session('error')}}"
});
@endif

@if($errors->any())
Swal.fire({
icon:'warning',
title:'Attention',
html:'{!! implode("<br>", $errors->all()) !!}'
});
@endif

});
</script>

</body>
</html>
