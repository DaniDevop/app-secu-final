<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rapport Administratif - ASP</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h1 { text-transform: uppercase; margin: 0; font-size: 20px; }
        .info-section { margin-bottom: 20px; }
        .info-label { font-weight: bold; text-decoration: underline; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; text-transform: uppercase; font-size: 12px; }
        
        .stats-box { margin-top: 20px; }
        .footer { margin-top: 50px; }
        .signature-space { margin-top: 40px; float: right; width: 250px; text-align: center; }
        .page-number:after { content: counter(page); }
    </style>
</head>
<body>

    <div class="header">
        <p>REPUBLIQUE DU SENEGAL<br>Un Peuple - Un But - Une Foi</p>
        <h1>GESTION DES STAGES - ASP</h1>
        <p>DIRECTION ADMINISTRATIVE</p>
    </div>

    <div class="info-section">
        <p><span class="info-label">Date du rapport :</span> {{ date('d/m/Y H:i') }}</p>
        <p><span class="info-label">Généré par :</span> {{ Auth::user()->grade }} {{ Auth::user()->name }}</p>
        <p><span class="info-label">Objet :</span> État statistique des stages en cours</p>
    </div>

    <h3>RÉSUMÉ DES STATISTIQUES</h3>
    <table>
        <thead>
            <tr>
                <th>Indicateur</th>
                <th>Valeur Actuelle</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Stagiaires Actifs</td>
                <td><strong>{{ $stagesAll }}</strong></td>
            </tr>
            <tr>
                <td>Stages Validés / Terminés</td>
                <td><strong>{{ $stagesValide }}</strong></td>
            </tr>
            <tr>
                <td>Dossiers en Attente</td>
                <td><strong>{{ $stagesAttente }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Certifié conforme aux registres de la base de données numérique.</p>
        
        <div class="signature-space">
            <p>Fait à Dakar, le {{ date('d/m/Y') }}</p>
            <p><strong>Le Responsable,</strong></p>
            <br><br>
            <p>__________________________</p>
            <p>{{ Auth::user()->name }}</p>
        </div>
    </div>

</body>
</html>