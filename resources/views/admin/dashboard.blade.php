@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="flex gap-6">
    <aside class="w-64 shrink-0">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <h2 class="font-bold text-lg text-gray-800 mb-4">Admin Panel</h2>
            <nav class="space-y-1">
                <x-admin.sidebar active="dashboard" />
            </nav>
        </div>
    </aside>

    <main class="flex-1 min-w-0">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Produk</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalProducts }}</p>
                    </div>
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Pesanan</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalOrders }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total User</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalUsers }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Pendapatan</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="font-bold text-gray-800 mb-4">Pesanan Terbaru</h2>
                @if($recentOrders->isEmpty())
                    <p class="text-gray-500 text-sm">Belum ada pesanan.</p>
                @else
                    <div class="space-y-3">
                        @foreach($recentOrders as $order)
                            <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                                <div>
                                    <p class="text-sm font-medium text-gray-800">#{{ $order->id }} - {{ $order->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</p>
                                </div>
                                <span class="text-xs px-2 py-1 rounded-full font-medium
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                    @elseif($order->status === 'completed') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="mt-4 inline-block text-sm text-indigo-600 hover:underline">Lihat semua &rarr;</a>
                @endif
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="font-bold text-gray-800 mb-4">Pendapatan Bulanan ({{ date('Y') }})</h2>
                @if($revenueByMonth->isEmpty())
                    <p class="text-gray-500 text-sm">Belum ada data pendapatan.</p>
                @else
                    <div class="space-y-2">
                        @foreach($revenueByMonth as $month => $total)
                            <div class="flex items-center gap-3">
                                <span class="text-sm text-gray-600 w-20">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</span>
                                <div class="flex-1 bg-gray-100 rounded-full h-2.5">
                                    <div class="bg-indigo-500 h-2.5 rounded-full" style="width: {{ ($total / $revenueByMonth->max()) * 100 }}%"></div>
                                </div>
                                <span class="text-sm font-medium text-gray-700 w-28 text-right">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>
@endsection
