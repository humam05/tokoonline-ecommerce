@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="relative">
    <div class="absolute top-0 right-0 w-72 h-72 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float-delayed"></div>

    <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-6 relative z-10 animate-slide-up">Keranjang Belanja</h1>

    @if($cartItems->isEmpty())
        <div class="bg-white/80 backdrop-blur-xl rounded-xl shadow-sm border border-gray-100 p-12 text-center relative z-10 animate-slide-up">
            <div class="w-24 h-24 mx-auto bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-4">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
            </div>
            <p class="text-gray-500 text-lg mb-2">Keranjang belanja kosong.</p>
            <p class="text-gray-400 text-sm mb-6">Yuk, mulai belanja produk-produk menarik kami!</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl hover:from-indigo-700 hover:to-purple-700 transition shadow-sm font-medium btn-shimmer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Belanja Sekarang
            </a>
        </div>
    @else
        <div class="bg-white/80 backdrop-blur-xl rounded-xl shadow-sm border border-gray-100 overflow-hidden relative z-10 animate-slide-up">
            <div class="hidden md:block">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-gray-50 to-indigo-50/50">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Produk</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600">Harga</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600">Jumlah</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600">Subtotal</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($cartItems as $item)
                            <tr class="hover:bg-indigo-50/30 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center shrink-0 overflow-hidden shadow-sm">
                                            @if($item->product->image)
                                                <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                            @else
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                            @endif
                                        </div>
                                        <div>
                                            <a href="{{ route('products.show', $item->product) }}" class="font-semibold text-gray-800 hover:text-indigo-600 transition">
                                                {{ $item->product->name }}
                                            </a>
                                            <p class="text-xs text-gray-400 mt-0.5">Stok: {{ $item->product->stock }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center text-gray-700 font-medium">Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center justify-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                            <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="px-2 py-1.5 hover:bg-gray-100 transition text-gray-600 text-sm">−</button>
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="99"
                                                class="w-14 text-center border-x border-gray-300 py-1.5 text-sm focus:outline-none">
                                            <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="px-2 py-1.5 hover:bg-gray-100 transition text-gray-600 text-sm">+</button>
                                        </div>
                                        <button type="submit" class="text-indigo-600 hover:bg-indigo-50 p-1.5 rounded transition text-sm font-medium">Update</button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 text-center font-bold text-gray-800">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:bg-red-50 p-2 rounded-lg transition" onclick="return confirm('Hapus item ini?')">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="md:hidden divide-y divide-gray-100">
                @foreach($cartItems as $item)
                    <div class="p-4 hover:bg-indigo-50/30 transition">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center shrink-0 overflow-hidden shadow-sm">
                                @if($item->product->image)
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                @endif
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">{{ $item->product->name }}</p>
                                <p class="text-sm text-gray-500">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                            </div>
                            <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 p-1.5 hover:bg-red-50 rounded-lg transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                            </form>
                        </div>
                        <div class="flex items-center justify-between">
                            <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PUT')
                                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                    <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="px-2 py-1 hover:bg-gray-100 transition text-gray-600 text-sm">−</button>
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="99"
                                        class="w-12 text-center border-x border-gray-300 py-1 text-sm focus:outline-none">
                                    <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="px-2 py-1 hover:bg-gray-100 transition text-gray-600 text-sm">+</button>
                                </div>
                                <button type="submit" class="text-indigo-600 text-sm font-medium hover:bg-indigo-50 p-1.5 rounded transition">Update</button>
                            </form>
                            <p class="font-bold text-gray-800">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-6 bg-white/80 backdrop-blur-xl rounded-xl shadow-sm border border-gray-100 p-6 relative z-10 card-glow animate-slide-up-2">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div>
                    <p class="text-sm text-gray-500">Total Belanja</p>
                    <span class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <a href="{{ route('checkout') }}" class="w-full sm:w-auto text-center bg-gradient-to-r from-emerald-500 to-green-600 text-white px-8 py-3.5 rounded-xl hover:from-emerald-600 hover:to-green-700 transition-all font-semibold shadow-lg shadow-emerald-200 hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 btn-shimmer flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    Lanjut ke Checkout
                </a>
            </div>
        </div>
    @endif
</div>
@endsection