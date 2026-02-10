<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accès Direction - Gestion des Stages ASP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0c2461 0%, #1e3799 50%, #4a69bd 100%);
            position: relative;
            overflow: hidden;
            padding: 20px;
        }

        /* Effets de particules */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        /* Carte de connexion */
        .login-container {
            width: 100%;
            max-width: 420px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3),
                        0 0 0 1px rgba(255, 255, 255, 0.1);
            overflow: hidden;
            position: relative;
            z-index: 10;
            backdrop-filter: blur(10px);
            transform: translateY(0);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .login-container:hover {
            transform: translateY(-5px);
        }

        /* En-tête */
        .login-header {
            background: linear-gradient(to right, #0c2461, #1e3799);
            color: white;
            padding: 40px 30px 30px;
            text-align: center;
            position: relative;
        }

        .logo-container {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .logo-icon {
            font-size: 36px;
            color: #0c2461;
            background: linear-gradient(to right, #0c2461, #1e3799);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .login-header h1 {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
        }

        .login-header p {
            font-size: 14px;
            opacity: 0.9;
            font-weight: 300;
        }

        /* Corps du formulaire */
        .login-body {
            padding: 40px 35px;
        }

        .input-group {
            margin-bottom: 28px;
            position: relative;
        }

        .input-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .input-container {
            position: relative;
        }

        .input-field {
            width: 100%;
            padding: 18px 20px 18px 50px;
            border: 2px solid #e1e8f0;
            border-radius: 12px;
            font-size: 16px;
            color: #333;
            background: #f8fafc;
            transition: all 0.3s ease;
            outline: none;
        }

        .input-field:focus {
            border-color: #4a69bd;
            background: white;
            box-shadow: 0 0 0 3px rgba(74, 105, 189, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .input-field:focus + .input-icon {
            color: #4a69bd;
        }

        .password-toggle {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #4a69bd;
        }

        /* Options */
        .login-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #555;
        }

        .checkbox {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 2px solid #cbd5e1;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
        }

        .checkbox.checked {
            background: #4a69bd;
            border-color: #4a69bd;
        }

        .checkbox.checked::after {
            content: '✓';
            position: absolute;
            color: white;
            font-size: 12px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .forgot-password {
            color: #4a69bd;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #0c2461;
            text-decoration: underline;
        }

        /* Bouton de connexion */
        .login-button {
            width: 100%;
            padding: 18px;
            background: linear-gradient(to right, #0c2461, #1e3799);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 6px 20px rgba(12, 36, 97, 0.3);
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(12, 36, 97, 0.4);
            background: linear-gradient(to right, #1a3cb8, #2d4fc8);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .button-icon {
            font-size: 18px;
        }

        /* Pied de page */
        .login-footer {
            padding: 25px 35px;
            background: #f8fafc;
            text-align: center;
            border-top: 1px solid #e1e8f0;
        }

        .security-notice {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: #64748b;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .security-icon {
            color: #10b981;
            font-size: 16px;
        }

        .copyright {
            font-size: 12px;
            color: #94a3b8;
        }

        /* Animation de chargement */
        .loader {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-container {
                max-width: 100%;
                border-radius: 20px;
            }
            
            .login-header {
                padding: 30px 20px 25px;
            }
            
            .login-body {
                padding: 30px 25px;
            }
            
            .login-footer {
                padding: 20px 25px;
            }
        }

        /* Éléments de décoration */
        .decoration {
            position: absolute;
            z-index: 5;
        }

        .decoration-1 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(74, 105, 189, 0.15) 0%, transparent 70%);
            top: -150px;
            right: -150px;
        }

        .decoration-2 {
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(12, 36, 97, 0.1) 0%, transparent 70%);
            bottom: -100px;
            left: -100px;
        }

        /* Message d'erreur */
        .error-message {
            position: absolute;
            bottom: -22px;
            left: 0;
            font-size: 13px;
            color: #ef4444;
            display: none;
        }
    </style>
</head>
<body>
    <!-- Effets de particules -->
    <div class="particles" id="particles"></div>
    
    <!-- Éléments de décoration -->
    <div class="decoration decoration-1"></div>
    <div class="decoration decoration-2"></div>
    
    <!-- Carte de connexion -->
    <div class="login-container">
        <!-- En-tête -->
        <div class="login-header">
            <div class="logo-container">
                <i class="fas fa-shield-alt logo-icon"></i>
            </div>
            <h1>PORTAL DIRECTION</h1>
            <p>Système de Gestion des Stages - Administration Pénitentiaire</p>
        </div>
        
        <!-- Formulaire -->
        <div class="login-body">
            <form id="loginForm" method="POST" action="{{route('login.user.admin')}}">
                @csrf
                <div class="input-group">
                    <label class="input-label">Identifiant</label>
                    <div class="input-container">
                        <input type="text" name="name" class="input-field" id="username" placeholder="Saisissez votre identifiant" required>
                        <i class="fas fa-user input-icon"></i>
                    </div>
                    <div class="error-message" id="usernameError">Identifiant incorrect</div>
                </div>
                
                <div class="input-group">
                    <label class="input-label">Mot de passe</label>
                    <div class="input-container">
                        <input type="password" name="password" class="input-field" id="password" placeholder="Saisissez votre mot de passe" required>
                        <i class="fas fa-lock input-icon"></i>
                        <button type="button" class="password-toggle" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="error-message" id="passwordError">Mot de passe incorrect</div>
                </div>
                
                <div class="login-options">
                    <div class="remember-me" id="rememberContainer">
                        <div class="checkbox" id="rememberCheckbox"></div>
                        <span>Se souvenir de moi</span>
                    </div>
                    <a href="#" class="forgot-password">Mot de passe oublié ?</a>
                </div>
                
                <button type="submit" class="login-button" id="loginButton">
                    <span>Se connecter</span>
                    <i class="fas fa-arrow-right button-icon"></i>
                    <div class="loader" id="loginLoader"></div>
                </button>
            </form>
        </div>
        
        <!-- Pied de page -->
        <div class="login-footer">
            <div class="security-notice">
                <i class="fas fa-lock security-icon"></i>
                <span>Connexion sécurisée par chiffrement TLS 1.3</span>
            </div>
            <div class="copyright">
                © 2024 Administration Pénitentiaire - Direction des Ressources Humaines
            </div>
        </div>
    </div>


</body>
</html>