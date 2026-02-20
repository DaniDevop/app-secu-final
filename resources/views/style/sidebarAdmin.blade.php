
<style>
    /* ===== SIDEBAR ===== */
.sidebar{
    width:260px;
    background:linear-gradient(180deg,#081C15,#1B4332);
    color:white;
    padding:30px 20px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    box-shadow:5px 0 25px rgba(0,0,0,0.2);
}

.logo{
    text-align:center;
}

.logo h2{
    color:#D4AF37;
    letter-spacing:2px;
    font-size:18px;
}

.menu{
    margin-top:40px;
}

.menu li{
    list-style:none;
    margin:15px 0;
}

.menu a{
    text-decoration:none;
    color:white;
    display:flex;
    align-items:center;
    padding:12px 15px;
    border-radius:8px;
    transition:0.3s;
}

.menu a:hover{
    background:#2D6A4F;
    transform:translateX(5px);
}

</style>
<div class="sidebar">
    <div>
        <div class="logo">
            <h2>SÉCURITÉ<br>PÉNITENTIAIRE</h2>
        </div>

        <ul class="menu">
            <li><a href="{{route('admin.dashboard')}}">🏠 Acceuil</a></li>
            <li><a href="{{route('users.agent.index')}}">👮 Agents</a></li>
            <li><a href="{{route('admin.ecole.index')}}">🏫 Écoles</a></li>
            <li><a href="{{route('admin.service.index')}}">👜Services</a></li>
            <li><a href="{{route('admin.listes.Admin')}}">Administrations</a></li>
            <li><a href="{{route('users.affectation.agent')}}">📚 Stages / Affectations</a></li>
            <li><a href="#">📊 Rapports</a></li>
        </ul>
    </div>

    <div class="logout">
        Application interne sécurisée
    </div>
</div>