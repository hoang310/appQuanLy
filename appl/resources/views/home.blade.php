<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Dashboard</title>

</head>

<body class="bg-slate-50 text-slate-800 font-sans" x-data="{ sidebarOpen: true }">

    <div class="flex h-screen overflow-hidden">

        <aside
            class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-white transform transition-transform duration-300 ease-in-out md:relative md:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:w-0 md:hidden'">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-800">
                <span class="text-xl font-bold tracking-wider text-indigo-400">LARAVEL ADMIN</span>
                <button @click="sidebarOpen = false"
                    class="md:hidden p-2 text-slate-400 hover:text-white rounded-xl hover:bg-slate-800 transition-colors focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <nav class="mt-6 px-4 space-y-1">
                <a href="#"
                    class="flex items-center px-4 py-3 text-sm font-medium bg-indigo-600 rounded-xl text-white transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    Dashboard
                </a>
                <a href="/categories"
                    class="flex items-center px-4 py-3 text-sm font-medium text-slate-300 rounded-xl hover:bg-slate-800 hover:text-white transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    Quản lý thể  loại
                </a>
                <a href="/books"
                    class="flex items-center px-4 py-3 text-sm font-medium text-slate-300 rounded-xl hover:bg-slate-800 hover:text-white transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Quản lý sách
                </a>
                <a href="/authors"
                    class="flex items-center px-4 py-3 text-sm font-medium text-slate-300 rounded-xl hover:bg-slate-800 hover:text-white transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Quản lý tác giả
                </a>
                <a href="#"
                    class="flex items-center px-4 py-3 text-sm font-medium text-slate-300 rounded-xl hover:bg-slate-800 hover:text-white transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                    </svg>
                    Cài đặt
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">

            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-slate-200">
                <div class="flex items-center">
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="text-slate-500 focus:outline-none hover:text-slate-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <div class="relative mx-4 lg:mx-6 hidden sm:block">
                        <input
                            class="w-32 pad-r pl-10 pr-4 py-2 text-sm text-slate-700 bg-slate-100 rounded-xl border-none focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition sm:w-64"
                            type="text" placeholder="Tìm kiếm...">
                    </div>
                </div>

                <div class="flex items-center space-x-4" x-data="{ userMenuOpen: false }">
                    <button class="text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                            </path>
                        </svg>
                    </button>

                    <div class="relative">
                        <button @click="userMenuOpen = !userMenuOpen" class="flex items-center focus:outline-none">
                            <img class="object-cover w-9 h-9 rounded-full border border-indigo-100"
                                src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80"
                                alt="Avatar">
                        </button>

                        <div x-show="userMenuOpen" @click.away="userMenuOpen = false"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-xl overflow-hidden shadow-xl z-50 border border-slate-100"
                            style="display: none;">
                            <a href="#" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50">Hồ sơ
                                cá nhân</a>
                            <a href="#" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50">Cài
                                đặt</a>
                            <hr class="border-slate-100">
                            <a href="#"
                                class="block px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 font-medium">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-6">
                
                @yield('content')
                
            </main>

        </div>
    </div>

    <footer class="mt-auto px-6 py-4 bg-slate-900 border-t">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-2 text-sm text-slate-500">
            <div>
                © 2026 <span class="font-semibold text-indigo-600">Laravel Admin</span>
            </div>
            
            <div class="flex items-center space-x-4">
                <a href="#" class="hover:text-slate-800 transition">Hỗ trợ</a>
                <span class="text-slate-300">|</span>
                <a href="#" class="hover:text-slate-800 transition">Điều khoản</a>
                <span class="text-slate-300 hidden sm:inline">|</span>
                <span class="text-xs font-mono bg-slate-100 text-slate-600 px-2 py-0.5 rounded-md hidden sm:inline">v1.0.0</span>
            </div>
        </div>
    </footer>

</body>

</html>
