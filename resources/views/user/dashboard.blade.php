<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#71806f]">
                    Customer Area
                </p>

                <h2 class="mt-1 text-xl font-semibold text-gray-900">
                    Dashboard
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Temukan buku dan pantau aktivitas akun kamu.
                </p>
            </div>

            <a
                href="{{ route('user.books.index') }}"
                class="rounded-md bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-800"
            >
                Jelajahi Buku
            </a>

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
                            Lanjutkan belanja, cek keranjang, pantau pesanan,
                            atau hubungi admin jika membutuhkan bantuan.
                        </p>
                    </div>

                    <div class="rounded-xl bg-white/70 px-5 py-4 ring-1 ring-white">

                        <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                            Akun
                        </p>

                        <p class="mt-2 text-sm font-semibold text-gray-800">
                            {{ auth()->user()->email }}
                        </p>

                    </div>

                </div>

            </div>

            {{-- SUMMARY --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                <a
                    href="{{ route('user.cart.index') }}"
                    class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-[#e7e7e1] transition hover:-translate-y-0.5 hover:shadow-md"
                >
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                        Keranjang
                    </p>

                    <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900">
                        {{ $cartItemsCount }}
                    </p>

                    <p class="mt-2 text-xs text-[#71806f]">
                        Item di keranjang →
                    </p>
                </a>

                <a
                    href="{{ route('user.orders.index') }}"
                    class="rounded-xl bg-[#fffaf0] p-5 shadow-sm ring-1 ring-amber-100 transition hover:-translate-y-0.5 hover:shadow-md"
                >
                    <p class="text-xs font-medium uppercase tracking-wide text-amber-600">
                        Pesanan Aktif
                    </p>

                    <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900">
                        {{ $activeOrdersCount }}
                    </p>

                    <p class="mt-2 text-xs text-amber-600">
                        Pending / diproses
                    </p>
                </a>

                <a
                    href="{{ route('user.orders.index') }}"
                    class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-[#e7e7e1] transition hover:-translate-y-0.5 hover:shadow-md"
                >
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                        Total Pesanan
                    </p>

                    <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900">
                        {{ $totalOrders }}
                    </p>

                    <p class="mt-2 text-xs text-[#71806f]">
                        Riwayat pesanan →
                    </p>
                </a>

            </div>

            <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-[minmax(0,1fr)_420px]">

                {{-- LEFT --}}
                <div class="space-y-6">

                    {{-- RECENT BOOKS --}}
                    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-[#e7e7e1]">

                        <div class="flex items-center justify-between border-b border-[#e7e7e1] px-6 py-4">

                            <div>
                                <h3 class="font-semibold text-gray-900">
                                    Buku Terbaru
                                </h3>

                                <p class="mt-1 text-xs text-gray-500">
                                    Koleksi terbaru yang tersedia.
                                </p>
                            </div>

                            <a
                                href="{{ route('user.books.index') }}"
                                class="text-xs font-semibold text-[#71806f] hover:text-gray-900"
                            >
                                Lihat Semua →
                            </a>

                        </div>

                        @if ($recentBooks->isEmpty())

                            <div class="px-6 py-12 text-center text-sm text-gray-500">
                                Belum ada buku yang tersedia.
                            </div>

                        @else

                            <div class="grid grid-cols-2 gap-4 p-5 sm:grid-cols-4">

                                @foreach ($recentBooks as $book)

                                    <a
                                        href="{{ route('user.books.show', $book) }}"
                                        class="group min-w-0"
                                    >

                                        <div class="overflow-hidden rounded-lg bg-[#f3f3ee] ring-1 ring-[#e7e7e1]">

                                            @if ($book->cover_image)

                                                <img
                                                    src="{{ asset('storage/' . $book->cover_image) }}"
                                                    alt="{{ $book->title }}"
                                                    class="aspect-[3/4] w-full object-cover transition duration-300 group-hover:scale-[1.02]"
                                                >

                                            @else

                                                <div class="flex aspect-[3/4] items-center justify-center px-3 text-center text-xs text-gray-400">
                                                    No Cover
                                                </div>

                                            @endif

                                        </div>

                                        <p class="mt-3 truncate text-sm font-semibold text-gray-900">
                                            {{ $book->title }}
                                        </p>

                                        <p class="mt-1 truncate text-xs text-gray-500">
                                            {{ $book->author }}
                                        </p>

                                        <p class="mt-2 text-sm font-semibold text-gray-900">
                                            Rp {{ number_format($book->price, 0, ',', '.') }}
                                        </p>

                                    </a>

                                @endforeach

                            </div>

                        @endif

                    </div>

                    {{-- RECENT ORDERS --}}
                    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-[#e7e7e1]">

                        <div class="flex items-center justify-between border-b border-[#e7e7e1] px-6 py-4">

                            <div>
                                <h3 class="font-semibold text-gray-900">
                                    Pesanan Terbaru
                                </h3>

                                <p class="mt-1 text-xs text-gray-500">
                                    Status pesanan yang terakhir kamu buat.
                                </p>
                            </div>

                            <a
                                href="{{ route('user.orders.index') }}"
                                class="text-xs font-semibold text-[#71806f] hover:text-gray-900"
                            >
                                Lihat Semua →
                            </a>

                        </div>

                        @if ($recentOrders->isEmpty())

                            <div class="px-6 py-12 text-center">

                                <p class="text-sm text-gray-500">
                                    Belum ada pesanan.
                                </p>

                                <a
                                    href="{{ route('user.books.index') }}"
                                    class="mt-4 inline-flex text-sm font-semibold text-[#71806f] hover:text-gray-900"
                                >
                                    Mulai belanja →
                                </a>

                            </div>

                        @else

                            <div class="divide-y divide-gray-100">

                                @foreach ($recentOrders as $order)

                                    <a
                                        href="{{ route('user.orders.show', $order) }}"
                                        class="flex items-center justify-between gap-4 px-6 py-4 transition hover:bg-[#fafaf7]"
                                    >

                                        <div class="min-w-0">

                                            <div class="flex items-center gap-2">

                                                <p class="font-medium text-gray-900">
                                                    Pesanan Buku
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

                                            <p class="mt-1 text-xs text-gray-500">
                                                {{ $order->created_at->format('d M Y H:i') }}
                                            </p>

                                        </div>

                                        <span class="text-sm text-gray-400">
                                            →
                                        </span>

                                    </a>

                                @endforeach

                            </div>

                        @endif

                    </div>

                </div>

                {{-- RIGHT --}}
                <div class="space-y-6">

                    {{-- QUICK ACCESS --}}
                    <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-[#e7e7e1]">

                        <h3 class="font-semibold text-gray-900">
                            Akses Cepat
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Menu yang sering digunakan.
                        </p>

                        <div class="mt-5 grid grid-cols-2 gap-3">

                            <a
                                href="{{ route('user.books.index') }}"
                                class="rounded-lg bg-[#fafaf7] px-4 py-4 text-sm font-medium text-gray-700 ring-1 ring-[#e7e7e1] transition hover:bg-[#eef1ea]"
                            >
                                Koleksi Buku
                            </a>

                            <a
                                href="{{ route('user.cart.index') }}"
                                class="rounded-lg bg-[#fafaf7] px-4 py-4 text-sm font-medium text-gray-700 ring-1 ring-[#e7e7e1] transition hover:bg-[#eef1ea]"
                            >
                                Keranjang
                            </a>

                            <a
                                href="{{ route('user.orders.index') }}"
                                class="rounded-lg bg-[#fafaf7] px-4 py-4 text-sm font-medium text-gray-700 ring-1 ring-[#e7e7e1] transition hover:bg-[#eef1ea]"
                            >
                                Pesanan Saya
                            </a>

                            <a
                                href="{{ route('user.contact.index') }}"
                                class="rounded-lg bg-[#fafaf7] px-4 py-4 text-sm font-medium text-gray-700 ring-1 ring-[#e7e7e1] transition hover:bg-[#eef1ea]"
                            >
                                Contact Admin
                            </a>

                        </div>

                    </div>

                    {{-- MESSAGES --}}
                    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-[#e7e7e1]">

                        <div class="flex items-center justify-between border-b border-[#e7e7e1] px-6 py-4">

                            <div>
                                <h3 class="font-semibold text-gray-900">
                                    Pesan Terbaru
                                </h3>

                                <p class="mt-1 text-xs text-gray-500">
                                    Pesan dan balasan dari admin.
                                </p>
                            </div>

                            <a
                                href="{{ route('user.contact.index') }}"
                                class="text-xs font-semibold text-[#71806f] hover:text-gray-900"
                            >
                                Buka →
                            </a>

                        </div>

                        @if ($recentMessages->isEmpty())

                            <div class="px-6 py-10 text-center">

                                <p class="text-sm text-gray-500">
                                    Belum ada riwayat pesan.
                                </p>

                                <a
                                    href="{{ route('user.contact.index') }}"
                                    class="mt-4 inline-flex text-sm font-semibold text-[#71806f] hover:text-gray-900"
                                >
                                    Hubungi Admin →
                                </a>

                            </div>

                        @else

                            <div class="divide-y divide-gray-100">

                                @foreach ($recentMessages as $message)

                                    <a
                                        href="{{ route('user.contact.index') }}"
                                        class="block px-6 py-4 transition hover:bg-[#fafaf7]"
                                    >

                                        <div class="flex items-start justify-between gap-3">

                                            <div class="min-w-0">

                                                <p class="truncate text-sm font-semibold text-gray-900">
                                                    {{ $message->subject }}
                                                </p>

                                                <p class="mt-1 text-xs text-gray-500">
                                                    {{ $message->created_at->format('d M Y H:i') }}
                                                </p>

                                            </div>

                                            @if (! empty($message->reply))

                                                <span class="shrink-0 rounded-full bg-green-100 px-2 py-1 text-[10px] font-semibold text-green-700">
                                                    Dibalas
                                                </span>

                                            @elseif ($message->is_read)

                                                <span class="shrink-0 rounded-full bg-blue-100 px-2 py-1 text-[10px] font-semibold text-blue-700">
                                                    Dibaca
                                                </span>

                                            @else

                                                <span class="shrink-0 rounded-full bg-amber-100 px-2 py-1 text-[10px] font-semibold text-amber-700">
                                                    Terkirim
                                                </span>

                                            @endif

                                        </div>

                                        @if (! empty($message->reply))

                                            <div class="mt-3 rounded-lg bg-[#f4f7f2] px-3 py-2">

                                                <p class="text-[10px] font-semibold uppercase tracking-wide text-[#71806f]">
                                                    Balasan Admin
                                                </p>

                                                <p class="mt-1 line-clamp-2 text-xs leading-5 text-gray-600">
                                                    {{ $message->reply }}
                                                </p>

                                            </div>

                                        @endif

                                    </a>

                                @endforeach

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>