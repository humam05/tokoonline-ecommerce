@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
<div class="flex flex-col lg:flex-row gap-6">
    <aside class="w-full lg:w-64 shrink-0">
        <div class="bg-white/80 backdrop-blur-xl rounded-xl shadow-sm border border-gray-100 p-4">
            <h2 class="font-bold text-lg bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-4">Admin Panel</h2>
            <nav class="space-y-1">
                <x-admin.sidebar active="orders" />
            </nav>
        </div>
    </aside>

    <main class="flex-1 min-w-0 max-w-4xl">
        <div class="flex items-center justify-between mb-6 animate-slide-up">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Detail Pesanan</h1>
                <p class="text-sm text-indigo-600 font-medium mt-1">{{ $order->invoice }}</p>
            </div>
            <span class="inline-block px-4 py-1.5 rounded-full text-sm font-medium
                @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                @elseif($order->status === 'completed') bg-green-100 text-green-800
                @else bg-red-100 text-red-800
                @endif">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white/80 backdrop-blur-xl rounded-xl shadow-sm border border-gray-100 p-6 card-glow-hover animate-slide-up-2">
                <h2 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Informasi Pelanggan
                </h2>
                <p class="text-gray-700"><span class="font-medium">Nama:</span> {{ $order->user->name }}</p>
                <p class="text-gray-700"><span class="font-medium">Email:</span> {{ $order->user->email }}</p>
                <p class="text-gray-700"><span class="font-medium">Telepon:</span> {{ $order->phone ?? '-' }}</p>
            </div>
            <div class="bg-white/80 backdrop-blur-xl rounded-xl shadow-sm border border-gray-100 p-6 card-glow-hover animate-slide-up-3">
                <h2 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Informasi Pengiriman
                </h2>
                <p class="text-gray-700">{{ $order->shipping_address ?? '-' }}</p>
                <p class="text-gray-700"><span class="font-medium">Kota:</span> {{ $order->city ?? '-' }}</p>
                <p class="text-gray-700"><span class="font-medium">Kode Pos:</span> {{ $order->postal_code ?? '-' }}</p>
                @if($order->notes)
                    <p class="text-gray-700 mt-2"><span class="font-medium">Catatan:</span> {{ $order->notes }}</p>
                @endif
                <p class="text-gray-500 text-sm mt-2">Dibuat: {{ $order->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>

        <div class="bg-white/80 backdrop-blur-xl rounded-xl shadow-sm border border-gray-100 overflow-x-auto mb-6 card-glow-hover animate-slide-up-3">
            <table class="w-full min-w-[500px]">
                <thead class="bg-gradient-to-r from-gray-50 to-indigo-50/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Produk</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Harga</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Jumlah</th>
                        <th class="px-4 py-3 text-right text-sm font-semibold text-gray-600">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($order->items as $item)
                        <tr class="hover:bg-indigo-50/30 transition">
                            <td class="px-4 py-3 text-gray-800">{{ $item->product->name }}</td>
                            <td class="px-4 py-3 text-center text-gray-700">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-center text-gray-700">{{ $item->quantity }}</td>
                            <td class="px-4 py-3 text-right font-medium text-gray-800">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="border-t-2 border-gray-200 bg-gradient-to-r from-gray-50 to-indigo-50/50">
                    <tr>
                        <td colspan="3" class="px-4 py-3 font-bold text-right text-gray-800">Total:</td>
                        <td class="px-4 py-3 font-bold text-right text-indigo-600 text-lg">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="bg-white/80 backdrop-blur-xl rounded-xl shadow-sm border border-gray-100 p-6 card-glow-hover">
            <h2 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Update Status Pesanan
            </h2>
            <form method="POST" action="{{ route('admin.orders.status', $order) }}" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                @csrf
                @method('PUT')
                <select name="status" class="border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 bg-gray-50/50 focus:bg-white transition-all duration-300">
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2.5 rounded-xl hover:from-indigo-700 hover:to-purple-700 transition font-medium shadow-sm hover:shadow-md btn-shimmer">Update Status</button>
            </form>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.orders.index') }}" class="text-indigo-600 hover:text-indigo-700 font-medium transition inline-flex items-center gap-1 hover:gap-2">&larr; Kembali</a>
        </div>
    </main>
</div>
@endsection