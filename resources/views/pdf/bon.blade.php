<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .title { text-align: center; font-size: 18px; font-weight: bold; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 30px; }
        td, th { padding: 10px; border: 1px solid #000; }
        .signatures td { height: 100px; vertical-align: bottom; }
    </style>
</head>
<body>
    <div class="title">Bon {{$type}} de matériel</div>
    <p><strong>Numéro du bon :</strong> {{ $numero_bon }}</p>
    <p><strong>Date :</strong> {{ $date }}</p>
    <p><strong>Nom et Prénom :</strong> {{ $nom }} {{ $prenom }}</p>
    <p><strong>Motif :</strong> {{ $motif }}</p>

    <table class="signatures">
        <tr>
            <th>Responsable IT</th>
            <th>Agent</th>
        </tr>
        <tr>
            <td>Signature : ___________<br>Nom & Numéro :</td>
            <td>Signature : ___________<br>Nom & Numéro :</td>
        </tr>
    </table>
</body>
</html>
