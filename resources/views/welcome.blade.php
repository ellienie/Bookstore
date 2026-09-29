<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BookStore</title>

    <x-cdn-assets />
</head>

<body class="bg-[#fafaf7] text-gray-900">

    <header class="border-b border-[#e9e9e3] bg-[#fafaf7]">

        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-5 sm:px-6 lg:px-8">

            <a
                href="{{ route('home') }}"
                class="text-xl font-bold tracking-tight text-gray-900"
            >
                BookStore
            </a>

            <nav class="flex items-center gap-6 text-sm font-medium text-gray-600">

                <a
                    href="{{ route('home') }}"
                    class="text-gray-900"
                >
                    Home
                </a>

                <a
                    href="{{ route('about') }}"
                    class="transition hover:text-gray-900"
                >
                    About Us
                </a>

                @auth

                    <a
                        href="{{ route('dashboard') }}"
                        class="rounded-md bg-gray-900 px-4 py-2 text-white transition hover:bg-gray-800"
                    >
                        Dashboard
                    </a>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="transition hover:text-gray-900"
                    >
                        Login
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="rounded-md bg-[#6f806d] px-4 py-2 text-white transition hover:bg-[#61705f]"
                    >
                        Register
                    </a>

                @endauth

            </nav>

        </div>

    </header>

    <main>

        <section class="border-b border-[#e9e9e3]">

            <div class="mx-auto grid max-w-7xl grid-cols-1 items-center gap-12 px-4 py-16 sm:px-6 lg:grid-cols-2 lg:px-8 lg:py-24">

                <div>

                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#71806f]">
                        BookStore
                    </p>

                    <h1 class="mt-4 max-w-xl text-4xl font-bold leading-tight tracking-tight text-gray-900 sm:text-5xl">
                        Temukan buku yang layak masuk rak kamu.
                    </h1>

                    <p class="mt-6 max-w-xl text-base leading-7 text-gray-600">
                        Jelajahi berbagai koleksi buku pilihan, temukan bacaan yang sesuai,
                        dan mulai perjalanan membaca dengan lebih mudah.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">

                        @auth

                            <a
                                href="{{ route('user.books.index') }}"
                                class="rounded-md bg-gray-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-gray-800"
                            >
                                Jelajahi Koleksi
                            </a>

                        @else

                            <a
                                href="{{ route('login') }}"
                                class="rounded-md bg-gray-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-gray-800"
                            >
                                Jelajahi Koleksi
                            </a>

                        @endauth

                        <a
                            href="{{ route('about') }}"
                            class="rounded-md border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                        >
                            About Us
                        </a>

                    </div>

                </div>

                <div>

                    <div class="rounded-[28px] bg-[#eef1ea] p-8">

                        @if ($books->isNotEmpty() && $books->first()->cover_image)

                            <div class="mx-auto max-w-[260px]">

                                <img
                                    src="{{ asset('storage/' . $books->first()->cover_image) }}"
                                    alt="{{ $books->first()->title }}"
                                    class="aspect-[3/4] w-full rounded-xl object-cover shadow-xl"
                                >

                            </div>

                        @else

                            <div class="mx-auto flex aspect-[3/4] max-w-[260px] items-center justify-center rounded-xl bg-white text-sm text-gray-400 shadow-sm">
                                Cover Buku
                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </section>

        <section class="py-16 lg:py-20">

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="mb-8 flex items-end justify-between gap-4">

                    <div>

                        <p class="text-sm font-semibold uppercase tracking-[0.16em] text-[#71806f]">
                            Koleksi
                        </p>

                        <h2 class="mt-2 text-3xl font-bold tracking-tight text-gray-900">
                            Buku Pilihan
                        </h2>

                        <p class="mt-2 text-sm text-gray-500">
                            Beberapa buku terbaru yang tersedia di BookStore.
                        </p>

                    </div>

                    @auth

                        <a
                            href="{{ route('user.books.index') }}"
                            class="text-sm font-semibold text-gray-700 hover:text-gray-900"
                        >
                            Lihat Semua →
                        </a>

                    @else

                        <a
                            href="{{ route('login') }}"
                            class="text-sm font-semibold text-gray-700 hover:text-gray-900"
                        >
                            Lihat Semua →
                        </a>

                    @endauth

                </div>

                @if ($books->isEmpty())

                    <div class="rounded-xl border border-[#e7e7e1] bg-white px-6 py-16 text-center">
                        <p class="text-sm text-gray-500">
                            Belum ada buku yang tersedia.
                        </p>
                    </div>

                @else

                    <div class="grid grid-cols-2 gap-5 sm:grid-cols-3 lg:grid-cols-4">

                        @foreach ($books as $book)

                            <article class="group overflow-hidden rounded-2xl border border-[#e7e7e1] bg-white">

                                <div class="aspect-[3/4] overflow-hidden bg-[#f1f1ed]">

                                    @if ($book->cover_image)

                                        <img
                                            src="{{ asset('storage/' . $book->cover_image) }}"
                                            alt="{{ $book->title }}"
                                            class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.02]"
                                        >

                                    @else

                                        <div class="flex h-full items-center justify-center text-sm text-gray-400">
                                            No Cover
                                        </div>

                                    @endif

                                </div>

                                <div class="p-5">

                                    <p class="text-xs font-medium uppercase tracking-wide text-[#71806f]">
                                        {{ $book->category?->name ?? 'Buku' }}
                                    </p>

                                    <h3 class="mt-2 line-clamp-2 text-base font-semibold text-gray-900">
                                        {{ $book->title }}
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ $book->author }}
                                    </p>

                                    <div class="mt-5 flex items-center justify-between">

                                        <div>

                                            <p class="font-semibold text-gray-900">
                                                Rp {{ number_format($book->price, 0, ',', '.') }}
                                            </p>

                                            @if ($book->stock > 0)

                                                <p class="mt-1 text-xs text-[#71806f]">
                                                    Stok {{ $book->stock }}
                                                </p>

                                            @else

                                                <p class="mt-1 text-xs text-red-500">
                                                    Stok habis
                                                </p>

                                            @endif

                                        </div>

                                        @if ($book->stock > 0)

                                            @auth

                                                <form
                                                    action="{{ route('user.cart.store', $book) }}"
                                                    method="POST"
                                                >
                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        title="Tambah ke keranjang"
                                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-[#eef1ea] text-gray-700 transition hover:bg-[#dfe6dc]"
                                                    >
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            fill="none"
                                                            viewBox="0 0 24 24"
                                                            stroke-width="1.8"
                                                            stroke="currentColor"
                                                            class="h-5 w-5"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M2.25 2.25l1.386.347c.43.107.77.438.89.864l2.052 7.293m0 0l.51 1.783A2.25 2.25 0 009.25 14.25h7.5a2.25 2.25 0 002.183-1.705l1.35-5.4a.75.75 0 00-.728-.932H6.578z"
                                                            />
                                                        </svg>
                                                    </button>

                                                </form>

                                            @else

                                                <a
                                                    href="{{ route('login') }}"
                                                    title="Login untuk membeli"
                                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-[#eef1ea] text-gray-700 transition hover:bg-[#dfe6dc]"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke-width="1.8"
                                                        stroke="currentColor"
                                                        class="h-5 w-5"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M2.25 2.25l1.386.347c.43.107.77.438.89.864l2.052 7.293m0 0l.51 1.783A2.25 2.25 0 009.25 14.25h7.5a2.25 2.25 0 002.183-1.705l1.35-5.4a.75.75 0 00-.728-.932H6.578z"
                                                        />
                                                    </svg>
                                                </a>

                                            @endauth

                                        @else

                                            <span class="flex h-10 w-10 cursor-not-allowed items-center justify-center rounded-full bg-gray-100 text-gray-300">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.8"
                                                    stroke="currentColor"
                                                    class="h-5 w-5"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M2.25 2.25l1.386.347c.43.107.77.438.89.864l2.052 7.293m0 0l.51 1.783A2.25 2.25 0 009.25 14.25h7.5a2.25 2.25 0 002.183-1.705l1.35-5.4a.75.75 0 00-.728-.932H6.578z"
                                                    />
                                                </svg>
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </article>

                        @endforeach

                    </div>

                @endif

            </div>

        </section>

        <section class="border-y border-[#e9e9e3] bg-white py-16 lg:py-20">

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="max-w-2xl">

                    <p class="text-sm font-semibold uppercase tracking-[0.16em] text-[#71806f]">
                        Tentang BookStore
                    </p>

                    <h2 class="mt-3 text-3xl font-bold tracking-tight text-gray-900">
                        Membuat proses menemukan buku terasa lebih sederhana.
                    </h2>

                    <p class="mt-5 leading-7 text-gray-600">
                        BookStore menyediakan berbagai koleksi buku dari beragam kategori.
                        Pengunjung dapat melihat pilihan buku yang tersedia, sementara pengguna
                        terdaftar dapat melakukan pemesanan, checkout, serta memantau status pesanannya.
                    </p>

                    <a
                        href="{{ route('about') }}"
                        class="mt-6 inline-flex text-sm font-semibold text-gray-900 underline decoration-gray-300 underline-offset-4 hover:decoration-gray-700"
                    >
                        Selengkapnya Tentang Kami
                    </a>

                </div>

            </div>

        </section>

    </main>

    <footer class="bg-[#f3f3ee]">

        <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-8 text-sm text-gray-500 sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8">

            <div>
                <span class="font-semibold text-gray-800">
                    BookStore
                </span>

                <span class="ml-2">
                    © {{ date('Y') }}
                </span>
            </div>

            <div class="flex gap-5">

                <a href="{{ route('home') }}" class="hover:text-gray-900">
                    Home
                </a>

                <a href="{{ route('about') }}" class="hover:text-gray-900">
                    About Us
                </a>

                @guest

                    <a href="{{ route('login') }}" class="hover:text-gray-900">
                        Login
                    </a>

                    <a href="{{ route('register') }}" class="hover:text-gray-900">
                        Register
                    </a>

                @endguest

            </div>

        </div>

    </footer>

</body>
</html>