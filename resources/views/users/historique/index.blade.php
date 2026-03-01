<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
<title>Historique des Stages - ASP</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- DataTables -->
<link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">

<!-- FontAwesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<!-- SweetAlert2 -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<!-- PDF Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>

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
.main-content { padding: 30px 40px; transition: all 0.3s ease; }

/* Header */
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

.main-header h1 { font-size: 24px; font-weight: 600; display: flex; align-items: center; gap: 10px; margin: 0; }
.main-header p { margin: 5px 0 0; opacity: .8; }

/* Search box */
.search-box { position: relative; min-width: 300px; }
.search-box i {
    position: absolute; top: 50%; left: 15px;
    transform: translateY(-50%);
    color: #aaa;
    z-index: 1;
}
.search-box input {
    padding: 12px 15px 12px 40px;
    border-radius: 30px;
    border: 1px solid rgba(255,255,255,0.2);
    width: 100%;
    background: rgba(255,255,255,0.15);
    color: white;
    transition: all 0.3s;
}
.search-box input::placeholder { color: rgba(255,255,255,0.7); }
.search-box input:focus {
    background: rgba(255,255,255,0.25);
    outline: none;
    border-color: white;
}

/* Bouton PDF */
.btn-pdf {
    background: #dc3545;
    color: white;
    border-radius: 30px;
    padding: 12px 25px;
    font-weight: 600;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.3s;
}
.btn-pdf:hover {
    background: #c82333;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
}

/* Table container */
.table-container {
    background: white;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    margin-top: 20px;
}

.table th {
    background: #f8f9fa;
    font-weight: 600;
    color: var(--primary);
    white-space: nowrap;
    padding: 15px 12px;
}

.table td { vertical-align: middle; padding: 12px; }

/* Avatar */
.avatar-circle {
    width: 35px; height: 35px;
    border-radius: 50%;
    background: #f0f2f5;
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.initials { font-size: 14px; font-weight: bold; color: #0d6efd; }

/* Empty state */
.empty-state {
    padding: 60px 20px;
    background: #f8f9fa;
    border-radius: 10px;
    text-align: center;
}

/* Responsive */
@media screen and (max-width: 992px) {
    body { padding-left: var(--sidebar-width-mobile); }
    .sidebar { width: var(--sidebar-width-mobile); padding: 20px 10px; }
    .menu a span { display: none; }
    .menu a { justify-content: center; padding: 12px; }
    .menu a i { font-size: 20px; margin: 0; }
    .sidebar-footer { font-size: 10px; writing-mode: vertical-rl; transform: rotate(180deg); }
    .main-content { padding: 20px; }
}

@media screen and (max-width: 768px) {
    .menu-toggle { display: flex; }
    body { padding-left: 0; }
    .sidebar { transform: translateX(-100%); width: 260px; padding: 30px 20px; }
    .sidebar.active { transform: translateX(0); }
    .sidebar .menu a span { display: inline; }
    .sidebar .menu a { justify-content: flex-start; }
    .sidebar-footer { writing-mode: horizontal-tb; transform: none; }
    .main-header { margin-top: 50px; flex-direction: column; align-items: stretch; }
    .search-box { width: 100%; }
    .btn-pdf { width: 100%; justify-content: center; }
}

/* DataTables customization */
.dataTables_filter input {
    border-radius: 30px;
    border: 2px solid #e9ecef;
    padding: 8px 15px;
    margin-left: 10px;
}
.dataTables_paginate .paginate_button {
    padding: 8px 14px;
    border-radius: 8px;
    background: white;
    border: 2px solid #e9ecef;
    color: var(--primary);
    cursor: pointer;
    margin: 0 2px;
}
.dataTables_paginate .paginate_button.current {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}
</style>
</head>
<body>

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
                    <li>
    <a href="{{route('users.historique.agent.stage')}}">
        <i class="fas fa-history"></i> Historique
    </a>
</li>
            <li class="nav-item mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link text-start w-100 text-danger" style="color: white !important;">
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
    <header class="main-header">
        <div class="header-text">
            <h1><i class="fas fa-history"></i> Historique des Stages</h1>
            <p>Consultez l'historique des stages terminés</p>
        </div>
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Rechercher...">
        </div>
    </header>

    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" onclick="generateHistoriquePDF()">
            <i class="fas fa-file-pdf me-2"></i>Exporter en PDF
        </button>
    </div>

    <!-- Table -->
    <div class="table-container">
        <table id="historiqueTable" class="table table-hover align-middle w-100">
            <thead class="table-dark">
                <tr>
                    <th>Matricule</th>
                    <th>Agent</th>
                    <th>Établissement</th>
                    <th>Date de fin</th>
                    <th>Moyenne</th>
                    <th>Mention</th>
                    <th class="no-export">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($historiques as $hist)
                <tr>
                    <td>
                        <span class="badge bg-secondary bg-opacity-25 text-dark px-3 py-2">
                            <i class="fas fa-id-card me-1"></i>
                            {{ $hist->agent_matricule ?? 'N/A' }}
                        </span>
                    </td>

                    <td>
                        <div class="d-flex align-items-center">
                            <div class="avatar-circle bg-primary bg-opacity-10 me-2">
                                <span class="initials">
                                    {{ substr($hist->agent_prenom ?? '', 0, 1) }}{{ substr($hist->agent_nom ?? '', 0, 1) }}
                                </span>
                            </div>
                            <div>
                                <strong>{{ $hist->agent_nom ?? '' }} {{ $hist->agent_prenom ?? '' }}</strong>
                                @if(isset($hist->agent_grade))
                                <div><small class="text-muted">{{ $hist->agent_grade }}</small></div>
                                @endif
                            </div>
                        </div>
                    </td>

                    <td>
                        <i class="fas fa-university text-primary me-1"></i>
                        <strong>{{ $hist->ecole_nom ?? 'Non assigné' }}</strong>
                    </td>

                    <td>
                        @if($hist->date_de_fin)
                        <span class="badge bg-info bg-opacity-10 text-dark px-3 py-2">
                            <i class="far fa-calendar-alt me-1"></i>
                            {{ \Carbon\Carbon::parse($hist->date_de_fin)->format('d/m/Y') }}
                        </span>
                        @else
                        <span class="badge bg-warning">En cours</span>
                        @endif
                    </td>

                    <td class="text-center">
                        @if(isset($hist->moyenne) && $hist->moyenne)
                        @php
                            $moyenneClass = $hist->moyenne >= 16 ? 'success' : ($hist->moyenne >= 12 ? 'info' : ($hist->moyenne >= 10 ? 'warning' : 'danger'));
                        @endphp
                        <span class="badge bg-{{ $moyenneClass }} px-3 py-2">
                            {{ number_format($hist->moyenne, 2) }}/20
                        </span>
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td>
                        @php
                            $mention = $hist->mention ?? '';
                            $mentionClass = match(true) {
                                str_contains(strtolower($mention), 'très') => 'success',
                                str_contains(strtolower($mention), 'bien') => 'primary',
                                str_contains(strtolower($mention), 'assez') => 'info',
                                str_contains(strtolower($mention), 'passable') => 'warning',
                                str_contains(strtolower($mention), 'insuffisant') => 'danger',
                                default => 'secondary'
                            };
                        @endphp
                        
                        @if($mention)
                        <span class="badge bg-{{ $mentionClass }} px-3 py-2">
                            <i class="fas fa-award me-1"></i>{{ $mention }}
                        </span>
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td>
                        
                            <button class="btn btn-outline-danger" title="Attestation">
                                <i class="fas fa-file-pdf"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-history fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Aucun historique disponible</h5>
                            <p class="text-muted">Les stages terminés apparaîtront ici</p>
                            <button class="btn btn-primary mt-3" onclick="window.location.href='{{ route('users.affectation.agent') }}'">
                                <i class="fas fa-plus-circle me-2"></i>Nouvelle affectation
                            </button>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    // Initialisation DataTable
    if ($('#historiqueTable tbody tr').length > 1 || !$('#historiqueTable tbody tr td[colspan]').length) {
        var table = $('#historiqueTable').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json",
                search: "Rechercher :",
                paginate: {
                    previous: "<i class='fas fa-chevron-left'></i>",
                    next: "<i class='fas fa-chevron-right'></i>"
                }
            },
            responsive: true,
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50, 100],
            order: [[3, 'desc']], // Trier par date de fin décroissante
            columnDefs: [
                { targets: [0,1,2,4,5], searchable: true },
                { targets: 3, searchable: false }, // Date
                { targets: 6, orderable: false, searchable: false } // Actions
            ],
            drawCallback: function() {
                $('.dataTables_paginate').addClass('mt-3');
            }
        });

        // Recherche personnalisée
        $('#searchInput').on('keyup', function() {
            table.search(this.value).draw();
        });
    }
});

// Fonction de génération PDF simplifiée
function generateHistoriquePDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('landscape');
    const pageWidth = doc.internal.pageSize.width;
    const pageHeight = doc.internal.pageSize.height;
    const margin = 20;

    // En-tête
    doc.setFontSize(14);
    doc.setTextColor(11, 61, 46);
    doc.text("HISTORIQUE DES STAGES", pageWidth/2, 20, { align: "center" });
    
    doc.setFontSize(10);
    doc.setTextColor(0,0,0);
    doc.text("Direction Générale de l'Administration Pénitentiaire", pageWidth/2, 28, { align: "center" });
    
    const today = new Date();
    doc.text(`Édité le ${today.toLocaleDateString('fr-FR')}`, margin, 38);

    // Récupération des données
    let data = [];
    $('#historiqueTable tbody tr').each(function() {
        if (!$(this).find('td[colspan]').length) {
            let row = [];
            $(this).find('td').each(function(index) {
                if (index < 6) { // Exclure la colonne actions
                    let text = $(this).text().trim().replace(/\s+/g, ' ');
                    row.push(text);
                }
            });
            if (row.length) data.push(row);
        }
    });

    if (!data.length) {
        Swal.fire('Info', 'Aucune donnée à exporter', 'info');
        return;
    }

    // Tableau
    doc.autoTable({
        head: [['Matricule', 'Agent', 'Établissement', 'Date fin', 'Moyenne', 'Mention']],
        body: data,
        startY: 45,
        styles: { fontSize: 8, cellPadding: 3 },
        headStyles: { fillColor: [11, 61, 46], textColor: 255 },
        alternateRowStyles: { fillColor: [245, 248, 250] },
        margin: { left: margin, right: margin }
    });

    // Total
    let finalY = doc.lastAutoTable.finalY + 10;
    doc.setFontSize(10);
    doc.text(`Total des stages : ${data.length}`, margin, finalY);

    // Footer
    doc.setFontSize(8);
    doc.setTextColor(100,100,100);
    doc.text("Document officiel - ASP", pageWidth/2, pageHeight-10, { align: "center" });
    doc.text(`Page 1/${doc.internal.getNumberOfPages()}`, pageWidth-40, pageHeight-10);

    doc.save(`historique_stages_${today.toISOString().slice(0,10)}.pdf`);
    
    Swal.fire({
        icon: 'success',
        title: 'PDF généré',
        text: `${data.length} stages exportés`,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
}
</script>

</body>
</html>