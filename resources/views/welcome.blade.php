<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toolzy | Gestion de Matériel - Jaspe Technologie</title>
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
        
        .hero-section {
            background: linear-gradient(135deg, var(--dark) 0%, var(--secondary) 100%);
            padding: 100px 0;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.1) 0%, transparent 70%);
            z-index: 0;
        }
        
        .feature-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 15px;
            overflow: hidden;
            height: 100%;
            border: none;
            background: #fff;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        
        .icon-container {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(37, 99, 235, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        
        .stats-badge {
            background: rgba(236, 240, 241, 0.9);
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .cta-section {
            background: linear-gradient(to right, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        
        footer {
            background: var(--dark);
            color: rgba(255,255,255,0.8);
        }
        
        .btn-primary {
            background: var(--primary);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            font-size: 1.1rem;
        }
        
        .btn-primary:hover {
            background: var(--secondary);
            transform: translateY(-3px);
            box-shadow: 0 7px 14px rgba(37, 99, 235, 0.3);
        }
        
        .btn-accent {
            background: var(--accent);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            font-size: 1.1rem;
            color: white;
        }
        
        .btn-accent:hover {
            background: #e69008;
            transform: translateY(-3px);
            box-shadow: 0 7px 14px rgba(245, 158, 11, 0.3);
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--dark) !important;
            font-size: 1.5rem;
        }
        
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 0;
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--dark) !important;
            transition: all 0.3s;
        }
        
        .nav-link:hover {
            color: var(--primary) !important;
        }
        
        .hero-illustration {
            position: relative;
            z-index: 2;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
            border: 8px solid rgba(255,255,255,0.1);
            transition: transform 0.5s ease;
        }
        
        .hero-illustration:hover {
            transform: translateY(-5px);
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .feature-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background: var(--accent);
            color: white;
            border-radius: 50px;
            padding: 5px 15px;
            font-weight: 600;
            font-size: 0.8rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        /* Correction pour l'alignement des fonctionnalités */
        .feature-list {
            text-align: left;
            padding-left: 0;
        }
        
        .feature-list li {
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
            text-align: left;
        }
        
        .feature-list i {
            margin-right: 10px;
            min-width: 20px;
            margin-top: 4px;
        }
        
        .feature-content {
            text-align: left;
        }
        
        .feature-card h4 {
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* CORRECTION DU BOUTON DE CONNEXION */
        .navbar-nav .nav-item {
            display: flex;
            align-items: center;
        }
        
        .nav-btn {
            margin-left: 10px;
        }
        
        /* Nouveaux styles */
        .dashboard-overlay {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 200px;
            height: 120px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            z-index: 3;
            transform: rotate(5deg);
        }
        
        .dashboard-overlay h6 {
            font-size: 0.8rem;
            margin: 0;
            color: var(--dark);
            font-weight: 600;
        }
        
        .dashboard-overlay .stats {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
        
        .dashboard-overlay .stat-item {
            text-align: center;
            font-size: 0.7rem;
        }
        
        .dashboard-overlay .stat-value {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--primary);
        }
        
        .inventory-tag {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background: white;
            padding: 8px 15px;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            z-index: 3;
            transform: rotate(-3deg);
        }
        
        .inventory-tag i {
            color: var(--accent);
            margin-right: 5px;
        }
        
        .benefits-section {
            background: #f8f9fa;
            padding: 80px 0;
        }
        
        .benefit-item {
            display: flex;
            margin-bottom: 30px;
            align-items: flex-start;
        }
        
        .benefit-icon {
            background: var(--primary);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            flex-shrink: 0;
        }
        
        .benefit-content h4 {
            margin-top: 0;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <!-- Barre de navigation avec correction -->
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
                        <a class="nav-link active" href="#">Accueil</a>
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
                        <a href="{{route('login')}}" class="btn btn-primary px-4">
                            <i class="fas fa-sign-in-alt me-2"></i>Connexion
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Section Hero avec nouvelle image significative -->
    <section class="hero-section">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="display-4 fw-bold mb-4">Optimisez votre parc <br>matériel avec <span class="text-warning">TOOLZY</span></h1>
                    <p class="lead mb-5">La solution complète pour une gestion efficace et traçable de votre inventaire professionnel</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="" class="btn btn-accent btn-lg px-5 py-3 pulse-animation">
                            <i class="fas fa-play-circle me-2"></i>Commencer
                        </a>
                    </div>
                    <div class="mt-5 d-flex flex-wrap gap-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-white p-2 rounded-circle me-3">
                                <i class="fas fa-check-circle text-success fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">+95%</h5>
                                <p class="mb-0 text-white-50">Efficacité accrue</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="bg-white p-2 rounded-circle me-3">
                                <i class="fas fa-clock text-primary fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">-70%</h5>
                                <p class="mb-0 text-white-50">Temps de gestion</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="position-relative">
                        <!-- Nouvelle image significative pour la gestion de matériel -->
                        <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=600&q=80" alt="Gestion de matériel professionnelle" class="img-fluid hero-illustration">
                        
                        
                        <span class="stats-badge position-absolute top-0 start-0 m-3">
                            <i class="fas fa-laptop me-2 text-success"></i>+245 matériels
                        </span>
                        <span class="stats-badge position-absolute bottom-0 end-0 m-3">
                            <i class="fas fa-users me-2 text-primary"></i>37 utilisateurs
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Avantages -->
    <section id="benefits" class="benefits-section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-3">Pourquoi choisir TOOLZY ?</h2>
                    <p class="text-muted">Découvrez les avantages de notre solution pour votre entreprise</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-chart-line fa-lg"></i>
                        </div>
                        <div class="benefit-content">
                            <h4>Optimisation des coûts</h4>
                            <p>Réduisez les pertes matérielles et les achats inutiles grâce à une gestion précise de votre inventaire.</p>
                        </div>
                    </div>
                    
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-search fa-lg"></i>
                        </div>
                        <div class="benefit-content">
                            <h4>Traçabilité complète</h4>
                            <p>Suivez chaque matériel de son acquisition à sa maintenance, avec un historique complet.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-clock fa-lg"></i>
                        </div>
                        <div class="benefit-content">
                            <h4>Gain de temps</h4>
                            <p>Automatisez vos processus de gestion et gagnez plusieurs heures par semaine.</p>
                        </div>
                    </div>
                    
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-shield-alt fa-lg"></i>
                        </div>
                        <div class="benefit-content">
                            <h4>Sécurité des données</h4>
                            <p>Protégez vos informations avec des sauvegardes automatiques et un système de sécurité avancé.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Fonctionnalités -->
    <section id="features" class="py-6 bg-white">
        <div class="container">
            <div class="row justify-content-center mb-6">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-3">Fonctionnalités Clés</h2>
                    <p class="text-muted">Découvrez comment Toolzy optimise votre gestion de matériel</p>
                </div>
            </div>
            
            <div class="row g-4">
                <!-- Gestionnaire -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card card p-4 h-100 position-relative">
                        <span class="feature-badge">Gestionnaire</span>
                        <div class="icon-container">
                            <i class="fas fa-cogs fa-2x text-primary"></i>
                        </div>
                        <h4 class="text-center mb-3">Gestion Complète</h4>
                        <div class="feature-content">
                            <ul class="feature-list">
                                <li>
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span>Ajout/modification de matériel</span>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span>Gestion des demandes</span>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span>Génération de bons</span>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span>Suivi des maintenances</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Administrateur -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card card p-4 h-100 position-relative">
                        <span class="feature-badge">Administrateur</span>
                        <div class="icon-container">
                            <i class="fas fa-user-shield fa-2x text-primary"></i>
                        </div>
                        <h4 class="text-center mb-3">Gestion Utilisateurs</h4>
                        <div class="feature-content">
                            <ul class="feature-list">
                                <li>
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span>Création de comptes</span>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span>Gestion des droits</span>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span>Suivi des activités</span>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span>Rapports personnalisés</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Employé -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card card p-4 h-100 position-relative">
                        <span class="feature-badge">Employé</span>
                        <div class="icon-container">
                            <i class="fas fa-user-tie fa-2x text-primary"></i>
                        </div>
                        <h4 class="text-center mb-3">Espace Personnel</h4>
                        <div class="feature-content">
                            <ul class="feature-list">
                                <li>
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span>Demandes de matériel</span>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span>Suivi des affectations</span>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span>Signalement de pannes</span>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span>Historique des emprunts</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section CTA -->
   
    
    <!-- Pied de page -->
    <footer id="contact" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="mb-4 text-white">
                        <i class="fas fa-tools me-2"></i>TOOLZY
                    </h5>
                    <p class="mb-4">
                        Solution de gestion de matériel pour Jaspe Technologie<br>
                        Optimisation • Traçabilité • Productivité
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin-in fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-github fa-lg"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="text-white mb-4">Navigation</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50">Accueil</a></li>
                        <li class="mb-2"><a href="#features" class="text-white-50">Fonctionnalités</a></li>
                        <li class="mb-2"><a href="#benefits" class="text-white-50">Avantages</a></li>
                        <li><a href="#contact" class="text-white-50">Contact</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-4">
                    <h5 class="text-white mb-4">Contact</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                            <span class="text-white-50"> Calavi, Bidossesi</span>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-phone me-2 text-primary"></i>
                            <span class="text-white-50">+229 47332880</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope me-2 text-primary"></i>
                            <span class="text-white-50">support@toolzy.bj</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <hr class="my-5 bg-light">
            
            <div class="text-center text-white-50">
                <p class="mb-0">&copy; 2024 Toolzy - Jaspe Technologie. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animation pour les badges
        document.addEventListener('DOMContentLoaded', function() {
            const badges = document.querySelectorAll('.stats-badge, .feature-badge');
            badges.forEach(badge => {
                badge.style.transform = 'scale(0.9)';
                setTimeout(() => {
                    badge.style.transition = 'transform 0.5s ease';
                    badge.style.transform = 'scale(1)';
                }, 300);
            });
            
            // Animation pour les cartes de fonctionnalités
            const featureCards = document.querySelectorAll('.feature-card');
            featureCards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    card.style.transition = 'all 0.5s ease';
                    
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 100);
                }, index * 100);
            });
        });
    </script>
</body>
</html>