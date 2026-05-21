<!doctype html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>@yield('title', 'Admin - SI-SPPG')</title>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Vite Directives for Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @yield('styles')
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc; /* slate-50 */
        }
        [x-cloak] { display: none !important; }
        
        /* Custom scrollbar for sidebar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background-color: #475569;
            border-radius: 20px;
        }
    </style>
</head>
<body class="text-slate-800 antialiased" x-data="{ sidebarOpen: false }">

    <!-- Mobile sidebar backdrop -->
    <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-40 bg-slate-900/80 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false" x-cloak></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-72 bg-blue-950 text-slate-300 transition-transform duration-300 ease-in-out lg:translate-x-0 flex flex-col h-screen border-r border-blue-900/30">
        
        <!-- Sidebar Header / Logo -->
        <div class="flex items-center justify-center h-20 border-b border-blue-900/40 px-6 shrink-0 bg-blue-950/50">
            <div class="flex items-center gap-3 w-full">
                <img src="{{ asset('assets/img/Logo_Badan_Gizi_Nasional_(2024).png') }}" alt="Logo" class="h-10 w-10 object-contain bg-white p-1 rounded-lg">
                <h1 class="text-white font-bold text-lg tracking-tight leading-tight">Admin<br>SI-SPPG</h1>
            </div>
            <!-- Close button for mobile -->
            <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto sidebar-scroll">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white font-medium shadow-lg shadow-blue-900/30' : 'text-slate-300 hover:bg-blue-900/40 hover:text-white' }}">
                <svg class="h-5 w-5 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-slate-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>
            
            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-semibold text-blue-300/60 uppercase tracking-wider">Manajemen</p>
            </div>
            
            <a href="{{ route('admin.menu') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.menu') ? 'bg-blue-600 text-white font-medium shadow-lg shadow-blue-900/30' : 'text-slate-300 hover:bg-blue-900/40 hover:text-white' }}">
                <svg class="h-5 w-5 {{ request()->routeIs('admin.menu') ? 'text-white' : 'text-slate-400 group-hover:text-slate-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                Kelola Menu
            </a>
            
            <a href="{{ route('admin.pelayanan') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.pelayanan') ? 'bg-blue-600 text-white font-medium shadow-lg shadow-blue-900/30' : 'text-slate-300 hover:bg-blue-900/40 hover:text-white' }}">
                <svg class="h-5 w-5 {{ request()->routeIs('admin.pelayanan') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                Kelola Pelayanan
            </a>

            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-semibold text-blue-300/60 uppercase tracking-wider">Pengaturan</p>
            </div>
            
            <a href="{{ route('admin.tambah') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.tambah') ? 'bg-blue-600 text-white font-medium shadow-lg shadow-blue-900/30' : 'text-slate-300 hover:bg-blue-900/40 hover:text-white' }}">
                <svg class="h-5 w-5 {{ request()->routeIs('admin.tambah') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                Tambah Admin
            </a>
            
            <a href="{{ route('admin.profil') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.profil') ? 'bg-blue-600 text-white font-medium shadow-lg shadow-blue-900/30' : 'text-slate-300 hover:bg-blue-900/40 hover:text-white' }}">
                <svg class="h-5 w-5 {{ request()->routeIs('admin.profil') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Profil Saya
            </a>
        </nav>

        <!-- Sidebar Footer / Logout -->
        <div class="p-4 border-t border-blue-900/40 shrink-0 bg-blue-950/50">
            <a href="{{ route('logout') }}" class="flex items-center gap-3 px-4 py-3 w-full rounded-xl text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-colors font-medium">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Logout
            </a>
        </div>
    </aside>

    <!-- Main Content wrapper -->
    <div class="flex-1 flex flex-col min-h-screen transition-all duration-300 lg:pl-72 w-full">
        
        <!-- Top header for mobile and user info -->
        <header class="h-20 bg-white border-b-2 border-blue-600/10 flex items-center justify-between px-4 sm:px-6 lg:px-8 z-30 shadow-sm sticky top-0">
            <!-- Mobile menu button -->
            <button @click="sidebarOpen = true" class="lg:hidden text-slate-500 hover:text-slate-700 focus:outline-none p-2 rounded-lg bg-slate-100 hover:bg-slate-200 transition-colors">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>

            <!-- Page Title -->
            <h2 class="text-xl font-bold text-slate-800 hidden sm:block">@yield('page_title', 'Dashboard')</h2>

            <!-- User Info -->
            <div class="flex items-center gap-4 ml-auto">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-slate-800">{{ Auth::user()->namalengkap ?? Auth::user()->username }}</p>
                    <p class="text-xs text-slate-500">Administrator</p>
                </div>
                <div class="h-10 w-10 rounded-full bg-blue-100 border-2 border-blue-200 flex items-center justify-center text-blue-700 font-bold overflow-hidden">
                    {{ strtoupper(substr(Auth::user()->namalengkap ?? Auth::user()->username ?? 'A', 0, 1)) }}
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>
        
        <!-- Footer -->
        <footer class="bg-white border-t border-slate-200 py-4 px-6 text-center text-sm text-slate-500 mt-auto">
            &copy; 2025 SI-SPPG Pucang 2. All rights reserved.
        </footer>
    </div>

    @yield('scripts')
</body>
</html>
