@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Checkout</h1>

<div class="grid lg:grid-cols-5 gap-6">
    <div class="lg:col-span-3 space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Ringkasan Pesanan</h2>
            <div class="space-y-3">
                @foreach($cartItems as $item)
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center shrink-0 overflow-hidden">
                                @if($item->product->image)
                                    <img src="{{ $item->product->image_url }}" alt="" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <p class="font-medium text-gray-800 text-sm truncate">{{ $item->product->name }}</p>
                                <p class="text-xs text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <p class="font-semibold text-gray-800 shrink-0 ml-3">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-between items-center mt-4 pt-4 border-t-2 border-gray-200">
                <span class="text-lg font-bold text-gray-800">Total</span>
                <span class="text-2xl font-bold text-indigo-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Alamat Pengiriman</h2>
            <form method="POST" action="{{ route('orders.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Alamat Lengkap</label>
                    <textarea name="shipping_address" rows="2" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('shipping_address') border-red-500 @enderror"
                        placeholder="Jl. Contoh No. 123, RT/RW">{{ old('shipping_address') }}</textarea>
                    @error('shipping_address') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Kota/Kabupaten</label>
                        <input type="text" name="city" value="{{ old('city') }}" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('city') border-red-500 @enderror"
                            placeholder="Jakarta">
                        @error('city') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Kode Pos</label>
                        <input type="text" name="postal_code" value="{{ old('postal_code') }}" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('postal_code') border-red-500 @enderror"
                            placeholder="12345">
                        @error('postal_code') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nomor Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('phone') border-red-500 @enderror"
                        placeholder="081234567890">
                    @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Catatan (opsional)</label>
                    <textarea name="notes" rows="2" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('notes') border-red-500 @enderror" placeholder="Catatan untuk kurir">{{ old('notes') }}</textarea>
                    @error('notes') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-emerald-500 to-green-600 text-white py-3.5 rounded-xl hover:from-emerald-600 hover:to-green-700 transition-all font-semibold shadow-sm hover:shadow-md flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Konfirmasi Pesanan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
