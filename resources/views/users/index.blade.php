<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
<title>Dashboard - Sécurité Pénitentiaire</title>

<!-- Font Awesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
/* ===== RESET ===== */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: 'Segoe UI', sans-serif;
}

body{
    display:flex;
    min-height:100vh;
    background:linear-gradient(135deg,#f1f3f5,#dee2e6);
    overflow-x: hidden;
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
    z-index:1000;
    transition:all 0.3s ease;
}

.logo{
    text-align:center;
    margin-bottom:40px;
}

.logo h2{
    color:#D4AF37;
    font-size:18px;
    letter-spacing:2px;
    word-break:break-word;
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
    transition:0.3s;
    font-size:14px;
}

.menu a i {
    width:20px;
    text-align:center;
    font-size:16px;
}

.menu a:hover,
.menu a.active{
    background:#2D6A4F;
    transform:translateX(5px);
}

.logout{
    font-size:13px;
    opacity:0.7;
    text-align:center;
}

/* Menu toggle button for mobile */
.menu-toggle {
    display: none;
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 1100;
    background: #081C15;
    color: white;
    border: none;
    border-radius: 8px;
    width: 45px;
    height: 45px;
    font-size: 20px;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    align-items: center;
    justify-content: center;
}

/* Overlay for mobile */
.sidebar-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 999;
    backdrop-filter: blur(3px);
}

.sidebar-overlay.active {
    display: block;
}

/* ===== MAIN ===== */
.main{
    flex:1;
    padding:30px 40px;
    margin-left:260px;
    transition:all 0.3s ease;
    width:calc(100% - 260px);
    min-height:100vh;
}

/* ===== HEADER ===== */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:15px;
    margin-bottom:20px;
}

.header h1{
    font-size:clamp(20px, 4vw, 24px);
    color:#1B4332;
    display:flex;
    align-items:center;
    gap:10px;
}

.header h1 i {
    color:#D4AF37;
}

.user-info{
    background:white;
    padding:12px 25px;
    border-radius:30px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
    font-weight:600;
    display:flex;
    align-items:center;
    gap:8px;
    white-space:nowrap;
}

.user-info i {
    color:#D4AF37;
}

/* ===== CARDS ===== */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:25px;
    margin-top:30px;
}

.card{
    background:white;
    padding:25px;
    border-radius:20px;
    position:relative;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
    transition:0.3s;
    display:flex;
    flex-direction:column;
    border:1px solid rgba(0,0,0,0.05);
}

.card:hover{
    transform:translateY(-8px);
    box-shadow:0 20px 40px rgba(0,0,0,0.15);
}

.card::before{
    content:'';
    position:absolute;
    width:5px;
    height:100%;
    background:#D4AF37;
    left:0;
    top:0;
}

.card i {
    font-size:24px;
    color:#1B4332;
    margin-bottom:15px;
    opacity:0.8;
}

.card h3{
    color:#1B4332;
    font-size:15px;
    margin-bottom:10px;
    text-transform:uppercase;
    letter-spacing:0.5px;
}

.card p{
    font-size:32px;
    font-weight:bold;
    color:#081C15;
    margin:0;
}

/* ===== SECTION TABLE ===== */
.section{
    margin-top:50px;
}

.section h2{
    margin-bottom:20px;
    color:#1B4332;
    display:flex;
    align-items:center;
    gap:10px;
    font-size:clamp(18px, 3vw, 22px);
}

.section h2 i {
    color:#D4AF37;
}

.table-container {
    background:white;
    border-radius:20px;
    padding:20px;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
    overflow-x:auto;
    -webkit-overflow-scrolling:touch;
}

table{
    width:100%;
    border-collapse:collapse;
    min-width:600px;
}

thead{
    background:#1B4332;
    color:white;
}

thead th {
    padding:15px;
    font-weight:600;
    white-space:nowrap;
}

thead th i {
    margin-right:8px;
    opacity:0.9;
}

th, td{
    padding:15px;
    text-align:left;
}

tbody tr{
    border-bottom:1px solid #e9ecef;
    transition:0.2s;
}

tbody tr:hover{
    background:#f8f9fa;
}

.status{
    padding:6px 12px;
    border-radius:30px;
    font-size:12px;
    font-weight:bold;
    display:inline-block;
    white-space:nowrap;
}

.en-cours{
    background:#d4edda;
    color:#155724;
    border:1px solid #c3e6cb;
}

.termine{
    background:#e2e3e5;
    color:#383d41;
    border:1px solid #d6d8db;
}

.attente{
    background:#fff3cd;
    color:#856404;
    border:1px solid #ffeeba;
}

/* ===== ANIMATIONS ===== */
@keyframes slideIn {
    from {
        opacity:0;
        transform:translateY(20px);
    }
    to {
        opacity:1;
        transform:translateY(0);
    }
}

.card, .section {
    animation:slideIn 0.5s ease;
}

/* ===== SCROLLBAR ===== */
::-webkit-scrollbar {
    width:8px;
    height:8px;
}

::-webkit-scrollbar-track {
    background:#f1f1f1;
}

::-webkit-scrollbar-thumb {
    background:#1B4332;
    border-radius:10px;
}

::-webkit-scrollbar-thumb:hover {
    background:#2D6A4F;
}

/* ===== RESPONSIVE ===== */
@media screen and (max-width: 992px) {
    .main {
        padding:20px;
    }
    
    .cards {
        gap:20px;
    }
    
    .card {
        padding:20px;
    }
    
    .card p {
        font-size:28px;
    }
}

@media screen and (max-width: 768px) {
    .menu-toggle {
        display:flex;
    }
    
    .sidebar {
        left:-260px;
    }
    
    .sidebar.active {
        left:0;
    }
    
    .main {
        margin-left:0;
        width:100%;
        padding:70px 15px 20px;
    }
    
    .header {
        flex-direction:column;
        align-items:stretch;
        text-align:center;
    }
    
    .user-info {
        justify-content:center;
    }
    
    .cards {
        grid-template-columns:1fr;
        gap:15px;
    }
    
    .card {
        padding:20px;
    }
    
    .card h3 {
        font-size:14px;
    }
    
    .card p {
        font-size:26px;
    }
    
    .table-container {
        padding:15px;
    }
    
    table {
        min-width:500px;
    }
    
    th, td {
        padding:12px 10px;
        font-size:14px;
    }
    
    .status {
        padding:4px 10px;
        font-size:11px;
    }
}

@media screen and (max-width: 480px) {
    .main {
        padding:70px 10px 15px;
    }
    
    .header h1 {
        font-size:18px;
    }
    
    .user-info {
        padding:10px 15px;
        font-size:14px;
    }
    
    .card {
        padding:15px;
    }
    
    .card i {
        font-size:20px;
    }
    
    .card h3 {
        font-size:13px;
    }
    
    .card p {
        font-size:22px;
    }
    
    .section h2 {
        font-size:16px;
    }
    
    .table-container {
        padding:10px;
    }
    
    th, td {
        padding:10px 8px;
        font-size:12px;
    }
    
    .status {
        padding:3px 8px;
        font-size:10px;
    }
}

/* Touch optimization */
@media (hover: none) and (pointer: coarse) {
    .menu a,
    .card,
    .status {
        cursor:pointer;
    }
    
    .menu a {
        padding:15px;
    }
    
    th, td {
        padding:15px 10px;
    }
}
</style>

</head>

<body>

<!-- Menu toggle button for mobile -->
<button class="menu-toggle" id="menuToggle">
    <i class="fas fa-bars"></i>
</button>

<!-- Overlay for mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div>
        <div class="logo">
            <h2>SÉCURITÉ<br>PÉNITENTIAIRE</h2>
        </div>

        <ul class="menu">
            <li><a href="{{route('admin.dashboard')}}" class="active"><i class="fas fa-home"></i> Accueil</a></li>
            <li><a href="{{route('users.agent.index')}}"><i class="fas fa-users"></i> Agents</a></li>
            <li><a href="{{route('admin.ecole.index')}}"><i class="fas fa-school"></i> Écoles</a></li>
            <li><a href="{{route('admin.service.index')}}"><i class="fas fa-briefcase"></i> Services</a></li>
            <li><a href="{{route('admin.listes.Admin')}}"><i class="fas fa-user-tie"></i> Administrations</a></li>
            <li><a href="{{route('users.affectation.agent')}}"><i class="fas fa-exchange-alt"></i> Stages / Affectations</a></li>
            <li><a href="#"><i class="fas fa-chart-bar"></i> Rapports</a></li>
        </ul>
    </div>

    <div class="logout">
        <i class="fas fa-lock me-1"></i> Application interne sécurisée
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="main">

    <div class="header">
        <h1>
            <i class="fas fa-chart-pie"></i> 
            Tableau de Bord
        </h1>
        <div class="user-info">
            <i class="fas fa-user-cog"></i>
            Admin Général
        </div>
    </div>

    <div class="cards">
        <div class="card">
            <i class="fas fa-user-shield"></i>
            <h3>Agents enregistrés</h3>
            <p>248</p>
            <small style="color:#6c757d; margin-top:10px;">+12 ce mois</small>
        </div>

        <div class="card">
            <i class="fas fa-clock"></i>
            <h3>Stages en cours</h3>
            <p>32</p>
            <small style="color:#6c757d; margin-top:10px;">78% de taux d'occupation</small>
        </div>

        <div class="card">
            <i class="fas fa-university"></i>
            <h3>Écoles partenaires</h3>
            <p>6</p>
            <small style="color:#6c757d; margin-top:10px;">+2 cette année</small>
        </div>

        <div class="card">
            <i class="fas fa-check-circle"></i>
            <h3>Stages terminés</h3>
            <p>115</p>
            <small style="color:#6c757d; margin-top:10px;">84% de réussite</small>
        </div>
    </div>

    <div class="section">
        <h2>
            <i class="fas fa-history"></i>
            Dernières affectations
        </h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th><i class="fas fa-id-card"></i> Matricule</th>
                        <th><i class="fas fa-user"></i> Nom</th>
                        <th><i class="fas fa-school"></i> École</th>
                        <th><i class="fas fa-tag"></i> Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>SPG001</strong></td>
                        <td>NDONG Jean</td>
                        <td>École Nationale</td>
                        <td><span class="status en-cours"><i class="fas fa-play me-1"></i>En cours</span></td>
                    </tr>
                    <tr>
                        <td><strong>SPG014</strong></td>
                        <td>OYONO Marc</td>
                        <td>Centre Spécialisé</td>
                        <td><span class="status attente"><i class="fas fa-hourglass-half me-1"></i>En attente</span></td>
                    </tr>
                    <tr>
                        <td><strong>SPG022</strong></td>
                        <td>MBADINGA Paul</td>
                        <td>École Militaire</td>
                        <td><span class="status termine"><i class="fas fa-check me-1"></i>Terminé</span></td>
                    </tr>
                    <tr>
                        <td><strong>SPG045</strong></td>
                        <td>BISSIEL Alice</td>
                        <td>Institut Supérieur</td>
                        <td><span class="status en-cours"><i class="fas fa-play me-1"></i>En cours</span></td>
                    </tr>
                    <tr>
                        <td><strong>SPG089</strong></td>
                        <td>MENGUE Pierre</td>
                        <td>Académie de Police</td>
                        <td><span class="status attente"><i class="fas fa-hourglass-half me-1"></i>En attente</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Mini footer d'information -->
        <div style="margin-top:20px; text-align:right;">
            <small style="color:#6c757d;">
                <i class="fas fa-sync-alt me-1"></i> 
                Dernière mise à jour : {{ now()->format('d/m/Y H:i') }}
            </small>
        </div>
    </div>

</div>

<!-- Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Éléments
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    // Fonction pour toggle la sidebar
    function toggleSidebar() {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
        
        // Changer l'icône du bouton
        const icon = menuToggle.querySelector('i');
        if (sidebar.classList.contains('active')) {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        } else {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    }
    
    // Event listeners
    if (menuToggle) {
        menuToggle.addEventListener('click', toggleSidebar);
    }
    
    if (overlay) {
        overlay.addEventListener('click', toggleSidebar);
    }
    
    // Fermer la sidebar si on clique sur un lien (mobile)
    document.querySelectorAll('.sidebar .menu a').forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                toggleSidebar();
            }
        });
    });
    
    // Réinitialiser l'affichage si redimensionnement
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            
            const icon = menuToggle.querySelector('i');
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    });
    
    // Animation des cartes au survol (optionnel)
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s ease';
        });
    });

    // Simulation de données dynamiques (à remplacer par vos données réelles)
    @if(isset($agentsCount))
        // Si vous avez des données du backend, vous pouvez les afficher ici
        console.log('Données chargées');
    @endif
});

// Fonction pour rafraîchir les données (optionnel)
function refreshData() {
    // À implémenter selon vos besoins
    console.log('Rafraîchissement des données...');
}
</script>

<!-- Script optionnel pour SweetAlert si vous voulez des notifications -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Exemple de notification (à décommenter si besoin)
/*
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Succès',
        text: "{{ session('success') }}",
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
@endif
*/
</script>

</body>
</html>