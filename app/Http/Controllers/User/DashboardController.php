<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\ContactMessage;
use App\Models\Order;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $userId = auth()->id();

        $cart = session()->get('cart', []);

        $cartItemsCount = collect($cart)->sum(function ($item) {
            return (int) ($item['quantity'] ?? 0);
        });

        $activeOrdersCount = Order::where('user_id', $userId)
            ->whereIn('status', [
                'pending',
                'processing',
            ])
            ->count();

        $totalOrders = Order::where('user_id', $userId)
            ->count();

        $recentOrders = Order::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        $recentBooks = Book::with('category')
            ->latest()
            ->take(4)
            ->get();

        $recentMessages = ContactMessage::where('user_id', $userId)
            ->latest()
            ->take(3)
            ->get();

        return view('user.dashboard', compact(
            'cartItemsCount',
            'activeOrdersCount',
            'totalOrders',
            'recentOrders',
            'recentBooks',
            'recentMessages',
        ));
    }
}