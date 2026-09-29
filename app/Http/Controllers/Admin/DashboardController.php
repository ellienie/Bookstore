<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalBooks = Book::count();

        $totalCategories = Category::count();

        $totalUsers = User::where('role', 'user')->count();

        $totalOrders = Order::count();

        $pendingOrders = Order::where('status', 'pending')->count();

        $unreadMessages = ContactMessage::where('is_read', false)->count();

        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        $recentMessages = ContactMessage::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBooks',
            'totalCategories',
            'totalUsers',
            'totalOrders',
            'pendingOrders',
            'unreadMessages',
            'recentOrders',
            'recentMessages',
        ));
    }
}