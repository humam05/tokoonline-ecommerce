@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
<div class="relative">
    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float"></div>
    <div class="absolute bottom-0 left-0 w-56 h-56 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float-delayed"></div>

    <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-6 relative z-10 animate-slide-up">Pesanan Saya</h1>

    @if($orders->isEmpty())
        <div class="bg-white/80 backdrop-blur-xl rounded-xl shadow-sm border border-gray-100 p-12 text-center relative z-10 animate-slide-up">
            <div class="w-24 h-24 mx-auto bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-4">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <p class="text-gray-500 text-lg mb-2">Belum ada pesanan.</p>
            <p class="text-gray-400 text-sm mb-6">Ayo belanja sekarang dan buat pesanan pertamamu!</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl hover:from-indigo-700 hover:to-purple-700 transition shadow-sm font-medium btn-shimmer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Mulai Belanja
            </a>
        </div>
    @else
        <div class="space-y-4 relative z-10">
            @foreach($orders as $index => $order)
                <div class="bg-white/80 backdrop-blur-xl rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition card-glow-hover" style="animation: slide-up 0.6s ease-out {{ $index * 0.08 }}s both;">
                    <div class="flex flex-col sm:flex-row justify-between items-start gap-3 mb-4">
                        <div>
                            <p class="text-sm font-medium text-indigo-600">{{ $order->invoice ?? '#' . $order->id }}</p>
                            <p class="text-xs text-gray-400">{{ $order->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-medium
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

                    <div class="border-t border-gray-100 pt-4 space-y-2">
                        @foreach($order->items as $item)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">{{ $item->product->name }} <span class="text-gray-400">x{{ $item->quantity }}</span></span>
                                <span class="font-medium text-gray-800">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-100 pt-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                        <a href="{{ route('orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-700 font-medium text-sm inline-flex items-center gap-1 hover:gap-2 transition-all">
                            Detail Pesanan
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <span class="font-bold text-lg bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection