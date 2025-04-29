<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email cím megerősítése</title>
</head>
<body>
    <h1>Üdvözöljük az Adatpiac rendszerében, {{ $user->nev }}!</h1>
    <p>Köszönjük a regisztrációt. Kérjük, erősítse meg email címét az alábbi linkre kattintva:</p>

    <a href="{{ $verificationUrl }}">Email cím megerősítése</a>

    <p>Ha Ön nem regisztrált, kérjük hagyja figyelmen kívül ezt az emailt.</p>

    <p>Üdvözlettel,<br>
    Adatpiac csapata</p>
</body>
</html>
