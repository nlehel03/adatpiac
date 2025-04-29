<!DOCTYPE html>
<html>
<head>
    <title>Jelszó visszaállítás</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #3498db;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 0 0 5px 5px;
        }
        .btn {
            display: inline-block;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 15px;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Jelszó visszaállítás</h1>
    </div>

    <div class="content">
        <h2>Kedves {{ $user->nev }}!</h2>
        <p>Ezt az e-mailt azért kapta, mert jelszó-visszaállítási kérelmet kaptunk a fiókjához.</p>

        <div style="text-align: center;">
            <a class="btn" href="{{ $resetUrl }}">Jelszó visszaállítása</a>
        </div>


        <p>A jelszó-visszaállítási link 60 percig érvényes.</p>

        <p>Ha nem Ön kérte a jelszó visszaállítását, nincs további teendője.</p>
    </div>

    <div class="footer">
        <p>Ez egy automatikusan generált üzenet, kérjük, ne válaszoljon rá.</p>
        <p>&copy; {{ date('Y') }} Adatpiac. Minden jog fenntartva.</p>
    </div>
</body>
</html>
