<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Bon de matériel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @page {
            margin: 40px 30px;
            size: A4;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 13px;
            line-height: 1.4;
            color: #2c3e50;
            background: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .document-container {
            max-width: 210mm;
            margin: 0 auto;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        /* Filigrane en arrière-plan */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 350px;
            height: 200px;
            opacity: 0.04;
            z-index: 1;
            background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAwIiBoZWlnaHQ9IjMwMCIgdmlld0JveD0iMCAwIDUwMCAzMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxwYXRoIGQ9Ik0xMDAgMjUwQzEwMCAyNTAgNTAgMjAwIDgwIDEwMEMxMTAgMjAgMTgwIDEwIDI0MCA1MEM0MjAgMjAgNDMwIDEwMCA0MjAgMTUwQzQxMCAyMDAgMzgwIDI0MCAzMDAgMjUwQzIyMCAyNjAgMTUwIDI2MCAxMDAgMjUwWiIgZmlsbD0iIzI4YTc0NSIvPgo8Y2lyY2xlIGN4PSIxODAiIGN5PSI0MCIgcj0iOCIgZmlsbD0iIzI4YTc0NSIvPgo8Y2lyY2xlIGN4PSIyMDAiIGN5PSI4MCIgcj0iNiIgZmlsbD0iIzI4YTc0NSIvPgo8Y2lyY2xlIGN4PSIyMjAiIGN5PSI2MCIgcj0iNSIgZmlsbD0iIzI4YTc0NSIvPgo8cGF0aCBkPSJNMTgwIDUwTDE4MCAyMDBNMTgwIDIwMEwyMTAgMTkwTTE4MCAyMDBMMTYwIDE4ME0xODAgMjAwTDE2MCAyMTBNMTgwIDIwMEwxNDAgMjIwIiBzdHJva2U9IndoaXRlIiBzdHJva2Utd2lkdGg9IjQiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIvPgo8Y2lyY2xlIGN4PSIxNDAiIGN5PSIyMjAiIHI9IjQiIGZpbGw9IndoaXRlIi8+CjxjaXJjbGUgY3g9IjE2MCIgY3k9IjE4MCIgcj0iNCIgZmlsbD0id2hpdGUiLz4KPGNpcmNsZSBjeD0iMTYwIiBjeT0iMjEwIiByPSI0IiBmaWxsPSJ3aGl0ZSIvPgo8Y2lyY2xlIGN4PSIyMTAiIGN5PSIxOTAiIHI9IjQiIGZpbGw9IndoaXRlIi8+Cjx0ZXh0IHg9IjI2MCIgeT0iMTYwIiBmaWxsPSIjMjhhNzQ1IiBmb250LXNpemU9IjM2IiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSJib2xkIj5KQVNQRSI8L3RleHQ+Cjx0ZXh0IHg9IjI2MCIgeT0iMTkwIiBmaWxsPSIjMjhhNzQ1IiBmb250LXNpemU9IjE4IiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiPlRFQ0hOT0xPR0lFPC90ZXh0Pgo8L3N2Zz4K') center/contain no-repeat;
        }

        .content {
            position: relative;
            z-index: 2;
            padding: 40px;
            min-height: 297mm;
        }

        /* En-tête avec bordure élégante */
        .header-section {
            border: 2px solid #2c3e50;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .reference-number {
            text-align: right;
            font-weight: bold;
            font-size: 11px;
            color: #6c757d;
            margin-bottom: 15px;
            font-family: 'Courier New', monospace;
        }

        .document-title {
            text-align: center;
            margin-bottom: 15px;
        }

        .document-title h1 {
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .company-name {
            text-align: center;
            font-size: 16px;
            color: #495057;
            font-weight: 600;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 10px;
        }

        /* Sections d'informations */
        .info-section {
            background: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            padding: 8px 0;
            border-bottom: 1px dotted #dee2e6;
        }

        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .info-label {
            font-weight: bold;
            color: #495057;
            min-width: 150px;
        }

        .info-value {
            flex: 1;
            text-align: left;
            padding-left: 20px;
            font-size: 14px;
        }

        .info-input {
            border-bottom: 1px solid #6c757d;
            min-width: 200px;
            padding: 2px 5px;
            background: transparent;
        }

        /* Section matériel */
        .material-section {
            margin: 30px 0;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
        }

        .material-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .material-table th {
            background-color: #2c3e50;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: bold;
        }

        .material-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #dee2e6;
        }

        .material-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        /* Section signatures */
        .signatures-section {
            margin-top: 50px;
            padding: 20px;
            border: 2px solid #2c3e50;
            border-radius: 8px;
        }

        .signatures-grid {
            display: table;
            width: 100%;
            margin-top: 20px;
            table-layout: fixed;
        }

        .signature-box {
            display: table-cell;
            text-align: center;
            padding: 20px;
            border: 1px dashed #6c757d;
            border-radius: 5px;
            background: #f8f9fa;
            width: 45%;
            vertical-align: top;
        }

        .signature-box:first-child {
            margin-right: 10%;
        }

        .signature-title {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 40px;
            font-size: 14px;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            width: 150px;
            margin: 10px auto;
            height: 20px;
        }

        .signature-field {
            margin: 10px 0;
            font-size: 12px;
        }

        /* Pied de page */
        .footer {
            position: absolute;
            bottom: 20px;
            left: 40px;
            right: 40px;
            text-align: center;
            font-size: 10px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
            padding-top: 10px;
            background: white;
        }

        .footer-line {
            margin: 2px 0;
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
                opacity: 0.12;
            }
        }
    </style>
</head>

<body>
    <div class="document-container">
        <!-- Filigrane -->
        <div class="watermark"></div>

        <div class="content">
            <!-- Numéro de référence -->
            <div class="reference-number">
                Référence : MG-20250624-{{ $numero_bon }}
            </div>

            <!-- En-tête -->
            <div class="header-section">
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
                    <span class="info-value info-input">BM-2025-{{ $numero_bon }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Date d'émission :</span>
                    <span class="info-value info-input">{{ $date }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nom et Prénom :</span>
                    <span class="info-value info-input">{{ $nom }} {{ $prenom }}</span>
                </div>
            </div>

            <!-- Section matériel -->
            <div class="material-section">
                <h3 style="margin-top: 0; color: #2c3e50;">Matériel concerné</h3>
                <table class="material-table">
                    <thead>
                        <tr>
                            <th>Désignation</th>
                            <th>Quantité</th>
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
                <h3 style="margin-top: 0; color: #2c3e50; text-align: center;">Signatures et Validation</h3>
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
            <div class="footer-line"><strong>JASPE TECHNOLOGIES</strong> - Système de gestion de matériel informatique
            </div>
            <div class="footer-line">Tél : +229 XX XX XX XX • Email : contact@jaspe-techno.com</div>
            <div class="footer-line">Document généré le 24/06/2025 à 14:30</div>
        </div>
    </div>
</body>

</html>
