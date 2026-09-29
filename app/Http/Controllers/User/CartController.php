<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = session()->get('cart', []);

        return view('user.cart.index', compact('cart'));
    }

    public function store(Book $book): RedirectResponse
    {
        if ($book->stock <= 0) {
            return back()->with('error', 'Stok buku habis.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$book->id])) {
            if ($cart[$book->id]['quantity'] >= $book->stock) {
                return back()->with('error', 'Jumlah melebihi stok tersedia.');
            }

            $cart[$book->id]['quantity']++;
        } else {
            $cart[$book->id] = [
                'book_id' => $book->id,
                'title' => $book->title,
                'price' => $book->price,
                'cover_image' => $book->cover_image,
                'stock' => $book->stock,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()
            ->route('user.cart.index')
            ->with('success', 'Buku berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, Book $book): RedirectResponse
    {
        $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:' . $book->stock,
            ],
        ]);

        $cart = session()->get('cart', []);

        if (! isset($cart[$book->id])) {
            return redirect()
                ->route('user.cart.index')
                ->with('error', 'Buku tidak ditemukan di keranjang.');
        }

        $cart[$book->id]['quantity'] = $request->integer('quantity');

        session()->put('cart', $cart);

        return redirect()
            ->route('user.cart.index')
            ->with('success', 'Jumlah buku berhasil diperbarui.');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$book->id])) {
            unset($cart[$book->id]);

            session()->put('cart', $cart);
        }

        return redirect()
            ->route('user.cart.index')
            ->with('success', 'Buku berhasil dihapus dari keranjang.');
    }
}