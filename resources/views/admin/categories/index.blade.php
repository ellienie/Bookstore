<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">
                    Kategori Buku
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Kelola kategori buku yang tersedia.
                </p>
            </div>

            <a
                href="{{ route('admin.categories.create') }}"
                class="inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-gray-800"
            >
                + Tambah Kategori
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

                <div class="overflow-x-auto">
                    <table class="w-full">

                        <thead class="bg-[#fafaf7]">
                            <tr class="border-b border-[#e7e7e1]">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                    No
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                    Nama Kategori
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                    Deskripsi
                                </th>

                                <th class="px-6 py-4 text-right text-sm font-semibold text-gray-700">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse ($categories as $category)

                                <tr class="hover:bg-[#fafaf7]">

                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                        {{ $category->name }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $category->description ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4">

                                        <div class="flex justify-end gap-2">

                                            <a
                                                href="{{ route('admin.categories.edit', $category) }}"
                                                class="rounded-md bg-[#d9a441] px-3 py-2 text-sm font-medium text-white transition hover:bg-[#c79335]"
                                            >
                                                Edit
                                            </a>

                                            <button
                                                type="button"
                                                @click="openDelete(
                                                    '{{ route('admin.categories.destroy', $category) }}',
                                                    @js($category->name)
                                                )"
                                                class="rounded-md bg-red-600 px-3 py-2 text-sm font-medium text-white transition hover:bg-red-700"
                                            >
                                                Hapus
                                            </button>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td
                                        colspan="4"
                                        class="px-6 py-14 text-center text-sm text-gray-500"
                                    >
                                        Belum ada kategori buku.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>
                </div>

            </div>

        </div>

        <x-delete-modal
            title="Hapus kategori?"
            message="akan dihapus. Tindakan ini tidak dapat dibatalkan."
        />

    </div>
</x-app-layout>