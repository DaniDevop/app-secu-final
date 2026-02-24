<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
<title>Dashboard - Sécurité Pénitentiaire</title>

<!-- Font Awesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Chart.js pour les graphiques -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

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

/* ===== SECTION GRAPHIQUES ===== */
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

.charts-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 25px;
    margin-bottom: 30px;
}

.chart-card {
    background: white;
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    transition: 0.3s;
}

.chart-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.12);
}

.chart-card h3 {
    color: #1B4332;
    font-size: 18px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    padding-bottom: 10px;
    border-bottom: 2px solid #f0f0f0;
}

.chart-card h3 i {
    color: #D4AF37;
}

.chart-wrapper {
    position: relative;
    height: 250px;
    width: 100%;
}

/* Stats supplémentaires */
.stats-mini {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #f0f0f0;
}

.stat-item {
    text-align: center;
}

.stat-label {
    font-size: 12px;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-value {
    font-size: 18px;
    font-weight: bold;
    color: #1B4332;
    margin-top: 5px;
}

.stat-value small {
    font-size: 12px;
    color: #6c757d;
    font-weight: normal;
}

/* Légende personnalisée */
.chart-legend {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
}

.legend-color {
    width: 12px;
    height: 12px;
    border-radius: 4px;
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

.card, .section, .chart-card {
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
    
    .charts-container {
        grid-template-columns: 1fr;
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
    
    .chart-card {
        padding: 20px;
    }
    
    .chart-wrapper {
        height: 220px;
    }
    
    .stats-mini {
        grid-template-columns: 1fr;
        gap: 10px;
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
    
    .chart-card h3 {
        font-size: 16px;
    }
    
    .chart-wrapper {
        height: 200px;
    }
}

/* Touch optimization */
@media (hover: none) and (pointer: coarse) {
    .menu a,
    .card,
    .chart-card {
        cursor:pointer;
    }
    
    .menu a {
        padding:15px;
    }
}

/* ===== LOGOUT BUTTON ===== */
.logout-form {
    margin-top: 10px;
}

.logout-btn {
    width: 100%;
    background: none;
    border: none;
    color: #ff6b6b;
    padding: 12px 15px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    cursor: pointer;
    transition: 0.3s;
}

.logout-btn i {
    width: 20px;
    text-align: center;
    font-size: 16px;
}

.logout-btn:hover {
    background: #2D6A4F;
    color: white;
    transform: translateX(5px);
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
            <li class="nav-item mt-auto">
    <li>
    <form method="POST" action="{{ route('logout') }}" class="logout-form">
        @csrf
        <button type="submit" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
            Déconnexion
        </button>
    </form>
</li>
</li>
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
            {{ Auth::user()->grade }}  {{ Auth::user()->name }}
        </div>
    </div>

    <div class="cards">
        <div class="card">
            <i class="fas fa-user-shield"></i>
            <h3>Agents enregistrés</h3>
            <p> {{$agentCount }} </p>
            <small style="color:#6c757d; margin-top:10px;">Total des effectifs</small>
        </div>

        <div class="card">
            <i class="fas fa-clock"></i>
            <h3>Stages en cours</h3>
            <p> {{$stageEncours}} </p>
            <small style="color:#6c757d; margin-top:10px;">{{$stageEncours > 0 ? round(($stageEncours/($stageEncours+$stageValider))*100, 1) : 0}}% des stages actifs</small>
        </div>

        <div class="card">
            <i class="fas fa-university"></i>
            <h3>Écoles partenaires</h3>
            <p> {{$EcoleStage}} </p>
            <small style="color:#6c757d; margin-top:10px;">Établissements</small>
        </div>

        <div class="card">
            <i class="fas fa-check-circle"></i>
            <h3>Stages terminés</h3>
            <p> {{$stageValider}} </p>
            <small style="color:#6c757d; margin-top:10px;">{{$stageValider > 0 ? round(($stageValider/($stageEncours+$stageValider))*100, 1) : 0}}% des stages</small>
        </div>
    </div>

    <div class="section">
        <h2>
            <i class="fas fa-chart-line"></i>
            Analyse des Stages
        </h2>
        
        <div class="charts-container">
            <!-- Graphique en camembert (Donut) -->
            <div class="chart-card">
                <h3>
                    <i class="fas fa-chart-pie"></i>
                    Répartition des Stages
                </h3>
                <div class="chart-wrapper">
                    <canvas id="stagesDonutChart"></canvas>
                </div>
                <div class="stats-mini">
                    <div class="stat-item">
                        <div class="stat-label">En cours</div>
                        <div class="stat-value" style="color: #1B4332;">{{$stageEncours}}</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Terminés</div>
                        <div class="stat-value" style="color: #D4AF37;">{{$stageValider}}</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Total</div>
                        <div class="stat-value">{{$stageEncours + $stageValider}}</div>
                    </div>
                </div>
            </div>

            <!-- Graphique en barres -->
            <div class="chart-card">
                <h3>
                    <i class="fas fa-chart-bar"></i>
                    Stages par École
                </h3>
                <div class="chart-wrapper">
                    <canvas id="ecolesBarChart"></canvas>
                </div>
                <div class="chart-legend" id="ecolesLegend">
                    <!-- La légende sera générée dynamiquement -->
                </div>
            </div>
        </div>

        <!-- Deuxième ligne de graphiques -->
        <div class="charts-container">
            <!-- Graphique linéaire (évolution) -->
            <div class="chart-card">
                <h3>
                    <i class="fas fa-chart-line"></i>
                    Évolution Mensuelle
                </h3>
                <div class="chart-wrapper">
                    <canvas id="evolutionLineChart"></canvas>
                </div>
                <div style="margin-top: 15px; text-align: center; color: #6c757d; font-size: 13px;">
                    <i class="fas fa-calendar-alt me-1"></i> Derniers 6 mois
                </div>
            </div>

            <!-- Graphique en barres horizontales (Grades) -->
            <div class="chart-card">
                <h3>
                    <i class="fas fa-star"></i>
                    Stagiaires par Grade
                </h3>
                <div class="chart-wrapper">
                    <canvas id="gradesBarChart"></canvas>
                </div>
                <div class="stats-mini">
                    <div class="stat-item">
                        <div class="stat-label">Officiers</div>
                        <div class="stat-value">32</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Sous-officiers</div>
                        <div class="stat-value">58</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Autres</div>
                        <div class="stat-value">10</div>
                    </div>
                </div>
            </div>
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
    
    // ===== INITIALISATION DES GRAPHIQUES =====
    
    // Données depuis le backend (avec valeurs par défaut si non définies)
    const stageEncours = {{$stageEncours ?? 24}};
    const stageValider = {{$stageValider ?? 18}};
    const totalStages = stageEncours + stageValider;
    
    // 1. Graphique en camembert (Donut)
    const donutCtx = document.getElementById('stagesDonutChart').getContext('2d');
    new Chart(donutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Stages en cours', 'Stages terminés'],
            datasets: [{
                data: [stageEncours, stageValider],
                backgroundColor: ['#1B4332', '#D4AF37'],
                borderColor: ['#0F2B21', '#B8960F'],
                borderWidth: 2,
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                        padding: 20,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const percentage = totalStages > 0 ? ((value / totalStages) * 100).toFixed(1) : 0;
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
    
    // 2. Graphique en barres (Stages par école)
    const ecolesCtx = document.getElementById('ecolesBarChart').getContext('2d');
    new Chart(ecolesCtx, {
        type: 'bar',
        data: {
            labels: ['École Nationale', 'Centre Spécialisé', 'École Militaire', 'Institut Supérieur', 'Académie Police'],
            datasets: [{
                label: 'Nombre de stages',
                data: [12, 8, 15, 7, 10],
                backgroundColor: '#1B4332',
                borderRadius: 6,
                barPercentage: 0.7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#e9ecef'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
    
    // 3. Graphique linéaire (Évolution mensuelle)
    const evolutionCtx = document.getElementById('evolutionLineChart').getContext('2d');
    new Chart(evolutionCtx, {
        type: 'line',
        data: {
            labels: ['Sep', 'Oct', 'Nov', 'Déc', 'Jan', 'Fév'],
            datasets: [
                {
                    label: 'Nouveaux stages',
                    data: [8, 12, 15, 10, 18, 14],
                    borderColor: '#1B4332',
                    backgroundColor: 'rgba(27, 67, 50, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#1B4332',
                    pointBorderColor: 'white',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                },
                {
                    label: 'Stages terminés',
                    data: [5, 8, 10, 12, 9, 15],
                    borderColor: '#D4AF37',
                    backgroundColor: 'rgba(212, 175, 55, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#D4AF37',
                    pointBorderColor: 'white',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#e9ecef'
                    }
                }
            }
        }
    });
    
    // 4. Graphique en barres horizontales (Grades)
    const gradesCtx = document.getElementById('gradesBarChart').getContext('2d');
    new Chart(gradesCtx, {
        type: 'bar',
        data: {
            labels: ['Caporal', 'Sergent', 'Adjudant', 'Lieutenant', 'Capitaine', 'Commandant'],
            datasets: [{
                label: 'Nombre de stagiaires',
                data: [25, 18, 12, 8, 5, 2],
                backgroundColor: '#D4AF37',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        color: '#e9ecef'
                    }
                },
                y: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
    
    // Animation des cartes au survol
    const cards = document.querySelectorAll('.card, .chart-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s ease';
        });
    });
});
</script>

<!-- Script optionnel pour SweetAlert si vous voulez des notifications -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>