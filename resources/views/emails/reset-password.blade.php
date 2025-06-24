<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réinitialisation du mot de passe</title>
</head>
<body style="font-family: 'Segoe UI', sans-serif; background: #f4f4f4; padding: 30px;">
    <div style="max-width: 600px; margin: auto; background: #fff; padding: 40px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
        
        <!-- En-tête -->
        <div style="text-align: center; margin-bottom: 30px;">
            <div style="font-size: 32px;">🛠️</div>
            <h1 style="color: #1e293b; margin: 10px 0 5px;">TOOLZY</h1>
            <h2 style="color: #2563eb; font-size: 20px;">Réinitialisation de mot de passe</h2>
        </div>

        <!-- Message principal -->
        <p style="font-size: 16px; color: #333;">Bonjour {{ $user->prenom ?? $user->name ?? '' }},</p>

        <p style="font-size: 16px; color: #333;">
            Nous avons reçu une demande de réinitialisation de votre mot de passe.
            Cliquez sur le bouton ci-dessous pour le réinitialiser :
        </p>

        <!-- Bouton -->
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $url }}"
               style="background: #2563eb; color: white; padding: 14px 30px;
               text-decoration: none; border-radius: 6px; font-weight: bold;">
                Réinitialiser mon mot de passe
            </a>
        </div>

        <p style="font-size: 14px; color: #777;">
            Ce lien expirera dans 60 minutes.
        </p>

        <p style="font-size: 14px; color: #777;">
            Si vous n’avez pas fait cette demande, vous pouvez ignorer cet email.
        </p>

        <!-- Lien brut -->
        <hr style="margin: 40px 0; border: none; border-top: 1px solid #eee;">

        <p style="font-size: 13px; color: #999;">
            Si le bouton ne fonctionne pas, copiez et collez ce lien dans votre navigateur :
            <br>
            <a href="{{ $url }}" style="color: #2563eb;">{{ $url }}</a>
        </p>

        <!-- Footer -->
        <p style="text-align: center; font-size: 12px; color: #aaa; margin-top: 40px;">
            © {{ date('Y') }} TOOLZY. Tous droits réservés.
        </p>
    </div>
</body>
</html>
