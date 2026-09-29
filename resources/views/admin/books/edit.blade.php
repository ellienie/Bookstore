<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Edit Buku
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Perbarui data buku, stok, harga, kategori, dan cover buku.
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

                <form
                    action="{{ route('admin.books.update', $book) }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                        <!-- Judul Buku -->
                        <div>
                            <label
                                for="title"
                                class="mb-2 block text-sm font-medium text-gray-700"
                            >
                                Judul Buku
                            </label>

                            <input
                                id="title"
                                type="text"
                                name="title"
                                value="{{ old('title', $book->title) }}"
                                placeholder="Contoh: Atomic Habits"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('title')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label
                                for="category_id"
                                class="mb-2 block text-sm font-medium text-gray-700"
                            >
                                Kategori
                            </label>

                            <select
                                id="category_id"
                                name="category_id"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >
                                <option value="">
                                    -- Pilih Kategori --
                                </option>

                                @foreach ($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        @selected(
                                            old('category_id', $book->category_id) == $category->id
                                        )
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Penulis -->
                        <div>
                            <label
                                for="author"
                                class="mb-2 block text-sm font-medium text-gray-700"
                            >
                                Penulis
                            </label>

                            <input
                                id="author"
                                type="text"
                                name="author"
                                value="{{ old('author', $book->author) }}"
                                placeholder="Nama penulis"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('author')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- ISBN -->
                        <div>
                            <label
                                for="isbn"
                                class="mb-2 block text-sm font-medium text-gray-700"
                            >
                                ISBN
                            </label>

                            <input
                                id="isbn"
                                type="text"
                                name="isbn"
                                value="{{ old('isbn', $book->isbn) }}"
                                placeholder="Opsional"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('isbn')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Harga -->
                        <div>
                            <label
                                for="price"
                                class="mb-2 block text-sm font-medium text-gray-700"
                            >
                                Harga
                            </label>

                            <input
                                id="price"
                                type="number"
                                name="price"
                                min="0"
                                step="1"
                                value="{{ old('price', $book->price) }}"
                                placeholder="Contoh: 120000"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('price')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Stok -->
                        <div>
                            <label
                                for="stock"
                                class="mb-2 block text-sm font-medium text-gray-700"
                            >
                                Stok
                            </label>

                            <input
                                id="stock"
                                type="number"
                                name="stock"
                                min="0"
                                value="{{ old('stock', $book->stock) }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('stock')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>

                    <!-- Cover Buku -->
                    <div
                        class="mt-8"
                        x-data="{
                            preview: null,

                            loadPreview(event) {
                                const file = event.target.files[0];

                                if (!file) {
                                    this.preview = null;
                                    return;
                                }

                                this.preview = URL.createObjectURL(file);
                            },

                            resetPreview() {
                                this.preview = null;
                                document.getElementById('cover_image').value = '';
                            }
                        }"
                    >
                        <div class="mb-3">
                            <h3 class="text-sm font-medium text-gray-700">
                                Cover Buku
                            </h3>

                            <p class="mt-1 text-xs text-gray-500">
                                Kosongkan jika tidak ingin mengganti cover lama.
                            </p>
                        </div>

                        <div class="flex flex-col gap-5 sm:flex-row sm:items-start">

                            <!-- Preview -->
                            <div>
                                <div
                                    class="flex h-56 w-40 items-center justify-center overflow-hidden rounded-lg border border-gray-200 bg-gray-50 shadow-sm"
                                >
                                    <template x-if="preview">
                                        <img
                                            :src="preview"
                                            alt="Preview cover baru"
                                            class="h-full w-full object-cover"
                                        >
                                    </template>

                                    <template x-if="!preview">
                                        <div class="h-full w-full">
                                            @if ($book->cover_image)
                                                <img
                                                    src="{{ asset('storage/' . $book->cover_image) }}"
                                                    alt="{{ $book->title }}"
                                                    class="h-full w-full object-cover"
                                                >
                                            @else
                                                <div
                                                    class="flex h-full w-full items-center justify-center px-4 text-center text-sm text-gray-400"
                                                >
                                                    Belum ada cover
                                                </div>
                                            @endif
                                        </div>
                                    </template>
                                </div>

                                @if ($book->cover_image)
                                    <p class="mt-2 text-center text-xs text-gray-500">
                                        Cover saat ini
                                    </p>
                                @endif
                            </div>

                            <!-- Input -->
                            <div class="flex-1">
                                <label
                                    for="cover_image"
                                    class="mb-2 block text-sm font-medium text-gray-700"
                                >
                                    Ganti Cover
                                </label>

                                <input
                                    id="cover_image"
                                    type="file"
                                    name="cover_image"
                                    accept=".jpg,.jpeg,.png,.webp"
                                    @change="loadPreview($event)"
                                    class="block w-full rounded-md border border-gray-300 bg-white text-sm text-gray-700 file:mr-4 file:border-0 file:bg-gray-100 file:px-4 file:py-2.5 file:text-sm file:font-medium file:text-gray-700 hover:file:bg-gray-200"
                                >

                                <p class="mt-2 text-xs text-gray-500">
                                    Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                                </p>

                                @error('cover_image')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                                <div
                                    x-show="preview"
                                    x-cloak
                                    class="mt-3"
                                >
                                    <button
                                        type="button"
                                        @click="resetPreview()"
                                        class="text-sm font-medium text-red-600 hover:text-red-700"
                                    >
                                        Batalkan cover baru
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mt-8">
                        <label
                            for="description"
                            class="mb-2 block text-sm font-medium text-gray-700"
                        >
                            Deskripsi
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="6"
                            placeholder="Deskripsi singkat buku..."
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >{{ old('description', $book->description) }}</textarea>

                        @error('description')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Action -->
                    <div class="mt-8 flex justify-end gap-3 border-t border-gray-100 pt-6">

                        <a
                            href="{{ route('admin.books.index') }}"
                            class="rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-200"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="rounded-md bg-gray-800 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-700"
                        >
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>