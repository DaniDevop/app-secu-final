<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
<title>Connexion - Gestion des Stages</title>

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
        font-family: 'Segoe UI', sans-serif;
        background: linear-gradient(rgba(8, 28, 21, 0.9), rgba(8, 28, 21, 0.9)),
                    url('https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .login-container {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-card {
        background: #1B4332;
        padding: 50px 40px;
        width: 100%;
        max-width: 450px;
        border-radius: 20px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        color: white;
        transition: all 0.3s ease;
        border: 1px solid rgba(212, 175, 55, 0.2);
    }

    .login-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .login-header i {
        font-size: 50px;
        color: #D4AF37;
        margin-bottom: 15px;
        opacity: 0.9;
    }

    .login-header h1 {
        font-size: clamp(18px, 4vw, 22px);
        letter-spacing: 2px;
        color: #D4AF37;
        margin-bottom: 5px;
        line-height: 1.3;
    }

    .login-header p {
        font-size: 14px;
        opacity: 0.8;
        margin-top: 5px;
    }

    .input-group {
        margin-bottom: 25px;
    }

    .input-group label {
        display: block;
        font-size: 14px;
        margin-bottom: 8px;
        color: #D4AF37;
        font-weight: 500;
    }

    .input-group label i {
        margin-right: 8px;
        font-size: 14px;
    }

    .input-group input {
        width: 100%;
        padding: 14px 16px;
        border: none;
        border-radius: 10px;
        outline: none;
        background: #081C15;
        color: white;
        font-size: 15px;
        transition: all 0.3s;
        border: 2px solid transparent;
    }

    .input-group input:focus {
        border-color: #D4AF37;
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
    }

    .input-group input::placeholder {
        color: rgba(255, 255, 255, 0.5);
        font-size: 14px;
    }

    button {
        width: 100%;
        padding: 14px;
        border: none;
        background: #D4AF37;
        color: #081C15;
        font-weight: bold;
        font-size: 16px;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
    }

    button i {
        font-size: 16px;
        transition: transform 0.3s;
    }

    button:hover {
        background: #c59b2d;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.3);
    }

    button:hover i {
        transform: translateX(5px);
    }

    .login-footer {
        text-align: center;
        margin-top: 30px;
        font-size: 13px;
        opacity: 0.7;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border-top: 1px solid rgba(212, 175, 55, 0.2);
        padding-top: 20px;
    }

    .login-footer i {
        color: #D4AF37;
    }

    /* Message d'erreur */
    .error-message {
        background: rgba(220, 53, 69, 0.2);
        border-left: 4px solid #dc3545;
        padding: 12px 15px;
        margin-bottom: 20px;
        border-radius: 8px;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #ff8a95;
    }

    .error-message i {
        font-size: 18px;
    }

    /* Animation d'apparition */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-card {
        animation: fadeInUp 0.6s ease;
    }

    /* Responsive pour petits écrans */
    @media (max-width: 768px) {
        .login-card {
            padding: 40px 30px;
        }
        
        .login-header i {
            font-size: 45px;
        }
        
        .input-group input {
            padding: 12px 14px;
        }
        
        button {
            padding: 12px;
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
        
        .login-header i {
            font-size: 40px;
        }
        
        .login-header h1 {
            font-size: 16px;
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
            padding: 10px 12px;
            font-size: 14px;
        }
        
        button {
            padding: 12px;
            font-size: 15px;
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
        
        .login-header i {
            font-size: 35px;
        }
    }

    /* Support pour les écrans très larges */
    @media (min-width: 1400px) {
        .login-card {
            max-width: 500px;
            padding: 60px 50px;
        }
    }

    /* Optimisation tactile */
    @media (hover: none) and (pointer: coarse) {
        .input-group input {
            font-size: 16px; /* Évite le zoom sur iOS */
        }
        
        button {
            padding: 16px;
        }
    }
</style>
</head>
<body>

<div class="login-container">

    <div class="login-card">
        <div class="login-header">
            <i class="fas fa-shield-alt"></i>
            <h1>SÉCURITÉ PÉNITENTIAIRE</h1>
            <p>République Gabonaise</p>
        </div>

        <!-- Affichage des erreurs de validation -->
        @if($errors->any())
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Affichage des erreurs de session -->
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

            <!-- Option "Se souvenir de moi" (optionnel) -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                    <input type="checkbox" name="remember" style="width: auto; accent-color: #D4AF37;">
                    <span style="font-size: 13px; opacity: 0.8;">Se souvenir de moi</span>
                </label>
                <!-- Lien mot de passe oublié (optionnel) -->
                <a href="#" style="color: #D4AF37; font-size: 13px; text-decoration: none;">
                    Mot de passe oublié?
                </a>
            </div>

            <button type="submit">
                <span>Se connecter</span>
                <i class="fas fa-arrow-right"></i>
            </button>
        </form>

        <div class="login-footer">
            <i class="fas fa-lock"></i>
            Application interne sécurisée
            <i class="fas fa-lock"></i>
        </div>
    </div>

</div>

<!-- Scripts optionnels pour la validation côté client -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            const matricule = document.getElementById('matricule').value.trim();
            const password = document.getElementById('password').value.trim();
            
            if (!matricule || !password) {
                e.preventDefault();
                showError('Veuillez remplir tous les champs');
            }
        });
    }
    
    // Fonction pour afficher les erreurs (optionnelle)
    function showError(message) {
        // Supprimer l'ancien message d'erreur s'il existe
        const oldError = document.querySelector('.error-message');
        if (oldError) {
            oldError.remove();
        }
        
        // Créer le nouveau message d'erreur
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.innerHTML = `
            <i class="fas fa-exclamation-circle"></i>
            <div>${message}</div>
        `;
        
        // Insérer après le header
        const header = document.querySelector('.login-header');
        header.insertAdjacentElement('afterend', errorDiv);
        
        // Animation de l'erreur
        errorDiv.style.animation = 'shake 0.5s ease';
        
        // Supprimer après 5 secondes
        setTimeout(() => {
            if (errorDiv.parentNode) {
                errorDiv.remove();
            }
        }, 5000);
    }
    
    // Animation shake pour les erreurs
    const style = document.createElement('style');
    style.textContent = `
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
    `;
    document.head.appendChild(style);
    
    // Focus sur le champ matricule si vide
    const matricule = document.getElementById('matricule');
    if (matricule && !matricule.value) {
        matricule.focus();
    }
});

// Optionnel : Afficher/masquer mot de passe (à décommenter si besoin)
/*
function togglePasswordVisibility() {
    const password = document.getElementById('password');
    const toggleBtn = document.querySelector('.toggle-password');
    
    if (password.type === 'password') {
        password.type = 'text';
        toggleBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
    } else {
        password.type = 'password';
        toggleBtn.innerHTML = '<i class="fas fa-eye"></i>';
    }
}
*/
</script>

<!-- SweetAlert2 pour des notifications plus jolies (optionnel) -->
@if(session('success') || session('error') || $errors->any())
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: "{{ session('success') }}",
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    @endif
    
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: "{{ session('error') }}",
            confirmButtonColor: '#1B4332'
        });
    @endif
    
    @if($errors->any())
        Swal.fire({
            icon: 'warning',
            title: 'Attention',
            html: '{!! implode("<br>", $errors->all()) !!}',
            confirmButtonColor: '#1B4332'
        });
    @endif
</script>
@endif

</body>
</html>