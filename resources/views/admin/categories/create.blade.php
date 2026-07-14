@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="flex flex-col lg:flex-row gap-6">
    <aside class="w-full lg:w-64 shrink-0">
        <div class="bg-white/80 backdrop-blur-xl rounded-xl shadow-sm border border-gray-100 p-4">
            <h2 class="font-bold text-lg bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-4">Admin Panel</h2>
            <nav class="space-y-1">
                <x-admin.sidebar />
            </nav>
        </div>
    </aside>

    <main class="flex-1 min-w-0 max-w-2xl">
        <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-6 animate-slide-up">Tambah Kategori</h1>

        <div class="bg-white/80 backdrop-blur-xl rounded-xl shadow-sm border border-gray-100 p-6 card-glow-hover animate-slide-up-2">
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Kategori</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full border border-gray-200 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 bg-gray-50/50 focus:bg-white transition-all duration-300 @error('name') border-red-400 bg-red-50/50 @enderror"
                        placeholder="Contoh: Elektronik">
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi (opsional)</label>
                    <textarea name="description" rows="3" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 bg-gray-50/50 focus:bg-white transition-all duration-300 @error('description') border-red-400 bg-red-50/50 @enderror" placeholder="Deskripsi kategori">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2.5 rounded-xl hover:from-indigo-700 hover:to-purple-700 transition font-medium shadow-sm hover:shadow-md btn-shimmer">Simpan</button>
                    <a href="{{ route('admin.categories.index') }}" class="text-gray-600 hover:text-gray-800 px-4 py-2.5">Batal</a>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection