<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Detail Buku
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Informasi lengkap buku.
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-show="show"
                    x-transition
                    class="fixed right-6 top-20 z-50 rounded-lg bg-green-600 px-5 py-4 text-sm font-medium text-white shadow-lg"
                >
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-show="show"
                    x-transition
                    class="fixed right-6 top-20 z-50 rounded-lg bg-red-600 px-5 py-4 text-sm font-medium text-white shadow-lg"
                >
                    {{ session('error') }}
                </div>
            @endif

            <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200">

                <div class="grid grid-cols-1 gap-8 p-6 md:grid-cols-[280px_1fr] md:p-8">

                    <div>
                        <div class="aspect-[3/4] overflow-hidden rounded-xl bg-gray-100">

                            @if ($book->cover_image)
                                <img
                                    src="{{ asset('storage/' . $book->cover_image) }}"
                                    alt="{{ $book->title }}"
                                    class="h-full w-full object-cover"
                                >
                            @else
                                <div class="flex h-full items-center justify-center text-sm text-gray-400">
                                    No Cover
                                </div>
                            @endif

                        </div>
                    </div>

                    <div>
                        <span
                            class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-600"
                        >
                            {{ $book->category?->name ?? '-' }}
                        </span>

                        <h1 class="mt-4 text-3xl font-bold text-gray-900">
                            {{ $book->title }}
                        </h1>

                        <p class="mt-2 text-lg text-gray-500">
                            {{ $book->author }}
                        </p>

                        @if ($book->isbn)
                            <p class="mt-2 text-sm text-gray-400">
                                ISBN: {{ $book->isbn }}
                            </p>
                        @endif

                        <div class="mt-6 border-y border-gray-100 py-6">

                            <p class="text-2xl font-bold text-gray-900">
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            </p>

                            <div class="mt-3">
                                @if ($book->stock > 0)
                                    <span
                                        class="inline-flex rounded-full bg-green-100 px-3 py-1 text-sm font-semibold text-green-700"
                                    >
                                        Stok tersedia: {{ $book->stock }}
                                    </span>
                                @else
                                    <span
                                        class="inline-flex rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-700"
                                    >
                                        Stok habis
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="mt-6">
                            <h2 class="text-base font-semibold text-gray-900">
                                Deskripsi
                            </h2>

                            <div class="mt-3 whitespace-pre-line text-sm leading-7 text-gray-600">
                                {{ $book->description ?: 'Belum ada deskripsi buku.' }}
                            </div>
                        </div>

                        <div class="mt-8 flex flex-wrap gap-3">

                            <a
                                href="{{ route('user.books.index') }}"
                                class="rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-200"
                            >
                                Kembali
                            </a>

                            @if ($book->stock > 0)
                                <form
                                    action="{{ route('user.cart.store', $book) }}"
                                    method="POST"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="rounded-md bg-gray-800 px-5 py-2.5 text-sm font-semibold text-white hover:bg-gray-700"
                                    >
                                        + Tambah ke Keranjang
                                    </button>
                                </form>
                            @else
                                <button
                                    type="button"
                                    disabled
                                    class="cursor-not-allowed rounded-md bg-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-500"
                                >
                                    Stok Habis
                                </button>
                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>