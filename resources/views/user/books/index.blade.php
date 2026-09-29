<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-900">
                Koleksi Buku
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Temukan buku yang ingin kamu beli.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-[1600px] px-5 sm:px-6 lg:px-8">

            @if (session('success'))
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-show="show"
                    x-transition
                    class="fixed right-6 top-6 z-50 rounded-lg bg-[#71806f] px-5 py-4 text-sm font-medium text-white shadow-lg"
                >
                    {{ session('success') }}
                </div>
            @endif

            {{-- SEARCH --}}
            <div class="mb-7 rounded-xl bg-white p-5 shadow-sm ring-1 ring-[#e7e7e1]">

                <form
                    method="GET"
                    action="{{ route('user.books.index') }}"
                    class="grid grid-cols-1 gap-4 lg:grid-cols-[minmax(0,1fr)_240px_168px_auto]"
                >

                    <div>
                        <label
                            for="search"
                            class="mb-2 block text-sm font-medium text-gray-700"
                        >
                            Cari Buku
                        </label>

                        <input
                            id="search"
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Judul, penulis, ISBN, atau kategori..."
                            class="w-full rounded-lg border-gray-300 bg-white px-4 py-2.5 text-sm shadow-sm focus:border-[#71806f] focus:ring-[#71806f]"
                        >
                    </div>

                    <div>
                        <label
                            for="category"
                            class="mb-2 block text-sm font-medium text-gray-700"
                        >
                            Kategori
                        </label>

                        <select
                            id="category"
                            name="category"
                            class="w-full rounded-lg border-gray-300 bg-white px-4 py-2.5 text-sm shadow-sm focus:border-[#71806f] focus:ring-[#71806f]"
                        >
                            <option value="">
                                Semua Kategori
                            </option>

                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    @selected(request('category') == $category->id)
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button
                            type="submit"
                            class="w-full rounded-lg bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-800"
                        >
                            Cari
                        </button>
                    </div>

                    <div class="flex items-end">
                        <a
                            href="{{ route('user.books.index') }}"
                            class="rounded-lg bg-[#f3f3ee] px-4 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-[#e9e9e3]"
                        >
                            Reset
                        </a>
                    </div>

                </form>

            </div>

            {{-- BOOK GRID --}}
            @if ($books->isEmpty())

                <div class="rounded-xl bg-white px-6 py-16 text-center shadow-sm ring-1 ring-[#e7e7e1]">

                    <h3 class="text-base font-semibold text-gray-900">
                        Buku tidak ditemukan
                    </h3>

                    <p class="mt-2 text-sm text-gray-500">
                        Coba gunakan kata pencarian atau kategori yang berbeda.
                    </p>

                </div>

            @else

                <div
                    class="
                        grid
                        grid-cols-2
                        gap-4
                        sm:grid-cols-3
                        lg:grid-cols-4
                        xl:grid-cols-5
                        2xl:grid-cols-6
                    "
                >

                    @foreach ($books as $book)

                        <article
                            class="group flex min-w-0 flex-col overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-[#e7e7e1] transition duration-200 hover:-translate-y-0.5 hover:shadow-md"
                        >

                            {{-- COVER --}}
                            <a
                                href="{{ route('user.books.show', $book) }}"
                                class="block overflow-hidden bg-[#f3f3ee]"
                            >
                                @if ($book->cover_image)

                                    <img
                                        src="{{ asset('storage/' . $book->cover_image) }}"
                                        alt="{{ $book->title }}"
                                        class="aspect-[3/4] w-full object-cover transition duration-300 group-hover:scale-[1.02]"
                                    >

                                @else

                                    <div class="flex aspect-[3/4] w-full items-center justify-center bg-[#f3f3ee] px-4 text-center text-xs text-gray-400">
                                        Cover tidak tersedia
                                    </div>

                                @endif
                            </a>

                            {{-- CONTENT --}}
                            <div class="flex flex-1 flex-col p-4">

                                <div>
                                    <span class="inline-flex rounded-full bg-[#f0f2ed] px-2 py-1 text-[10px] font-semibold text-[#71806f]">
                                        {{ $book->category?->name ?? 'Tanpa Kategori' }}
                                    </span>
                                </div>

                                <a
                                    href="{{ route('user.books.show', $book) }}"
                                    class="mt-3 line-clamp-2 text-sm font-semibold leading-5 text-gray-900 transition hover:text-[#71806f]"
                                >
                                    {{ $book->title }}
                                </a>

                                <p class="mt-1 truncate text-xs text-gray-500">
                                    {{ $book->author }}
                                </p>

                                <div class="mt-4 flex items-end justify-between gap-2">

                                    <div class="min-w-0">
                                        <div class="text-sm font-bold text-gray-900">
                                            Rp {{ number_format($book->price, 0, ',', '.') }}
                                        </div>

                                        <div class="mt-0.5 text-[11px] text-gray-400">
                                            Stok: {{ $book->stock }}
                                        </div>
                                    </div>

                                    @if ($book->stock > 0)
                                        <span class="shrink-0 rounded-full bg-green-50 px-2 py-1 text-[10px] font-semibold text-green-700">
                                            Tersedia
                                        </span>
                                    @else
                                        <span class="shrink-0 rounded-full bg-red-50 px-2 py-1 text-[10px] font-semibold text-red-600">
                                            Habis
                                        </span>
                                    @endif

                                </div>

                                {{-- ACTION --}}
                                <div class="mt-auto grid grid-cols-[1fr_42px] gap-2 pt-4">

                                    <a
                                        href="{{ route('user.books.show', $book) }}"
                                        class="flex h-10 items-center justify-center rounded-lg bg-[#f3f3ee] px-3 text-xs font-semibold text-gray-700 transition hover:bg-[#e9e9e3]"
                                    >
                                        Detail
                                    </a>

                                    @if ($book->stock > 0)

                                        <form
                                            method="POST"
                                            action="{{ route('user.cart.store', $book) }}"
                                        >
                                            @csrf

                                            <button
                                                type="submit"
                                                title="Tambah ke keranjang"
                                                class="flex h-10 w-full items-center justify-center rounded-lg bg-gray-900 text-white transition hover:bg-gray-800"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.8"
                                                    stroke="currentColor"
                                                    class="h-[18px] w-[18px]"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M2.25 2.25l1.5 1.5m0 0L5.25 15a2.25 2.25 0 002.25 2.25h9.75a2.25 2.25 0 002.25-2.25l.75-7.5H5.25M3.75 3.75H2.25m6.75 17.25a.75.75 0 100-1.5.75.75 0 000 1.5zm8.25 0a.75.75 0 100-1.5.75.75 0 000 1.5z"
                                                    />
                                                </svg>
                                            </button>

                                        </form>

                                    @else

                                        <button
                                            type="button"
                                            disabled
                                            title="Stok habis"
                                            class="flex h-10 w-full cursor-not-allowed items-center justify-center rounded-lg bg-gray-200 text-gray-400"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.8"
                                                stroke="currentColor"
                                                class="h-[18px] w-[18px]"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M2.25 2.25l1.5 1.5m0 0L5.25 15a2.25 2.25 0 002.25 2.25h9.75a2.25 2.25 0 002.25-2.25l.75-7.5H5.25"
                                                />
                                            </svg>
                                        </button>

                                    @endif

                                </div>

                            </div>

                        </article>

                    @endforeach

                </div>

            @endif

        </div>
    </div>
</x-app-layout>