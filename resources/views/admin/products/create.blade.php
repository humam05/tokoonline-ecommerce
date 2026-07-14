@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="flex flex-col lg:flex-row gap-6">
    <aside class="w-full lg:w-64 shrink-0">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <h2 class="font-bold text-lg text-gray-800 mb-4">Admin Panel</h2>
            <nav class="space-y-1"><x-admin.sidebar active="products" /></nav>
        </div>
    </aside>

    <main class="flex-1 min-w-0 max-w-2xl">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Tambah Produk</h1>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori</label>
                    <select name="category_id" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Produk</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror"
                        placeholder="Nama produk">
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror" placeholder="Deskripsi produk">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Harga (Rp)</label>
                        <input type="number" name="price" value="{{ old('price') }}" required min="0"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('price') border-red-500 @enderror"
                            placeholder="100000">
                        @error('price') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Stok</label>
                        <input type="number" name="stock" value="{{ old('stock') }}" required min="0"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('stock') border-red-500 @enderror"
                            placeholder="10">
                        @error('stock') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Gambar Produk</label>
                    <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('image') border-red-500 @enderror">
                    <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG, WebP. Maks: 2MB</p>
                    @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg hover:bg-indigo-700 transition font-medium">Simpan</button>
                    <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-gray-800 px-4 py-2.5">Batal</a>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection
