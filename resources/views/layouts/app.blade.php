<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Rekomendasi Formatur IPM Jawa Tengah')</title>
    <meta name="copyright" content="© 2024 TEPE-DEV. All rights reserved.">
    <meta name="author" content="TEPE-DEV">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Custom CSS Variables */
        :root {
            --ipm-green: #009245;
            --ipm-yellow: #FDCB0A;
            --ipm-red: #E30613;
            --ipm-white: #FFFFFF;
            --ipm-black: #000000;
            --ipm-dark: #1a1a1a;
            --ipm-light: #f8f9fa;
            --ipm-gray-50: #f9fafb;
            --ipm-gray-100: #f3f4f6;
            --ipm-gray-200: #e5e7eb;
            --ipm-gray-300: #d1d5db;
            --ipm-gray-400: #9ca3af;
            --ipm-gray-500: #6b7280;
            --ipm-gray-600: #4b5563;
            --ipm-gray-700: #374151;
            --ipm-gray-800: #1f2937;
            --ipm-gray-900: #111827;
            --ipm-gradient: linear-gradient(135deg, #009245 0%, #FDCB0A 50%, #E30613 100%);
            --ipm-shadow: 0 10px 30px rgba(0, 146, 69, 0.2);
            --ipm-shadow-light: 0 5px 15px rgba(0, 146, 69, 0.1);
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--ipm-gray-50);
            color: var(--ipm-gray-900);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Main Layout Container */
        .app-layout {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--ipm-green) 0%, #007a3a 100%);
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            overflow-x: hidden;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            border-right: 4px solid var(--ipm-yellow);
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, var(--ipm-yellow), var(--ipm-red));
            border-radius: 50%;
            transform: translate(30px, -30px);
            opacity: 0.1;
        }

        /* Sidebar Header */
        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            position: relative;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            color: var(--ipm-white);
            transition: all 0.3s ease;
        }

        .sidebar-brand:hover {
            color: var(--ipm-yellow);
        }

        .sidebar-logo {
            width: 50px;
            height: 50px;
            background: var(--ipm-white);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--ipm-shadow-light);
            border: 3px solid var(--ipm-yellow);
            flex-shrink: 0;
        }

        .sidebar-logo img {
            width: 35px;
            height: 35px;
            object-fit: contain;
        }

        .sidebar-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--ipm-white);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            white-space: nowrap;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .sidebar-title {
            opacity: 0;
            transform: translateX(-20px);
        }

        .sidebar-subtitle {
            font-size: 0.875rem;
            color: var(--ipm-yellow);
            font-weight: 600;
            white-space: nowrap;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .sidebar-subtitle {
            opacity: 0;
            transform: translateX(-20px);
        }

        /* Sidebar Navigation */
        .sidebar-nav {
            padding: 1.5rem 0;
        }

        .nav-item {
            margin: 0.25rem 1rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 600;
            position: relative;
            overflow: hidden;
            white-space: nowrap;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            color: var(--ipm-white);
            transform: translateX(8px);
            box-shadow: var(--ipm-shadow-light);
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--ipm-yellow), #f4b942);
            color: var(--ipm-black);
            box-shadow: var(--ipm-shadow);
            transform: translateX(8px);
        }

        .nav-link i {
            width: 24px;
            text-align: center;
            font-size: 1.125rem;
            flex-shrink: 0;
        }

        .nav-link.active i {
            color: var(--ipm-black);
        }

        .nav-text {
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .nav-text {
            opacity: 0;
            transform: translateX(-20px);
        }

        /* Main Content Area */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            background: var(--ipm-gray-50);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar.collapsed + .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Content Header */
        .content-header {
            background: var(--ipm-white);
            border-bottom: 1px solid var(--ipm-gray-200);
            padding: 1.5rem 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .content-header::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--ipm-gradient);
        }

        .content-body {
            padding: 2rem;
            min-height: calc(100vh - 80px);
        }

        /* Toggle Button */
        .sidebar-toggle {
            position: fixed;
            top: 1.5rem;
            left: calc(var(--sidebar-width) - 3rem);
            z-index: 1001;
            background: var(--ipm-white);
            border: 2px solid var(--ipm-green);
            border-radius: 12px;
            padding: 0.75rem;
            box-shadow: var(--ipm-shadow);
            color: var(--ipm-green);
            font-size: 1.125rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            background: var(--ipm-green);
            color: var(--ipm-white);
            transform: scale(1.05);
        }

        .sidebar.collapsed + .main-content .sidebar-toggle {
            left: calc(var(--sidebar-collapsed-width) - 3rem);
        }

        /* Mobile Toggle */
        .mobile-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1001;
            background: var(--ipm-white);
            border: 2px solid var(--ipm-green);
            border-radius: 12px;
            padding: 0.75rem;
            box-shadow: var(--ipm-shadow);
            color: var(--ipm-green);
            font-size: 1.125rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .mobile-toggle:hover {
            background: var(--ipm-green);
            color: var(--ipm-white);
        }

        /* Cards */
        .card {
            background: var(--ipm-white);
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--ipm-gray-200);
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            padding: 1.5rem 2rem;
            background: linear-gradient(135deg, var(--ipm-green), #007a3a);
            color: var(--ipm-white);
            border: none;
        }

        .card-header h3 {
            font-size: 1.125rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-header i {
            font-size: 1.25rem;
            color: var(--ipm-yellow);
        }

        .card-body {
            padding: 2rem;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.875rem;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--ipm-green), #007a3a);
            color: var(--ipm-white);
            box-shadow: 0 4px 12px rgba(0, 146, 69, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #007a3a, var(--ipm-green));
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 146, 69, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--ipm-green), #007a3a);
            color: var(--ipm-white);
            box-shadow: 0 4px 12px rgba(0, 146, 69, 0.3);
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--ipm-yellow), #f4b942);
            color: var(--ipm-black);
            box-shadow: 0 4px 12px rgba(253, 203, 10, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--ipm-red), #c1051a);
            color: var(--ipm-white);
            box-shadow: 0 4px 12px rgba(227, 6, 19, 0.3);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--ipm-green);
            color: var(--ipm-green);
        }

        .btn-outline:hover {
            background: var(--ipm-green);
            color: var(--ipm-white);
        }

        /* Tables */
        .table {
            width: 100%;
            border-collapse: collapse;
            background: var(--ipm-white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--ipm-gray-200);
        }

        .table th {
            background: linear-gradient(135deg, var(--ipm-green), #007a3a);
            color: var(--ipm-white);
            padding: 1rem 1.5rem;
            text-align: left;
            font-weight: 700;
            font-size: 0.875rem;
            border: none;
        }

        .table td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--ipm-gray-200);
            font-weight: 500;
        }

        .table tbody tr:hover {
            background: rgba(0, 146, 69, 0.05);
        }

        /* Forms */
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--ipm-gray-200);
            border-radius: 12px;
            background: var(--ipm-white);
            color: var(--ipm-gray-900);
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--ipm-green);
            box-shadow: 0 0 0 4px rgba(0, 146, 69, 0.1);
        }

        /* Alerts */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            border: none;
            font-weight: 600;
            position: relative;
            overflow: hidden;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(0, 146, 69, 0.1), rgba(0, 146, 69, 0.05));
            color: var(--ipm-green);
            border-left: 4px solid var(--ipm-green);
        }

        .alert-warning {
            background: linear-gradient(135deg, rgba(253, 203, 10, 0.1), rgba(253, 203, 10, 0.05));
            color: #856404;
            border-left: 4px solid var(--ipm-yellow);
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(227, 6, 19, 0.1), rgba(227, 6, 19, 0.05));
            color: var(--ipm-red);
            border-left: 4px solid var(--ipm-red);
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-primary {
            background: linear-gradient(135deg, var(--ipm-green), #007a3a);
            color: var(--ipm-white);
        }

        .badge-success {
            background: linear-gradient(135deg, var(--ipm-green), #007a3a);
            color: var(--ipm-white);
        }

        .badge-warning {
            background: linear-gradient(135deg, var(--ipm-yellow), #f4b942);
            color: var(--ipm-black);
        }

        .badge-danger {
            background: linear-gradient(135deg, var(--ipm-red), #c1051a);
            color: var(--ipm-white);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--ipm-white);
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--ipm-gray-200);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--ipm-gradient);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--ipm-green);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--ipm-gray-600);
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .sidebar-toggle {
                display: none;
            }
            
            .mobile-toggle {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .content-body {
                padding: 1rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .card-body {
                padding: 1.5rem;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .content-body {
            animation: fadeInUp 0.6s ease-out;
        }

        .card {
            animation: fadeInUp 0.6s ease-out;
        }

        .stat-card {
            animation: fadeInUp 0.6s ease-out;
        }

        /* User Info in Sidebar */
        .sidebar-user {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: auto;
        }

        .sidebar-user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 0.5rem;
        }

        .sidebar-user-info i {
            width: 24px;
            text-align: center;
        }

        .sidebar-user-info span {
            font-size: 0.875rem;
            font-weight: 600;
            white-space: nowrap;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .sidebar-user-info span {
            opacity: 0;
            transform: translateX(-20px);
        }
    </style>
</head>
<body>
    <div class="app-layout" x-data="{ sidebarCollapsed: false, mobileMenuOpen: false }">
        <!-- Mobile Toggle Button -->
        <button class="mobile-toggle" @click="mobileMenuOpen = !mobileMenuOpen" x-show="!mobileMenuOpen">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Sidebar -->
        <aside class="sidebar" 
               :class="{ 'collapsed': sidebarCollapsed, 'open': mobileMenuOpen }"
               x-transition:enter="transition ease-out duration-300"
               x-transition:enter-start="-translate-x-full"
               x-transition:enter-end="translate-x-0"
               x-transition:leave="transition ease-in duration-300"
               x-transition:leave-start="translate-x-0"
               x-transition:leave-end="-translate-x-full">
            
            <div class="sidebar-header">
                <a href="{{ route('dashboard') }}" class="sidebar-brand">
                    <div class="sidebar-logo">
                        <img src="{{ asset('Logo_IPM.png') }}" alt="Logo IPM Jawa Tengah">
                    </div>
                    <div>
                        <div class="sidebar-title">SAW Formatur</div>
                        <div class="sidebar-subtitle">IPM Jawa Tengah</div>
                    </div>
                </a>
            </div>
            
            <nav class="sidebar-nav">
                <div class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kandidat.*') ? 'active' : '' }}" href="{{ route('kandidat.index') }}">
                        <i class="fas fa-users"></i>
                        <span class="nav-text">Kelola Kandidat</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kriteria.*') ? 'active' : '' }}" href="{{ route('kriteria.index') }}">
                        <i class="fas fa-list"></i>
                        <span class="nav-text">Kriteria & Bobot</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a class="nav-link {{ request()->routeIs('penilaian.*') ? 'active' : '' }}" href="{{ route('penilaian.index') }}">
                        <i class="fas fa-star"></i>
                        <span class="nav-text">Input Penilaian</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a class="nav-link {{ request()->routeIs('hasil.*') ? 'active' : '' }}" href="{{ route('hasil.index') }}">
                        <i class="fas fa-trophy"></i>
                        <span class="nav-text">Hasil SAW</span>
                    </a>
                </div>
            </nav>

            <div class="sidebar-user">
                <div class="sidebar-user-info">
                    <i class="fas fa-user"></i>
                    <span>{{ Auth::guard('admin')->user()->nama_lengkap }}</span>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline" style="width: 100%; justify-content: flex-start;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="nav-text">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Desktop Toggle Button -->
            <button class="sidebar-toggle" @click="sidebarCollapsed = !sidebarCollapsed" x-show="!mobileMenuOpen">
                <i class="fas fa-chevron-left" x-show="!sidebarCollapsed"></i>
                <i class="fas fa-chevron-right" x-show="sidebarCollapsed"></i>
            </button>

            <div class="content-header">
                <h1 style="font-size: 1.875rem; font-weight: 700; color: var(--ipm-gray-900); margin: 0;">
                    @yield('page-title', 'Dashboard')
                </h1>
            </div>

            <div class="content-body">
                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle" style="margin-right: 0.5rem;"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('info'))
                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>
                        {{ session('info') }}
                    </div>
                @endif

                @yield('content')
            </div>
            
            <!-- Footer -->
            <footer style="background: var(--ipm-gray-50); border-top: 1px solid var(--ipm-gray-200); padding: 1rem 2rem; margin-top: auto;">
                <div style="text-align: center; color: var(--ipm-gray-600); font-size: 0.875rem;">
                    <p style="margin: 0;">
                        © 2024 <strong>TEPE-DEV</strong> - All Rights Reserved | 
                        <span style="color: var(--ipm-green);">Sistem Rekomendasi Formatur IPM Jawa Tengah</span>
                    </p>
                    <p style="margin: 0.25rem 0 0 0; font-size: 0.75rem;">
                        Penggunaan hanya untuk yang diizinkan | 
                        <a href="https://tepe-dev.com" style="color: var(--ipm-green); text-decoration: none;">tepe-dev.com</a>
                    </p>
                </div>
            </footer>
        </main>
    </div>

    @yield('scripts')
</body>
</html>