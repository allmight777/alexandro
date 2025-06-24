<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Bon de matériel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @page {
            margin: 20px 25px;
            size: A4;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
            line-height: 1.3;
            color: #2c3e50;
            background: #f8f9fa;
            margin: 0;
            padding: 15px;
        }

        .document-container {
            max-width: 210mm;
            margin: 0 auto;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            min-height: 270mm;
        }

        /* Filigrane en arrière-plan - Version améliorée */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80px;
            font-weight: 100;
            color: #e9ecef;
            z-index: 1;
            letter-spacing: 8px;
            white-space: nowrap;
            user-select: none;
            pointer-events: none;
        }

        /* Logo en en-tête */
        .logo-watermark {
            position: absolute;
            top: 30px;
            right: 30px;
            width: 120px;
            height: 120px;
            opacity: 0.08;
            z-index: 1;
        }

        .content {
            position: relative;
            z-index: 2;
            padding: 25px;
            height: calc(270mm - 50px);
            display: flex;
            flex-direction: column;
        }

        /* En-tête avec bordure élégante */
        .header-section {
            border: 2px solid #2c3e50;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            flex-shrink: 0;
            position: relative;
        }

        .header-logo {
            position: absolute;
            top: 15px;
            left: 20px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 24px;
        }

        .reference-number {
            text-align: right;
            font-weight: bold;
            font-size: 10px;
            color: #6c757d;
            margin-bottom: 10px;
            font-family: 'Courier New', monospace;
        }

        .document-title {
            text-align: center;
            margin-bottom: 10px;
            margin-left: 70px;
        }

        .document-title h1 {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .company-name {
            text-align: center;
            font-size: 14px;
            color: #495057;
            font-weight: 600;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 8px;
            margin-left: 70px;
        }

        /* Sections d'informations */
        .info-section {
            background: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 15px;
            margin: 15px 0;
            border-radius: 0 6px 6px 0;
            flex-shrink: 0;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
            padding: 6px 0;
            border-bottom: 1px dotted #dee2e6;
        }

        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .info-label {
            font-weight: bold;
            color: #495057;
            min-width: 130px;
            font-size: 11px;
        }

        .info-value {
            flex: 1;
            text-align: left;
            padding-left: 15px;
            font-size: 12px;
        }

        .info-input {
            border-bottom: 1px solid #6c757d;
            min-width: 180px;
            padding: 2px 5px;
            background: transparent;
        }

        /* Section matériel */
        .material-section {
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            flex-shrink: 0;
        }

        .material-section h3 {
            margin-top: 0;
            margin-bottom: 10px;
            color: #2c3e50;
            font-size: 16px;
            display: flex;
            align-items: center;
        }

        .material-section h3::before {
            margin-right: 8px;
            font-size: 18px;
        }

        .material-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .material-table th {
            background-color: #2c3e50;
            color: white;
            padding: 12px 10px;
            text-align: left;
            font-weight: bold;
            font-size: 12px;
        }

        .material-table td {
            padding: 10px;
            border-bottom: 1px solid #dee2e6;
            font-size: 11px;
        }

        .material-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .material-table tr:hover {
            background-color: #e3f2fd;
        }

        /* Section signatures */
        .signatures-section {
            margin-top: auto;
            padding: 20px;
            border: 2px solid #2c3e50;
            border-radius: 6px;
            flex-shrink: 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        }

        .signatures-section h3 {
            margin-top: 0;
            margin-bottom: 15px;
            color: #2c3e50;
            text-align: center;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .signatures-section h3::before {
            margin-right: 8px;
            font-size: 18px;
        }

        .signatures-grid {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .signature-box {
            flex: 1;
            text-align: center;
            padding: 20px;
            border: 1px solid #007bff;
            border-radius: 8px;
            background: white;
            box-shadow: 0 2px 4px rgba(0,123,255,0.1);
        }

        .signature-title {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 12px;
            padding: 5px 10px;
            background: #e3f2fd;
            border-radius: 4px;
        }

        .signature-line {
            border-bottom: 2px solid #007bff;
            width: 120px;
            margin: 15px auto;
            height: 20px;
        }

        .signature-field {
            margin: 8px 0;
            font-size: 10px;
            color: #6c757d;
        }

        /* Pied de page */
        .footer {
            position: absolute;
            bottom: 15px;
            left: 25px;
            right: 25px;
            text-align: center;
            font-size: 9px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
            padding-top: 8px;
            background: white;
            z-index: 3;
        }

        .footer-line {
            margin: 2px 0;
        }

        /* Badge de statut */
        .status-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: #28a745;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
            z-index: 3;
        }

        /* Responsive pour impression */
        @media print {
            body {
                background: white;
                padding: 0;
            }

            .document-container {
                box-shadow: none;
                max-width: none;
            }

            .watermark {
                opacity: 0.03;
            }

            .logo-watermark {
                opacity: 0.05;
            }

            @page {
                margin: 15mm 20mm;
            }
        }
    </style>
</head>

<body>
    <div class="document-container">
        <!-- Badge de statut -->
        <div class="status-badge">OFFICIEL</div>

        <!-- Filigrane texte -->
        <div class="watermark">JASPE TECHNOLOGIES</div>

        <!-- Logo en arrière-plan -->
        <div class="logo-watermark">
            <svg viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="60" cy="60" r="50" fill="#007bff" opacity="0.1"/>
                <text x="60" y="75" text-anchor="middle" fill="#007bff" font-size="48" font-family="Arial Black" font-weight="900" opacity="0.3">J</text>
                <circle cx="60" cy="60" r="45" stroke="#007bff" stroke-width="2" fill="none" opacity="0.2"/>
            </svg>
        </div>

        <div class="content">
            <!-- Numéro de référence -->
            <div class="reference-number">
                Référence : MG-20250624-{{$numero_bon}}
            </div>

            <!-- En-tête -->
            <div class="header-section">
                <div class="header-logo">
                     <img src="{{ public_path('images/jaspe_logo_noir_web.png') }}" alt="" width="50" height="50">
                </div>
                <div class="document-title">
                    <h1>Bon de Matériel</h1>
                </div>
                <div class="company-name">
                    JASPE TECHNOLOGIES
                </div>
            </div>

            <!-- Informations du bon -->
            <div class="info-section">
                <div class="info-row">
                    <span class="info-label">Numéro du bon :</span>
                    <span class="info-value info-input">BM-2025-{{$numero_bon}}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Date d'émission :</span>
                    <span class="info-value info-input">{{$date}}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nom et Prénom :</span>
                    <span class="info-value info-input">{{$nom}} {{$prenom}}</span>
                </div>
            </div>

            <!-- Section matériel -->
            <div class="material-section">
                <h3>Matériel concerné</h3>
                <table class="material-table">
                    <thead>
                        <tr>
                            <th style="width: 70%;">Désignation</th>
                            <th style="width: 30%;">Quantité</th>
                        </tr>
                    </thead>
                    <tbody>
                          @foreach ($equipements as $eq)
                            <tr>
                                <td>{{ $eq['nom'] }}</td>
                                <td>{{ $eq['quantite'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Motif -->
            <div class="info-section">
                <div class="info-row">
                    <span class="info-label">Motif :</span>
                    <span class="info-value info-input">{{$motif}}</span>
                </div>
            </div>

            <!-- Signatures -->
            <div class="signatures-section">
                <h3>Signatures et Validation</h3>
                <div class="signatures-grid">
                    <div class="signature-box">
                        <div class="signature-title">Responsable IT</div>
                        <div class="signature-line"></div>
                        <div class="signature-field">Nom : _________________</div>
                        <div class="signature-field">Date : ___/___/______</div>
                    </div>
                    <div class="signature-box">
                        <div class="signature-title">Bénéficiaire</div>
                        <div class="signature-line"></div>
                        <div class="signature-field">Nom : _________________</div>
                        <div class="signature-field">Date : ___/___/______</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pied de page -->
        <div class="footer">
            <div class="footer-line"><strong>JASPE TECHNOLOGIES</strong> - Système de gestion de matériel informatique</div>
            <div class="footer-line">Tél : +229 XX XX XX XX • Email : contact@jaspe-techno.com</div>
            <div class="footer-line">Document généré le {{$date}} • Confidentiel</div>
        </div>
    </div>
</body>
</html>