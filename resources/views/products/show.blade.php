@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="max-w-6xl mx-auto relative">
    <div class="absolute top-20 left-0 w-64 h-64 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float"></div>
    <div class="absolute bottom-20 right-0 w-48 h-48 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float-delayed"></div>

    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6 relative z-10 animate-slide-up">
        <a href="{{ route('products.index') }}" class="hover:text-indigo-600 transition">Produk</a>
        @if($product->category)
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('products.index', ['category' => $product->category_id]) }}" class="hover:text-indigo-600 transition">{{ $product->category->name }}</a>
        @endif
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-800 font-medium truncate">{{ $product->name }}</span>
    </nav>

    <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-sm border border-gray-100 overflow-hidden card-glow animate-slide-up-2">
        <div class="md:flex">
            <div class="md:w-1/2 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 flex items-center justify-center p-8">
                @if($product->image)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-xl max-h-96 shadow-lg">
                @else
                    <div class="text-center">
                        <div class="w-32 h-32 mx-auto bg-white/50 rounded-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <p class="text-gray-400 mt-2">Tidak ada gambar</p>
                    </div>
                @endif
            </div>
            <div class="p-8 md:w-1/2 flex flex-col">
                <div class="flex-1">
                    @if($product->category)
                        <span class="text-xs font-medium text-purple-600 bg-purple-50 px-3 py-1 rounded-full">{{ $product->category->name }}</span>
                    @endif
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mt-2">{{ $product->name }}</h1>

                    <div class="flex items-baseline gap-3 mt-4">
                        <span class="text-3xl font-bold text-indigo-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        @if($product->stock > 0)
                            <span class="text-sm text-emerald-600 bg-emerald-50 px-2.5 py-0.5 rounded-full font-medium">Tersedia</span>
                        @else
                            <span class="text-sm text-red-600 bg-red-50 px-2.5 py-0.5 rounded-full font-medium">Stok Habis</span>
                        @endif
                    </div>

                    <div class="flex items-center gap-2 mt-2 text-sm text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        Stok: <span class="font-medium text-gray-700">{{ $product->stock }}</span>
                    </div>

                    <div class="mt-6 p-5 bg-gradient-to-br from-gray-50 to-indigo-50/50 rounded-xl border border-indigo-100/50">
                        <h3 class="font-semibold text-gray-800 mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Deskripsi
                        </h3>
                        <p class="text-gray-600 leading-relaxed">{{ $product->description ?? 'Tidak ada deskripsi untuk produk ini.' }}</p>
                    </div>
                </div>

                @if($product->stock > 0)
                    <form action="{{ route('cart.store') }}" method="POST" class="mt-6 pt-6 border-t border-gray-100">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="flex items-center gap-4 mb-4">
                            <label class="text-sm font-medium text-gray-700">Jumlah:</label>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="px-3 py-2 hover:bg-gray-100 transition text-gray-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg></button>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-16 text-center border-x border-gray-300 py-2 focus:outline-none">
                                <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="px-3 py-2 hover:bg-gray-100 transition text-gray-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg></button>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 text-white py-3.5 rounded-xl hover:from-indigo-700 hover:via-purple-700 hover:to-pink-600 transition-all font-semibold shadow-lg shadow-indigo-200 hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 btn-shimmer flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                            Tambah ke Keranjang
                        </button>
                    </form>
                @else
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <p class="text-center text-red-500 font-semibold bg-red-50 rounded-xl py-3">Maaf, produk ini sedang habis.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if($relatedProducts->isNotEmpty())
        <div class="mt-12 animate-slide-up-3">
            <h2 class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-6">Produk Terkait</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
                @foreach($relatedProducts as $related)
                    <div class="group bg-white/80 backdrop-blur-xl rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 card-glow-hover">
                        <a href="{{ route('products.show', $related) }}">
                            <div class="h-36 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                @if($related->image)
                                    <img src="{{ $related->image_url }}" alt="" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                @endif
                            </div>
                        </a>
                        <div class="p-3">
                            <a href="{{ route('products.show', $related) }}" class="text-sm font-semibold text-gray-800 hover:text-indigo-600 transition line-clamp-1">{{ $related->name }}</a>
                            <p class="text-sm font-bold text-indigo-600 mt-1">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="mt-6 relative z-10">
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-medium transition group">
            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke daftar produk
        </a>
    </div>
</div>
@endsection
