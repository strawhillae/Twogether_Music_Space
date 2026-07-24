<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twogether Hub</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Inter:wght@300;400;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body { overflow: hidden; }

        .hero {
            width: 100%;
            height: 100vh;
            background-image: linear-gradient(rgba(0,0,0,.55), rgba(0,0,0,.55)),
                              url("{{ asset('images/studio.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        nav {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            padding: 35px 70px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 35px;
            font-size: 18px;
            font-weight: 600;
            position: relative;
            transition: .3s;
            font-family: 'Inter', sans-serif;
        }

        nav a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -8px;
            width: 0;
            height: 2px;
            background: #ffffff;
            transition: .3s;
        }

        nav a:hover::after { width: 100%; }

        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
        }

        /* ===== TEKS DENGAN EFEK BAYANGAN ===== */
        .welcome-text {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-style: italic;
            font-size: 65px;
            display: block;
            color: white;
            letter-spacing: 2px;
            
            /* EFEK BAYANGAN LEMBUT */
            text-shadow: 2px 4px 12px rgba(0, 0, 0, 0.7);
        }

        .studio-name {
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            font-size: 65px;
            display: block;
            color: #7C5CFC;
            letter-spacing: 4px;
            
            /* EFEK BAYANGAN LEMBUT */
            text-shadow: 2px 4px 12px rgba(0, 0, 0, 0.7);
        }

    </style>
</head>

<body>
    <div class="hero">
        <nav>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        </nav>

        <div class="content">
            <h1>
                <span class="welcome-text">WELCOME TO</span> <br>
                <span class="studio-name">TWOGETHER MUSIC SPACE</span>
            </h1>
        </div>
    </div>
</body>
</html>