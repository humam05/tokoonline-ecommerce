@extends('layouts.app')

@section('title', 'Kelola Pesanan')

@section('content')
<div class="flex gap-6">
    <aside class="w-64 shrink-0">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <h2 class="font-bold text-lg text-gray-800 mb-4">Admin Panel</h2>
            <nav class="space-y-1">
                <x-admin.sidebar active="orders" />
            </nav>
        </div>
    </aside>

    <main class="flex-1 min-w-0">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Kelola Pesanan</h1>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Invoice</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Pelanggan</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Total</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tanggal</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($orders as $order)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm font-medium text-indigo-600">{{ $order->invoice }}</td>
                            <td class="px-4 py-3">
                                <p class="font-medium text-gray-800">{{ $order->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $order->user->email }}</p>
                            </td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-center">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-medium
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                    @elseif($order->status === 'completed') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-indigo-600 hover:bg-indigo-50 p-1.5 rounded inline-block transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($orders->isEmpty())
                <div class="p-8 text-center text-gray-500">Belum ada pesanan.</div>
            @endif
        </div>

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </main>
</div>
@endsection
