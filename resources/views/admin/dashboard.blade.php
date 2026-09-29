<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#71806f]">
                    Admin Panel
                </p>

                <h2 class="mt-1 text-xl font-semibold text-gray-900">
                    Dashboard
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Ringkasan aktivitas BookStore hari ini.
                </p>
            </div>

            <div class="flex gap-2">

                <a
                    href="{{ route('admin.categories.create') }}"
                    class="rounded-md bg-[#eef1ea] px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-[#dfe6dc]"
                >
                    + Kategori
                </a>

                <a
                    href="{{ route('admin.books.create') }}"
                    class="rounded-md bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-800"
                >
                    + Tambah Buku
                </a>

            </div>

        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-[1600px] px-5 sm:px-6 lg:px-8">

            {{-- WELCOME --}}
            <div class="mb-6 overflow-hidden rounded-2xl bg-[#eef1ea] ring-1 ring-[#e1e7de]">

                <div class="flex flex-col gap-6 px-6 py-7 lg:flex-row lg:items-center lg:justify-between">

                    <div>
                        <p class="text-sm font-medium text-[#71806f]">
                            Selamat datang kembali
                        </p>

                        <h3 class="mt-1 text-2xl font-bold tracking-tight text-gray-900">
                            {{ auth()->user()->name }}
                        </h3>

                        <p class="mt-2 max-w-2xl text-sm leading-6 text-gray-600">
                            Kelola katalog buku, pesanan pelanggan, pengguna,
                            dan pesan yang masuk melalui satu dashboard.
                        </p>
                    </div>

                    <div class="rounded-xl bg-white/70 px-5 py-4 ring-1 ring-white">
                        <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                            Status Akun
                        </p>

                        <div class="mt-2 flex items-center gap-2">
                            <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>

                            <span class="text-sm font-semibold text-gray-800">
                                Administrator
                            </span>
                        </div>
                    </div>

                </div>

            </div>

            {{-- STAT CARDS --}}
            <div class="grid grid-cols-2 gap-4 lg:grid-cols-3 2xl:grid-cols-6">

                <a
                    href="{{ route('admin.books.index') }}"
                    class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-[#e7e7e1] transition hover:-translate-y-0.5 hover:shadow-md"
                >
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                        Total Buku
                    </p>

                    <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900">
                        {{ $totalBooks }}
                    </p>

                    <p class="mt-2 text-xs text-[#71806f]">
                        Lihat katalog →
                    </p>
                </a>

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-[#e7e7e1] transition hover:-translate-y-0.5 hover:shadow-md"
                >
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                        Kategori
                    </p>

                    <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900">
                        {{ $totalCategories }}
                    </p>

                    <p class="mt-2 text-xs text-[#71806f]">
                        Kelola kategori →
                    </p>
                </a>

                <a
                    href="{{ route('admin.users.index') }}"
                    class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-[#e7e7e1] transition hover:-translate-y-0.5 hover:shadow-md"
                >
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                        User
                    </p>

                    <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900">
                        {{ $totalUsers }}
                    </p>

                    <p class="mt-2 text-xs text-[#71806f]">
                        User terdaftar →
                    </p>
                </a>

                <a
                    href="{{ route('admin.orders.index') }}"
                    class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-[#e7e7e1] transition hover:-translate-y-0.5 hover:shadow-md"
                >
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                        Total Pesanan
                    </p>

                    <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900">
                        {{ $totalOrders }}
                    </p>

                    <p class="mt-2 text-xs text-[#71806f]">
                        Semua pesanan →
                    </p>
                </a>

                <a
                    href="{{ route('admin.orders.index') }}"
                    class="rounded-xl bg-[#fffaf0] p-5 shadow-sm ring-1 ring-amber-100 transition hover:-translate-y-0.5 hover:shadow-md"
                >
                    <p class="text-xs font-medium uppercase tracking-wide text-amber-600">
                        Menunggu
                    </p>

                    <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900">
                        {{ $pendingOrders }}
                    </p>

                    <p class="mt-2 text-xs text-amber-600">
                        Pesanan pending
                    </p>
                </a>

                <a
                    href="{{ route('admin.messages.index') }}"
                    class="rounded-xl bg-[#f4f7f2] p-5 shadow-sm ring-1 ring-[#dfe6dc] transition hover:-translate-y-0.5 hover:shadow-md"
                >
                    <p class="text-xs font-medium uppercase tracking-wide text-[#71806f]">
                        Pesan Baru
                    </p>

                    <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900">
                        {{ $unreadMessages }}
                    </p>

                    <p class="mt-2 text-xs text-[#71806f]">
                        Belum dibaca
                    </p>
                </a>

            </div>

            {{-- RECENT ACTIVITY --}}
            <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-2">

                {{-- ORDERS --}}
                <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-[#e7e7e1]">

                    <div class="flex items-center justify-between border-b border-[#e7e7e1] px-6 py-4">

                        <div>
                            <h3 class="font-semibold text-gray-900">
                                Pesanan Terbaru
                            </h3>

                            <p class="mt-1 text-xs text-gray-500">
                                Aktivitas pesanan pelanggan terbaru.
                            </p>
                        </div>

                        <a
                            href="{{ route('admin.orders.index') }}"
                            class="text-xs font-semibold text-[#71806f] hover:text-gray-900"
                        >
                            Lihat Semua →
                        </a>

                    </div>

                    @if ($recentOrders->isEmpty())

                        <div class="px-6 py-12 text-center text-sm text-gray-500">
                            Belum ada pesanan.
                        </div>

                    @else

                        <div class="divide-y divide-gray-100">

                            @foreach ($recentOrders as $order)

                                <a
                                    href="{{ route('admin.orders.show', $order) }}"
                                    class="flex items-center justify-between gap-4 px-6 py-4 transition hover:bg-[#fafaf7]"
                                >

                                    <div class="min-w-0">

                                        <div class="flex items-center gap-2">

                                            <p class="truncate font-medium text-gray-900">
                                                {{ $order->user?->name ?? 'User' }}
                                            </p>

                                            @php
                                                $status = strtolower($order->status);
                                            @endphp

                                            @if ($status === 'pending')

                                                <span class="rounded-full bg-amber-100 px-2 py-0.5 text-[10px] font-semibold text-amber-700">
                                                    Pending
                                                </span>

                                            @elseif ($status === 'processing')

                                                <span class="rounded-full bg-blue-100 px-2 py-0.5 text-[10px] font-semibold text-blue-700">
                                                    Diproses
                                                </span>

                                            @elseif (in_array($status, ['completed', 'done', 'selesai']))

                                                <span class="rounded-full bg-green-100 px-2 py-0.5 text-[10px] font-semibold text-green-700">
                                                    Selesai
                                                </span>

                                            @elseif (in_array($status, ['cancelled', 'canceled']))

                                                <span class="rounded-full bg-red-100 px-2 py-0.5 text-[10px] font-semibold text-red-700">
                                                    Dibatalkan
                                                </span>

                                            @else

                                                <span class="rounded-full bg-gray-100 px-2 py-0.5 text-[10px] font-semibold text-gray-600">
                                                    {{ ucfirst($order->status) }}
                                                </span>

                                            @endif

                                        </div>

                                        <p class="mt-1 truncate text-sm text-gray-500">
                                            Pesanan terbaru dari pelanggan
                                        </p>

                                    </div>

                                    <div class="shrink-0 text-right">

                                        <p class="text-xs text-gray-400">
                                            {{ $order->created_at->format('d M Y') }}
                                        </p>

                                        <p class="mt-1 text-[11px] text-gray-400">
                                            {{ $order->created_at->format('H:i') }}
                                        </p>

                                    </div>

                                </a>

                            @endforeach

                        </div>

                    @endif

                </div>

                {{-- MESSAGES --}}
                <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-[#e7e7e1]">

                    <div class="flex items-center justify-between border-b border-[#e7e7e1] px-6 py-4">

                        <div>
                            <h3 class="font-semibold text-gray-900">
                                Pesan Terbaru
                            </h3>

                            <p class="mt-1 text-xs text-gray-500">
                                Pesan terbaru yang dikirim oleh user.
                            </p>
                        </div>

                        <a
                            href="{{ route('admin.messages.index') }}"
                            class="text-xs font-semibold text-[#71806f] hover:text-gray-900"
                        >
                            Lihat Semua →
                        </a>

                    </div>

                    @if ($recentMessages->isEmpty())

                        <div class="px-6 py-12 text-center text-sm text-gray-500">
                            Belum ada pesan.
                        </div>

                    @else

                        <div class="divide-y divide-gray-100">

                            @foreach ($recentMessages as $message)

                                <a
                                    href="{{ route('admin.messages.show', $message) }}"
                                    class="flex items-center justify-between gap-4 px-6 py-4 transition hover:bg-[#fafaf7]"
                                >

                                    <div class="min-w-0">

                                        <div class="flex items-center gap-2">

                                            <p class="truncate font-medium text-gray-900">
                                                {{ $message->subject }}
                                            </p>

                                            @if (! $message->is_read)
                                                <span class="h-2 w-2 shrink-0 rounded-full bg-[#71806f]"></span>
                                            @endif

                                        </div>

                                        <p class="mt-1 truncate text-sm text-gray-500">
                                            {{ $message->user?->name ?? 'User' }}
                                        </p>

                                    </div>

                                    <div class="shrink-0 text-right">

                                        @if (! $message->is_read)

                                            <span class="rounded-full bg-[#eef1ea] px-2 py-1 text-[10px] font-semibold text-[#71806f]">
                                                Baru
                                            </span>

                                        @else

                                            <span class="rounded-full bg-gray-100 px-2 py-1 text-[10px] font-semibold text-gray-500">
                                                Dibaca
                                            </span>

                                        @endif

                                        <p class="mt-2 text-[11px] text-gray-400">
                                            {{ $message->created_at->format('d M Y') }}
                                        </p>

                                        <p class="mt-1 text-[11px] text-gray-400">
                                            {{ $message->created_at->format('H:i') }}
                                        </p>

                                    </div>

                                </a>

                            @endforeach

                        </div>

                    @endif

                </div>

            </div>

            {{-- QUICK MANAGEMENT --}}
            <div class="mt-6 rounded-xl bg-white p-6 shadow-sm ring-1 ring-[#e7e7e1]">

                <div>
                    <h3 class="font-semibold text-gray-900">
                        Kelola BookStore
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Akses cepat ke menu administrasi.
                    </p>
                </div>

                <div class="mt-5 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-5">

                    <a
                        href="{{ route('admin.categories.index') }}"
                        class="rounded-lg bg-[#fafaf7] px-4 py-4 text-sm font-medium text-gray-700 ring-1 ring-[#e7e7e1] transition hover:bg-[#eef1ea]"
                    >
                        Kategori
                    </a>

                    <a
                        href="{{ route('admin.books.index') }}"
                        class="rounded-lg bg-[#fafaf7] px-4 py-4 text-sm font-medium text-gray-700 ring-1 ring-[#e7e7e1] transition hover:bg-[#eef1ea]"
                    >
                        Buku
                    </a>

                    <a
                        href="{{ route('admin.users.index') }}"
                        class="rounded-lg bg-[#fafaf7] px-4 py-4 text-sm font-medium text-gray-700 ring-1 ring-[#e7e7e1] transition hover:bg-[#eef1ea]"
                    >
                        User
                    </a>

                    <a
                        href="{{ route('admin.orders.index') }}"
                        class="rounded-lg bg-[#fafaf7] px-4 py-4 text-sm font-medium text-gray-700 ring-1 ring-[#e7e7e1] transition hover:bg-[#eef1ea]"
                    >
                        Pesanan
                    </a>

                    <a
                        href="{{ route('admin.messages.index') }}"
                        class="rounded-lg bg-[#fafaf7] px-4 py-4 text-sm font-medium text-gray-700 ring-1 ring-[#e7e7e1] transition hover:bg-[#eef1ea]"
                    >
                        Pesan
                    </a>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>