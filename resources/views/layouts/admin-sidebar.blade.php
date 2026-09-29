<aside class="h-screen w-52 shrink-0 border-r border-[#e7e7e1] bg-[#f6f6f1]">
    <div class="flex h-full flex-col">

        <div class="shrink-0 border-b border-[#e7e7e1] px-5 py-5">
            <a href="{{ route('admin.dashboard') }}" class="block">
                <div class="text-base font-bold tracking-tight text-gray-900">
                    BookStore
                </div>

                <div class="mt-1 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#71806f]">
                    Admin Panel
                </div>
            </a>
        </div>

        <nav class="min-h-0 flex-1 overflow-y-auto px-3 py-4">
            <div class="space-y-1">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center rounded-lg px-3 py-2 text-sm font-medium transition
                    {{ request()->routeIs('admin.dashboard')
                        ? 'bg-[#e8eee5] text-gray-900'
                        : 'text-gray-600 hover:bg-white hover:text-gray-900' }}"
                >
                    Dashboard
                </a>

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="flex items-center rounded-lg px-3 py-2 text-sm font-medium transition
                    {{ request()->routeIs('admin.categories.*')
                        ? 'bg-[#e8eee5] text-gray-900'
                        : 'text-gray-600 hover:bg-white hover:text-gray-900' }}"
                >
                    Kategori
                </a>

                <a
                    href="{{ route('admin.books.index') }}"
                    class="flex items-center rounded-lg px-3 py-2 text-sm font-medium transition
                    {{ request()->routeIs('admin.books.*')
                        ? 'bg-[#e8eee5] text-gray-900'
                        : 'text-gray-600 hover:bg-white hover:text-gray-900' }}"
                >
                    Buku
                </a>

                <a
                    href="{{ route('admin.users.index') }}"
                    class="flex items-center rounded-lg px-3 py-2 text-sm font-medium transition
                    {{ request()->routeIs('admin.users.*')
                        ? 'bg-[#e8eee5] text-gray-900'
                        : 'text-gray-600 hover:bg-white hover:text-gray-900' }}"
                >
                    User
                </a>

                <a
                    href="{{ route('admin.orders.index') }}"
                    class="flex items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition
                    {{ request()->routeIs('admin.orders.*')
                        ? 'bg-[#e8eee5] text-gray-900'
                        : 'text-gray-600 hover:bg-white hover:text-gray-900' }}"
                >
                    <span>Pesanan</span>

                    @if (($pendingOrdersCount ?? 0) > 0)
                        <span
                            class="inline-flex min-w-[20px] items-center justify-center rounded-full bg-[#71806f] px-1.5 py-0.5 text-[10px] font-bold text-white"
                        >
                            {{ $pendingOrdersCount ?? 0 }}
                        </span>
                    @endif
                </a>

                <a
                    href="{{ route('admin.messages.index') }}"
                    class="flex items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition
                    {{ request()->routeIs('admin.messages.*')
                        ? 'bg-[#e8eee5] text-gray-900'
                        : 'text-gray-600 hover:bg-white hover:text-gray-900' }}"
                >
                    <span>Pesan</span>

                    @if (($unreadMessagesCount ?? 0) > 0)
                        <span
                            class="inline-flex min-w-[20px] items-center justify-center rounded-full bg-[#71806f] px-1.5 py-0.5 text-[10px] font-bold text-white"
                        >
                            {{ $unreadMessagesCount ?? 0 }}
                        </span>
                    @endif
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