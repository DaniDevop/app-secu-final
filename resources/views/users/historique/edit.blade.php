<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
<title>Modifier l'Historique du Stage - ASP</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- FontAwesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<!-- SweetAlert2 -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

<style>
:root {
    --primary: #0B3D2E;
    --primary-light: #1F6F5C;
    --gold: #D4AF37;
    --bg: #F1F4F8;
    --sidebar-width: 260px;
    --sidebar-width-mobile: 70px;
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    background: var(--bg);
    font-family: 'Segoe UI', sans-serif;
    padding-left: var(--sidebar-width);
    transition: padding-left 0.3s ease;
    min-height: 100vh;
}

/* Sidebar */
.sidebar {
    width: var(--sidebar-width);
    background: linear-gradient(180deg, #081C15, #1B4332);
    color: white;
    padding: 30px 20px;
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    z-index: 1000;
    transition: all 0.3s ease;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.logo { text-align: center; margin-bottom: 40px; }
.logo h2 { color: var(--gold); font-size: 18px; letter-spacing: 2px; }

.menu { list-style: none; padding: 0; }
.menu li { margin: 8px 0; }
.menu a {
    text-decoration: none;
    color: white;
    padding: 12px 15px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s;
}
.menu a:hover, .menu a.active { background: #2D6A4F; transform: translateX(5px); }

.sidebar-footer { font-size: 12px; text-align: center; opacity: .7; margin-top: 20px; }

/* Menu toggle mobile */
.menu-toggle {
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

/* Main content */
.main-content {
    padding: 30px 40px;
    transition: all 0.3s ease;
    min-height: 100vh;
}

/* Header */
.page-header {
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

.page-header h1 {
    font-size: 24px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0;
}

.page-header p { margin: 5px 0 0; opacity: .8; }

/* Card */
.card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    border: none;
    overflow: hidden;
}

.card-header {
    background: #f8f9fa;
    padding: 20px 25px;
    border-bottom: 2px solid #e9ecef;
}

.card-header h5 {
    margin: 0;
    color: var(--primary);
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.card-body { padding: 30px 25px; }

/* Formulaire */
.form-section {
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e9ecef;
}

.form-section:last-child { border-bottom: none; }

.form-section-title {
    color: var(--primary);
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.form-label {
    font-weight: 500;
    color: #495057;
    margin-bottom: 8px;
}

.form-control, .form-select {
    border-radius: 12px;
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    transition: all 0.3s;
}

.form-control:focus, .form-select:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
    outline: none;
}

.form-control.is-invalid, .form-select.is-invalid {
    border-color: #dc3545;
    background-image: none;
}

.invalid-feedback {
    font-size: 13px;
    margin-top: 5px;
}

/* Input group */
.input-group-text {
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 12px 0 0 12px;
    padding: 0 15px;
}

.input-group .form-control {
    border-left: none;
    border-radius: 0 12px 12px 0;
}

/* Readonly field */
.field-readonly {
    background: #f8f9fa;
    padding: 12px 15px;
    border-radius: 12px;
    border: 2px solid #e9ecef;
    display: flex;
    align-items: center;
    gap: 10px;
}

.field-readonly i { color: var(--primary); }

/* Rating stars */
.rating {
    display: flex;
    gap: 5px;
    align-items: center;
}

.rating-input {
    display: none;
}

.rating-star {
    font-size: 24px;
    color: #ddd;
    cursor: pointer;
    transition: all 0.2s;
}

.rating-star:hover,
.rating-star.active,
.rating-star.selected {
    color: #ffc107;
}

/* Buttons */
.btn {
    padding: 12px 25px;
    border-radius: 30px;
    font-weight: 600;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-primary {
    background: var(--primary);
    border: none;
    color: white;
}

.btn-primary:hover {
    background: var(--primary-light);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(11, 61, 46, 0.3);
}

.btn-outline-secondary {
    border: 2px solid #e9ecef;
    color: #6c757d;
}

.btn-outline-secondary:hover {
    background: #e9ecef;
    transform: translateY(-2px);
}

.btn-danger {
    background: #dc3545;
    border: none;
    color: white;
}

.btn-danger:hover {
    background: #c82333;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
}

/* Info badges */
.info-badge {
    background: #e7f3ff;
    color: #0d6efd;
    padding: 4px 12px;
    border-radius: 30px;
    font-size: 13px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

/* Alert */
.alert-info {
    background: #e7f3ff;
    border: none;
    border-radius: 12px;
    padding: 15px 20px;
    color: #0d6efd;
    margin-bottom: 25px;
}

/* Responsive */
@media screen and (max-width: 992px) {
    body { padding-left: var(--sidebar-width-mobile); }
    .sidebar { width: var(--sidebar-width-mobile); padding: 20px 10px; }
    .menu a span { display: none; }
    .menu a { justify-content: center; }
    .sidebar-footer { writing-mode: vertical-rl; transform: rotate(180deg); }
}

@media screen and (max-width: 768px) {
    .menu-toggle { display: flex; }
    body { padding-left: 0; }
    .sidebar { transform: translateX(-100%); width: 260px; }
    .sidebar.active { transform: translateX(0); }
    .sidebar .menu a span { display: inline; }
    .sidebar .menu a { justify-content: flex-start; }
    .sidebar-footer { writing-mode: horizontal-tb; transform: none; }
    .page-header { margin-top: 50px; }
    .main-content { padding: 20px 15px; }
    .card-body { padding: 20px; }
}

/* Select2 customization */
.select2-container--bootstrap-5 .select2-selection {
    min-height: 48px;
    padding: 8px 12px;
    border: 2px solid #e9ecef;
    border-radius: 12px;
}

.select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
    line-height: 28px;
}

/* Loading spinner */
.spinner-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255,255,255,0.8);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.spinner-overlay.active { display: flex; }
</style>
</head>
<body>

<!-- Loading Spinner -->
<div class="spinner-overlay" id="spinner">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="visually-hidden">Chargement...</span>
    </div>
</div>

<!-- Menu toggle mobile -->
<button class="menu-toggle" id="menuToggle">
    <i class="fas fa-bars"></i>
</button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div>
        <div class="logo"><h2>SÉCURITÉ<br>PÉNITENTIAIRE</h2></div>
        <ul class="menu">
            <li><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i><span> Accueil</span></a></li>
            <li><a href="{{route('users.agent.index')}}"><i class="fas fa-user-shield"></i><span> Agents</span></a></li>
            <li><a href="{{route('admin.ecole.index')}}"><i class="fas fa-university"></i><span> Écoles</span></a></li>
            <li><a href="{{route('admin.service.index')}}"><i class="fas fa-briefcase"></i><span> Services</span></a></li>
            <li><a href="{{route('admin.listes.Admin')}}"><i class="fas fa-users-cog"></i><span> Administrations</span></a></li>
            <li><a href="{{route('users.affectation.agent')}}"><i class="fas fa-exchange-alt"></i><span> Stages</span></a></li>
            <li><a href="{{route('users.historique.agent.stage')}}" class="active"><i class="fas fa-history"></i><span> Historique</span></a></li>
            <li class="nav-item mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link text-start w-100" style="color: white;">
                        <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                    </button>
                </form>
            </li>
        </ul>
    </div>
    <div class="sidebar-footer">Application interne sécurisée</div>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="page-header">
        <div>
            <h1><i class="fas fa-edit"></i> Modifier l'Historique</h1>
            <p>Édition des informations de stage pour {{ $historique->agent_nom ?? '' }} {{ $historique->agent_prenom ?? '' }}</p>
        </div>
        <div class="d-flex gap-2">
            <span class="info-badge">
                <i class="fas fa-calendar"></i>
                {{ \Carbon\Carbon::parse($historique->date_de_fin)->format('d/m/Y') }}
            </span>
        </div>
    </div>

    <!-- Messages Flash -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i> Veuillez corriger les erreurs ci-dessous
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Formulaire d'édition -->
    <div class="card">
        <div class="card-header">
            <h5>
                <i class="fas fa-history"></i>
                Détails du stage
            </h5>
        </div>
        <div class="card-body">
            <form id="editHistoriqueForm" action="" method="POST">
                @csrf

                <!-- Section: Informations de l'agent (readonly) -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-user-shield"></i>
                        Agent concerné
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Matricule</label>
                            <div class="field-readonly">
                                <i class="fas fa-id-card"></i>
                                <span>{{ $historique->agent_matricule ?? 'Non disponible' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Nom complet</label>
                            <div class="field-readonly">
                                <i class="fas fa-user"></i>
                                <span>{{ $historique->agent_nom ?? '' }} {{ $historique->agent_prenom ?? '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Grade</label>
                            <div class="field-readonly">
                                <i class="fas fa-star"></i>
                                <span>{{ $historique->agent_grade ?? 'Non spécifié' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section: Établissement (readonly) -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-university"></i>
                        Établissement d'accueil
                    </div>
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">École / Établissement</label>
                            <div class="field-readonly">
                                <i class="fas fa-school"></i>
                                <span>{{ $historique->ecole_nom ?? 'Non assigné' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Type de formation</label>
                            <div class="field-readonly">
                                <i class="fas fa-graduation-cap"></i>
                                <span>{{ $historique->type_formation ?? 'Non spécifié' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section: Période du stage -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-calendar-alt"></i>
                        Période du stage
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Date de début</label>
                            <div class="field-readonly">
                                <i class="fas fa-calendar-plus"></i>
                                <span>{{ \Carbon\Carbon::parse($historique->affection_date_debut)->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="date_fin" class="form-label">Date de fin <span class="text-danger">*</span></label>
                            <input type="date" 
                                   class="form-control @error('date_fin') is-invalid @enderror" 
                                   id="date_fin" 
                                   name="date_fin" 
                                   value="{{ old('date_fin', $historique->date_fin) }}" 
                                   required>
                            @error('date_fin')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Durée estimée</label>
                            <div class="field-readonly">
                                <i class="fas fa-clock"></i>
                                <span>
                                    @php
                                        $debut = \Carbon\Carbon::parse($historique->affection_date_debut);
                                        $fin = \Carbon\Carbon::parse($historique->date_fin);
                                        $duree = $debut->diffInDays($fin);
                                    @endphp
                                    {{ $duree }} jours
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section: Évaluation -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-chart-line"></i>
                        Évaluation du stage
                    </div>

                    <!-- Alert info -->
                    <div class="alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Les notes sont sur 20. La mention est automatiquement calculée en fonction de la moyenne.
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="moyenne" class="form-label">Moyenne /20 <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-star"></i>
                                </span>
                                <input type="number" 
                                       class="form-control @error('moyenne') is-invalid @enderror" 
                                       id="moyenne" 
                                       name="moyenne" 
                                       value="{{ old('moyenne', $historique->moyenne) }}" 
                                       step="0.01" 
                                       min="0" 
                                       max="20" 
                                       required
                                       onchange="calculateMention()">
                            </div>
                            @error('moyenne')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="mention" class="form-label">Mention <span class="text-danger">*</span></label>
                            <select class="form-select @error('mention') is-invalid @enderror" 
                                    id="mention" 
                                    name="mention" 
                                    required>
                                <option value="">Sélectionner une mention</option>
                                <option value="Insuffisant" {{ old('mention', $historique->mention) == 'Insuffisant' ? 'selected' : '' }}>Insuffisant</option>
                                <option value="Passable" {{ old('mention', $historique->mention) == 'Passable' ? 'selected' : '' }}>Passable</option>
                                <option value="Assez bien" {{ old('mention', $historique->mention) == 'Assez bien' ? 'selected' : '' }}>Assez bien</option>
                                <option value="Bien" {{ old('mention', $historique->mention) == 'Bien' ? 'selected' : '' }}>Bien</option>
                                <option value="Très bien" {{ old('mention', $historique->mention) == 'Très bien' ? 'selected' : '' }}>Très bien</option>
                                <option value="Excellent" {{ old('mention', $historique->mention) == 'Excellent' ? 'selected' : '' }}>Excellent</option>
                            </select>
                            @error('mention')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="appreciation" class="form-label">Appréciation générale</label>
                            <div class="rating" id="rating">
                                <input type="radio" name="rating" value="1" id="star1" class="rating-input" {{ old('rating', $historique->rating) == 1 ? 'checked' : '' }}>
                                <label for="star1" class="rating-star"><i class="far fa-star"></i></label>
                                <input type="radio" name="rating" value="2" id="star2" class="rating-input" {{ old('rating', $historique->rating) == 2 ? 'checked' : '' }}>
                                <label for="star2" class="rating-star"><i class="far fa-star"></i></label>
                                <input type="radio" name="rating" value="3" id="star3" class="rating-input" {{ old('rating', $historique->rating) == 3 ? 'checked' : '' }}>
                                <label for="star3" class="rating-star"><i class="far fa-star"></i></label>
                                <input type="radio" name="rating" value="4" id="star4" class="rating-input" {{ old('rating', $historique->rating) == 4 ? 'checked' : '' }}>
                                <label for="star4" class="rating-star"><i class="far fa-star"></i></label>
                                <input type="radio" name="rating" value="5" id="star5" class="rating-input" {{ old('rating', $historique->rating) == 5 ? 'checked' : '' }}>
                                <label for="star5" class="rating-star"><i class="far fa-star"></i></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="commentaire" class="form-label">Commentaire détaillé</label>
                            <textarea class="form-control @error('commentaire') is-invalid @enderror" 
                                      id="commentaire" 
                                      name="commentaire" 
                                      rows="4" 
                                      placeholder="Observations, remarques, appréciations sur le déroulement du stage...">{{ old('commentaire', $historique->commentaire) }}</textarea>
                            @error('commentaire')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Ce commentaire sera visible dans l'historique et les rapports</small>
                        </div>
                    </div>
                </div>

              

              

                <!-- Boutons d'action -->
                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <div>
                        <button type="button" class="btn btn-outline-secondary" onclick="window.history.back()">
                            <i class="fas fa-arrow-left me-2"></i>Annuler
                        </button>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $historique->id }})">
                            <i class="fas fa-trash me-2"></i>Supprimer  
                        </button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save me-2"></i>Enregistrer les modifications
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Timeline du stage (optionnel) -->
    <div class="card mt-4">
        <div class="card-header">
            <h5>
                <i class="fas fa-timeline"></i>
                Chronologie du stage
            </h5>
        </div>
        <div class="card-body">
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-marker bg-success"></div>
                    <div class="timeline-content">
                        <h6>Début du stage</h6>
                        <p class="text-muted">{{ \Carbon\Carbon::parse($historique->affection_date_debut)->format('d/m/Y') }}</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-marker bg-warning"></div>
                    <div class="timeline-content">
                        <h6>Fin du stage</h6>
                        <p class="text-muted">{{ \Carbon\Carbon::parse($historique->date_fin)->format('d/m/Y') }}</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-marker bg-info"></div>
                    <div class="timeline-content">
                        <h6>Dernière modification</h6>
                        <p class="text-muted">{{ $historique->updated_at ? \Carbon\Carbon::parse($historique->updated_at)->format('d/m/Y H:i') : 'Jamais' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    // Menu toggle mobile
    $('#menuToggle').on('click', function() {
        $('#sidebar').toggleClass('active');
        $(this).find('i').toggleClass('fa-bars fa-times');
    });

    // Fermer sidebar en cliquant à l'extérieur
    $(document).on('click', function(e) {
        if ($(window).width() <= 768) {
            if (!$(e.target).closest('#sidebar').length && !$(e.target).closest('#menuToggle').length) {
                $('#sidebar').removeClass('active');
                $('#menuToggle i').removeClass('fa-times').addClass('fa-bars');
            }
        }
    });

    // Initialisation Select2
    $('#mention').select2({
        theme: 'bootstrap-5',
        width: '100%',
        placeholder: 'Sélectionner une mention'
    });

    // Gestion des étoiles de notation
    $('.rating-star').on('click', function() {
        let star = $(this);
        let ratingInput = star.prev('input.rating-input');
        
        $('.rating-star').removeClass('active selected');
        star.addClass('active selected');
        
        ratingInput.prop('checked', true);
        
        // Marquer les étoiles précédentes
        let index = $('.rating-star').index(this);
        $('.rating-star').each(function(i) {
            if (i <= index) {
                $(this).addClass('selected');
                $(this).html('<i class="fas fa-star"></i>');
            } else {
                $(this).removeClass('selected');
                $(this).html('<i class="far fa-star"></i>');
            }
        });
    });

    // Animation au survol des étoiles
    $('.rating-star').hover(
        function() {
            let index = $('.rating-star').index(this);
            $('.rating-star').each(function(i) {
                if (i <= index) {
                    $(this).addClass('active');
                }
            });
        },
        function() {
            $('.rating-star').removeClass('active');
        }
    );

    // Initialiser les étoiles si déjà notées
    let checkedStar = $('.rating-input:checked');
    if (checkedStar.length) {
        let index = $('.rating-input').index(checkedStar);
        $('.rating-star').each(function(i) {
            if (i <= index) {
                $(this).addClass('selected');
                $(this).html('<i class="fas fa-star"></i>');
            }
        });
    }

    // Validation du formulaire
    $('#editHistoriqueForm').on('submit', function(e) {
        e.preventDefault();
        
        let moyenne = $('#moyenne').val();
        let mention = $('#mention').val();
        
        if (moyenne < 0 || moyenne > 20) {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'La moyenne doit être comprise entre 0 et 20'
            });
            return;
        }
        
        if (!mention) {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Veuillez sélectionner une mention'
            });
            return;
        }
        
        // Afficher le spinner
        $('#spinner').addClass('active');
        
        // Soumettre le formulaire
        this.submit();
    });
});

// Calcul automatique de la mention
function calculateMention() {
    let moyenne = parseFloat($('#moyenne').val());
    let mentionSelect = $('#mention');
    
    if (!isNaN(moyenne)) {
        if (moyenne < 10) {
            mentionSelect.val('Insuffisant').trigger('change');
        } else if (moyenne < 12) {
            mentionSelect.val('Passable').trigger('change');
        } else if (moyenne < 14) {
            mentionSelect.val('Assez bien').trigger('change');
        } else if (moyenne < 16) {
            mentionSelect.val('Bien').trigger('change');
        } else if (moyenne < 18) {
            mentionSelect.val('Très bien').trigger('change');
        } else {
            mentionSelect.val('Excellent').trigger('change');
        }
    }
}

// Confirmation de suppression
function confirmDelete(id) {
    Swal.fire({
        title: 'Supprimer cet historique ?',
        text: "Cette action est irréversible !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $('#spinner').addClass('active');
            
            // Créer un formulaire de suppression
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = `/users/historique/${id}/delete`;
            
            let csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            
            let methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            
            form.appendChild(csrfInput);
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit();
        }
    });
}

// Prévenir la perte de données si on quitte la page
let formChanged = false;

$('#editHistoriqueForm input, #editHistoriqueForm textarea, #editHistoriqueForm select').on('change', function() {
    formChanged = true;
});

$(window).on('beforeunload', function() {
    if (formChanged) {
        return 'Vous avez des modifications non enregistrées. Êtes-vous sûr de vouloir quitter ?';
    }
});

// Désactiver l'alerte à la soumission du formulaire
$('#editHistoriqueForm').on('submit', function() {
    formChanged = false;
});
</script>

<!-- Styles additionnels pour la timeline -->
<style>
.timeline {
    position: relative;
    padding: 20px 0;
}

.timeline-item {
    position: relative;
    padding-left: 40px;
    margin-bottom: 25px;
}

.timeline-marker {
    position: absolute;
    left: 0;
    top: 0;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 3px solid white;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: 9px;
    top: 20px;
    bottom: -25px;
    width: 2px;
    background: #e9ecef;
}

.timeline-item:last-child::before {
    display: none;
}

.timeline-content h6 {
    margin-bottom: 5px;
    font-weight: 600;
}

.timeline-content p {
    margin-bottom: 0;
    font-size: 13px;
}
</style>

</body>
</html>