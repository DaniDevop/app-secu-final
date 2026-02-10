   <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        :root {
            --primary-dark: #0c2461;
            --primary: #1e3799;
            --primary-light: #4a69bd;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-700: #334155;
            --gray-900: #0f172a;
        }

        body {
            background: #f8fafc;
            color: var(--gray-900);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Layout principal */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, var(--primary-dark) 0%, var(--primary) 100%);
            color: white;
            position: fixed;
            height: 100vh;
            z-index: 100;
            transition: transform 0.3s ease;
            box-shadow: 5px 0 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 30px 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .sidebar-logo {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 20px;
            font-weight: bold;
        }

        .sidebar-title {
            font-size: 18px;
            font-weight: 700;
        }

        .sidebar-nav {
            padding: 25px 0;
        }

        .nav-item {
            padding: 16px 25px;
            display: flex;
            align-items: center;
            gap: 15px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            cursor: pointer;
        }

        .nav-item:hover, .nav-item.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: white;
        }

        .nav-item i {
            width: 20px;
            font-size: 18px;
        }

        .nav-text {
            font-size: 15px;
            font-weight: 500;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 25px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .user-details h4 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .user-details p {
            font-size: 12px;
            opacity: 0.8;
        }

        /* Contenu principal */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 30px;
            transition: margin-left 0.3s ease;
        }

        /* Header */
        .main-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--gray-200);
        }

        .header-left h1 {
            font-size: 32px;
            color: var(--primary-dark);
            font-weight: 800;
            margin-bottom: 8px;
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .header-left p {
            color: var(--gray-700);
            font-size: 16px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding: 12px 20px 12px 45px;
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            width: 300px;
            font-size: 15px;
            background: white;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(30, 55, 153, 0.1);
            outline: none;
        }

        .search-box i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-700);
        }

        .notification-bell {
            position: relative;
            background: white;
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-700);
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .notification-bell:hover {
            color: var(--primary);
            transform: translateY(-2px);
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger);
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            font-size: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Bouton Ajouter */
        .btn-add {
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(12, 36, 97, 0.2);
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(12, 36, 97, 0.3);
            background: linear-gradient(to right, var(--primary), var(--primary-light));
        }

        /* Tableau des écoles */
        .table-container {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
        }

        th {
            padding: 20px;
            text-align: left;
            color: white;
            font-weight: 600;
            font-size: 15px;
            letter-spacing: 0.5px;
        }

        th:first-child {
            border-radius: 16px 0 0 0;
        }

        th:last-child {
            border-radius: 0 16px 0 0;
        }

     

     
        td {
            padding: 20px;
            color: var(--gray-900);
            font-size: 15px;
        }

        .school-name {
            font-weight: 600;
            color: var(--primary-dark);
        }

        .school-address {
            color: var(--gray-700);
            font-size: 14px;
            line-height: 1.5;
        }

        /* Actions */
        .actions {
            display: flex;
            gap: 10px;
        }

        .btn-action {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .btn-edit:hover {
            background: var(--success);
            color: white;
            transform: translateY(-2px);
        }

        .btn-delete {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .btn-delete:hover {
            background: var(--danger);
            color: white;
            transform: translateY(-2px);
        }

        /* Message vide */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        .empty-icon {
            font-size: 60px;
            color: var(--gray-300);
            margin-bottom: 20px;
        }

        .empty-state h3 {
            color: var(--gray-700);
            margin-bottom: 10px;
            font-size: 20px;
        }

        .empty-state p {
            color: var(--gray-500);
            margin-bottom: 30px;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 30px;
        }

        .page-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 2px solid var(--gray-200);
            background: white;
            color: var(--gray-700);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .page-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .page-btn.active {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .page-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

      

        .modal-overlay.active {
            display: flex;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

     

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-50px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-header {
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
            color: white;
            padding: 25px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 22px;
            font-weight: 700;
        }

        .close-btn {
            background: rgba(255, 255, 255, 0.2);
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: none;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .close-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 30px;
        }

        /* Formulaire */
        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            font-size: 15px;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 10px;
        }

        .form-control {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            font-size: 16px;
            color: var(--gray-900);
            background: white;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(30, 55, 153, 0.1);
            outline: none;
        }

        .form-control::placeholder {
            color: var(--gray-400);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        /* Boutons du modal */
        .modal-footer {
            padding: 20px 30px;
            background: var(--gray-50);
            border-top: 1px solid var(--gray-200);
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            min-width: 100px;
        }

        .btn-cancel {
            background: var(--gray-200);
            color: var(--gray-700);
        }

        .btn-cancel:hover {
            background: var(--gray-300);
        }

        .btn-submit {
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
            color: white;
        }

        .btn-submit:hover {
            background: linear-gradient(to right, var(--primary), var(--primary-light));
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(30, 55, 153, 0.2);
        }

        /* Messages */
        .message {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: none;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message.success {
            background: rgba(16, 185, 129, 0.1);
            border-left: 4px solid var(--success);
            color: var(--success);
        }

        .message.error {
            background: rgba(239, 68, 68, 0.1);
            border-left: 4px solid var(--danger);
            color: var(--danger);
        }

        /* Loading */
        .loading {
            text-align: center;
            padding: 40px;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 3px solid var(--gray-200);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Menu mobile */
        .mobile-toggle {
            display: none;
            background: var(--primary);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            cursor: pointer;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 101;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .search-box input {
                width: 250px;
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .mobile-toggle {
                display: flex;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 20px;
            }
            
            .main-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
            
            .header-right {
                width: 100%;
                justify-content: space-between;
            }
            
            .search-box input {
                width: 100%;
            }
            
            .header-left h1 {
                font-size: 28px;
            }
            
            .table-container {
                overflow-x: auto;
            }
            
            table {
                min-width: 600px;
            }
            
            th, td {
                padding: 15px;
            }
            
            .actions {
                flex-direction: column;
            }
            
            .btn-action {
                width: 35px;
                height: 35px;
            }
        }

        @media (max-width: 480px) {
            .modal-body {
                padding: 20px;
            }
            
            .modal-footer {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
            
            .header-left h1 {
                font-size: 24px;
            }
        }





          /* Styles spécifiques pour le modal ASP */
        :root {
            --primary-dark: #0c2461;
            --primary: #1e3799;
            --primary-light: #4a69bd;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-700: #334155;
            --gray-900: #0f172a;
        }

        /* Style du modal pour correspondre au thème ASP */
        .asp-modal .modal-content {
            border-radius: 20px;
            border: none;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }

        .asp-modal .modal-header {
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
            color: white;
            padding: 25px 30px;
            border-bottom: none;
        }

        .asp-modal .modal-title {
            font-size: 22px;
            font-weight: 700;
        }

        .asp-modal .btn-close {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            opacity: 1;
            padding: 12px;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e");
            transition: all 0.3s ease;
        }

        .asp-modal .btn-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .asp-modal .modal-body {
            padding: 30px;
        }

        .asp-modal .form-group {
            margin-bottom: 25px;
        }

        .asp-modal .form-label {
            display: block;
            font-size: 15px;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 10px;
        }

        .asp-modal .form-control {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            font-size: 16px;
            color: var(--gray-900);
            background: white;
            transition: all 0.3s ease;
        }

        .asp-modal .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(30, 55, 153, 0.1);
            outline: none;
        }

        .asp-modal .form-control::placeholder {
            color: #94a3b8;
        }

        textarea.asp-modal .form-control {
            min-height: 120px;
            resize: vertical;
        }

        .asp-modal .modal-footer {
            padding: 20px 30px;
            background: var(--gray-50);
            border-top: 1px solid var(--gray-200);
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }

        .asp-modal .btn {
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            min-width: 100px;
        }

        .asp-modal .btn-cancel {
            background: var(--gray-200);
            color: var(--gray-700);
        }

        .asp-modal .btn-cancel:hover {
            background: var(--gray-300);
            transform: translateY(-2px);
        }

        .asp-modal .btn-submit {
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
            color: white;
        }

        .asp-modal .btn-submit:hover {
            background: linear-gradient(to right, var(--primary), var(--primary-light));
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(30, 55, 153, 0.2);
        }

        /* Animation pour l'ouverture du modal */
        .asp-modal.fade .modal-dialog {
            transform: translateY(-50px) scale(0.95);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .asp-modal.show .modal-dialog {
            transform: translateY(0) scale(1);
        }

        /* Icônes dans les labels */
        .form-label i {
            margin-right: 10px;
            width: 20px;
            color: var(--primary);
        }

        /* Messages d'erreur */
        .error-message {
            color: var(--danger);
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        /* Bouton Ajouter dans le header */
        .btn-add {
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(12, 36, 97, 0.2);
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(12, 36, 97, 0.3);
            background: linear-gradient(to right, var(--primary), var(--primary-light));
        }

        /* Bouton Ajouter dans l'état vide */
        #addFirstSchoolBtn {
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(12, 36, 97, 0.2);
            margin: 0 auto;
        }

        #addFirstSchoolBtn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(12, 36, 97, 0.3);
            background: linear-gradient(to right, var(--primary), var(--primary-light));
        }

        /* Modal de confirmation de suppression */
        .delete-modal .modal-content {
            border-radius: 20px;
            border: none;
            overflow: hidden;
            max-width: 400px;
            margin: 0 auto;
        }

        .delete-modal .modal-header {
            background: linear-gradient(to right, var(--danger), #f87171);
            color: white;
            padding: 25px 30px;
            border-bottom: none;
        }

        .delete-modal .modal-body {
            padding: 30px;
            text-align: center;
        }

        .delete-modal .modal-body p {
            font-size: 16px;
            color: var(--gray-700);
            margin-bottom: 10px;
        }

        .delete-modal .school-name {
            color: var(--danger);
            font-weight: 600;
            font-size: 18px;
            margin: 15px 0;
        }

        .delete-modal .modal-footer {
            padding: 20px 30px;
            background: var(--gray-50);
            border-top: 1px solid var(--gray-200);
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .delete-modal .btn-delete {
            background: var(--danger);
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            min-width: 100px;
        }

        .delete-modal .btn-delete:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }



         .btn-add {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-add:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }

        .btn-add i {
            font-size: 18px;
        }

        /* Boutons d'action dans le tableau */
        .actions {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .btn-edit {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .btn-edit:hover {
            background: #3b82f6;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-delete {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .btn-delete:hover {
            background: #ef4444;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .btn-view {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .btn-view:hover {
            background: #10b981;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        /* Styles pour le modal */
        .asp-modal .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }

        .asp-modal .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px 30px;
            border-bottom: none;
        }

        .asp-modal .modal-title {
            font-weight: 700;
            font-size: 22px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .asp-modal .modal-title i {
            font-size: 24px;
        }

        .asp-modal .btn-close {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 1;
            transition: all 0.3s ease;
            padding: 0;
        }

        .asp-modal .btn-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .asp-modal .btn-close::before {
            content: '×';
            font-size: 24px;
            color: white;
            line-height: 1;
        }

        .asp-modal .btn-close img {
            display: none;
        }

        .asp-modal .modal-body {
            padding: 30px;
            background: #f8fafc;
        }

        .asp-modal .modal-footer {
            padding: 20px 30px;
            background: white;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }

        /* Boutons du modal */
        .btn-cancel {
            background: #f1f5f9;
            color: #64748b;
            border: 2px solid #e2e8f0;
            padding: 12px 25px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: #e2e8f0;
            color: #475569;
            transform: translateY(-2px);
        }

        .btn-submit {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-delete {
            background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-delete:hover {
            background: linear-gradient(135deg, #f87171 0%, #ef4444 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(239, 68, 68, 0.3);
        }

        /* Style pour les formulaires dans le modal */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
        }

        .form-label i {
            color: #667eea;
            font-size: 16px;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 16px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: white;
        }

        /* Badge amélioré */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
        }

        .bg-light {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%) !important;
            color: #475569 !important;
            border: 1px solid #cbd5e1;
        }

        /* Animation pour le modal */
        .modal.fade .modal-dialog {
            transform: translateY(-30px) scale(0.95);
            transition: transform 0.3s ease-out;
        }

        .modal.show .modal-dialog {
            transform: translateY(0) scale(1);
        }

        /* Style pour le tableau */
        .table-container {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        #schoolsTable {
            margin-bottom: 0;
        }

        #schoolsTable thead th {
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            padding: 18px 20px;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 13px;
        }

        #schoolsTable tbody td {
            padding: 18px 20px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }

        #schoolsTable tbody tr:hover {
            background: #f8fafc;
        }

        .school-name {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            color: #334155;
        }

        .school-name i {
            font-size: 18px;
        }

        /* Responsive pour le modal */
        @media (max-width: 768px) {
            .asp-modal .modal-dialog {
                margin: 20px;
                max-width: calc(100% - 40px);
            }
            
            .asp-modal .modal-header {
                padding: 20px;
            }
            
            .asp-modal .modal-body {
                padding: 20px;
            }
            
            .asp-modal .modal-footer {
                padding: 15px 20px;
                flex-direction: column;
            }
            
            .asp-modal .modal-footer button {
                width: 100%;
            }
            
            .btn-add {
                width: 100%;
                justify-content: center;
            }
        }

        /* Correction pour DataTables */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            padding: 20px;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 15px;
            width: 250px;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }


         .export-container {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            align-items: center;
        }
        
        /* Boutons d'export */
        .btn-export {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-export:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(16, 185, 129, 0.3);
        }
        
        .btn-print {
            background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(59, 130, 246, 0.3);
        }
        
        .btn-excel {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-excel:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(34, 197, 94, 0.3);
        }
        
        /* Bouton Ajouter principal */
        .btn-add {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-add:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }

        .btn-add i {
            font-size: 18px;
        }
        
        /* Boutons d'action dans le tableau */
        .actions {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .btn-edit {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .btn-edit:hover {
            background: #3b82f6;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        /* Header avec actions alignées */
        .main-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        /* Style pour le tableau */
        .table-container {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }
        
        /* Styles pour l'impression */
        @media print {
            body * {
                visibility: hidden;
            }
            
            .print-table, .print-table * {
                visibility: visible;
            }
            
            .print-table {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                font-size: 12px;
            }
            
            .print-header {
                text-align: center;
                margin-bottom: 20px;
            }
            
            .print-header h1 {
                font-size: 18px;
                margin-bottom: 5px;
            }
            
            .print-header p {
                font-size: 12px;
                color: #666;
            }
            
            .print-footer {
                margin-top: 30px;
                text-align: center;
                font-size: 10px;
                color: #666;
            }
            
            .no-print {
                display: none !important;
            }
            
            table {
                width: 100%;
                border-collapse: collapse;
            }
            
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            
            th {
                background-color: #f5f5f5;
                font-weight: bold;
            }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .export-container {
                flex-direction: column;
                align-items: stretch;
            }
            
            .btn-export, .btn-print, .btn-excel, .btn-add {
                width: 100%;
                justify-content: center;
            }
        }
    </style>