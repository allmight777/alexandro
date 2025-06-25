<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rapport</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .content { margin-top: 30px; line-height: 1.6; }
        .footer { margin-top: 50px; font-size: 12px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Rapport</h2>
        <p>Généré par: {{ $user->nom}}</p>
        <p>Date: {{ now()->format('d/m/Y H:i') }}</p>
    </div>
    
    <div class="content">
        {!! nl2br(e($contenu)) !!}
    </div>
    
    <div class="footer">
        Signature: ________________________
    </div>
</body>
</html>