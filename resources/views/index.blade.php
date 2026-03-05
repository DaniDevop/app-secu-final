<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
<title>Connexion - Gestion des Stages ASP</title>

<!-- Font Awesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
body {
    margin: 0;
    font-family: 'Poppins', 'Segoe UI', sans-serif;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    position: relative;
    overflow-x: hidden;
    /* Supprime le background ici, on utilise le ::before */
    background-color: #081C15; 
}

/* Background avec l'image */
body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* Utilise background-image pour plus de clarté */
    background-image: url("{{ asset('storage/image/derfCadre.jpg') }}");
    background-repeat: no-repeat;
    background-position: center center;
    background-attachment: fixed;
    background-size: cover;
    z-index: -2;
    /* L'image sera plus nette et plus claire */
    /* Légère réduction du zoom pour éviter l'excès de flou */
}
    /* Overlay gradient pour améliorer la lisibilité */
    body::after {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at center, transparent 0%, rgba(8, 28, 21, 0.7) 100%);
        z-index: -1;
    }

    .login-container {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        perspective: 1000px;
    }

    .login-card {
        background: rgba(27, 67, 50, 0.85);
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
        padding: 50px 40px;
        width: 100%;
        max-width: 450px;
        border-radius: 30px;
        box-shadow: 
            0 30px 60px rgba(0, 0, 0, 0.5),
            0 0 0 2px rgba(212, 175, 55, 0.2) inset,
            0 0 30px rgba(212, 175, 55, 0.2);
        color: white;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(212, 175, 55, 0.3);
        transform-style: preserve-3d;
        animation: cardAppear 1s ease-out;
    }

    .login-card:hover {
        transform: translateY(-5px) rotateX(2deg);
        box-shadow: 
            0 40px 80px rgba(0, 0, 0, 0.6),
            0 0 0 2px rgba(212, 175, 55, 0.3) inset,
            0 0 50px rgba(212, 175, 55, 0.3);
        background: rgba(27, 67, 50, 0.9);
    }

    @keyframes cardAppear {
        0% {
            opacity: 0;
            transform: translateY(50px) rotateX(-10deg);
        }
        100% {
            opacity: 1;
            transform: translateY(0) rotateX(0);
        }
    }

    .login-header {
        text-align: center;
        margin-bottom: 40px;
        position: relative;
    }

    .login-header::after {
        content: '';
        position: absolute;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, transparent, #D4AF37, transparent);
        border-radius: 3px;
    }

    .logo-container {
        width: 100px;
        height: 100px;
        background: rgba(212, 175, 55, 0.15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        border: 3px solid rgba(212, 175, 55, 0.3);
        position: relative;
        overflow: hidden;
    }

    .logo-container::before {
        content: '';
        position: absolute;
        width: 150%;
        height: 150%;
        background: radial-gradient(circle, rgba(212, 175, 55, 0.2) 0%, transparent 70%);
        animation: rotate 10s linear infinite;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .logo-container i {
        font-size: 50px;
        color: #D4AF37;
        position: relative;
        z-index: 1;
        filter: drop-shadow(0 0 10px rgba(212, 175, 55, 0.5));
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    .login-header h1 {
        font-size: clamp(18px, 4vw, 22px);
        letter-spacing: 3px;
        color: #D4AF37;
        margin-bottom: 5px;
        line-height: 1.3;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .login-header p {
        font-size: 14px;
        opacity: 0.9;
        margin-top: 5px;
        letter-spacing: 1px;
    }

    .input-group {
        margin-bottom: 25px;
        position: relative;
    }

    .input-group label {
        display: block;
        font-size: 14px;
        margin-bottom: 8px;
        color: #D4AF37;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s;
    }

    .input-group label i {
        margin-right: 8px;
        font-size: 14px;
        color: #D4AF37;
    }

    .input-group input {
        width: 100%;
        padding: 16px 18px;
        border: none;
        border-radius: 15px;
        outline: none;
        background: rgba(8, 28, 21, 0.8);
        color: white;
        font-size: 15px;
        transition: all 0.3s;
        border: 2px solid transparent;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .input-group input:focus {
        border-color: #D4AF37;
        background: rgba(8, 28, 21, 0.95);
        box-shadow: 
            0 5px 20px rgba(212, 175, 55, 0.3),
            0 0 0 3px rgba(212, 175, 55, 0.1);
        transform: translateY(-2px);
    }

    .input-group input::placeholder {
        color: rgba(255, 255, 255, 0.4);
        font-size: 14px;
        font-style: italic;
    }

    /* Icône de validation */
    .input-group.success input {
        border-color: #28a745;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2328a745' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='20 6 9 17 4 12'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        padding-right: 45px;
    }

    .input-group.error input {
        border-color: #dc3545;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23dc3545' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='12' cy='12' r='10'%3E%3C/circle%3E%3Cline x1='12' y1='8' x2='12' y2='12'%3E%3C/line%3E%3Cline x1='12' y1='16' x2='12.01' y2='16'%3E%3C/line%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        padding-right: 45px;
    }

    button {
        width: 100%;
        padding: 16px;
        border: none;
        background: linear-gradient(135deg, #D4AF37, #b3942f);
        color: #081C15;
        font-weight: bold;
        font-size: 16px;
        border-radius: 15px;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
        text-transform: uppercase;
        letter-spacing: 2px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }

    button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    button:hover::before {
        left: 100%;
    }

    button i {
        font-size: 16px;
        transition: transform 0.3s;
    }

    button:hover {
        background: linear-gradient(135deg, #c59b2d, #9e7d28);
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
    }

    button:hover i {
        transform: translateX(8px) scale(1.2);
    }

    button:active {
        transform: translateY(0);
    }

    .login-footer {
        text-align: center;
        margin-top: 30px;
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        border-top: 1px solid rgba(212, 175, 55, 0.2);
        padding-top: 20px;
        color: rgba(255, 255, 255, 0.7);
    }

    .login-footer i {
        color: #D4AF37;
        font-size: 16px;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-3px); }
    }

    /* Message d'erreur amélioré */
    .error-message {
        background: rgba(220, 53, 69, 0.15);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-left: 4px solid #dc3545;
        padding: 15px 18px;
        margin-bottom: 25px;
        border-radius: 12px;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 12px;
        color: #ff8a95;
        animation: slideInError 0.3s ease;
        border: 1px solid rgba(220, 53, 69, 0.3);
    }

    @keyframes slideInError {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .error-message i {
        font-size: 20px;
        color: #dc3545;
    }

    /* Checkbox personnalisée */
    .remember-me {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.8);
    }

    .remember-me input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #D4AF37;
    }

    .forgot-password {
        color: #D4AF37;
        font-size: 13px;
        text-decoration: none;
        transition: all 0.3s;
        position: relative;
    }

    .forgot-password::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 1px;
        background: #D4AF37;
        transition: width 0.3s;
    }

    .forgot-password:hover::after {
        width: 100%;
    }

    .forgot-password:hover {
        color: #e5c158;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .login-card {
            padding: 40px 30px;
        }
        
        .logo-container {
            width: 80px;
            height: 80px;
        }
        
        .logo-container i {
            font-size: 40px;
        }
        
        .input-group input {
            padding: 14px 16px;
        }
        
        button {
            padding: 14px;
        }
    }

    @media (max-width: 480px) {
        body {
            padding: 15px;
        }
        
        .login-card {
            padding: 30px 20px;
        }
        
        .login-header {
            margin-bottom: 30px;
        }
        
        .logo-container {
            width: 70px;
            height: 70px;
        }
        
        .logo-container i {
            font-size: 35px;
        }
        
        .login-header h1 {
            font-size: 16px;
            letter-spacing: 2px;
        }
        
        .login-header p {
            font-size: 12px;
        }
        
        .input-group {
            margin-bottom: 20px;
        }
        
        .input-group label {
            font-size: 13px;
        }
        
        .input-group input {
            padding: 12px 14px;
            font-size: 14px;
        }
        
        button {
            padding: 14px;
            font-size: 14px;
        }
        
        .login-footer {
            font-size: 11px;
            margin-top: 25px;
            padding-top: 15px;
        }
    }

    @media (max-width: 360px) {
        .login-card {
            padding: 25px 15px;
        }
    }

    /* Optimisation tactile */
    @media (hover: none) and (pointer: coarse) {
        .input-group input {
            font-size: 16px;
        }
        
        button {
            padding: 18px;
        }
        
        .remember-me input[type="checkbox"] {
            width: 22px;
            height: 22px;
        }
    }

    /* Loader pour la soumission */
    .btn-loading {
        position: relative;
        pointer-events: none;
        opacity: 0.8;
    }

    .btn-loading i {
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>
</head>
<body>

<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <div class="logo-container">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h1>SÉCURITÉ PÉNITENTIAIRE</h1>
            <p>République Gabonaise • Direction Générale</p>
        </div>

        <!-- Affichage des erreurs -->
        @if($errors->any())
            <div class="error-message">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        <form method="POST" action="{{ route('login.user.admin') }}" id="loginForm">
            @csrf
            
            <div class="input-group">
                <label for="matricule">
                    <i class="fas fa-id-card"></i> Matricule
                </label>
                <input type="text" 
                       id="matricule" 
                       name="name" 
                       placeholder="Entrez votre matricule" 
                       value="{{ old('name') }}"
                       required 
                       autofocus>
            </div>

            <div class="input-group">
                <label for="password">
                    <i class="fas fa-lock"></i> Mot de passe
                </label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       placeholder="••••••••" 
                       required>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <label class="remember-me">
                    <input type="checkbox" name="remember">
                    <span>Se souvenir de moi</span>
                </label>
                <a href="#" class="forgot-password">
                    Mot de passe oublié?
                </a>
            </div>

            <button type="submit" id="submitBtn">
                <span>Se connecter</span>
                <i class="fas fa-arrow-right"></i>
            </button>
        </form>

        <div class="login-footer">
            <i class="fas fa-lock"></i>
            <span>Application interne sécurisée • ASP 2026</span>
            <i class="fas fa-lock"></i>
        </div>
    </div>
</div>
<!-- Scripts améliorés -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    const submitBtn = document.getElementById('submitBtn');
    const matricule = document.getElementById('matricule');
    const password = document.getElementById('password');

    // Animation des inputs
    const inputs = document.querySelectorAll('.input-group input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
    });

    // Validation en temps réel
    matricule.addEventListener('input', function() {
        const group = this.closest('.input-group');
        if (this.value.length >= 3) {
            group.classList.add('success');
            group.classList.remove('error');
        } else if (this.value.length > 0) {
            group.classList.add('error');
            group.classList.remove('success');
        } else {
            group.classList.remove('success', 'error');
        }
    });

    password.addEventListener('input', function() {
        const group = this.closest('.input-group');
        if (this.value.length >= 6) {
            group.classList.add('success');
            group.classList.remove('error');
        } else if (this.value.length > 0) {
            group.classList.add('error');
            group.classList.remove('success');
        } else {
            group.classList.remove('success', 'error');
        }
    });

    // Soumission du formulaire
    if (form) {
        form.addEventListener('submit', function(e) {
            const matriculeValue = matricule.value.trim();
            const passwordValue = password.value.trim();
            
            if (!matriculeValue || !passwordValue) {
                e.preventDefault();
                showError('Veuillez remplir tous les champs');
                return;
            }
            
            if (passwordValue.length < 3) {
                e.preventDefault();
                showError('Le mot de passe doit contenir au moins 6 caractères');
                return;
            }
            
            // Animation de chargement
            submitBtn.classList.add('btn-loading');
            submitBtn.innerHTML = '<span>Connexion en cours...</span><i class="fas fa-spinner"></i>';
        });
    }
    
    // Fonction pour afficher les erreurs
    function showError(message) {
        const oldError = document.querySelector('.error-message');
        if (oldError) {
            oldError.remove();
        }
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.innerHTML = `
            <i class="fas fa-exclamation-triangle"></i>
            <div>${message}</div>
        `;
        
        const header = document.querySelector('.login-header');
        header.insertAdjacentElement('afterend', errorDiv);
        
        setTimeout(() => {
            if (errorDiv.parentNode) {
                errorDiv.style.animation = 'slideInError 0.3s ease reverse';
                setTimeout(() => errorDiv.remove(), 300);
            }
        }, 5000);
    }
    
    // Focus sur le champ matricule
    if (matricule && !matricule.value) {
        matricule.focus();
    }
});

// Fonction pour afficher/masquer le mot de passe (optionnel)
function togglePasswordVisibility() {
    const password = document.getElementById('password');
    const type = password.type === 'password' ? 'text' : 'password';
    password.type = type;
    
    // Chercher ou créer le bouton toggle
    let toggleBtn = document.querySelector('.toggle-password');
    if (!toggleBtn) {
        toggleBtn = document.createElement('span');
        toggleBtn.className = 'toggle-password';
        toggleBtn.style.cssText = `
            position: absolute;
            right: 15px;
            top: 45px;
            cursor: pointer;
            color: #D4AF37;
            z-index: 10;
        `;
        password.parentElement.appendChild(toggleBtn);
    }
    
    toggleBtn.innerHTML = type === 'password' ? 
        '<i class="fas fa-eye"></i>' : 
        '<i class="fas fa-eye-slash"></i>';
}
</script>

<!-- SweetAlert2 pour les notifications -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>