<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page Simple</title>
    <link rel="stylesheet" href="{{ asset('css/stye.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">MyBrand</div>
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="hero-content">
            <h1>Selamat Datang di Website Kami</h1>
            <p>Solusi digital terbaik untuk mengelola infrastruktur dan aplikasi Anda dengan mudah.</p>
            <a href="{{ route('dashboard') }}" class="btn">Mulai Sekarang</a>
        </div>
    </header>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2026 MyBrand Project. All rights reserved.</p>
    </footer>

</body>
</html>
