<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>About Us - BookStore</title>

    <x-cdn-assets />
</head>

<body class="bg-[#fafaf7] text-gray-900">

    <header class="border-b border-[#e9e9e3]">

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
                    class="transition hover:text-gray-900"
                >
                    Home
                </a>

                <a
                    href="{{ route('about') }}"
                    class="text-gray-900"
                >
                    About Us
                </a>

                @auth

                    <a
                        href="{{ route('dashboard') }}"
                        class="rounded-md bg-gray-900 px-4 py-2 text-white hover:bg-gray-800"
                    >
                        Dashboard
                    </a>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="hover:text-gray-900"
                    >
                        Login
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="rounded-md bg-[#6f806d] px-4 py-2 text-white hover:bg-[#61705f]"
                    >
                        Register
                    </a>

                @endauth

            </nav>

        </div>

    </header>

    <main>

        <section class="border-b border-[#e9e9e3]">

            <div class="mx-auto max-w-4xl px-4 py-20 text-center sm:px-6 lg:px-8">

                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#71806f]">
                    About Us
                </p>

                <h1 class="mt-4 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                    Buku yang tepat untuk setiap pembaca.
                </h1>

                <p class="mx-auto mt-6 max-w-2xl leading-7 text-gray-600">
                    BookStore adalah platform penjualan buku yang membantu pembaca menemukan
                    dan membeli berbagai koleksi buku secara lebih sederhana.
                </p>

            </div>

        </section>

        <section class="py-16 lg:py-20">

            <div class="mx-auto grid max-w-7xl grid-cols-1 gap-12 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">

                <div>

                    <p class="text-sm font-semibold uppercase tracking-[0.16em] text-[#71806f]">
                        Tentang BookStore
                    </p>

                    <h2 class="mt-3 text-3xl font-bold tracking-tight text-gray-900">
                        Tempat sederhana untuk menemukan bacaan berikutnya.
                    </h2>

                    <p class="mt-5 leading-7 text-gray-600">
                        Kami menyediakan berbagai koleksi buku dari beragam kategori.
                        Melalui BookStore, pelanggan dapat mencari buku, melihat informasi
                        buku, melakukan pemesanan, dan memantau status pesanan dengan lebih mudah.
                    </p>

                </div>

                <div class="rounded-3xl bg-[#eef1ea] p-8">

                    <div class="grid gap-4 sm:grid-cols-2">

                        <div class="rounded-xl bg-white p-5">

                            <h3 class="font-semibold text-gray-900">
                                Koleksi Buku
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-gray-500">
                                Berbagai pilihan buku berdasarkan kategori dan penulis.
                            </p>

                        </div>

                        <div class="rounded-xl bg-white p-5">

                            <h3 class="font-semibold text-gray-900">
                                Pencarian Mudah
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-gray-500">
                                Temukan buku yang dibutuhkan dengan lebih cepat.
                            </p>

                        </div>

                        <div class="rounded-xl bg-white p-5">

                            <h3 class="font-semibold text-gray-900">
                                Pemesanan Online
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-gray-500">
                                Tambahkan buku ke keranjang dan lakukan checkout.
                            </p>

                        </div>

                        <div class="rounded-xl bg-white p-5">

                            <h3 class="font-semibold text-gray-900">
                                Status Pesanan
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-gray-500">
                                Pantau perkembangan pesanan setelah melakukan pembelian.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <section class="border-t border-[#e9e9e3] bg-white py-16">

            <div class="mx-auto max-w-3xl px-4 text-center sm:px-6 lg:px-8">

                <h2 class="text-3xl font-bold tracking-tight text-gray-900">
                    Mulai temukan bukumu.
                </h2>

                <p class="mt-4 text-gray-600">
                    Jelajahi koleksi buku yang tersedia di BookStore.
                </p>

                <div class="mt-7 flex justify-center gap-3">

                    @auth

                        <a
                            href="{{ route('user.books.index') }}"
                            class="rounded-md bg-gray-900 px-5 py-3 text-sm font-semibold text-white hover:bg-gray-800"
                        >
                            Lihat Koleksi
                        </a>

                    @else

                        <a
                            href="{{ route('login') }}"
                            class="rounded-md bg-gray-900 px-5 py-3 text-sm font-semibold text-white hover:bg-gray-800"
                        >
                            Lihat Koleksi
                        </a>

                        <a
                            href="{{ route('register') }}"
                            class="rounded-md bg-[#eef1ea] px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-[#e2e7df]"
                        >
                            Daftar
                        </a>

                    @endauth

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