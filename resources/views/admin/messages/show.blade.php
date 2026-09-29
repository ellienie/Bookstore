<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Detail Pesan
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Pesan yang dikirim user.
                </p>
            </div>

            <a
                href="{{ route('admin.messages.index') }}"
                class="rounded-md bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200"
            >
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

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

            <div class="space-y-6">

                <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                        <div>
                            <p class="text-xs text-gray-500">
                                Nama User
                            </p>

                            <p class="mt-1 font-medium text-gray-900">
                                {{ $message->user->name }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500">
                                Email
                            </p>

                            <p class="mt-1 font-medium text-gray-900">
                                {{ $message->user->email }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500">
                                Subject
                            </p>

                            <p class="mt-1 font-medium text-gray-900">
                                {{ $message->subject }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500">
                                Tanggal
                            </p>

                            <p class="mt-1 font-medium text-gray-900">
                                {{ $message->created_at->format('d M Y H:i') }}
                            </p>
                        </div>

                    </div>

                    <div class="mt-6 border-t border-gray-100 pt-6">
                        <p class="text-xs text-gray-500">
                            Pesan User
                        </p>

                        <p class="mt-3 whitespace-pre-line text-sm leading-7 text-gray-700">
                            {{ $message->message }}
                        </p>
                    </div>

                </div>

                @if ($message->reply)
                    <div class="rounded-xl bg-green-50 p-6 ring-1 ring-green-200">

                        <div class="flex items-center justify-between gap-4">
                            <h3 class="font-semibold text-green-900">
                                Balasan Admin
                            </h3>

                            @if ($message->replied_at)
                                <span class="text-xs text-green-700">
                                    {{ $message->replied_at->format('d M Y H:i') }}
                                </span>
                            @endif
                        </div>

                        <p class="mt-4 whitespace-pre-line text-sm leading-7 text-green-900">
                            {{ $message->reply }}
                        </p>

                    </div>
                @endif

                <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $message->reply ? 'Ubah Balasan' : 'Balas Pesan' }}
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Balasan ini akan tampil di halaman Contact Admin milik user.
                    </p>

                    <form
                        action="{{ route('admin.messages.reply', $message) }}"
                        method="POST"
                        class="mt-5"
                    >
                        @csrf
                        @method('PATCH')

                        <div>
                            <label
                                for="reply"
                                class="mb-2 block text-sm font-medium text-gray-700"
                            >
                                Balasan
                            </label>

                            <textarea
                                id="reply"
                                name="reply"
                                rows="6"
                                placeholder="Tulis balasan untuk user..."
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >{{ old('reply', $message->reply) }}</textarea>

                            @error('reply')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <button
                            type="submit"
                            class="mt-4 rounded-md bg-gray-800 px-5 py-2.5 text-sm font-semibold text-white hover:bg-gray-700"
                        >
                            {{ $message->reply ? 'Simpan Perubahan' : 'Kirim Balasan' }}
                        </button>

                    </form>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>