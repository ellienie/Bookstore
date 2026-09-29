<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BookStore') }}</title>

    <x-cdn-assets />
</head>

<body class="min-h-screen bg-[#fafaf7] text-gray-900">

    <div class="min-h-screen lg:grid lg:grid-cols-2">

        <div class="hidden border-r border-[#e9e9e3] bg-[#eef1ea] lg:flex lg:flex-col lg:justify-between lg:p-12">

            <a
                href="{{ route('home') }}"
                class="text-xl font-bold tracking-tight text-gray-900"
            >
                BookStore
            </a>

            <div class="max-w-md">

                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#71806f]">
                    BookStore
                </p>

                <h1 class="mt-4 text-4xl font-bold leading-tight tracking-tight text-gray-900">
                    Temukan bacaan yang cocok untuk kamu.
                </h1>

                <p class="mt-5 leading-7 text-gray-600">
                    Jelajahi koleksi buku, simpan ke keranjang, lakukan checkout,
                    dan pantau pesananmu dalam satu tempat.
                </p>

            </div>

            <p class="text-sm text-gray-500">
                © {{ date('Y') }} BookStore
            </p>

        </div>

        <div class="flex min-h-screen items-center justify-center px-4 py-10 sm:px-6 lg:px-10">

            <div class="w-full max-w-md">

                <div class="mb-8 flex items-center justify-between lg:hidden">

                    <a
                        href="{{ route('home') }}"
                        class="text-xl font-bold tracking-tight text-gray-900"
                    >
                        BookStore
                    </a>

                    <a
                        href="{{ route('home') }}"
                        class="text-sm font-medium text-gray-500 hover:text-gray-900"
                    >
                        Kembali ke Home
                    </a>

                </div>

                {{ $slot }}

            </div>

        </div>

    </div>

</body>
</html>