@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
<div class="max-w-4xl mx-auto">
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('orders.index') }}" class="hover:text-indigo-600 transition">Pesanan</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-800 font-medium">{{ $order->invoice ?? '#' . $order->id }}</span>
    </nav>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Detail Pesanan</h1>
            <p class="text-sm text-indigo-600 font-medium mt-1">{{ $order->invoice ?? '#' . $order->id }}</p>
        </div>
        <span class="inline-block px-4 py-1.5 rounded-full text-sm font-medium
            @if($order->status === 'pending') bg-yellow-100 text-yellow-800
            @elseif($order->status === 'processing') bg-blue-100 text-blue-800
            @elseif($order->status === 'completed') bg-green-100 text-green-800
            @else bg-red-100 text-red-800
            @endif">
            @if($order->status === 'pending') Menunggu
            @elseif($order->status === 'processing') Diproses
            @elseif($order->status === 'completed') Selesai
            @else Dibatalkan
            @endif
        </span>
    </div>

    <div class="grid md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="font-bold text-gray-800 mb-3">Informasi Pengiriman</h2>
            <div class="space-y-2 text-sm">
                <p class="text-gray-700"><span class="font-medium text-gray-800">Alamat:</span> {{ $order->shipping_address }}</p>
                <p class="text-gray-700"><span class="font-medium text-gray-800">Kota:</span> {{ $order->city ?? '-' }}</p>
                <p class="text-gray-700"><span class="font-medium text-gray-800">Kode Pos:</span> {{ $order->postal_code ?? '-' }}</p>
                <p class="text-gray-700"><span class="font-medium text-gray-800">Telepon:</span> {{ $order->phone }}</p>
                @if($order->notes)
                    <p class="text-gray-700"><span class="font-medium text-gray-800">Catatan:</span> {{ $order->notes }}</p>
                @endif
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="font-bold text-gray-800 mb-3">Informasi Pesanan</h2>
            <div class="space-y-2 text-sm">
                <p class="text-gray-700"><span class="font-medium text-gray-800">Invoice:</span> <span class="text-indigo-600 font-medium">{{ $order->invoice }}</span></p>
                <p class="text-gray-700"><span class="font-medium text-gray-800">Tanggal:</span> {{ $order->created_at->format('d M Y H:i') }}</p>
                <p class="text-gray-700"><span class="font-medium text-gray-800">Status:</span>
                    <span class="font-medium
                        @if($order->status === 'pending') text-yellow-600
                        @elseif($order->status === 'processing') text-blue-600
                        @elseif($order->status === 'completed') text-green-600
                        @else text-red-600
                        @endif">
                        @if($order->status === 'pending') Menunggu
                        @elseif($order->status === 'processing') Diproses
                        @elseif($order->status === 'completed') Selesai
                        @else Dibatalkan
                        @endif
                    </span>
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
            <h2 class="font-bold text-gray-800">Item Pesanan</h2>
        </div>
        <div class="divide-y divide-gray-100">
            @foreach($order->items as $item)
                <div class="px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center shrink-0 overflow-hidden">
                            @if($item->product->image)
                                <img src="{{ $item->product->image_url }}" alt="" class="w-full h-full object-cover">
                            @else
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            @endif
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ $item->product->name }}</p>
                            <p class="text-xs text-gray-500">Rp {{ number_format($item->price, 0, ',', '.') }} x {{ $item->quantity }}</p>
                        </div>
                    </div>
                    <p class="font-semibold text-gray-800">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
            <span class="font-bold text-gray-800">Total</span>
            <span class="text-2xl font-bold text-indigo-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('orders.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-medium transition group">
            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke daftar pesanan
        </a>
    </div>
</div>
@endsection
