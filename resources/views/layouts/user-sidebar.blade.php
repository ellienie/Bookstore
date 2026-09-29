<aside class="h-screen w-52 shrink-0 border-r border-[#e7e7e1] bg-[#f6f6f1]">
    <div class="flex h-full flex-col">

        <div class="shrink-0 border-b border-[#e7e7e1] px-5 py-5">
            <a href="{{ route('user.dashboard') }}" class="block">
                <div class="text-base font-bold tracking-tight text-gray-900">
                    BookStore
                </div>

                <div class="mt-1 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#71806f]">
                    Customer Area
                </div>
            </a>
        </div>

        <nav class="min-h-0 flex-1 overflow-y-auto px-3 py-4">
            <div class="space-y-1">

                <a
                    href="{{ route('user.dashboard') }}"
                    class="flex items-center rounded-lg px-3 py-2 text-sm font-medium transition
                    {{ request()->routeIs('user.dashboard')
                        ? 'bg-[#e8eee5] text-gray-900'
                        : 'text-gray-600 hover:bg-white hover:text-gray-900' }}"
                >
                    Dashboard
                </a>

                <a
                    href="{{ route('user.books.index') }}"
                    class="flex items-center rounded-lg px-3 py-2 text-sm font-medium transition
                    {{ request()->routeIs('user.books.*')
                        ? 'bg-[#e8eee5] text-gray-900'
                        : 'text-gray-600 hover:bg-white hover:text-gray-900' }}"
                >
                    Buku
                </a>

                <a
                    href="{{ route('user.cart.index') }}"
                    class="flex items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition
                    {{ request()->routeIs('user.cart.*')
                        ? 'bg-[#e8eee5] text-gray-900'
                        : 'text-gray-600 hover:bg-white hover:text-gray-900' }}"
                >
                    <span>Keranjang</span>

                    @if (($cartItemsCount ?? 0) > 0)
                        <span
                            class="inline-flex min-w-[20px] items-center justify-center rounded-full bg-[#71806f] px-1.5 py-0.5 text-[10px] font-bold text-white"
                        >
                            {{ $cartItemsCount ?? 0 }}
                        </span>
                    @endif
                </a>

                <a
                    href="{{ route('user.orders.index') }}"
                    class="flex items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition
                    {{ request()->routeIs('user.orders.*')
                        ? 'bg-[#e8eee5] text-gray-900'
                        : 'text-gray-600 hover:bg-white hover:text-gray-900' }}"
                >
                    <span>Pesanan Saya</span>

                    @if (($activeOrdersCount ?? 0) > 0)
                        <span
                            class="inline-flex min-w-[20px] items-center justify-center rounded-full bg-[#71806f] px-1.5 py-0.5 text-[10px] font-bold text-white"
                        >
                            {{ $activeOrdersCount ?? 0 }}
                        </span>
                    @endif
                </a>

                <a
                    href="{{ route('user.contact.index') }}"
                    class="flex items-center rounded-lg px-3 py-2 text-sm font-medium transition
                    {{ request()->routeIs('user.contact.*')
                        ? 'bg-[#e8eee5] text-gray-900'
                        : 'text-gray-600 hover:bg-white hover:text-gray-900' }}"
                >
                    Contact Admin
                </a>

            </div>
        </nav>

        <div class="shrink-0 border-t border-[#e7e7e1] p-3">
            <div class="rounded-lg bg-white p-3 ring-1 ring-[#e7e7e1]">

                <div class="truncate text-sm font-semibold text-gray-900">
                    {{ Auth::user()->name }}
                </div>

                <div class="mt-0.5 truncate text-[11px] text-gray-500">
                    {{ Auth::user()->email }}
                </div>

                <div class="mt-3 grid grid-cols-2 gap-2">

                    <a
                        href="{{ route('profile.edit') }}"
                        class="rounded-md px-2 py-2 text-center text-xs font-medium
                        {{ request()->routeIs('profile.edit')
                            ? 'bg-[#e8eee5] text-gray-900'
                            : 'bg-[#f3f3ee] text-gray-700 hover:bg-[#e9e9e3]' }}"
                    >
                        Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            type="submit"
                            class="w-full rounded-md bg-gray-900 px-2 py-2 text-xs font-semibold text-white hover:bg-gray-800"
                        >
                            Logout
                        </button>
                    </form>

                </div>

            </div>
        </div>

    </div>
</aside>