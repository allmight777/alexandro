<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toolzy | Connexion - Jaspe Technologie</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --secondary: #1e40af;
            --accent: #f59e0b;
            --dark: #1e293b;
        }

        body {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Styles de la navbar */
        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--dark) !important;
            font-size: 1.5rem;
        }

        .nav-link {
            font-weight: 500;
            color: var(--dark) !important;
            transition: all 0.3s;
        }

        .nav-link:hover {
            color: var(--primary) !important;
        }

        /* Styles du formulaire */
        .login-container {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 40px 0;
        }

        .auth-form {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
        }

        .form-brand {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-title {
            color: var(--dark);
            font-weight: 600;
            margin-bottom: 10px;
        }

        .form-subtitle {
            color: #6c757d;
            font-weight: 400;
            margin-bottom: 30px;
        }

        .form-control {
            height: 50px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .btn-login {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 8px;
            height: 50px;
            font-weight: 500;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .btn-login:hover {
            background: linear-gradient(to right, var(--secondary), var(--primary));
            color: white;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
        }

        /* Styles du footer */
        footer {
            background: var(--dark);
            color: rgba(255, 255, 255, 0.8);
            padding: 40px 0 20px;
        }

        footer h5 {
            color: white;
            margin-bottom: 20px;
            font-size: 1.1rem;
        }

        footer a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s;
        }

        footer a:hover {
            color: white;
            text-decoration: underline;
        }

        .footer-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin: 30px 0 20px;
        }

        .social-icons a {
            display: inline-block;
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            text-align: center;
            line-height: 36px;
            margin-right: 10px;
            transition: all 0.3s;
        }

        .social-icons a:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }
    </style>
</head>

<body>
    <!-- Barre de navigation identique à la page d'accueil -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <i class="fas fa-tools me-2 text-primary"></i>
                <span>TOOLZY</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">Accueil</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#features">Fonctionnalités</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#benefits">Avantages</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item nav-btn">
                        <a href="{{ route('login') }}" class="btn btn-primary px-4">
                            <i class="fas fa-sign-in-alt me-2"></i>Connexion
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Section de connexion -->
    <div class="container login-container">
        <div class="row justify-content-center w-100">
            <div class="col-md-6 col-lg-5">
                <div class="auth-form">
                    <div class="form-brand">
                        <i class="fas fa-tools fa-3x me-2 text-primary"></i>
                        <h2 style="font-weight: 700; color: var(--dark); margin-top: 15px;">TOOLZY</h2>
                    </div>

                    <h3 class="form-title">Bienvenue !</h3>
                    <p class="form-subtitle">Connectez-vous pour accéder à votre espace</p>

                    <form method="POST" action="{{ route('Postlogin') }}">
                        @method('POST')
                        @csrf

                        <div class="form-group">
                            <input type="email" class="form-control form-control-lg" id="emailInput" name="email"
                                placeholder="Email ou nom d'utilisateur" required>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control form-control-lg" id="passwordInput"
                                name="password" placeholder="Mot de passe" required>
                        </div>

                        <button type="submit" class="btn btn-login">
                            CONNEXION
                        </button>

                        <!-- Ligne modifiée pour l'alignement -->
                        <div class="form-options d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <a href="{{ route('password.request') }}" class="text-primary">Mot de passe oublié ?</a>
                            </div>
                            <div>
                                <span>Pas encore de compte ? </span>
                                <a href="{{ route('register') }}" class="text-primary">Créer un compte</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Pied de page -->
    <footer id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="mb-4">
                        <i class="fas fa-tools me-2"></i>TOOLZY
                    </h5>
                    <p class="mb-4">
                        Solution de gestion de matériel pour Jaspe Technologie<br>
                        Optimisation • Traçabilité • Productivité
                    </p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-github"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5>Navigation</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#">Accueil</a></li>
                        <li class="mb-2"><a href="#features">Fonctionnalités</a></li>
                        <li class="mb-2"><a href="#benefits">Avantages</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>

                <div class="col-lg-4">
                    <h5>Contact</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            Calavi, Bidossesi
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-phone me-2"></i>
                            +229 47332880
                        </li>
                        <li>
                            <i class="fas fa-envelope me-2"></i>
                            support@toolzy.bj
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-divider"></div>

            <div class="text-center">
                <p class="mb-0">&copy; 2024 Toolzy - Jaspe Technologie. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
