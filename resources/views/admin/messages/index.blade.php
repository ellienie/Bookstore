<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-900">
                Pesan User
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Pesan yang dikirim user kepada admin.
            </p>
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

                @if ($messages->isEmpty())

                    <div class="px-6 py-16 text-center">
                        <h3 class="text-base font-semibold text-gray-900">
                            Belum ada pesan
                        </h3>

                        <p class="mt-2 text-sm text-gray-500">
                            Pesan dari user akan tampil di halaman ini.
                        </p>
                    </div>

                @else

                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="bg-[#fafaf7]">
                                <tr class="border-b border-[#e7e7e1]">

                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        User
                                    </th>

                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        Subject
                                    </th>

                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        Status
                                    </th>

                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        Tanggal
                                    </th>

                                    <th class="px-6 py-4 text-right text-sm font-semibold text-gray-700">
                                        Aksi
                                    </th>

                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">

                                @foreach ($messages as $message)

                                    <tr class="hover:bg-[#fafaf7]">

                                        <td class="px-6 py-4">

                                            <div class="font-medium text-gray-900">
                                                {{ $message->user->name }}
                                            </div>

                                            <div class="mt-1 text-xs text-gray-500">
                                                {{ $message->user->email }}
                                            </div>

                                        </td>

                                        <td class="px-6 py-4">

                                            <div
                                                class="max-w-xs truncate text-sm font-medium text-gray-700"
                                                title="{{ $message->subject }}"
                                            >
                                                {{ $message->subject }}
                                            </div>

                                        </td>

                                        <td class="px-6 py-4">

                                            @if ($message->reply)

                                                <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">
                                                    Dibalas
                                                </span>

                                            @elseif ($message->is_read)

                                                <span class="rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-700">
                                                    Dibaca
                                                </span>

                                            @else

                                                <span class="rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                                    Baru
                                                </span>

                                            @endif

                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $message->created_at->format('d M Y H:i') }}
                                        </td>

                                        <td class="px-6 py-4">

                                            <div class="flex justify-end gap-2">

                                                <a
                                                    href="{{ route('admin.messages.show', $message) }}"
                                                    class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white transition hover:bg-gray-800"
                                                >
                                                    Detail
                                                </a>

                                                <button
                                                    type="button"
                                                    @click="openDelete(
                                                        '{{ route('admin.messages.destroy', $message) }}',
                                                        @js($message->subject)
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
            title="Hapus pesan?"
            message="akan dihapus dari riwayat pesan. Tindakan ini tidak dapat dibatalkan."
        />

    </div>
</x-app-layout>