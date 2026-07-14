@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->id)

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

    <main class="flex-1 min-w-0 max-w-4xl">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Detail Pesanan</h1>
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
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="font-bold text-gray-800 mb-3">Informasi Pelanggan</h2>
                <p class="text-gray-700"><span class="font-medium">Nama:</span> {{ $order->user->name }}</p>
                <p class="text-gray-700"><span class="font-medium">Email:</span> {{ $order->user->email }}</p>
                <p class="text-gray-700"><span class="font-medium">Telepon:</span> {{ $order->phone ?? '-' }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="font-bold text-gray-800 mb-3">Informasi Pengiriman</h2>
                <p class="text-gray-700">{{ $order->shipping_address ?? '-' }}</p>
                <p class="text-gray-700"><span class="font-medium">Kota:</span> {{ $order->city ?? '-' }}</p>
                <p class="text-gray-700"><span class="font-medium">Kode Pos:</span> {{ $order->postal_code ?? '-' }}</p>
                @if($order->notes)
                    <p class="text-gray-700 mt-2"><span class="font-medium">Catatan:</span> {{ $order->notes }}</p>
                @endif
                <p class="text-gray-500 text-sm mt-2">Dibuat: {{ $order->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Produk</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Harga</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Jumlah</th>
                        <th class="px-4 py-3 text-right text-sm font-semibold text-gray-600">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($order->items as $item)
                        <tr>
                            <td class="px-4 py-3 text-gray-800">{{ $item->product->name }}</td>
                            <td class="px-4 py-3 text-center text-gray-700">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-center text-gray-700">{{ $item->quantity }}</td>
                            <td class="px-4 py-3 text-right font-medium text-gray-800">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="border-t-2 border-gray-200 bg-gray-50">
                    <tr>
                        <td colspan="3" class="px-4 py-3 font-bold text-right text-gray-800">Total:</td>
                        <td class="px-4 py-3 font-bold text-right text-indigo-600 text-lg">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="font-bold text-gray-800 mb-4">Update Status Pesanan</h2>
            <form method="POST" action="{{ route('admin.orders.status', $order) }}" class="flex items-center gap-4">
                @csrf
                @method('PUT')
                <select name="status" class="border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg hover:bg-indigo-700 transition font-medium">Update Status</button>
            </form>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.orders.index') }}" class="text-indigo-600 hover:underline">&larr; Kembali</a>
        </div>
    </main>
</div>
@endsection
