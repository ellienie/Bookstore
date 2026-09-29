<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Tambah Buku
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Tambahkan data buku baru beserta cover-nya.
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

                <form
                    action="{{ route('admin.books.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                        <!-- Judul -->
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
                                value="{{ old('title') }}"
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
                                        @selected(old('category_id') == $category->id)
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
                                value="{{ old('author') }}"
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
                                value="{{ old('isbn') }}"
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
                                value="{{ old('price') }}"
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
                                value="{{ old('stock', 0) }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('stock')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>

                    <!-- Cover -->
                    <div
                        class="mt-6"
                        x-data="{
                            preview: null,
                            loadPreview(event) {
                                const file = event.target.files[0];

                                if (!file) {
                                    this.preview = null;
                                    return;
                                }

                                this.preview = URL.createObjectURL(file);
                            }
                        }"
                    >
                        <label
                            for="cover_image"
                            class="mb-2 block text-sm font-medium text-gray-700"
                        >
                            Cover Buku
                        </label>

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-start">
                            <div
                                class="flex h-48 w-36 shrink-0 items-center justify-center overflow-hidden rounded-lg border border-dashed border-gray-300 bg-gray-50"
                            >
                                <template x-if="preview">
                                    <img
                                        :src="preview"
                                        class="h-full w-full object-cover"
                                        alt="Preview cover"
                                    >
                                </template>

                                <template x-if="!preview">
                                    <span class="px-3 text-center text-sm text-gray-400">
                                        Preview Cover
                                    </span>
                                </template>
                            </div>

                            <div class="flex-1">
                                <input
                                    id="cover_image"
                                    type="file"
                                    name="cover_image"
                                    accept=".jpg,.jpeg,.png,.webp"
                                    @change="loadPreview($event)"
                                    class="block w-full rounded-md border border-gray-300 bg-white text-sm text-gray-700 file:mr-4 file:border-0 file:bg-gray-100 file:px-4 file:py-2.5 file:text-sm file:font-medium file:text-gray-700 hover:file:bg-gray-200"
                                >

                                <p class="mt-2 text-xs text-gray-500">
                                    Format: JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                                </p>

                                @error('cover_image')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
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
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mt-6 flex justify-end gap-3 border-t border-gray-100 pt-6">
                        <a
                            href="{{ route('admin.books.index') }}"
                            class="rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-200"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="rounded-md bg-gray-800 px-5 py-2.5 text-sm font-semibold text-white hover:bg-gray-700"
                        >
                            Simpan Buku
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>