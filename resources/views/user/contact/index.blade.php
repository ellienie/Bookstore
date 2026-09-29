<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Contact Admin
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Kirim pesan kepada admin BookStore.
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

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

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-[420px_1fr]">

                <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

                    <h3 class="text-lg font-semibold text-gray-900">
                        Kirim Pesan
                    </h3>

                    <form
                        action="{{ route('user.contact.store') }}"
                        method="POST"
                        class="mt-6"
                    >
                        @csrf

                        <div>
                            <label
                                for="subject"
                                class="mb-2 block text-sm font-medium text-gray-700"
                            >
                                Subject
                            </label>

                            <input
                                id="subject"
                                type="text"
                                name="subject"
                                value="{{ old('subject') }}"
                                placeholder="Contoh: Pertanyaan pesanan"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('subject')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mt-5">
                            <label
                                for="message"
                                class="mb-2 block text-sm font-medium text-gray-700"
                            >
                                Pesan
                            </label>

                            <textarea
                                id="message"
                                name="message"
                                rows="7"
                                placeholder="Tulis pesan untuk admin..."
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >{{ old('message') }}</textarea>

                            @error('message')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <button
                            type="submit"
                            class="mt-6 w-full rounded-md bg-gray-800 px-5 py-3 text-sm font-semibold text-white hover:bg-gray-700"
                        >
                            Kirim Pesan
                        </button>
                    </form>

                </div>

                <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200">

                    <div class="border-b border-gray-100 px-6 py-4">
                        <h3 class="font-semibold text-gray-900">
                            Riwayat Pesan
                        </h3>
                    </div>

                    @if ($messages->isEmpty())

                        <div class="px-6 py-12 text-center text-sm text-gray-500">
                            Belum ada pesan yang dikirim.
                        </div>

                    @else

                        <div class="divide-y divide-gray-100">

                            @foreach ($messages as $message)

                                <div class="p-6">

                                    <div class="flex items-start justify-between gap-4">

                                        <div>
                                            <h4 class="font-semibold text-gray-900">
                                                {{ $message->subject }}
                                            </h4>

                                            <p class="mt-1 text-xs text-gray-500">
                                                {{ $message->created_at->format('d M Y H:i') }}
                                            </p>
                                        </div>

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
                                                Terkirim
                                            </span>

                                        @endif

                                    </div>

                                    <div class="mt-4 rounded-lg bg-gray-50 p-4">

                                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                            Pesan Kamu
                                        </p>

                                        <p class="mt-2 whitespace-pre-line text-sm leading-6 text-gray-700">
                                            {{ $message->message }}
                                        </p>

                                    </div>

                                    @if ($message->reply)

                                        <div class="mt-3 rounded-lg bg-green-50 p-4 ring-1 ring-green-100">

                                            <div class="flex items-center justify-between gap-3">

                                                <p class="text-xs font-semibold uppercase tracking-wide text-green-700">
                                                    Balasan Admin
                                                </p>

                                                @if ($message->replied_at)
                                                    <span class="text-xs text-green-600">
                                                        {{ $message->replied_at->format('d M Y H:i') }}
                                                    </span>
                                                @endif

                                            </div>

                                            <p class="mt-2 whitespace-pre-line text-sm leading-6 text-green-900">
                                                {{ $message->reply }}
                                            </p>

                                        </div>

                                    @endif

                                </div>

                            @endforeach

                        </div>

                    @endif

                </div>

            </div>

        </div>
    </div>
</x-app-layout>