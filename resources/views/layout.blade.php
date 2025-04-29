<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adatpiac - @yield('title', 'Kezdőlap')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Egyedi CSS -->
    <style>
        /* Alapstílus */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Fejléc */
        .navbar {
            background-color: #3498db;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: rgba(255,255,255,0.85);
            transition: all 0.3s;
        }

        .navbar-dark .navbar-nav .nav-link:hover {
            color: white;
            transform: translateY(-2px);
        }

        /* Kártya stílus */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .card-header {
            background-color: #3498db;
            color: white;
            font-weight: 600;
            border: none;
        }

        /* Űrlap stílusok */
        .form-control {
            border-radius: 6px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
        }

        .btn-primary {
            background-color: #3498db;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        /* Lábléc */
        footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px 0;
            margin-top: 40px;
        }

        footer a {
            color: #3498db;
        }

        footer a:hover {
            color: #2980b9;
        }

        /* Hibaüzenetek */
        .alert {
            border-radius: 8px;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        /* Animációk */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Egyéb hasznos segédosztályok */
        .section-padding {
            padding: 80px 0;
        }

        .rounded-custom {
            border-radius: 15px;
        }
    </style>
</head>
<body>
    <!-- Fejléc -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <i class="fas fa-chart-line me-2"></i>Adatpiac
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}">Főoldal</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Bejelentkezés</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('registration') }}">Regisztráció</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Irányítópult</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Kijelentkezés
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Tartalom -->
    <div class="container my-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Lábléc -->
    <footer class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p>© {{ date('Y') }} Adatpiac - Minden jog fenntartva</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="mx-2"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="mx-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="mx-2"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript (Bootstrap és egyéb) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Egyéni szkriptek
        document.addEventListener('DOMContentLoaded', function() {
            // Tooltip inicializálása
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
</body>
</html>
