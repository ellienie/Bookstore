<x-app-layout>

    <x-slot name="header">

        <h2 class="text-xl font-semibold text-gray-800">
            Tambah Kategori Buku
        </h2>

    </x-slot>

    <div class="py-10">

        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">

            <div class="rounded-lg bg-white p-6 shadow-sm">

                <form
                    action="{{ route('admin.categories.store') }}"
                    method="POST"
                >

                    @csrf

                    <div class="mb-6">

                        <label
                            for="name"
                            class="mb-2 block font-medium text-gray-700"
                        >
                            Nama Kategori
                        </label>

                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Contoh: Novel"
                        >

                        @error('name')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div class="mb-6">

                        <label
                            for="description"
                            class="mb-2 block font-medium text-gray-700"
                        >
                            Deskripsi
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Deskripsi kategori..."
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div class="flex justify-end gap-3 border-t pt-6">

                        <a
                            href="{{ route('admin.categories.index') }}"
                            class="rounded-md bg-gray-200 px-5 py-2.5 font-medium text-gray-700 hover:bg-gray-300"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="rounded-md bg-gray-800 px-5 py-2.5 font-medium text-white hover:bg-gray-700"
                        >
                            Simpan Kategori
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>