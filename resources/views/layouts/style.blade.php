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
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
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
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .cta-section {
        background: linear-gradient(to right, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    footer {
        background: var(--dark);
        color: rgba(255, 255, 255, 0.8);
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
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        border: 8px solid rgba(255, 255, 255, 0.1);
        transition: transform 0.5s ease;
    }

    .hero-illustration:hover {
        transform: translateY(-5px);
    }

    .pulse-animation {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
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
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
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
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
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
