<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Rapport</title>

    @php
        $imagePath = public_path('images/jaspe_logo_noir_web.png');
        $base64 = null;
        if (file_exists($imagePath)) {
            $mime = mime_content_type($imagePath); // ex : image/png
            $imageData = file_get_contents($imagePath);
            $base64 = 'data:' . $mime . ';base64,' . base64_encode($imageData);
        }
    @endphp

    <style>
        @page {
            margin: 20px;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            position: relative;
        }

        .big-image {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90vw;
            height: auto;
            max-height: 90vh;
            object-fit: contain;
            z-index: 0;
            opacity: 0.1; /* Discret pour fond de page */
        }

        .main-container {
            position: relative;
            z-index: 1;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            max-width: 900px;
            margin: 20px auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #4a90e2;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }

        .header h2 {
            color: #4a90e2;
            margin: 0;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .content {
            font-size: 1.05rem;
            line-height: 1.8;
            white-space: pre-wrap;
        }

        .footer {
            margin-top: 60px;
            font-size: 0.9rem;
            color: #777;
            text-align: right;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }

        .signature-line {
            display: inline-block;
            border-bottom: 1px solid #aaa;
            width: 250px;
            margin-left: 15px;
        }
    </style>
</head>
<body>

    @if($base64)
        <img src="{{ $base64 }}" alt="Image de fond" class="big-image" />
    @else
        <p style="color:red; text-align:center;">Logo non disponible</p>
    @endif

    <div class="main-container">
        <div class="header mb-4">
            <h2 class="display-5 fw-bold">Rapport</h2>
            <p class="text-muted mb-1">Écritté par : <strong>{{ $user->nom }}</strong></p>
            <p class="text-muted">Date : <strong>{{ now()->format('d/m/Y H:i') }}</strong></p>
        </div>

        <div class="content mb-4">
            {!! nl2br(e($contenu)) !!}
        </div>

        <div class="footer">
            Signature : <span class="signature-line"></span>
        </div>
    </div>

</body>
</html>
