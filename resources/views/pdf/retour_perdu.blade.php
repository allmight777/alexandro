<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retour de Matériel - Déclaration de Perte</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .document-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 2px solid #dee2e6;
            max-width: 800px;
            margin: 2rem auto;
            overflow: hidden;
        }
        
        .header-section {
            background-color: #2c3e50;
            color: white;
            padding: 2rem 2.5rem;
            text-align: center;
            margin: 0;
        }
        
        .logo-container {
            margin-bottom: 1.5rem;
        }
        
        .logo-placeholder {
            width: 120px;
            height: 80px;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-weight: bold;
            color: #2c3e50;
            font-size: 14px;
        }
        
        .header-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .content-section {
            padding: 2.5rem;
        }
        
        .info-card {
            background: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-radius: 0 8px 8px 0;
        }
        
        .info-item {
            margin-bottom: 1rem;
            padding: 0.75rem;
            background: white;
            border-radius: 6px;
            border: 1px solid #e9ecef;
        }
        
        .info-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.25rem;
        }
        
        .info-value {
            color: #212529;
            font-size: 1.1rem;
        }
        
        .description-section {
            background: #e3f2fd;
            border: 1px solid #2196f3;
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 1.5rem;
        }
        
        .description-title {
            color: #1976d2;
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }
        
        .stamp-area {
            border: 2px dashed #6c757d;
            padding: 2rem;
            text-align: center;
            margin-top: 2rem;
            border-radius: 8px;
            background: #fafafa;
        }
        
        .print-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
        
        @media print {
            .print-button { display: none; }
            .document-container { 
                box-shadow: none; 
                margin: 0;
                max-width: none;
            }
            body { background: white; }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="document-container">
            <!-- En-tête -->
            <div class="header-section">
                <div class="logo-container">
                    <!-- Logo placeholder - remplacez par votre vraie image -->
                    <img src="{{ public_path('images/jaspe_logo_noir_web.png') }}" alt="Jaspe Technologie" style="max-width: 140px; filter: brightness(0) invert(1);">
                </div>
                <h1 class="header-title">Retour de Matériel</h1>
                <p class="mb-0 fs-5">Déclaration de Perte</p>
            </div>

            <!-- Contenu principal -->
            <div class="content-section">
                <div class="info-card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">Date :</div>
                                <div class="info-value">{{ $date }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">Employé :</div>
                                <div class="info-value">{{ $nom }} {{ $prenom }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Matériel concerné :</div>
                        <div class="info-value">{{ $equipement }}</div>
                    </div>
                </div>

                <div class="description-section">
                    <div class="description-title">
                        <i class="fas fa-info-circle me-2"></i>Description
                    </div>
                    <p class="mb-0">
                        Ce document atteste que le matériel mentionné ci-dessus, initialement déclaré comme 
                        <span class="badge bg-warning text-dark">PERDU</span>, a été retourné en date du 
                        <strong>{{ $date }}</strong>.
                    </p>
                </div>

                <div class="stamp-area">
                    <p class="text-muted mb-0">Cachet et signature de l'entreprise</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bouton d'impression -->
    <button class="btn btn-primary btn-lg print-button" onclick="window.print()">
        <i class="fas fa-print me-2"></i>Imprimer
    </button>

    <!-- Bootstrap JS et Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</body>
</html>