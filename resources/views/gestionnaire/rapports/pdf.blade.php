<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Rapport </title>

    @php
        $imagePath = public_path('images/logo-removebg-preview.png');
        $base64 = null;
        if (file_exists($imagePath)) {
            $mime = mime_content_type($imagePath);
            $imageData = file_get_contents($imagePath);
            $base64 = 'data:' . $mime . ';base64,' . base64_encode($imageData);
        }
    @endphp

    <style>
        @page {
            margin: 30mm 25mm;
            size: A4;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            color: #000;
            font-size: 12pt;
            margin: 0;
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 800px;
            height: 800px;
            transform: translate(-50%, -50%);
            opacity: 0.06;
            z-index: 0;
        }

        html,
        body {
            height: 100%;
        }

        .main-wrapper {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }

        .content-wrapper {
            flex: 1;
        }


        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header img {
            max-height: 80px;
            margin-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 18pt;
            font-weight: bold;
        }

        .info-block {
            margin-bottom: 30px;
        }

        .info-block p {
            margin: 3px 0;
            font-size: 11pt;
        }

        .section-title {
            font-size: 13pt;
            font-weight: bold;
            border-bottom: 1px solid #000;
            margin-bottom: 10px;
            padding-bottom: 3px;
        }

        .content {
            text-align: justify;
            line-height: 1.8;
            font-size: 11.5pt;
        }

        .footer {
            font-size: 10pt;
            color: #666;
            text-align: center;
            border-top: 1px solid #aaa;
            padding-top: 8px;
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        @if ($base64)
            <img src="{{ $base64 }}" alt="Filigrane" class="watermark">
        @endif

        <div class="header">
            <img src="{{ public_path('images/jaspe_logo_noir_web.png') }}" alt="Logo Jaspe">
            <h1>Rapport </h1>
        </div>

        <div class="info-block">
            <p><strong>Auteur :</strong> {{ $user->nom }} {{ $user->prenom }}</p>
            <p><strong>Date :</strong> {{ now()->format('d/m/Y') }}</p>
            <p><strong>Heure :</strong> {{ now()->format('H:i') }}</p>
            <p><strong>Référence :</strong> RPT-{{ now()->format('Ymd-Hi') }}</p>
        </div>

        <div class="content-wrapper">
            <div class="section-title">Contenu du rapport</div>
            <div class="content">
                {!! nl2br(e($contenu)) !!}
            </div>
        </div>

        <div class="footer">
            Jaspe Technologie — Rapport généré automatiquement le {{ now()->format('d/m/Y à H:i') }}
        </div>
    </div>
</body>

</html>
