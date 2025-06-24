<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Identifiants de connexion</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .email-header {
            background-color: #0d6efd;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .email-header i {
            font-size: 24px;
            margin-right: 8px;
        }

        .email-body {
            padding: 30px;
        }

        .email-body h2 {
            margin-top: 0;
            color: #333333;
        }

        .email-body p {
            color: #555;
            line-height: 1.6;
        }

        .credentials {
            background-color: #f1f1f1;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
        }

        .credentials li {
            margin-bottom: 8px;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #999;
            padding: 20px;
        }
    </style>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <i class="fas fa-tools"></i> <strong>TOOLZY</strong>
        </div>

        <div class="email-body">
            <h2>Bienvenue {{ $user->prenom }} {{ $user->nom }},</h2>

            <p>Un compte a été créé pour vous sur la plateforme <strong>TOOLZY</strong>.</p>

            <p>Voici vos identifiants de connexion :</p>

            <div class="credentials">
                <ul>
                    <li><strong>Email :</strong> {{ $user->email }}</li>
                    <li><strong>Mot de passe :</strong> {{ $password }}</li>
                </ul>
            </div>

            <p>Merci de vous connecter dès que possible.</p>

            <p>Cordialement,<br>L'équipe TOOLZY</p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} TOOLZY. Tous droits réservés.
        </div>
    </div>
</body>
</html>
