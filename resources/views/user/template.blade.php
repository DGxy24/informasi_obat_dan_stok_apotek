<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Apotek Sehat Sentosa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            background-color: #f8fafc;
        }

        /* Navbar Styles */
        .navbar {
            background: linear-gradient(135deg, #0ea5e9 0%, #2563eb 100%);
            color: white;
            padding: 1rem 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 0.7rem 0;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .navbar-logo {
            width: 45px;
            height: 45px;
            object-fit: contain;
            border-radius: 8px;
            background: white;
            padding: 4px;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 2.5rem;
            list-style: none;
        }

        .navbar-menu a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 1.05rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .navbar-menu a:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .navbar-menu a.active {
            background: rgba(255, 255, 255, 0.2);
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 25px;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: white;
            color: #0ea5e9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .user-name {
            font-weight: 500;
        }

        .logout-btn {
            background: rgba(220, 38, 38, 0.9);
            color: white;
            padding: 0.6rem 1.5rem;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background: rgba(220, 38, 38, 1);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 38, 38, 0.4);
        }

        .login-btn {
            background: #0A1E5E;
            color: #0ea5e9;
            padding: 0.6rem 1.5rem;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.4);
        }

        /* Main Content */
        .main-content {
            margin-top: 80px;
            min-height: calc(100vh - 80px);
        }

        .obat-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        .page-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .page-header h1 {
            font-size: 2.5rem;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .page-header p {
            font-size: 1.1rem;
            color: #64748b;
        }

        /* Search Bar */
        .search-section {
            max-width: 600px;
            margin: 0 auto 3rem;
        }

        .search-box {
            display: flex;
            gap: 1rem;
            background: white;
            padding: 0.5rem;
            border-radius: 50px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .search-box input {
            flex: 1;
            border: none;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            outline: none;
        }

        .search-btn {
            background: linear-gradient(135deg, #0ea5e9 0%, #2563eb 100%);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .search-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 20px rgba(14, 165, 233, 0.4);
        }

        /* Filter Section */
        .filter-section {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.7rem 1.5rem;
            border: 2px solid #e2e8f0;
            background: white;
            color: #64748b;
            border-radius: 25px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-btn:hover,
        .filter-btn.active {
            border-color: #0ea5e9;
            background: #0ea5e9;
            color: white;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: 250px;
            background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 5rem;
            position: relative;
        }

        .product-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: #10b981;
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .product-badge.low-stock {
            background: #f59e0b;
        }

        .product-badge.out-of-stock {
            background: #ef4444;
        }

        .product-info {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-category {
            color: #0ea5e9;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .product-name {
            font-size: 1.3rem;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 0.8rem;
        }

        .product-description {
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1rem;
            flex: 1;
        }

        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
            margin-top: auto;
        }

        .product-stock {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #64748b;
            font-size: 0.9rem;
        }

        .stock-icon {
            font-size: 1.2rem;
        }

        .product-price {
            font-size: 1.8rem;
            font-weight: bold;
            color: #0ea5e9;
        }

        .product-actions {
            display: flex;
            gap: 0.8rem;
            margin-top: 1rem;
        }

        .btn-detail,
        .btn-add {
            flex: 1;
            padding: 0.8rem;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
            text-decoration: none;
            display: block;
        }

        .btn-detail {
            background: #f1f5f9;
            color: #475569;
        }

        .btn-detail:hover {
            background: #e2e8f0;
        }

        .btn-add {
            background: linear-gradient(135deg, #0ea5e9 0%, #2563eb 100%);
            color: white;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(14, 165, 233, 0.4);
        }

        .btn-add:disabled {
            background: #cbd5e1;
            cursor: not-allowed;
            transform: none;
        }

        /* Footer */
        footer {
            background: #1e293b;
            color: white;
            padding: 2rem;
            text-align: center;
            margin-top: 4rem;
        }

        footer p {
            color: #94a3b8;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: 1fr;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .navbar-container {
                flex-direction: column;
                gap: 1rem;
            }

            .navbar-menu {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="navbar-container">
            <a href="{{ route('obat.index') }}" class="navbar-brand">
                @if(!empty($apotek->logo))
                    <img src="{{ asset('storage/' . $apotek->logo) }}" alt="{{ $apotek->nama_apotek }}" class="navbar-logo" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
                    <span style="font-size: 2rem; display: none;">💊</span>
                @else
                    <span style="font-size: 2rem;">💊</span>
                @endif
                {{$apotek->nama_apotek}}
            </a>

            <ul class="navbar-menu">
                <li>
                    <a href="{{ route('obat.index') }}" class="{{ Route::is('obat.*') ? 'active' : '' }}">
                        Obat
                    </a>
                </li>

                <li>
                    <a href="{{ route('lokasi') }}" class="{{ Route::is('lokasi') ? 'active' : '' }}">
                        Lokasi
                    </a>
                </li>

                <li>
                    <a href="{{ route('about') }}" class="{{ Route::is('about') ? 'active' : '' }}">
                        About
                    </a>
                </li>

                <div class="navbar-user">
                    @auth
                        {{-- User sudah login --}}
                        <div class="user-info">
                            <div class="user-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="user-name">{{ Auth::user()->name }}</span>
                        </div>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    @else
                        {{-- User belum login (Guest) --}}
                        <div class="user-info">
                            <div class="user-avatar">
                                G
                            </div>
                            <span class="user-name">Guest</span>
                        </div>
                        <a href="{{ route('home') }}" class="login-btn">Login</a>
                    @endauth
                </div>
            </ul>
        </div>
    </nav>


    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Apotek Sehat Sentosa. Semua hak dilindungi.</p>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>