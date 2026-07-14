@extends('layouts.app')

@section('title', 'Produk')

@section('content')
<div class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 rounded-2xl p-8 sm:p-12 mb-10 text-white">
    <div class="relative z-10">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-3">Belanja Kebutuhanmu</h1>
        <p class="text-indigo-100 text-lg sm:text-xl max-w-xl">Temukan produk-produk terbaik dengan harga spesial untukmu!</p>
        <div class="mt-6 flex flex-wrap gap-3">
            <span class="inline-flex items-center gap-1.5 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Gratis Ongkir
            </span>
            <span class="inline-flex items-center gap-1.5 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Pengiriman Cepat
            </span>
            <span class="inline-flex items-center gap-1.5 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Garansi 100%
            </span>
        </div>
    </div>
    <div class="absolute -top-10 -right-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>
</div>

<div class="flex flex-col lg:flex-row gap-6 mb-8">
    <div class="lg:w-60 shrink-0">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                Kategori
            </h3>
            <div class="space-y-1">
                <a href="{{ route('products.index') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-sm {{ !request('category') ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-gray-600 hover:bg-gray-50 transition' }}">
                    <span>Semua</span>
                    <span class="text-xs bg-gray-100 px-2 py-0.5 rounded-full">{{ $categories->sum('products_count') }}</span>
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->id, 'search' => request('search')]) }}"
                        class="flex items-center justify-between px-3 py-2 rounded-lg text-sm {{ request('category') == $category->id ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-gray-600 hover:bg-gray-50 transition' }}">
                        <span>{{ $category->name }}</span>
                        <span class="text-xs bg-gray-100 px-2 py-0.5 rounded-full">{{ $category->products_count }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex-1 min-w-0">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                @if(request('category') && $categories->firstWhere('id', request('category')))
                    {{ $categories->firstWhere('id', request('category'))->name }}
                @elseif(request('search'))
                    Hasil Pencarian: "{{ request('search') }}"
                @else
                    Semua Produk
                @endif
            </h2>
            <form method="GET" action="{{ route('products.index') }}" class="w-full sm:w-auto">
                <div class="flex items-center gap-2">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <div class="relative flex-1 sm:flex-none">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                            class="w-full sm:w-64 border border-gray-300 rounded-lg pl-10 pr-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2.5 rounded-lg hover:bg-indigo-700 transition text-sm font-medium">Cari</button>
                </div>
            </form>
        </div>

        @if($products->isEmpty())
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                <div class="w-20 h-20 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <p class="text-gray-500 text-lg">Produk tidak ditemukan.</p>
                <a href="{{ route('products.index') }}" class="mt-4 inline-block text-indigo-600 hover:underline">Reset filter</a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                @foreach($products as $product)
                    <div class="group bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col">
                        <a href="{{ route('products.show', $product) }}" class="relative overflow-hidden">
                            <div class="h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                @if($product->image)
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                @endif
                            </div>
                            @if($product->stock < 1)
                                <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                                    <span class="bg-red-500 text-white px-4 py-1.5 rounded-full text-sm font-bold">Stok Habis</span>
                                </div>
                            @endif
                        </a>
                        <div class="p-4 flex flex-col flex-1">
                            @if($product->category)
                                <span class="text-xs font-medium text-purple-600 bg-purple-50 px-2 py-0.5 rounded-full inline-block w-fit mb-1.5">{{ $product->category->name }}</span>
                            @endif
                            <a href="{{ route('products.show', $product) }}" class="text-sm font-semibold text-gray-800 hover:text-indigo-600 transition line-clamp-2 min-h-[2.5rem]">
                                {{ $product->name }}
                            </a>
                            <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100">
                                <span class="text-lg font-bold text-indigo-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="text-xs text-gray-400 {{ $product->stock < 1 ? 'text-red-400' : '' }}">
                                    <svg class="w-3.5 h-3.5 inline mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                    {{ $product->stock > 0 ? 'Stok: ' . $product->stock : 'Habis' }}
                                </span>
                            </div>
                            <form action="{{ route('cart.store') }}" method="POST" class="mt-3">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit"
                                    class="w-full py-2.5 rounded-lg text-sm font-semibold transition-all duration-300 {{ $product->stock > 0 ? 'bg-indigo-600 text-white hover:bg-indigo-700 shadow-sm hover:shadow-md' : 'bg-gray-200 text-gray-400 cursor-not-allowed' }}"
                                    {{ $product->stock < 1 ? 'disabled' : '' }}>
                                    @if($product->stock > 0)
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                                        Tambah ke Keranjang
                                    @else
                                        Stok Habis
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
