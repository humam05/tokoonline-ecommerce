@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="min-h-[80vh] flex items-center justify-center relative overflow-hidden py-8">
    <div class="absolute inset-0 bg-gradient-to-br from-purple-50 via-white to-pink-50"></div>
    <div class="absolute top-10 right-20 w-48 md:w-80 h-48 md:h-80 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-float"></div>
    <div class="absolute bottom-10 left-20 w-48 md:w-72 h-48 md:h-72 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-float-delayed"></div>
    <div class="absolute top-1/3 left-1/3 w-32 md:w-48 h-32 md:h-48 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>

    <div class="w-full max-w-md relative z-10 px-4">
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl border border-white/50 p-8 card-glow animate-slide-up">
            <div class="text-center mb-8 animate-slide-up-2">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 via-pink-500 to-rose-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-purple-200 -rotate-3 hover:rotate-0 transition-transform duration-500">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                </div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-600 via-pink-500 to-rose-500 bg-clip-text text-transparent">Buat Akun Baru</h1>
                <p class="text-gray-500 mt-2">Daftar untuk mulai berbelanja</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div class="field-delay-1 group">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5 group-focus-within:text-purple-600 transition-colors">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-purple-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="w-full border border-gray-200 rounded-xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-purple-500/30 focus:border-purple-500 bg-gray-50/50 focus:bg-white transition-all duration-300 @error('name') border-red-400 bg-red-50/50 @enderror"
                            placeholder="Nama Anda">
                    </div>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1.5 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>
                    @enderror
                </div>

                <div class="field-delay-2 group">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5 group-focus-within:text-purple-600 transition-colors">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-purple-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full border border-gray-200 rounded-xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-purple-500/30 focus:border-purple-500 bg-gray-50/50 focus:bg-white transition-all duration-300 @error('email') border-red-400 bg-red-50/50 @enderror"
                            placeholder="nama@email.com">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1.5 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>
                    @enderror
                </div>

                <div class="field-delay-3 group">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5 group-focus-within:text-purple-600 transition-colors">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-purple-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input type="password" name="password" required
                            class="w-full border border-gray-200 rounded-xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-purple-500/30 focus:border-purple-500 bg-gray-50/50 focus:bg-white transition-all duration-300 @error('password') border-red-400 bg-red-50/50 @enderror"
                            placeholder="Minimal 8 karakter">
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1.5 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>
                    @enderror
                </div>

                <div class="field-delay-4 group">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5 group-focus-within:text-purple-600 transition-colors">Konfirmasi Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-purple-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <input type="password" name="password_confirmation" required
                            class="w-full border border-gray-200 rounded-xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-purple-500/30 focus:border-purple-500 bg-gray-50/50 focus:bg-white transition-all duration-300"
                            placeholder="Ulangi password">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-gradient-to-r from-purple-600 via-pink-500 to-rose-500 text-white py-3.5 rounded-xl hover:from-purple-700 hover:via-pink-600 hover:to-rose-600 transition-all duration-300 font-semibold shadow-lg shadow-purple-200 hover:shadow-xl hover:shadow-purple-300 hover:-translate-y-0.5 active:translate-y-0 btn-shimmer relative overflow-hidden group/btn">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                            Daftar Akun
                        </span>
                    </button>
                </div>

                <div class="text-center pt-2">
                    <p class="text-gray-500">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-700 font-semibold hover:underline transition-all">Login</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
