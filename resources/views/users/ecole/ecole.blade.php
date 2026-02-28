<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
<title>Gestion des Écoles - ASP Stages</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

  @include('users.services.style')

</head>

<body>

<!-- Menu toggle button for mobile -->
<button class="menu-toggle" id="menuToggle">
    <i class="fas fa-bars"></i>
</button>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div>
        <div class="logo"><h2>SÉCURITÉ<br>PÉNITENTIAIRE</h2></div>
        <ul class="menu">
            <li><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i><span> Accueil</span></a></li>
            <li><a href="{{route('users.agent.index')}}"><i class="fas fa-user-shield"></i><span> Agents</span></a></li>
            <li><a href="{{route('admin.ecole.index')}}" class="active"><i class="fas fa-university"></i><span> Écoles</span></a></li>
            <li><a href="{{route('admin.service.index')}}"><i class="fas fa-briefcase"></i><span> Services</span></a></li>
            <li><a href="{{route('admin.listes.Admin')}}"><i class="fas fa-users-cog"></i><span> Administrations</span></a></li>
            <li><a href="{{route('users.affectation.agent')}}"><i class="fas fa-exchange-alt"></i><span> Stages / Affectations</span></a></li>
            <li class="nav-item mt-auto">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="nav-link btn btn-link text-start w-100 text-danger">
            <i class="fas fa-sign-out-alt me-2"></i>
            Déconnexion
        </button>
    </form>
</li>
        </ul>
    </div>
    <div class="sidebar-footer">Application interne sécurisée</div>
</div>

<div class="main-content" id="mainContent">

    <header class="main-header">
        <div class="header-text">
            <h1><i class="fas fa-university"></i> Gestion des Écoles</h1>
            <p>Administration et gestion des établissements partenaires</p>
        </div>
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Rechercher une école...">
        </div>
    </header>

    
@if($errors->any())
    <div style="background:red;color:white;padding:10px;">
        {{ implode('', $errors->all()) }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

    <div class="d-flex justify-content-end mb-4">
          <button class="btn btn-info me-2" onclick="generateEcolesPDF()">
        <i class="fas fa-file-pdf me-2"></i> PDF Officiel
    </button>
        <button class="btn-add" id="addSchoolBtn" type="button" data-bs-toggle="modal" data-bs-target="#addSchoolModal">
            <i class="fas fa-plus-circle"></i> Ajouter une école
        </button>
    </div>

 <div class="table-container">
    <table id="schoolsTable" class="table table-hover align-middle">
        <thead>
            <tr>
                <th><i class="fas fa-school me-2"></i>Nom de l'École</th>
                <th><i class="fas fa-globe me-2"></i>Pays</th>
                <th><i class="fas fa-user-graduate me-2"></i>Stagiaires</th>
                <th class="text-center"><i class="fas fa-cogs me-2"></i>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ecoles as $ecole)
            <tr>
                <td data-label="Nom de l'École">
                    <i class="fas fa-school text-primary me-2"></i>
                    {{$ecole->nom_ecole}}
                </td>
                <td data-label="Pays">
                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                    {{$ecole->adresse}}
                </td>
                <td data-label="Stagiaires">
                    <a class="btn btn-sm btn-outline-info" title="Voir les stagiaires" href="{{route('admin.ecole.agentByEcole', $ecole->id)}}">
                        <i class="fas fa-users me-1"></i> 
                        <span>Stagiaires</span>
                    </a>
                </td>
                <td class="text-center" data-label="Actions">
                    <div class="btn-group" role="group">
                        <a class="btn btn-sm btn-outline-primary" title="Modifier l'école" href="{{route('admin.ecole.edit', $ecole->id)}}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger" title="Supprimer l'école" onclick="confirmDelete({{$ecole->id}}, '{{$ecole->nom_ecole}}')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Zone de pagination personnalisée -->
    <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
        <div class="dataTables_info" id="schoolsTable_info" role="status" aria-live="polite">
            Affichage de 1 à 10 sur X entrées
        </div>
        <div class="dataTables_paginate paging_simple_numbers" id="schoolsTable_paginate">
            <!-- La pagination sera générée automatiquement par DataTables -->
        </div>
    </div>
</div>

    

    <!-- MODAL ADD / EDIT SCHOOL -->
    <div class="modal fade asp-modal" id="addSchoolModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-university me-2"></i> Ajouter / Modifier une école</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="schoolForm" action="{{route('admin.ecole.addEcole')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold" for="schoolName">
                                <i class="fas fa-university me-1 text-primary"></i> Nom de l'école *
                            </label>
                            <input type="text" id="schoolName" name="nom_ecole" class="form-control" placeholder="Ex: Université de Paris" required>
                        </div>
                         <div class="form-group mb-3">
                            <label class="form-label fw-bold" for="schoolName">
                                 Pays *
                            </label>
                            <input type="text" id="schoolName" name="pays" class="form-control" placeholder="Ex: Gabon" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<!-- AJOUTEZ CES DEUX LIGNES POUR LES BOUTONS DATATABLES -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>



<script>
function generateEcolesPDF() {
    // Vérifier si DataTable existe
    if (!$.fn.DataTable.isDataTable('#schoolsTable')) {
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'La table n\'est pas initialisée',
        });
        return;
    }
    
    // Récupérer l'instance DataTable
    var table = $('#schoolsTable').DataTable();
    
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('landscape');

    const pageWidth = doc.internal.pageSize.width;
    const pageHeight = doc.internal.pageSize.height;

    // =============================
    // EN-TÊTE ADMINISTRATIF
    // =============================
    function addHeader() {
        doc.setFont("helvetica", "bold");
        doc.setFontSize(16);
        doc.text("REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE", pageWidth/2, 15, { align: "center" });

        doc.setFontSize(13);
        doc.text("MINISTERE DE LA JUSTICE", pageWidth/2, 22, { align: "center" });

        doc.setFontSize(12);
        doc.text("DIRECTION GENERALE DE L'ADMINISTRATION PENITENTIAIRE", pageWidth/2, 29, { align: "center" });

        doc.setFontSize(14);
        doc.setTextColor(11, 61, 46);
        doc.text("LISTE OFFICIELLE DES ÉTABLISSEMENTS PARTENAIRES", pageWidth/2, 40, { align: "center" });

        doc.setTextColor(0,0,0);
        
        // Ajouter la ligne de séparation
        doc.line(14, 45, pageWidth - 14, 45);
    }

    // Ajouter l'en-tête sur la première page
    addHeader();

    // =============================
    // INFOS DOCUMENT
    // =============================
    const today = new Date();
    const dateStr = today.toLocaleDateString('fr-FR');
    const refNumber = "ECO-" + today.getFullYear() + "-" + Math.floor(Math.random() * 9999);

    doc.setFontSize(11);
    doc.setFont("helvetica", "normal");

    doc.text("Référence : " + refNumber, 14, 50);
    doc.text("Date d'édition : " + dateStr, pageWidth - 70, 50);

    // =============================
    // COLONNES EXPORTABLES
    // =============================
    let columns = [];
    $('#schoolsTable thead th').each(function(index) {
        // Nettoyer le texte des icônes HTML
        let colText = $(this).clone().children().remove().end().text().trim();
        columns.push(colText || $(this).text().trim());
    });

    // =============================
    // DONNÉES FILTRÉES
    // =============================
    let rows = [];
    
    // Parcourir les lignes filtrées
    table.rows({ search: 'applied' }).every(function(rowIdx, tableLoop, rowLoop) {
        let rowData = this.data();
        let cleanRow = [];

        // Parcourir chaque cellule de la ligne
        for (let i = 0; i < rowData.length; i++) {
            // Nettoyer le contenu HTML
            let cellContent = rowData[i];
            
            // Si c'est une chaîne avec du HTML, nettoyer
            if (typeof cellContent === 'string') {
                // Supprimer les balises HTML
                cellContent = cellContent.replace(/<[^>]*>/g, '');
                // Remplacer les entités HTML courantes
                cellContent = cellContent.replace(/&nbsp;/g, ' ')
                                         .replace(/&agrave;/g, 'à')
                                         .replace(/&eacute;/g, 'é')
                                         .replace(/&egrave;/g, 'è')
                                         .replace(/&ccedil;/g, 'ç')
                                         .replace(/&icirc;/g, 'î')
                                         .replace(/&ocirc;/g, 'ô')
                                         .replace(/&ucirc;/g, 'û')
                                         .trim();
            }
            
            cleanRow.push(cellContent);
        }

        // Ne garder que les lignes qui ont du contenu
        if (cleanRow.some(cell => cell && cell.toString().trim() !== '')) {
            rows.push(cleanRow);
        }
    });

    // Vérifier s'il y a des données
    if (rows.length === 0) {
        Swal.fire({
            icon: 'info',
            title: 'Aucune donnée',
            text: 'Aucune école trouvée avec les filtres actuels',
        });
        return;
    }

    // =============================
    // TABLEAU PRINCIPAL
    // =============================
    doc.autoTable({
        head: [columns],
        body: rows,
        startY: 65,
        theme: 'grid',
        styles: {
            fontSize: 11,
            cellPadding: 5,
            overflow: 'linebreak',
            halign: 'left',
            valign: 'middle'
        },
        headStyles: {
            fillColor: [11, 61, 46],
            textColor: 255,
            halign: 'center',
            fontStyle: 'bold',
            fontSize: 12
        },
        alternateRowStyles: {
            fillColor: [240, 244, 248]
        },
        columnStyles: {
            0: { cellWidth: 80 }, // Nom de l'école
            1: { cellWidth: 60 }, // Pays
            2: { cellWidth: 50, halign: 'center' }, // Stagiaires
            3: { cellWidth: 40, halign: 'center' }  // Actions
        },
        margin: { left: 14, right: 14 },
        didDrawPage: function(data) {
            // N'ajouter l'en-tête que si ce n'est pas la première page
            if (data.pageNumber > 1) {
                addHeader();
                
                // Réajouter les infos document sur les nouvelles pages
                doc.setFontSize(11);
                doc.setFont("helvetica", "normal");
                doc.text("Référence : " + refNumber, 14, 50);
                doc.text("Date d'édition : " + dateStr, pageWidth - 70, 50);
                doc.setTextColor(0,0,0);
            }
        }
    });

    // =============================
    // RÉCAPITULATIF STATISTIQUES
    // =============================
    let finalY = doc.lastAutoTable.finalY + 15;

    // Vérifier s'il reste assez d'espace sur la page pour le récapitulatif
    if (finalY > pageHeight - 70) {
        doc.addPage();
        addHeader();
        finalY = 65; // Réinitialiser la position Y sur la nouvelle page
    }

    // Calculer les statistiques
    let totalEcoles = rows.length;
    
    // Compter les écoles par pays (si disponible)
    let paysStats = {};
    rows.forEach(row => {
        let pays = row[1] || 'Non spécifié';
        paysStats[pays] = (paysStats[pays] || 0) + 1;
    });

    // Ajouter le récapitulatif
    doc.setFontSize(12);
    doc.setFont("helvetica", "bold");
    doc.text("RÉCAPITULATIF DES ÉTABLISSEMENTS", 14, finalY);
    
    doc.setFont("helvetica", "normal");
    doc.setFontSize(11);
    doc.text(`Total des établissements : ${totalEcoles}`, 14, finalY + 8);
    
    // Afficher la répartition par pays
    let yPos = finalY + 16;
    doc.setFont("helvetica", "bold");
    doc.text("Répartition par pays :", 14, yPos);
    doc.setFont("helvetica", "normal");
    
    yPos += 8;
    
    // Calculer la hauteur nécessaire pour la répartition par pays
    let paysList = Object.keys(paysStats);
    let neededHeight = paysList.length * 7 + 40; // 7px par pays + marge
    
    // Vérifier si on a assez d'espace pour la répartition par pays
    if (yPos + neededHeight > pageHeight - 40) {
        doc.addPage();
        addHeader();
        yPos = 65;
        
        // Réécrire l'en-tête du récapitulatif sur la nouvelle page
        doc.setFontSize(12);
        doc.setFont("helvetica", "bold");
        doc.text("RÉCAPITULATIF DES ÉTABLISSEMENTS (suite)", 14, yPos);
        yPos += 8;
    }
    
    for (let pays in paysStats) {
        doc.text(`• ${pays} : ${paysStats[pays]} établissement${paysStats[pays] > 1 ? 's' : ''}`, 20, yPos);
        yPos += 7;
    }

    // =============================
    // SIGNATURE + CACHET
    // =============================
    let signatureY = yPos + 20;

    // Vérifier s'il reste assez d'espace pour la signature
    if (signatureY > pageHeight - 30) {
        doc.addPage();
        addHeader();
        signatureY = 65;
    }

    doc.setFontSize(11);
    doc.setFont("helvetica", "normal");
    doc.text("Le Directeur de l'Administration Pénitentiaire", pageWidth - 100, signatureY);
    doc.text("Signature et Cachet Officiel", pageWidth - 100, signatureY + 8);

    // =============================
    // FOOTER + PAGINATION
    // =============================
    let pageCount = doc.internal.getNumberOfPages();

    for (let i = 1; i <= pageCount; i++) {
        doc.setPage(i);

        doc.setFontSize(9);
        doc.text(
            "Document administratif interne - Direction Générale de l'Administration Pénitentiaire",
            pageWidth / 2,
            pageHeight - 10,
            { align: "center" }
        );

        doc.text(
            "Page " + i + " / " + pageCount,
            pageWidth - 30,
            pageHeight - 10
        );
    }

    // =============================
    // TELECHARGEMENT
    // =============================
    doc.save("Liste_Etablissements_ASP.pdf");
}

$(document).ready(function() {
    // Initialize DataTable
    var table = $('#schoolsTable').DataTable({
        language: { 
            url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json",
            search: "",
            searchPlaceholder: "Rechercher..."
        },
      
       
        
    });
    // Custom search
    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });

    // Success message
    @if(session('success'))
        Swal.fire({ 
            icon: 'success', 
            title: 'Opération réussie', 
            text: "{{session('success')}}", 
            toast: true, 
            position: 'top-end', 
            showConfirmButton: false, 
            timer: 3000,
            timerProgressBar: true
        });
    @endif

    // Error messages
    @if($errors->any())
        Swal.fire({ 
            icon: 'error', 
            title: 'Erreur de validation', 
            html: '{!! implode("<br>", $errors->all()) !!}',
            confirmButtonColor: '#0B3D2E'
        });
    @endif

    // Mobile menu toggle
    $('#menuToggle').click(function() {
        $('#sidebar').toggleClass('active');
        $(this).find('i').toggleClass('fa-bars fa-times');
    });

    // Close sidebar when clicking outside on mobile
    $(document).on('click', function(e) {
        if ($(window).width() <= 768) {
            if (!$(e.target).closest('#sidebar').length && !$(e.target).closest('#menuToggle').length) {
                $('#sidebar').removeClass('active');
                $('#menuToggle i').removeClass('fa-times').addClass('fa-bars');
            }
        }
    });

    // Handle window resize
    $(window).on('resize', function() {
        if ($(window).width() > 768) {
            $('#sidebar').removeClass('active');
            $('#menuToggle i').removeClass('fa-times').addClass('fa-bars');
        }
    });

    // Show/hide empty state based on table rows
    function toggleEmptyState() {
        if (table.rows().count() === 0) {
            $('.table-container').hide();
            $('#emptyState').show();
        } else {
            $('.table-container').show();
            $('#emptyState').hide();
        }
    }
    
    toggleEmptyState();
    table.on('draw', function() {
        toggleEmptyState();
    });

    // Form validation
    $('#schoolForm').on('submit', function(e) {
        let schoolName = $('#schoolName').val().trim();
        
        if (schoolName === '') {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Champs obligatoires',
                text: 'Veuillez remplir tous les champs obligatoires.',
                confirmButtonColor: '#0B3D2E'
            });
        }
    });

    // Reset form when modal is closed
    $('#addSchoolModal').on('hidden.bs.modal', function() {
        $('#schoolForm')[0].reset();
    });
});

// Delete confirmation function
function confirmDelete(id, name) {
    Swal.fire({
        title: 'Supprimer cette école ?',
        text: "Êtes-vous sûr de vouloir supprimer : " + name,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/admin/ecole/delete/" + id;
        }
    });
}
</script>
</body>
</html>
