<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Gestion des Stages ASP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     @include('style.style')
</head>
<body>
    <!-- Menu mobile -->
    <div class="mobile-toggle" id="mobileToggle">
        <i class="fas fa-bars"></i>
    </div>

    <!-- Sidebar -->
     @include('style.sidebar')

    <!-- Contenu principal -->
    <div class="main-content" id="mainContent">
        <!-- Header -->
        <header class="main-header">
            <div class="header-left">
                <h1>Tableau de Bord</h1>
                <p>Agent connecté  : {{ Auth::user()->grade ?? 'Admin Direction' }}  {{ Auth::user()->name ?? 'Admin Direction' }}</p>
            </div>
            <div class="header-right">
                <div class="search-box">
                <h4>Agent connecté  : {{ Auth::user()->grade ?? 'Admin Direction' }}  {{ Auth::user()->name ?? 'Admin Direction' }}</h4>
                </div>
                <div class="notification-bell">
                    
                </div>
            </div>
        </header>

        <!-- Cartes de statistiques -->
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-title">Stagiaires Actifs</div>
                    <div class="stat-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
                <div class="stat-number">142</div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                    <span>12% ce mois</span>
                </div>
            </div>
            
            <div class="stat-card green">
                <div class="stat-header">
                    <div class="stat-title">Stages Validés</div>
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="stat-number">89</div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                    <span>8% ce mois</span>
                </div>
            </div>
            
            <div class="stat-card orange">
                <div class="stat-header">
                    <div class="stat-title">En Attente</div>
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
                <div class="stat-number">24</div>
                <div class="stat-trend trend-down">
                    <i class="fas fa-arrow-down"></i>
                    <span>3% ce mois</span>
                </div>
            </div>
            
            
        </div>

        <!-- Contenu principal en grille -->
       
    </div>


</body>
</html>