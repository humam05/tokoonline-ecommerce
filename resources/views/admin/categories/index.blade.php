@extends('layouts.app')

@section('title', 'Kelola Kategori')

@section('content')
<div class="flex flex-col lg:flex-row gap-6">
    <aside class="w-full lg:w-64 shrink-0">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <h2 class="font-bold text-lg text-gray-800 mb-4">Admin Panel</h2>
            <nav class="space-y-1">
                <x-admin.sidebar />
            </nav>
        </div>
    </aside>

    <main class="flex-1 min-w-0">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Kelola Kategori</h1>
            <a href="{{ route('admin.categories.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Kategori
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
            <table class="w-full min-w-[600px]">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">ID</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Nama</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Slug</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Jumlah Produk</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($categories as $category)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm text-gray-600">#{{ $category->id }}</td>
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $category->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500">{{ $category->slug }}</td>
                            <td class="px-4 py-3 text-center">
                                <span class="inline-block px-2.5 py-1 text-xs rounded-full bg-indigo-100 text-indigo-700 font-medium">{{ $category->products_count }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-indigo-600 hover:bg-indigo-50 p-1.5 rounded transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori ini? Kategori dengan produk tidak bisa dihapus.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:bg-red-50 p-1.5 rounded transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($categories->isEmpty())
                <div class="p-8 text-center text-gray-500">Belum ada kategori.</div>
            @endif
        </div>

        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </main>
</div>
@endsection
