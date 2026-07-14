@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="flex gap-6">
    <aside class="w-64 shrink-0">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <h2 class="font-bold text-lg text-gray-800 mb-4">Admin Panel</h2>
            <nav class="space-y-1">
                <x-admin.sidebar />
            </nav>
        </div>
    </aside>

    <main class="flex-1 min-w-0 max-w-2xl">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Kategori</h1>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Kategori</label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror">
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi (opsional)</label>
                    <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror">{{ old('description', $category->description) }}</textarea>
                    @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg hover:bg-indigo-700 transition font-medium">Simpan Perubahan</button>
                    <a href="{{ route('admin.categories.index') }}" class="text-gray-600 hover:text-gray-800 px-4 py-2.5">Batal</a>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection
