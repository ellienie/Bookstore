<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">
                    Data Buku
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Kelola buku yang tersedia di BookStore.
                </p>
            </div>

            <a
                href="{{ route('admin.books.create') }}"
                class="inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-gray-800"
            >
                + Tambah Buku
            </a>
        </div>
    </x-slot>

    <div
        x-data="{
            deleteOpen: false,
            deleteAction: '',
            deleteName: '',

            openDelete(action, name) {
                this.deleteAction = action;
                this.deleteName = name;
                this.deleteOpen = true;
            },

            closeDelete() {
                this.deleteOpen = false;
                this.deleteAction = '';
                this.deleteName = '';
            }
        }"
        class="py-10"
    >
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

            <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-[#e7e7e1]">

                @if ($books->isEmpty())

                    <div class="px-6 py-16 text-center">
                        <h3 class="text-base font-semibold text-gray-900">
                            Belum ada buku
                        </h3>

                        <p class="mt-2 text-sm text-gray-500">
                            Tambahkan buku untuk mulai mengisi katalog.
                        </p>
                    </div>

                @else

                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="bg-[#fafaf7]">
                                <tr class="border-b border-[#e7e7e1]">

                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        Cover
                                    </th>

                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        Judul
                                    </th>

                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        Kategori
                                    </th>

                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        Penulis
                                    </th>

                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        Harga
                                    </th>

                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        Stok
                                    </th>

                                    <th class="px-6 py-4 text-right text-sm font-semibold text-gray-700">
                                        Aksi
                                    </th>

                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">

                                @foreach ($books as $book)

                                    <tr class="hover:bg-[#fafaf7]">

                                        <td class="px-6 py-4">

                                            @if ($book->cover_image)
                                                <img
                                                    src="{{ asset('storage/' . $book->cover_image) }}"
                                                    alt="{{ $book->title }}"
                                                    class="h-20 w-14 rounded-md object-cover ring-1 ring-gray-200"
                                                >
                                            @else
                                                <div class="flex h-20 w-14 items-center justify-center rounded-md bg-gray-100 px-1 text-center text-[10px] text-gray-400">
                                                    No Cover
                                                </div>
                                            @endif

                                        </td>

                                        <td class="px-6 py-4">

                                            <div class="font-medium text-gray-900">
                                                {{ $book->title }}
                                            </div>

                                            @if ($book->isbn)
                                                <div class="mt-1 text-xs text-gray-500">
                                                    ISBN: {{ $book->isbn }}
                                                </div>
                                            @endif

                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $book->category?->name ?? '-' }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $book->author }}
                                        </td>

                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                            Rp {{ number_format($book->price, 0, ',', '.') }}
                                        </td>

                                        <td class="px-6 py-4">

                                            @if ($book->stock > 0)
                                                <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">
                                                    {{ $book->stock }}
                                                </span>
                                            @else
                                                <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">
                                                    Habis
                                                </span>
                                            @endif

                                        </td>

                                        <td class="px-6 py-4">

                                            <div class="flex justify-end gap-2">

                                                <a
                                                    href="{{ route('admin.books.edit', $book) }}"
                                                    class="rounded-md bg-[#d9a441] px-3 py-2 text-sm font-medium text-white transition hover:bg-[#c79335]"
                                                >
                                                    Edit
                                                </a>

                                                <button
                                                    type="button"
                                                    @click="openDelete(
                                                        '{{ route('admin.books.destroy', $book) }}',
                                                        @js($book->title)
                                                    )"
                                                    class="rounded-md bg-red-600 px-3 py-2 text-sm font-medium text-white transition hover:bg-red-700"
                                                >
                                                    Hapus
                                                </button>

                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @endif

            </div>

        </div>

        <x-delete-modal
            title="Hapus buku?"
            message="akan dihapus beserta cover yang tersimpan. Tindakan ini tidak dapat dibatalkan."
        />

    </div>
</x-app-layout>