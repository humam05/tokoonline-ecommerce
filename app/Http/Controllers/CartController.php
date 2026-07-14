<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get();

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1|max:99',
        ]);

        $product = Product::findOrFail($data['product_id']);

        if ($product->stock < 1) {
            return redirect()->back()->with('error', 'Stok produk habis!');
        }

        $cartItem = CartItem::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ],
            [
                'quantity' => ($data['quantity'] ?? 1),
            ]
        );

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $cartItem->update($data);

        return redirect()->back()->with('success', 'Keranjang berhasil diperbarui!');
    }

    public function destroy(CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->delete();

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang!');
    }
}
