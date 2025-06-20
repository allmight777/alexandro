<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        .header { text-align: center; margin-bottom: 20px; }
        .logo img { width: 120px; }
        .content { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="/images/jaspe_blanc.png" alt="Jaspe Technologie">
        </div>
        <h2>Retour de Matériel - Déclaration de Perte</h2>
    </div>

    <div class="content">
        <p>Date : {{ $date }}</p>
        <p>Employé : {{ $nom }} {{ $prenom }}</p>
        <p>Matériel concerné : {{ $equipement }}</p>
        <p>Description : Ce document atteste que le matériel mentionné ci-dessus, initialement déclaré comme <strong>perdu</strong>, a été retourné.</p>
    </div>
</body>
</html>
