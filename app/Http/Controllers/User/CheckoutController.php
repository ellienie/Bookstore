<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use RuntimeException;

class CheckoutController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('user.cart.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('user.checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'address' => [
                'required',
                'string',
                'min:10',
                'max:1000',
            ],
            'payment_method' => [
                'required',
                'in:cod',
            ],
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('user.cart.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        try {
            $order = DB::transaction(function () use ($cart, $validated) {
                $items = [];
                $total = 0;

                foreach ($cart as $cartItem) {
                    $book = Book::query()
                        ->lockForUpdate()
                        ->find($cartItem['book_id']);

                    if (! $book) {
                        throw new RuntimeException(
                            'Salah satu buku sudah tidak tersedia.'
                        );
                    }

                    $quantity = (int) $cartItem['quantity'];

                    if ($quantity < 1) {
                        throw new RuntimeException(
                            'Jumlah buku tidak valid.'
                        );
                    }

                    if ($book->stock < $quantity) {
                        throw new RuntimeException(
                            'Stok buku "' . $book->title . '" tidak mencukupi.'
                        );
                    }

                    $price = (float) $book->price;
                    $subtotal = $price * $quantity;

                    $total += $subtotal;

                    $items[] = [
                        'book' => $book,
                        'quantity' => $quantity,
                        'price' => $price,
                        'subtotal' => $subtotal,
                    ];
                }

                $order = Order::create([
                    'user_id' => auth()->id(),
                    'order_number' => $this->generateOrderNumber(),
                    'total_amount' => $total,
                    'address' => $validated['address'],
                    'payment_method' => $validated['payment_method'],
                    'status' => 'pending',
                ]);

                foreach ($items as $item) {
                    $book = $item['book'];

                    $order->items()->create([
                        'book_id' => $book->id,
                        'book_title' => $book->title,
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'subtotal' => $item['subtotal'],
                    ]);

                    $book->decrement('stock', $item['quantity']);
                }

                return $order;
            });
        } catch (RuntimeException $exception) {
            return redirect()
                ->route('user.cart.index')
                ->with('error', $exception->getMessage());
        }

        session()->forget('cart');

        return redirect()
            ->route('user.checkout.success', $order);
    }

    public function success(Order $order): View
    {
        abort_if(
            $order->user_id !== auth()->id(),
            403
        );

        $order->load('items');

        return view('user.checkout.success', compact('order'));
    }

    private function generateOrderNumber(): string
    {
        do {
            $number = 'ORD-' .
                now()->format('YmdHis') .
                '-' .
                Str::upper(Str::random(5));
        } while (
            Order::where('order_number', $number)->exists()
        );

        return $number;
    }
}