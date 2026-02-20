<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard - Sécurité Pénitentiaire</title>
   @include('style.admin')

</head>

<body>

   @include('style.sidebarAdmin')


<div class="main">

    <div class="header">
        <h1>Tableau de Bord</h1>
        <div class="user-info">Admin Général</div>
    </div>

    <div class="cards">
        <div class="card">
            <h3>Agents enregistrés</h3>
            <p>248</p>
        </div>

        <div class="card">
            <h3>Stages en cours</h3>
            <p>32</p>
        </div>

        <div class="card">
            <h3>Écoles partenaires</h3>
            <p>6</p>
        </div>

        <div class="card">
            <h3>Stages terminés</h3>
            <p>115</p>
        </div>
    </div>

    <div class="section">
        <h2>Dernières affectations</h2>
        <table>
            <thead>
                <tr>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>École</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>SPG001</td>
                    <td>NDONG Jean</td>
                    <td>École Nationale</td>
                    <td><span class="status en-cours">En cours</span></td>
                </tr>
                <tr>
                    <td>SPG014</td>
                    <td>OYONO Marc</td>
                    <td>Centre Spécialisé</td>
                    <td><span class="status attente">En attente</span></td>
                </tr>
                <tr>
                    <td>SPG022</td>
                    <td>MBADINGA Paul</td>
                    <td>École Militaire</td>
                    <td><span class="status termine">Terminé</span></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
