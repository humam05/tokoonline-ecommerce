<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TokoOnline') - TokoOnline</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes float { 0%, 100% { transform: translateY(0px) rotate(0deg); } 50% { transform: translateY(-20px) rotate(5deg); } }
        @keyframes float-delayed { 0%, 100% { transform: translateY(0px) rotate(0deg); } 50% { transform: translateY(-15px) rotate(-5deg); } }
        @keyframes slide-up { from { opacity: 0; transform: translateY(30px) scale(0.95); } to { opacity: 1; transform: translateY(0) scale(1); } }
        @keyframes shimmer { 0% { background-position: -200% center; } 100% { background-position: 200% center; } }
        @keyframes pulse-glow { 0%, 100% { box-shadow: 0 0 20px rgba(99,102,241,0.15); } 50% { box-shadow: 0 0 40px rgba(99,102,241,0.3); } }
        @keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-float-delayed { animation: float-delayed 7s ease-in-out infinite; }
        .animate-slide-up { animation: slide-up 0.6s ease-out both; }
        .animate-slide-up-2 { animation: slide-up 0.6s ease-out 0.15s both; }
        .animate-slide-up-3 { animation: slide-up 0.6s ease-out 0.3s both; }
        .animate-fade-in { animation: fade-in 0.8s ease-out both; }
        .btn-shimmer { background-size: 200% auto; animation: shimmer 3s linear infinite; }
        .card-glow { animation: pulse-glow 3s ease-in-out infinite; }
        .card-glow-hover:hover { animation: pulse-glow 2s ease-in-out infinite; }
        .field-delay-1 { animation: slide-up 0.5s ease-out 0.1s both; }
        .field-delay-2 { animation: slide-up 0.5s ease-out 0.2s both; }
        .field-delay-3 { animation: slide-up 0.5s ease-out 0.3s both; }
        .field-delay-4 { animation: slide-up 0.5s ease-out 0.4s both; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('products.index') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">TokoOnline</span>
                </a>

                <div class="flex items-center gap-1 sm:gap-3">
                    <a href="{{ route('products.index') }}" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition">Produk</a>

                    @auth
                        <a href="{{ route('cart.index') }}" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition relative">
                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                            Keranjang
                            @php $cartCount = auth()->user()->cartItems()->count(); @endphp
                            @if($cartCount > 0)
                                <span class="absolute -top-0.5 -right-0.5 bg-red-500 text-white text-[10px] font-bold rounded-full w-5 h-5 flex items-center justify-center shadow-sm">{{ $cartCount }}</span>
                            @endif
                        </a>
                        <a href="{{ route('orders.index') }}" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition">
                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            Pesanan
                        </a>

                        @auth
                            @if(auth()->user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 text-sm font-medium text-purple-600 hover:text-purple-700 hover:bg-purple-50 rounded-lg transition">
                                    <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Admin
                            </a>
                            @endif
                        @endauth

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-3 py-2 text-sm font-medium text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition shadow-sm">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="bg-emerald-50 border-b border-emerald-200 text-emerald-800 px-4 py-3 text-center text-sm font-medium">
            <div class="max-w-7xl mx-auto flex items-center justify-center gap-2">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border-b border-red-200 text-red-800 px-4 py-3 text-center text-sm font-medium">
            <div class="max-w-7xl mx-auto flex items-center justify-center gap-2">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        </div>
                        <span class="text-lg font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">TokoOnline</span>
                    </div>
                    <p class="text-sm text-gray-500">Toko online terpercaya dengan berbagai produk berkualitas dengan harga terbaik.</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800 mb-3">Navigasi</h3>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li><a href="{{ route('products.index') }}" class="hover:text-indigo-600 transition">Semua Produk</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-indigo-600 transition">Keranjang Belanja</a></li>
                        <li><a href="{{ route('orders.index') }}" class="hover:text-indigo-600 transition">Pesanan Saya</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800 mb-3">Akun</h3>
                    <ul class="space-y-2 text-sm text-gray-500">
                        @auth
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="hover:text-red-600 transition">Logout</button>
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}" class="hover:text-indigo-600 transition">Login</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-indigo-600 transition">Register</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-200 mt-8 pt-6 text-center text-sm text-gray-400">
                &copy; {{ date('Y') }} TokoOnline. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>
