<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <i class="fas fa-shield-alt"></i>
        </div>
        <div class="sidebar-title">ASP Stages</div>
    </div>
    
    <nav class="sidebar-nav">
        <a href="{{route('admin.dashboard')}}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i>
            <span class="nav-text">Tableau de bord</span>
        </a>
        <a href="{{route('users.agent.index')}}" class="nav-item {{ request()->routeIs('users.agent.*') ? 'active' : '' }}">
            <i class="fas fa-user-graduate"></i>
            <span class="nav-text">Stagiaires</span>
        </a>
        <a href="{{route('admin.ecole.index')}}" class="nav-item {{ request()->routeIs('admin.ecole.*') ? 'active' : '' }}">
            <i class="fas fa-university"></i>
            <span class="nav-text">Établissements</span>
        </a>
        <a href="{{route('admin.service.index')}}" class="nav-item {{ request()->routeIs('admin.service.*') ? 'active' : '' }}">
            <i class="fas fa-sitemap"></i>
            <span class="nav-text">Services</span>
        </a>
        <a href="{{route('users.affectation.agent')}}" class="nav-item {{ request()->routeIs('users.affectation.*') ? 'active' : '' }}">
            <i class="fas fa-clipboard-check"></i>
            <span class="nav-text">Affectations</span>
        </a>
        <a href="{{route('admin.listes.Admin')}}" class="nav-item {{ request()->routeIs('admin.listes.*') ? 'active' : '' }}">
            <i class="fas fa-users-cog"></i>
            <span class="nav-text">Administration</span>
        </a>
    </nav>
    
    <div class="sidebar-footer">
        <a href="{{ route('logout') }}" 
           class="nav-item logout-item" 
           style="color: #ff7675; margin-bottom: 15px;"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span class="nav-text">Déconnexion</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

        <hr style="border-color: rgba(255,255,255,0.1); margin: 10px 0;">

        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="user-details">
                <h4>{{ Auth::user()->name ?? 'Admin Direction' }}</h4>
            </div>
        </div>
    </div>
</div>