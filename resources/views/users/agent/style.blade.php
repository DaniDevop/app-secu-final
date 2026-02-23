
<style>

/* ===== GLOBAL ===== */
body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:linear-gradient(135deg,#f1f3f5,#dee2e6);
    display:flex;
    min-height:100vh;
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
    z-index: 1000;
    transition: all 0.3s ease;
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
    font-size: 14px;
}

.menu a i {
    width: 20px;
    text-align: center;
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

/* Menu toggle pour mobile (hamburger) */
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
}

/* ===== MAIN CONTENT ===== */
.main-content{
    margin-left:260px;
    flex:1;
    padding:30px 40px;
    width: calc(100% - 260px);
    transition: all 0.3s ease;
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
    flex-wrap: wrap;
    gap: 15px;
}

.main-header h1 {
    font-size: clamp(1.2rem, 4vw, 2rem);
    margin-bottom: 5px;
}

.main-header small {
    font-size: clamp(0.7rem, 3vw, 0.9rem);
    opacity: 0.9;
}

.search-box{
    background:rgba(255,255,255,0.15);
    padding:8px 15px;
    border-radius:30px;
    display:flex;
    align-items:center;
    min-width: 200px;
    max-width: 100%;
    border: 1px solid rgba(255,255,255,0.2);
}

.search-box i {
    color: rgba(255,255,255,0.7);
    font-size: 14px;
}

.search-box input{
    border:none;
    background:transparent;
    color:white;
    outline:none;
    margin-left:10px;
    width: 100%;
}

.search-box input::placeholder {
    color: rgba(255,255,255,0.7);
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
    white-space: nowrap;
    cursor: pointer;
}

.btn-add:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 20px rgba(0,0,0,0.2);
}

.dt-buttons{
    display:flex;
    gap:10px;
    flex-wrap: wrap;
}

.btn-export{
    border-radius:30px !important;
    padding:10px 20px !important;
    font-weight:600 !important;
    white-space: nowrap;
    border: none !important;
    cursor: pointer !important;
}

.btn-excel{
    background:#198754 !important;
    color: white !important;
}

.btn-excel:hover {
    background:#157347 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3) !important;
}

/* ===== TABLE ===== */
.table-container{
    background:white;
    padding:25px;
    border-radius:18px;
    box-shadow:0 15px 40px rgba(0,0,0,0.08);
    overflow-x: auto;
    width: 100%;
}

.table-container table {
    min-width: 800px;
    width: 100%;
}

table.dataTable thead{
    background:#1B4332;
    color:white;
}

table.dataTable thead th {
    color: white;
    font-weight: 600;
    border-bottom: none;
}

table.dataTable tbody tr:hover{
    background:#f8f9fa;
}

.badge{
    border-radius:20px;
    padding:6px 12px;
    white-space: nowrap;
    font-weight: 500;
}

.btn-action{
    width:35px;
    height:35px;
    border-radius:50%;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    background:#f1f3f5;
    transition:.3s;
    text-decoration: none;
    color: #333;
    border: none;
    cursor: pointer;
}

.btn-action:hover{
    background:#1B4332;
    color:white;
    transform: translateY(-2px);
}

/* ===== PAGINATION LARAVEL ===== */
.pagination {
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 20px;
}

.pagination .page-link {
    border-radius: 8px;
    margin: 0 3px;
    color: #081C15;
    border: 1px solid #dee2e6;
    padding: 8px 12px;
}

.pagination .page-item.active .page-link {
    background: #1B4332;
    border-color: #1B4332;
    color: white;
}

.pagination .page-link:hover {
    background: #2D6A4F;
    color: white;
}

/* ===== MODAL ===== */
.modal-header{
    background:linear-gradient(135deg,#081C15,#1B4332);
    color:white;
}

.modal-header .btn-close {
    filter: brightness(0) invert(1);
    opacity: 0.8;
}

.modal-header .btn-close:hover {
    opacity: 1;
}

.modal-content {
    border-radius: 18px;
    overflow: hidden;
    border: none;
}

.modal-body {
    padding: 25px;
}

.modal-footer {
    padding: 20px 25px;
}

.form-control, .form-select{
    border-radius:12px;
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    transition: all 0.3s;
}

.form-control:focus, .form-select:focus{
    border-color:#D4AF37;
    box-shadow:0 0 0 3px rgba(212,175,55,.2);
    outline: none;
}

.form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

/* Overlay pour mobile quand sidebar est ouverte */
.sidebar-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 999;
}

.sidebar-overlay.active {
    display: block;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .main-content {
        padding: 20px;
    }
    
    .main-header {
        padding: 20px;
    }
    
    .table-container {
        padding: 20px;
    }
}

@media (max-width: 768px) {
    body {
        flex-direction: column;
    }
    
    .menu-toggle {
        display: block;
        z-index: 1100;
    }
    
    .sidebar {
        left: -260px;
        z-index: 1050;
    }
    
    .sidebar.active {
        left: 0;
    }
    
    .main-content {
        margin-left: 0;
        width: 100%;
        padding: 70px 15px 20px;
    }
    
    .main-header {
        flex-direction: column;
        align-items: stretch;
        text-align: center;
        padding: 15px;
    }
    
    .search-box {
        width: 100%;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 15px;
        align-items: stretch !important;
    }
    
    #exportButtonsContainer {
        width: 100%;
    }
    
    .dt-buttons {
        justify-content: center;
        width: 100%;
    }
    
    .btn-export {
        flex: 1;
        text-align: center;
        width: 100%;
    }
    
    .btn-add {
        width: 100%;
    }
    
    .table-container {
        padding: 15px;
    }
    
    .modal-dialog {
        margin: 10px;
    }
    
    .modal-body {
        padding: 15px;
    }
    
    .row.g-3 > [class*="col-"] {
        margin-bottom: 10px;
    }
}

@media (max-width: 480px) {
    .main-header h1 {
        font-size: 1.2rem;
    }
    
    .main-header i {
        font-size: 1.2rem;
    }
    
    .main-header small {
        font-size: 0.8rem;
    }
    
    .badge {
        font-size: 0.7rem;
        padding: 4px 8px;
    }
    
    .btn-action {
        width: 30px;
        height: 30px;
    }
    
    .btn-action i {
        font-size: 12px;
    }
    
    .modal-body .row.g-3 > .col-md-6 {
        width: 100%;
    }
    
    .pagination .page-link {
        padding: 5px 10px;
        font-size: 12px;
    }
}

@media (max-width: 350px) {
    .main-content {
        padding: 70px 10px 10px;
    }
    
    .table-container {
        padding: 10px;
    }
    
    .btn-export {
        font-size: 0.8rem;
        padding: 8px 10px !important;
    }
}

/* DataTables customisation */
.dataTables_wrapper .row {
    margin: 0;
}

.dataTables_length,
.dataTables_filter {
    display: none; /* Cacher les contrôles par défaut */
}

table.dataTable {
    margin-top: 0 !important;
    margin-bottom: 0 !important;
}

/* Animation */
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

/* Scrollbar personnalisée */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
    background: #1B4332;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: #2D6A4F;
}



/* Style pour la pagination DataTables */
.dataTables_wrapper .dataTables_paginate {
    float: none;
    text-align: center;
    padding-top: 0;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0.5rem 0.75rem;
    margin: 0 0.25rem;
    border-radius: 0.375rem;
    border: 1px solid #dee2e6;
    background-color: #fff;
    color: var(--primary) !important;
    cursor: pointer;
    transition: all 0.2s;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background-color: var(--primary);
    border-color: var(--primary);
    color: white !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background-color: var(--primary);
    border-color: var(--primary);
    color: white !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.dataTables_wrapper .dataTables_length {
    margin-bottom: 1rem;
}

.dataTables_wrapper .dataTables_length select {
    padding: 0.375rem 1.75rem 0.375rem 0.75rem;
    border-radius: 0.375rem;
    border: 1px solid #ced4da;
}

.dataTables_wrapper .dataTables_info {
    color: var(--gray);
    font-size: 0.875rem;
}

/* Style pour le sélecteur d'entrées par page */
.dataTables_wrapper .dataTables_length {
    margin-bottom: 1rem;
}

.dataTables_wrapper .dataTables_length label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: normal;
}

.dataTables_wrapper .dataTables_filter {
    margin-bottom: 1rem;
}

.dataTables_wrapper .dataTables_filter input {
    padding: 0.375rem 0.75rem;
    border-radius: 0.375rem;
    border: 1px solid #ced4da;
}

/* Responsive */
@media screen and (max-width: 768px) {
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        text-align: left;
        float: none;
        margin: 0.5rem 0;
        width: 100%;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.375rem 0.5rem;
        margin: 0.125rem;
    }
}
</style>