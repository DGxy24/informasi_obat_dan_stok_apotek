<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Apotek Sehat Sentosa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            color: white;
            transition: all 0.3s;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-size: 1.3rem;
            font-weight: bold;
            white-space: nowrap;
        }

        .sidebar-brand-icon {
            font-size: 2rem;
        }

        .sidebar.collapsed .sidebar-brand-text {
            display: none;
        }

        .sidebar-toggle {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .sidebar-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .sidebar-menu {
            padding: 1rem 0;
            list-style: none;
        }

        .menu-item {
            margin-bottom: 0.3rem;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.9rem 1.5rem;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s;
            position: relative;
        }

        .menu-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .menu-link.active {
            background: rgba(59, 130, 246, 0.2);
            color: white;
            border-left: 3px solid #3b82f6;
        }

        .menu-icon {
            font-size: 1.5rem;
            width: 24px;
            text-align: center;
        }

        .sidebar.collapsed .menu-text {
            display: none;
        }

        .menu-badge {
            margin-left: auto;
            background: #ef4444;
            color: white;
            padding: 0.2rem 0.6rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .sidebar.collapsed .menu-badge {
            display: none;
        }

        /* User Info in Sidebar */
        .sidebar-user {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.2);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: bold;
            flex-shrink: 0;
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.95rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .sidebar.collapsed .user-details {
            display: none;
        }

        /* Main Content */
        .main-wrapper {
            margin-left: 260px;
            transition: all 0.3s;
            min-height: 100vh;
        }

        .sidebar.collapsed~.main-wrapper {
            margin-left: 70px;
        }

        /* Top Navbar */
        .top-navbar {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .page-title {
            font-size: 1.5rem;
            color: #1e293b;
            font-weight: 600;
        }

        .top-navbar-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .notification-btn {
            position: relative;
            background: #f1f5f9;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.3s;
        }

        .notification-btn:hover {
            background: #e2e8f0;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .logout-btn {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 0.6rem 1.5rem;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 2px 10px rgba(239, 68, 68, 0.3);
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
        }

        /* Content Area */
        .content {
            padding: 2rem;
        }

        /* Alert Messages */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .alert-success {
            background: #f0fdf4;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .alert-icon {
            font-size: 1.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .top-navbar {
                padding: 1rem;
            }

            .content {
                padding: 1rem;
            }
        }





        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: #f1f5f9;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1.4rem;
            /* Sedikit diperbesar agar lebih terlihat */
            color: #1e293b;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-right: 10px;
            /* ✅ Tambahkan jarak dari tulisan */
        }

        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }
    </style>
    @yield('styles')
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-brand">
                <span class="sidebar-brand-icon">🏥</span>
                <span class="sidebar-brand-text">Admin Panel</span>
            </div>
            <button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">
                ☰
            </button>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-item">
                <a href="{{ route('admin.dashboard') }}"
                    class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="menu-icon">📊</span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.obat.index') }}"
                    class="menu-link {{ request()->routeIs('admin.obat.*') ? 'active' : '' }}">
                    <span class="menu-icon">💊</span>
                    <span class="menu-text">Kelola Obat</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.supplier.index') }}"
                    class="menu-link {{ request()->routeIs('admin.supplier.*') ? 'active' : '' }}">
                    <span class="menu-icon">🫱🏻‍🫲🏻</span>
                    <span class="menu-text">Kelola Supplier</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.stock.index') }}"
                    class="menu-link {{ request()->routeIs('admin.stock.*') ? 'active' : '' }}">
                    <span class="menu-icon">📦</span>
                    <span class="menu-text">Stok</span>
                    {{-- <span class="menu-badge">5</span> --}}
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.users.index') }}"
                    class="menu-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <span class="menu-icon">👥</span>
                    <span class="menu-text">Kelola User</span>
                </a>
            </li>

     


    


            <li class="menu-item">
                <a href="{{ route('admin.reports') }}"
                    class="menu-link {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                    <span class="menu-icon">📈</span>
                    <span class="menu-text">Laporan</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="#" class="menu-link">
                    <span class="menu-icon">⚙️</span>
                    <span class="menu-text">Pengaturan</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-user">
            <div class="user-info">
                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div class="user-details">
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="main-wrapper">
        <!-- Top Navbar -->
        <nav class="top-navbar">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <button class="mobile-menu-toggle" onclick="toggleMobileSidebar()">☰</button>
                <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
            </div>

            <div class="top-navbar-actions">
            
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </nav>

        <!-- Content Area -->
        <main class="content">
            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="alert alert-success">
                    <span class="alert-icon">✅</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">
                    <span class="alert-icon">❌</span>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        // Toggle Sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');

            // Save state to localStorage
            const isCollapsed = sidebar.classList.contains('collapsed');
            localStorage.setItem('sidebarCollapsed', isCollapsed);
        }

        // Toggle Mobile Sidebar
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('mobile-open');
        }

        // Close mobile sidebar when clicking outside
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const mobileToggle = document.querySelector('.mobile-menu-toggle');

            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && event.target !== mobileToggle) {
                    sidebar.classList.remove('mobile-open');
                }
            }
        });

        // Load sidebar state from localStorage
        window.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

            if (isCollapsed) {
                sidebar.classList.add('collapsed');
            }
        });

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.remove();
                    }, 500);
                }, 5000);
            });
        });
    </script>
    @yield('scripts')
</body>

</html>
