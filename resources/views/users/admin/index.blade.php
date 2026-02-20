<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
    <title>Gestion des Administrateurs - ASP Stages</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    
    <!-- SweetAlert2 -->
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
            --sidebar-width: 260px;
            --sidebar-width-mobile: 70px;
        }

        /* ================== GLOBAL ================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--bg);
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding-left: var(--sidebar-width);
            transition: padding-left 0.3s ease;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ================== SIDEBAR ================== */
        .sidebar {
            width: var(--sidebar-width);
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
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        .logo { 
            text-align: center; 
            margin-bottom: 40px; 
        }

        .logo h2 { 
            color: var(--gold); 
            font-size: 18px; 
            letter-spacing: 2px;
            word-break: break-word;
        }

        .menu { 
            list-style: none; 
            padding: 0; 
        }

        .menu li { 
            margin: 8px 0; 
        }

        .menu a {
            text-decoration: none;
            color: white;
            padding: 12px 15px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s;
            font-size: 15px;
            white-space: nowrap;
        }

        .menu a i {
            font-size: 18px;
            width: 24px;
            text-align: center;
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
            margin-top: 20px;
        }

        /* Menu toggle button for mobile */
        .mobile-toggle {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1001;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            align-items: center;
            justify-content: center;
        }

        /* Sidebar overlay for mobile */
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

        /* ================== MAIN CONTENT ================== */
        .main-content { 
            padding: 30px 40px; 
            transition: all 0.3s ease;
            width: 100%;
            min-height: 100vh;
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
            flex-wrap: wrap;
            gap: 20px;
        }

        .main-header h1 { 
            font-size: clamp(20px, 4vw, 24px); 
            font-weight: 600; 
            display: flex; 
            align-items: center; 
            gap: 10px; 
            margin: 0;
        }

        .main-header p { 
            margin: 5px 0 0 0; 
            opacity: .8; 
            font-size: clamp(13px, 3vw, 14px);
        }

        .header-left {
            flex: 1;
            min-width: 250px;
        }

        .header-right {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }

        /* ================== SEARCH BOX ================== */
        .search-box { 
            position: relative; 
            min-width: 200px;
        }

        .search-box i {
            position: absolute; 
            top: 50%; 
            left: 15px; 
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 14px;
            z-index: 1;
        }

        .search-box input {
            padding: 12px 15px 12px 40px;
            border-radius: 30px;
            border: 1px solid rgba(255,255,255,0.2);
            width: 100%;
            min-width: 250px;
            background: rgba(255,255,255,0.15);
            color: white;
            transition: all 0.3s;
        }

        .search-box input::placeholder {
            color: rgba(255,255,255,0.7);
        }

        .search-box input:focus {
            background: rgba(255,255,255,0.25);
            outline: none;
            border-color: white;
        }

        /* ================== BUTTON ================== */
        .btn-add {
            background: var(--primary);
            color: white;
            border-radius: 30px;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
            white-space: nowrap;
            cursor: pointer;
        }

        .btn-add:hover { 
            background: var(--primary-light); 
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(11, 61, 46, 0.3);
        }

        .btn-cancel { 
            background: #6c757d; 
            color: white; 
            border-radius: 30px; 
            padding: 10px 25px; 
            border: none;
            font-weight: 600;
            transition: all 0.3s;
            cursor: pointer;
        }

        .btn-cancel:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .btn-submit { 
            background: var(--primary); 
            color: white; 
            border-radius: 30px; 
            padding: 10px 25px; 
            border: none;
            font-weight: 600;
            transition: all 0.3s;
            cursor: pointer;
        }

        .btn-submit:hover { 
            background: var(--primary-light); 
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(11, 61, 46, 0.3);
        }

        .btn-delete {
            background: #dc3545;
            color: white;
            border-radius: 30px;
            padding: 10px 25px;
            border: none;
            font-weight: 600;
            transition: all 0.3s;
            cursor: pointer;
        }

        .btn-delete:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

        .btn-action {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            color: var(--primary);
            transition: all 0.3s;
            text-decoration: none;
            margin: 0 3px;
        }

        .btn-action:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        /* ================== TABLE ================== */
        .table-container {
            background: var(--card);
            border-radius: 20px;
            padding: 25px;
            overflow-x: auto;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            width: 100%;
            margin-bottom: 0;
            min-width: 800px;
        }

        .table th, .table td { 
            vertical-align: middle !important;
            padding: 15px 12px;
        }

        .table th {
            background: #f8f9fa;
            font-weight: 600;
            color: var(--primary);
            white-space: nowrap;
        }

        .table td {
            word-break: break-word;
            font-size: 14px;
        }

        .school-name {
            display: flex;
            align-items: center;
            font-weight: 500;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 30px;
            font-weight: 500;
        }

        .actions {
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        /* ================== PAGINATION ================== */
        .pagination {
            flex-wrap: wrap;
            justify-content: center;
            gap: 5px;
            margin-top: 20px !important;
        }

        .pagination .page-link {
            border-radius: 8px !important;
            margin: 0 2px;
            color: var(--primary);
            border: 1px solid #dee2e6;
            padding: 8px 12px;
        }

        .pagination .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .pagination .page-link:hover {
            background: var(--primary-light);
            color: white;
        }

        /* ================== EMPTY STATE ================== */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 20px;
            margin-top: 20px;
        }

        .empty-icon {
            font-size: 70px;
            color: var(--gray);
            opacity: 0.3;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            color: var(--text);
            margin-bottom: 10px;
        }

        .empty-state p {
            color: var(--gray);
            margin-bottom: 20px;
        }

        /* ================== MESSAGE ================== */
        .message {
            padding: 12px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: none;
        }

        .message.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            display: block;
        }

        .message.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            display: block;
        }

        /* ================== MODAL ================== */
        .asp-modal .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }

        .asp-modal .modal-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            padding: 20px 25px;
        }

        .asp-modal .modal-header .btn-close {
            filter: brightness(0) invert(1);
            opacity: 0.8;
        }

        .asp-modal .modal-header .btn-close:hover {
            opacity: 1;
        }

        .asp-modal .modal-body {
            padding: 25px;
        }

        .asp-modal .form-group {
            margin-bottom: 20px;
        }

        .asp-modal .form-label {
            font-weight: 600;
            color: var(--text);
            margin-bottom: 8px;
            font-size: 14px;
        }

        .asp-modal .form-label i {
            margin-right: 8px;
            color: var(--primary);
        }

        .asp-modal .form-control,
        .asp-modal .form-select { 
            border-radius: 12px; 
            padding: 12px 15px; 
            border: 2px solid #e9ecef;
            transition: all 0.3s;
            font-size: 15px;
            width: 100%;
        }

        .asp-modal .form-control:focus,
        .asp-modal .form-select:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
            outline: none;
        }

        .asp-modal .modal-footer { 
            border-top: none; 
            padding: 20px 25px;
            background: #f8f9fa;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
        }

        /* ================== MEDIA QUERIES ================== */
        @media screen and (max-width: 992px) {
            body {
                padding-left: var(--sidebar-width-mobile);
            }
            
            .sidebar {
                width: var(--sidebar-width-mobile);
                padding: 20px 10px;
            }
            
            .logo h2 {
                font-size: 12px;
                white-space: normal;
                word-break: break-word;
            }
            
            .menu a span {
                display: none;
            }
            
            .menu a {
                justify-content: center;
                padding: 12px;
            }
            
            .menu a i {
                font-size: 20px;
                margin: 0;
                width: auto;
            }
            
            .sidebar-footer {
                font-size: 10px;
                writing-mode: vertical-rl;
                transform: rotate(180deg);
                white-space: nowrap;
                height: auto;
                align-self: center;
            }
        }

        @media screen and (max-width: 768px) {
            .mobile-toggle {
                display: flex;
            }
            
            body {
                padding-left: 0;
            }
            
            .sidebar {
                transform: translateX(-100%);
                width: 260px;
                padding: 30px 20px;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .sidebar .menu a span {
                display: inline;
            }
            
            .sidebar .menu a {
                justify-content: flex-start;
            }
            
            .sidebar .logo h2 {
                font-size: 16px;
            }
            
            .sidebar-footer {
                writing-mode: horizontal-tb;
                transform: none;
            }
            
            .main-content {
                padding: 70px 15px 20px;
            }
            
            .main-header {
                margin-top: 0;
                flex-direction: column;
                align-items: stretch;
                padding: 20px;
            }
            
            .header-right {
                flex-direction: column;
                width: 100%;
            }
            
            .search-box {
                width: 100%;
            }
            
            .search-box input {
                width: 100%;
            }
            
            div[style*="display: flex; justify-content: flex-end"] {
                justify-content: stretch !important;
            }
            
            .btn-add {
                width: 100%;
                justify-content: center;
            }
            
            .table-container {
                padding: 15px;
                border-radius: 15px;
            }
            
            .table th, 
            .table td {
                padding: 12px 8px;
                font-size: 13px;
            }
            
            .badge {
                font-size: 11px;
                padding: 4px 8px;
            }
            
            .btn-action {
                width: 30px;
                height: 30px;
            }
            
            .modal-dialog {
                margin: 10px;
            }
            
            .modal-body {
                padding: 20px;
            }
            
            .modal-footer {
                flex-direction: column-reverse;
                gap: 10px;
            }
            
            .modal-footer button {
                width: 100%;
            }
            
            .row {
                margin: 0;
            }
            
            .col-md-6 {
                padding: 0 5px;
                margin-bottom: 10px;
            }
        }

        @media screen and (max-width: 480px) {
            .main-header {
                padding: 15px;
            }
            
            .main-header h1 {
                font-size: 20px;
            }
            
            .main-header p {
                font-size: 12px;
            }
            
            .table-container {
                padding: 10px;
            }
            
            .table th, 
            .table td {
                padding: 10px 6px;
                font-size: 12px;
            }
            
            .school-name i {
                font-size: 12px;
                margin-right: 5px !important;
            }
            
            .btn-action {
                width: 28px;
                height: 28px;
            }
            
            .btn-action i {
                font-size: 12px;
            }
            
            .modal-header {
                padding: 15px 20px;
            }
            
            .modal-header h5 {
                font-size: 16px;
            }
            
            .modal-body {
                padding: 15px;
            }
            
            .form-control,
            .form-select {
                padding: 10px 12px;
                font-size: 14px;
            }
            
            .modal-footer {
                padding: 15px;
            }
        }

        @media screen and (min-width: 1400px) {
            .main-content {
                max-width: 1600px;
                margin: 0 auto;
            }
        }

        /* ================== ANIMATIONS ================== */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .main-content {
            animation: slideIn 0.5s ease;
        }

        /* ================== SCROLLBAR ================== */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-light);
        }

        /* ================== TOUCH OPTIMIZATION ================== */
        @media (hover: none) and (pointer: coarse) {
            .menu a,
            .btn-add,
            .btn-action,
            .page-link {
                padding: 15px 20px;
                font-size: 16px;
            }
            
            .btn-action {
                width: 40px;
                height: 40px;
            }
            
            .table td {
                padding: 15px 10px;
            }
        }
    </style>
</head>
<body>

    <!-- Mobile toggle button -->
    <div class="mobile-toggle" id="mobileToggle">
        <i class="fas fa-bars"></i>
    </div>

    <!-- Sidebar overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
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


    <!-- Contenu principal -->
    <div class="main-content" id="mainContent">
        <!-- Header -->
        <header class="main-header">
            <div class="header-left">
                <h1><i class="fas fa-university"></i> Gestion des Administrateurs</h1>
                <p>Administration des comptes administrateurs</p>
            </div>
            <div class="header-right">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Rechercher un administrateur...">
                </div>
            </div>
        </header>

        <!-- Bouton Ajouter -->
        <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
            <button class="btn-add" id="addSchoolBtn" type="button" data-bs-toggle="modal" data-bs-target="#addStagiareModal">
                <i class="fas fa-plus-circle"></i>
                Ajouter un administrateur
            </button>
        </div>

        <!-- Message de notification -->
        <div class="message" id="notificationMessage"></div>

        <!-- Tableau des administrateurs -->
        <div class="table-container">
            <table id="schoolsTable" class="table table-hover w-100">
                <thead>
                    <tr>
                        <th width="10%">Numéro</th>
                        <th width="20%">Nom</th>
                        <th width="20%">Prénom</th>
                        <th width="15%">Grade</th>
                        <th width="15%">Téléphone</th>
                        <th width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stagiares as $stagiare)
                    <tr>
                        <td>
                            <div class="school-name">
                                <i class="fas fa-id-card" style="margin-right: 10px; color: var(--primary);"></i>
                                {{$stagiare->id}}
                            </div>
                        </td>
                        <td>{{$stagiare->name}}</td>
                        <td>{{$stagiare->prenom}}</td>
                        <td><span class="badge bg-light text-dark">{{$stagiare->grade}}</span></td>
                        <td>{{ $stagiare->tel }}</td>
                        <td>
                            <div class="actions">
                                <a class="btn-action btn-edit" title="Modifier" href="{{ route('users.editAgentStagiare', $stagiare->id) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn-action btn-delete" title="Supprimer" onclick="confirmDelete({{$stagiare->id}}, '{{$stagiare->name}} {{$stagiare->prenom}}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{$stagiares->links()}}
            </div>
        </div>

        <!-- État vide -->
        <div class="empty-state" id="emptyState" style="display: none;">
            <div class="empty-icon">
                <i class="fas fa-university"></i>
            </div>
            <h3>Aucun administrateur enregistré</h3>
            <p>Commencez par ajouter votre premier administrateur.</p>
            <button class="btn-add" id="addFirstSchoolBtn" type="button" data-bs-toggle="modal" data-bs-target="#addStagiareModal">
                <i class="fas fa-plus-circle"></i>
                Ajouter un administrateur
            </button>
        </div>
    </div>

    <!-- Modal d'ajout/modification -->
    <div class="modal fade asp-modal" id="addStagiareModal" tabindex="-1" aria-labelledby="addStagiareModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStagiareModalLabel">
                        <i class="fas fa-user-graduate"></i> Ajouter un administrateur
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="stagiareForm" action="{{route('admin.add.admin')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="nom">
                                        <i class="fas fa-user"></i> Nom *
                                    </label>
                                    <input type="text" 
                                           id="nom" 
                                           name="name"
                                           class="form-control @error('name') is-invalid @enderror" 
                                           placeholder="Nom de famille"
                                           value="{{ old('name') }}"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="prenom">
                                        <i class="fas fa-user"></i> Prénom *
                                    </label>
                                    <input type="text" 
                                           id="prenom" 
                                           name="prenom"
                                           class="form-control @error('prenom') is-invalid @enderror" 
                                           placeholder="Prénom"
                                           value="{{ old('prenom') }}"
                                           required>
                                    @error('prenom')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="grade">
                                        <i class="fas fa-graduation-cap"></i> Grade *
                                    </label>
                                    <select id="grade" name="grade" class="form-select @error('grade') is-invalid @enderror" required>
                                        <option value="">Sélectionner un grade</option>
                                        <option value="Caporal" {{ old('grade') == 'Caporal' ? 'selected' : '' }}>Caporal</option>
                                        <option value="Caporal-chef" {{ old('grade') == 'Caporal-chef' ? 'selected' : '' }}>Caporal chef</option>
                                        <option value="Sergent" {{ old('grade') == 'Sergent' ? 'selected' : '' }}>Sergent</option>
                                        <option value="Sergent-chef" {{ old('grade') == 'Sergent-chef' ? 'selected' : '' }}>Sergent chef</option>
                                        <option value="Sergent-chef-major" {{ old('grade') == 'Sergent-chef-major' ? 'selected' : '' }}>Sergent chef major</option>
                                        <option value="Adjudant" {{ old('grade') == 'Adjudant' ? 'selected' : '' }}>Adjudant</option>
                                        <option value="Adjudant-chef" {{ old('grade') == 'Adjudant-chef' ? 'selected' : '' }}>Adjudant chef</option>
                                        <option value="Adjudant-chef-major" {{ old('grade') == 'Adjudant-chef-major' ? 'selected' : '' }}>Adjudant chef major</option>
                                        <option value="Sous-lieutenant" {{ old('grade') == 'Sous-lieutenant' ? 'selected' : '' }}>Sous-lieutenant</option>
                                        <option value="Lieutenant" {{ old('grade') == 'Lieutenant' ? 'selected' : '' }}>Lieutenant</option>
                                        <option value="Capitaine" {{ old('grade') == 'Capitaine' ? 'selected' : '' }}>Capitaine</option>
                                        <option value="Commandant" {{ old('grade') == 'Commandant' ? 'selected' : '' }}>Commandant</option>
                                        <option value="Lieutenant-colonel" {{ old('grade') == 'Lieutenant-colonel' ? 'selected' : '' }}>Lieutenant colonel</option>
                                        <option value="Colonel" {{ old('grade') == 'Colonel' ? 'selected' : '' }}>Colonel</option>
                                    </select>
                                    @error('grade')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="tel">
                                        <i class="fas fa-phone"></i> Téléphone *
                                    </label>
                                    <input type="text" 
                                           id="tel" 
                                           name="tel"
                                           class="form-control @error('tel') is-invalid @enderror" 
                                           placeholder="06 XX XX XX XX"
                                           value="{{ old('tel') }}"
                                           required>
                                    @error('tel')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="password">
                                        <i class="fas fa-lock"></i> Mot de passe *
                                    </label>
                                    <input type="password"
                                           id="password"
                                           name="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="Minimum 4 caractères"
                                           minlength="4"
                                           required>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="password_confirmation">
                                        <i class="fas fa-lock"></i> Confirmation *
                                    </label>
                                    <input type="password"
                                           id="password_confirmation"
                                           name="password_confirmation"
                                           class="form-control"
                                           placeholder="Confirmer le mot de passe"
                                           minlength="4"
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Annuler
                        </button>
                        <button type="submit" class="btn btn-submit" id="submitBtn">
                            <i class="fas fa-save me-1"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Initialisation de DataTable
            var table = $('#schoolsTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json"
                },
                "dom": 'rtip',
                "pageLength": 10,
                "ordering": true,
                "responsive": true,
                "paging": false,
                "searching": true
            });

            // Liaison de la recherche personnalisée
            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Mobile menu toggle
            $('#mobileToggle').click(function() {
                $('#sidebar').toggleClass('active');
                $('#sidebarOverlay').toggleClass('active');
                $(this).find('i').toggleClass('fa-bars fa-times');
            });

            // Close sidebar when clicking on overlay
            $('#sidebarOverlay').click(function() {
                $('#sidebar').removeClass('active');
                $('#sidebarOverlay').removeClass('active');
                $('#mobileToggle i').removeClass('fa-times').addClass('fa-bars');
            });

            // Close sidebar when clicking on menu links (mobile)
            $('.sidebar .menu a').click(function() {
                if ($(window).width() <= 768) {
                    $('#sidebar').removeClass('active');
                    $('#sidebarOverlay').removeClass('active');
                    $('#mobileToggle i').removeClass('fa-times').addClass('fa-bars');
                }
            });

            // Handle window resize
            $(window).on('resize', function() {
                if ($(window).width() > 768) {
                    $('#sidebar').removeClass('active');
                    $('#sidebarOverlay').removeClass('active');
                    $('#mobileToggle i').removeClass('fa-times').addClass('fa-bars');
                }
            });
        });

        // Messages de notification
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Succès !',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end',
                    timerProgressBar: true
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#0B3D2E'
                });
            @endif
            
            @if($errors->any())
                Swal.fire({
                    icon: 'warning',
                    title: 'Attention',
                    html: '{!! implode("<br>", $errors->all()) !!}',
                    confirmButtonColor: '#0B3D2E'
                });
            @endif
        });

        // Validation du formulaire
        document.getElementById('stagiareForm').addEventListener('submit', function (e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (password.length < 4) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Mot de passe trop court',
                    text: 'Le mot de passe doit contenir au moins 4 caractères',
                    confirmButtonColor: '#0B3D2E'
                });
                return;
            }

            if (password !== confirmPassword) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Les mots de passe ne correspondent pas',
                    confirmButtonColor: '#0B3D2E'
                });
                return;
            }
        });

        // Fonction de confirmation de suppression
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Supprimer cet administrateur ?',
                text: "Êtes-vous sûr de vouloir supprimer : " + name,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/admin/administrateur/delete/" + id;
                }
            });
        }
    </script>
</body>
</html>