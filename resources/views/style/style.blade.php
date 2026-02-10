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
        }

        .header-left h1 {
            font-size: 28px;
            color: var(--gray-900);
            font-weight: 700;
            margin-bottom: 8px;
        }

        .header-left p {
            color: var(--gray-700);
            font-size: 15px;
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

        /* Cartes de statistiques */
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            border-left: 5px solid var(--primary);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
        }

        .stat-card.green {
            border-left-color: var(--success);
        }

        .stat-card.orange {
            border-left-color: var(--warning);
        }

        .stat-card.red {
            border-left-color: var(--danger);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .stat-title {
            font-size: 15px;
            color: var(--gray-700);
            font-weight: 600;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: rgba(30, 55, 153, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 22px;
        }

        .stat-card.green .stat-icon {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .stat-card.orange .stat-icon {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .stat-card.red .stat-icon {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .stat-number {
            font-size: 32px;
            font-weight: 800;
            color: var(--gray-900);
            margin-bottom: 8px;
        }

        .stat-trend {
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .trend-up {
            color: var(--success);
        }

        .trend-down {
            color: var(--danger);
        }

        /* Sections principales */
        .dashboard-section {
            background: white;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--gray-900);
        }

        .section-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(30, 55, 153, 0.2);
        }

        .btn-secondary {
            background: var(--gray-100);
            color: var(--gray-900);
        }

        .btn-secondary:hover {
            background: var(--gray-200);
        }

        /* Tableau */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 15px;
            font-weight: 600;
            color: var(--gray-700);
            border-bottom: 2px solid var(--gray-100);
        }

        td {
            padding: 15px;
            border-bottom: 1px solid var(--gray-100);
        }

        tr:hover {
            background: var(--gray-50);
        }

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
        }

        .status.active {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .status.pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .status.rejected {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        /* Graphique */
        .chart-container {
            height: 300px;
            margin-top: 20px;
        }

        .chart-placeholder {
            background: linear-gradient(to right, #f8fafc, #f1f5f9);
            border-radius: 12px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-700);
            font-weight: 600;
        }

        /* Layout responsive */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
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
            .content-grid {
                grid-template-columns: 1fr;
            }
            
            .search-box input {
                width: 200px;
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
            
            .stats-cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 20px;
            }
            
            .stats-cards {
                grid-template-columns: 1fr;
            }
            
            .header-right {
                flex-wrap: wrap;
            }
            
            .search-box input {
                width: 100%;
            }
            
            .main-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
                margin-bottom: 30px;
            }
        }
    </style>