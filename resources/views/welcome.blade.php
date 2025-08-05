@extends('layouts.welcome')

@section('content')
    <style>
        #ca-titre {
            background-color: #198754;

            color: white;
            padding: 40px 0;
            width: 100%;
            margin-bottom: 30px;
            padding-bottom: 30px;

        }

        #ca-titre h2,
        #ca-titre p {
            color: white;
            margin: 0;
        }
    </style>
    <!-- Hero Section -->
    <section id="hero" class="hero section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="hero-wrapper">
                <div class="row g-4">


                    <div class="col-lg-7">
                        <div class="hero-content" data-aos="zoom-in" data-aos-delay="200">
                            <div class="content-header">
                                <span class="hero-label">
                                    <i class="bi bi-house-heart"></i>
                                    Dream Homes Await
                                </span>
                                <h1>Trouvez le logement idéal près de votre université</h1>
                                <p>Recherchez facilement un logement étudiant parmi des annonces vérifiées. Gagnez du temps
                                    et bénéficiez de l'accompagnement de propriétaires de confiance pour une installation en
                                    toute sérénité.</p>

                            </div>
                            <div class="search-container" data-aos="fade-up" data-aos-delay="300">
                                <div class="search-header text-center mb-4">
                                    <h3>Lancez votre recherche de logement</h3>
                                    <p>Découvrez des milliers d’annonces vérifiées près des universités</p>

                                </div>

                                <div class="property-search-form">
                                    <div class="row g-3">

                                        <div class="search-field">
                                            <label for="search-location" class="field-label">Location</label>
                                            <input type="text" id="search-location" name="location" placeholder="Tapez la ville souhaitée"
>
                                            <i class="bi bi-geo-alt field-icon"></i>
                                        </div>

                                        <!-- Type de logement -->
                                        <div class="col-md-4">
                                            <div class="search-field position-relative">
                                                <label for="search-type" class="field-label">Type de logement</label>
                                                <select id="search-type" name="property_type" class="form-select">
                                                    <option value="">Tous les types</option>
                                                    <option value="house">Maison simple</option>
                                                    <option value="apartment">Appartement</option>
                                                    <option value="villa">Villa</option>
                                                    <option value="commercial">Autres</option>
                                                </select>
                                                <i
                                                    class="bi bi-building field-icon position-absolute end-0 top-50 translate-middle-y me-3"></i>
                                            </div>
                                        </div>

                                        <!-- Budget -->
                                        <div class="col-md-4">
                                            <div class="search-field position-relative">
                                                <label for="search-budget" class="field-label">Budget</label>
                                                <select id="search-budget" name="price_range" class="form-select">
                                                    <option value="">Tous les budgets</option>
                                                    <option value="5000-15000">5 000 FCFA - 15 000 FCFA</option>
                                                    <option value="15000-30000">15 000 FCFA - 30 000 FCFA</option>
                                                    <option value="30000+">Plus de 30 000 FCFA</option>
                                                </select>
                                                <i
                                                    class="bi bi-currency-dollar field-icon position-absolute end-0 top-50 translate-middle-y me-3"></i>
                                            </div>
                                        </div>

                                        <!-- Chambres -->
                                        <div class="col-md-4">
                                            <div class="search-field position-relative">
                                                <label for="search-rooms" class="field-label">Nombre de chambres</label>
                                                <select id="search-rooms" name="bedrooms" class="form-select">
                                                    <option value="">Toutes</option>
                                                    <option value="1">1 chambre</option>
                                                    <option value="2">2 chambres</option>
                                                    <option value="3">3 chambres</option>
                                                    <option value="4">4+ chambres</option>
                                                </select>
                                                <i
                                                    class="bi bi-door-open field-icon position-absolute end-0 top-50 translate-middle-y me-3"></i>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="hero-content mt-4 text-center" data-aos="zoom-in" data-aos-delay="200">
                                    <a href="{{ route('maison') }}"
                                        class="btn btn-success search-btn d-inline-flex align-items-center justify-content-center px-4 py-2">
                                        <i class="bi bi-search me-2"></i>
                                        Trouver un logement
                                    </a>
                                </div>
                            </div>


                            <div class="achievement-grid" data-aos="fade-up" data-aos-delay="400">
                                <div class="achievement-item">
                                    <div class="achievement-number">
                                        <span data-purecounter-start="0" data-purecounter-end="1250"
                                            data-purecounter-duration="1" class="purecounter"></span>+
                                    </div>
                                    <span class="achievement-text">Active Listings</span>
                                </div>
                                <div class="achievement-item">
                                    <div class="achievement-number">
                                        <span data-purecounter-start="0" data-purecounter-end="89"
                                            data-purecounter-duration="1" class="purecounter"></span>+
                                    </div>
                                    <span class="achievement-text">Expert Agents</span>
                                </div>
                                <div class="achievement-item">
                                    <div class="achievement-number">
                                        <span data-purecounter-start="0" data-purecounter-end="96"
                                            data-purecounter-duration="1" class="purecounter"></span>%
                                    </div>
                                    <span class="achievement-text">Success Rate</span>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Hero Content -->

                    <div class="col-lg-5">
                        <div class="hero-visual" data-aos="fade-left" data-aos-delay="400">
                            <div class="visual-container">
                                <div class="featured-property">
                                    <img src="{{ asset('images/image_1.webp') }}" alt="Featured Property"
                                        class="img-fluid">
                                    <div class="property-info">
                                        <div class="property-price">$925,000</div>
                                        <div class="property-details">
                                            <span><i class="bi bi-geo-alt"></i> Downtown District</span>
                                            <span><i class="bi bi-house"></i> 4 Bed, 3 Bath</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="overlay-images">
                                    <div class="overlay-img overlay-1">
                                        <img src="{{ asset('images/image_2.webp') }}" alt="Interior View"
                                            class="img-fluid">
                                    </div>
                                    <div class="overlay-img overlay-2">
                                        <img src="{{ asset('images/image_3.webp') }}" alt="Exterior View"
                                            class="img-fluid">
                                    </div>
                                </div>
                                <br>
                                <div class="agent-card">
                                    <div class="agent-profile">
                                        <img src="{{ asset('images/image_19.webp') }}" alt="House"
                                            class="agent-photo">
                                        <div class="agent-info">
                                            <h4>FASSINOU Noel</h4>
                                            <p>Conseiller immobilier senior</p>

                                            <div class="agent-rating">
                                                <div class="stars">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                </div>
                                                <span class="rating-text">5.0 (94 reviews)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="contact-agent-btn">
                                        <i class="bi bi-chat-dots"></i>
                                    </button>
                                </div>

                                <!-- le 2eme argent -->

                                <div class="agent-card">
                                    <div class="agent-profile">
                                        <img src="{{ asset('images/image_3.webp') }}" alt="House" class="agent-photo">
                                        <div class="agent-info">
                                            <h4>TOMETIN Fréjus</h4>
                                            <p>Conseiller</p>

                                            <div class="agent-rating">
                                                <div class="stars">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                </div>
                                                <span class="rating-text">5.0 (97 reviews)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="contact-agent-btn">
                                        <i class="bi bi-chat-dots"></i>
                                    </button>
                                </div>

                                <!-- le 3eme argent -->

                                <div class="agent-card">
                                    <div class="agent-profile">
                                        <img src="{{ asset('images/image_15.webp') }}" alt="House"
                                            class="agent-photo">
                                        <div class="agent-info">
                                            <h4>NADEGE Nadege</h4>
                                            <p>Conseiller</p>

                                            <div class="agent-rating">
                                                <div class="stars">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                </div>
                                                <span class="rating-text">5.0 (97 reviews)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="contact-agent-btn">
                                        <i class="bi bi-chat-dots"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Hero Visual -->

                </div>
            </div>

        </div>

    </section><!-- /Hero Section -->

    <!-- Section À Propos -->
    <section id="home-about" class="home-about section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-5">

                <div class="col-lg-5" data-aos="zoom-in" data-aos-delay="200">
                    <div class="image-gallery">
                        <div class="primary-image">
                            <img src="{{ asset('images/image_5.webp') }}" alt="Logement moderne" class="img-fluid">
                            <div class="experience-badge">
                                <div class="badge-content">
                                    <div class="number">
                                        <span data-purecounter-start="0" data-purecounter-end="2"
                                            data-purecounter-duration="1" class="purecounter"></span>+
                                    </div>
                                    <div class="text">Ans<br>d'expérience</div>
                                </div>
                            </div>
                        </div>
                        <div class="secondary-image">
                            <img src="{{ asset('images/image_2.webp') }}" alt="Intérieur moderne" class="img-fluid">
                        </div>
                    </div>
                </div>

                <div class="col-lg-7" data-aos="fade-left" data-aos-delay="300">
                    <div class="content">
                        <div class="section-header">
                            <span class="section-label">À propos de nous</span>
                            <h2>Construire des projets, créer des logements depuis 2023</h2>
                        </div>

                        <p>Depuis plus de 2 ans, nous aidons étudiants, jeunes actifs et familles à trouver le logement
                            idéal. Nous mettons à disposition des offres fiables et un accompagnement personnalisé pour vous
                            garantir une expérience sereine.</p>

                        <div class="achievements-list">
                            <div class="achievement-item">
                                <div class="achievement-icon">
                                    <i class="bi bi-house-door"></i>
                                </div>
                                <div class="achievement-content">
                                    <h4>
                                        <span data-purecounter-start="0" data-purecounter-end="250"
                                            data-purecounter-duration="2" class="purecounter"></span>+ logements trouvés
                                    </h4>
                                    <p>Des milliers de mises en relation réussies</p>
                                </div>
                            </div>
                            <div class="achievement-item">
                                <div class="achievement-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="achievement-content">
                                    <h4>
                                        <span data-purecounter-start="0" data-purecounter-end="98"
                                            data-purecounter-duration="1" class="purecounter"></span>% de satisfaction
                                    </h4>
                                    <p>Nos utilisateurs nous recommandent</p>
                                </div>
                            </div>
                        </div>

                        <div class="action-section">
                            <a href="{{ route('contact') }}" class="btn-cta">
                                <span>Nous contacter</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                            <div class="contact-info">
                                <div class="contact-icon">
                                    <i class="bi bi-telephone"></i>
                                </div>
                                <div class="contact-details">
                                    <span>Appelez-nous dès aujourd'hui</span>
                                    <strong>+229 01 94849958</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section><!-- /Section À Propos -->


    <!-- Section Services en Vedette -->
    <section id="featured-services" class="featured-services section">

        <!-- Titre de la section -->
        <div id="ca-titre" class="container-fluid section-title" data-aos="fade-up">
            <h2>Nos Services</h2>
            <p>Des solutions simples et efficaces pour trouver rapidement un logement fiable</p>
        </div>


        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row g-4">

                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="bi bi-search"></i>
                        </div>
                        <div class="service-info">
                            <h3><a href="service-details.html">Recherche rapide</a></h3>
                            <p>Trouvez en quelques clics des logements proches de votre université selon vos critères.</p>
                            <ul class="service-highlights">
                                <li><i class="bi bi-check-circle-fill"></i> Annonces vérifiées</li>
                                <li><i class="bi bi-check-circle-fill"></i> Filtres avancés</li>
                                <li><i class="bi bi-check-circle-fill"></i> Visites virtuelles</li>
                            </ul>
                            <a href="#" class="service-link">
                                <span>Explorer maintenant</span>
                                <i class="bi bi-arrow-up-right"></i>
                            </a>
                        </div>
                        <div class="service-visual">
                            <img src="{{ asset('images/image_9.webp') }}" class="img-fluid" alt="Recherche de logement"
                                loading="lazy">
                        </div>
                    </div>
                </div><!-- Fin Service 1 -->

                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="bi bi-calculator"></i>
                        </div>
                        <div class="service-info">
                            <h3><a href="service-details.html">Tarifs abordables</a></h3>
                            <p>Comparez les loyers et trouvez un logement adapté à votre budget étudiant.</p>
                            <ul class="service-highlights">
                                <li><i class="bi bi-check-circle-fill"></i> Analyse du marché</li>
                                <li><i class="bi bi-check-circle-fill"></i> Rapports comparatifs</li>
                                <li><i class="bi bi-check-circle-fill"></i> Conseils personnalisés</li>
                            </ul>
                            <a href="#" class="service-link">
                                <span>Obtenir une estimation</span>
                                <i class="bi bi-arrow-up-right"></i>
                            </a>
                        </div>
                        <div class="service-visual">
                            <img src="{{ asset('images/image_10.webp') }}" class="img-fluid" alt="Évaluation des biens"
                                loading="lazy">
                        </div>
                    </div>
                </div><!-- Fin Service 2 -->

            </div>

            <div class="row g-4 mt-4">

                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="400">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="bi bi-key"></i>
                        </div>
                        <div class="service-info">
                            <h3><a href="service-details.html">Sécurité & Confiance</a></h3>
                            <p>Propriétaires vérifiés, contrats clairs et assistance continue pour garantir votre
                                tranquillité.</p>
                            <ul class="service-highlights">
                                <li><i class="bi bi-check-circle-fill"></i> Mise en relation sécurisée</li>
                                <li><i class="bi bi-check-circle-fill"></i> Gestion des contrats</li>
                                <li><i class="bi bi-check-circle-fill"></i> Suivi des logements</li>
                            </ul>
                            <a href="{{ route('maison') }}" class="service-link">
                                <span>Commencer à louer</span>
                                <i class="bi bi-arrow-up-right"></i>
                            </a>
                        </div>
                        <div class="service-visual">
                            <img src="{{ asset('images/image_7.webp') }}" class="img-fluid" alt="Location de logement"
                                loading="lazy">
                        </div>
                    </div>
                </div><!-- Fin Service 3 -->

                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="500">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div class="service-info">
                            <h3><a href="service-details.html">Assistance rapide</a></h3>
                            <p>Notre équipe vous accompagne rapidement en cas de problème ou de question.</p>
                            <ul class="service-highlights">
                                <li><i class="bi bi-check-circle-fill"></i> Aide en ligne</li>
                                <li><i class="bi bi-check-circle-fill"></i> Suivi en temps réel</li>
                                <li><i class="bi bi-check-circle-fill"></i> Support réactif</li>
                            </ul>
                            <a href="{{ route('contact') }}" class="service-link">
                                <span>En savoir plus</span>
                                <i class="bi bi-arrow-up-right"></i>
                            </a>
                        </div>
                        <div class="service-visual">
                            <img src="{{ asset('images/image_8.webp') }}" class="img-fluid" alt="Support client"
                                loading="lazy">
                        </div>
                    </div>
                </div><!-- Fin Service 4 -->

            </div>

            <div class="text-center mt-5" data-aos="zoom-in" data-aos-delay="600">
                <a href="{{ route('service') }}" class="btn-view-all">
                    <span>Voir tous les services</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

        </div>

    </section><!-- /Section Services en Vedette -->



    <!-- Section Agents en Vedette -->
    <section id="featured-agents" class="featured-agents section">

        <!-- Titre de la section -->
        <div id="ca-titre" class="container-fluid section-title" data-aos="fade-up">
            <h2>Nos Agents Recommandés</h2>
            <p>Des experts de confiance pour vous aider à trouver le logement parfait près de votre campus</p>
        </div><!-- Fin du titre -->


        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4 justify-content-center">

                <!-- Agent 1 -->
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="featured-agent">
                        <div class="agent-wrapper">
                            <div class="agent-photo">
                                <img src="{{ asset('images/image_19.webp') }}" alt="Agent Vedette" class="img-fluid">
                                <div class="overlay-info">
                                    <div class="contact-actions">
                                        <a href="tel:+2290147877811" class="contact-btn phone" title="Appeler">
                                            <i class="bi bi-telephone-fill"></i>
                                        </a>
                                        <a href="mailto:noelfassinou53@gmail.com" class="contact-btn email"
                                            title="Envoyer un email">
                                            <i class="bi bi-envelope-fill"></i>
                                        </a>
                                    </div>
                                </div>
                                <span class="achievement-badge">Agent Star</span>
                            </div>
                            <div class="agent-details">
                                <h4>FASSINOU Noel</h4>
                                <span class="position">Conseiller Immobilier Premium</span>
                                <div class="location-info">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <span>Cadjèhoun</span>
                                </div>
                                <div class="expertise-tags">
                                    <span class="tag">Logements étudiants</span>
                                    <span class="tag">Studios & Apparts</span>
                                </div>
                                <a href="{{ route('agent') }}" class="view-profile">Voir le profil</a>
                            </div>
                        </div>
                    </div>
                </div><!-- Fin Agent 1 -->

                <!-- Agent 2 -->
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="featured-agent">
                        <div class="agent-wrapper">
                            <div class="agent-photo">
                                <img src="{{ asset('images/image_12.webp') }}" alt="Agent Vedette" class="img-fluid">
                                <div class="overlay-info">
                                    <div class="contact-actions">
                                        <a href="tel:+2290194849958" class="contact-btn phone" title="Appeler">
                                            <i class="bi bi-telephone-fill"></i>
                                        </a>
                                        <a href="mailto:agoliganange15@gmail.com" class="contact-btn email"
                                            title="Envoyer un email">
                                            <i class="bi bi-envelope-fill"></i>
                                        </a>
                                    </div>
                                </div>
                                <span class="achievement-badge expert">Expert</span>
                            </div>
                            <div class="agent-details">
                                <h4>AGOLIGAN Ange</h4>
                                <span class="position">Spécialiste Immobilier Commercial</span>
                                <div class="location-info">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <span>Cotonou</span>
                                </div>
                                <div class="expertise-tags">
                                    <span class="tag">Bureaux</span>
                                    <span class="tag">Espaces Commerciaux</span>
                                </div>
                                <a href="{{ route('agent') }}" class="view-profile">Voir le profil</a>
                            </div>
                        </div>
                    </div>
                </div><!-- Fin Agent 2 -->

                <!-- Agent 3 -->
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                    <div class="featured-agent">
                        <div class="agent-wrapper">
                            <div class="agent-photo">
                                <img src="assets/img/real-estate/agent-5.webp" alt="Agent Vedette" class="img-fluid">
                                <div class="overlay-info">
                                    <div class="contact-actions">
                                        <a href="tel:+2290194849958" class="contact-btn phone" title="Appeler">
                                            <i class="bi bi-telephone-fill"></i>
                                        </a>
                                        <a href="mailto:agoliganange15@gmail.com" class="contact-btn email"
                                            title="Envoyer un email">
                                            <i class="bi bi-envelope-fill"></i>
                                        </a>
                                    </div>
                                </div>
                                <span class="achievement-badge rising">Étoile montante</span>
                            </div>
                            <div class="agent-details">
                                <h4>Sophia Rivera</h4>
                                <span class="position">Spécialiste primo-accédants</span>
                                <div class="location-info">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <span>Porto-Novo</span>
                                </div>
                                <div class="expertise-tags">
                                    <span class="tag">Studios</span>
                                    <span class="tag">Résidences partagées</span>
                                </div>
                                <a href="agent-profile.html" class="view-profile">Voir le profil</a>
                            </div>
                        </div>
                    </div>
                </div><!-- Fin Agent 3 -->

                <!-- Agent 4 -->
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                    <div class="featured-agent">
                        <div class="agent-wrapper">
                            <div class="agent-photo">
                                <img src="assets/img/real-estate/agent-9.webp" alt="Agent Vedette" class="img-fluid">
                                <div class="overlay-info">
                                    <div class="contact-actions">
                                        <a href="tel:+22996321456" class="contact-btn phone" title="Appeler">
                                            <i class="bi bi-telephone-fill"></i>
                                        </a>
                                        <a href="mailto:daniel.morrison@example.com" class="contact-btn email"
                                            title="Envoyer un email">
                                            <i class="bi bi-envelope-fill"></i>
                                        </a>
                                    </div>
                                </div>
                                <span class="achievement-badge veteran">Expérimenté</span>
                            </div>
                            <div class="agent-details">
                                <h4>Daniel Morrison</h4>
                                <span class="position">Conseiller en investissement locatif</span>
                                <div class="location-info">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <span>Abomey-Calavi</span>
                                </div>
                                <div class="expertise-tags">
                                    <span class="tag">Immeubles collectifs</span>
                                    <span class="tag">Investissements étudiants</span>
                                </div>
                                <a href="agent-profile.html" class="view-profile">Voir le profil</a>
                            </div>
                        </div>
                    </div>
                </div><!-- Fin Agent 4 -->

            </div>

            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="500">
                <a href="{{ route('agent') }}" class="discover-all-agents">
                    <span>Voir tous les agents</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

        </div>

    </section><!-- /Section Agents en Vedette -->


    <!-- Section Appel à l'action -->
    <section class="call-to-action-1 call-to-action section" id="call-to-action">
        <div class="cta-bg" style="background-image: url('{{ asset('images/image_3.webp') }}');"></div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">

                    <div class="cta-content text-center">
                        <h2>Besoin d’aide pour trouver votre logement idéal ?</h2>
                        <p>Notre équipe est là pour vous accompagner à chaque étape. Trouvez facilement un logement
                            sécurisé, proche de votre université et adapté à votre budget.</p>

                        <div class="cta-buttons">
                            <a href="{{ route('agent') }}" class="btn btn-primary">Contactez un agent</a>
                            <a href="{{ route('contact') }}" class="btn btn-outline">Planifier un appel</a>
                        </div>

                        <div class="cta-features">
                            <div class="feature-item" data-aos="fade-up" data-aos-delay="200">
                                <i class="bi bi-telephone-fill"></i>
                                <span>Conseils gratuits</span>
                            </div>
                            <div class="feature-item" data-aos="fade-up" data-aos-delay="250">
                                <i class="bi bi-clock-fill"></i>
                                <span>Assistance 24h/24</span>
                            </div>
                            <div class="feature-item" data-aos="fade-up" data-aos-delay="300">
                                <i class="bi bi-shield-check-fill"></i>
                                <span>Experts vérifiés</span>
                            </div>
                        </div>

                    </div><!-- Fin du contenu CTA -->

                </div>
            </div>

        </div>
    </section><!-- /Fin section Appel à l'action -->


    <br><br>
@endsection
