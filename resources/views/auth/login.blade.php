@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
    @keyframes float { 0%, 100% { transform: translateY(0px) rotate(0deg); } 50% { transform: translateY(-20px) rotate(5deg); } }
    @keyframes float-delayed { 0%, 100% { transform: translateY(0px) rotate(0deg); } 50% { transform: translateY(-15px) rotate(-5deg); } }
    @keyframes slide-up { from { opacity: 0; transform: translateY(30px) scale(0.95); } to { opacity: 1; transform: translateY(0) scale(1); } }
    @keyframes shimmer { 0% { background-position: -200% center; } 100% { background-position: 200% center; } }
    @keyframes pulse-glow { 0%, 100% { box-shadow: 0 0 20px rgba(99,102,241,0.15); } 50% { box-shadow: 0 0 40px rgba(99,102,241,0.3); } }
    .animate-float { animation: float 6s ease-in-out infinite; }
    .animate-float-delayed { animation: float-delayed 7s ease-in-out infinite; }
    .animate-slide-up { animation: slide-up 0.6s ease-out both; }
    .animate-slide-up-2 { animation: slide-up 0.6s ease-out 0.15s both; }
    .animate-slide-up-3 { animation: slide-up 0.6s ease-out 0.3s both; }
    .btn-shimmer { background-size: 200% auto; animation: shimmer 3s linear infinite; }
    .card-glow { animation: pulse-glow 3s ease-in-out infinite; }
</style>

<div class="min-h-[80vh] flex items-center justify-center relative overflow-hidden py-8">
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 via-white to-purple-50"></div>
    <div class="absolute top-20 left-10 w-72 h-72 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-float"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-float-delayed"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>

    <div class="w-full max-w-md relative z-10 px-4">
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl border border-white/50 p-8 card-glow animate-slide-up">
            <div class="text-center mb-8 animate-slide-up-2">
                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-indigo-200 rotate-3 hover:rotate-0 transition-transform duration-500">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 bg-clip-text text-transparent">Selamat Datang</h1>
                <p class="text-gray-500 mt-2">Silakan login ke akun Anda</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="animate-slide-up-3">
                @csrf

                <div class="mb-5 group">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5 group-focus-within:text-indigo-600 transition-colors">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full border border-gray-200 rounded-xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 bg-gray-50/50 focus:bg-white transition-all duration-300 @error('email') border-red-400 bg-red-50/50 @enderror"
                            placeholder="nama@email.com">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1.5 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6 group">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5 group-focus-within:text-indigo-600 transition-colors">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input type="password" name="password" required
                            class="w-full border border-gray-200 rounded-xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 bg-gray-50/50 focus:bg-white transition-all duration-300 @error('password') border-red-400 bg-red-50/50 @enderror"
                            placeholder="Masukkan password">
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1.5 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 text-white py-3.5 rounded-xl hover:from-indigo-700 hover:via-purple-700 hover:to-pink-600 transition-all duration-300 font-semibold shadow-lg shadow-indigo-200 hover:shadow-xl hover:shadow-indigo-300 hover:-translate-y-0.5 active:translate-y-0 btn-shimmer relative overflow-hidden group/btn">
                    <span class="relative z-10 flex items-center justify-center gap-2">
                        Login
                        <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </span>
                </button>

                <div class="mt-6 text-center">
                    <p class="text-gray-500">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold hover:underline transition-all">Daftar Sekarang</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
