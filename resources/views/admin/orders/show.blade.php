<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Detail Pesanan
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Informasi lengkap pesanan user.
                </p>
            </div>

            <a
                href="{{ route('admin.orders.index') }}"
                class="rounded-md bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200"
            >
                Kembali
            </a>
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

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_360px]">

                <div class="space-y-6">

                    <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

                        <h3 class="text-lg font-semibold text-gray-900">
                            Informasi Pesanan
                        </h3>

                        <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2">

                            <div>
                                <p class="text-xs text-gray-500">
                                    Nomor Pesanan
                                </p>

                                <p class="mt-1 font-medium text-gray-900">
                                    {{ $order->order_number }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500">
                                    Tanggal
                                </p>

                                <p class="mt-1 font-medium text-gray-900">
                                    {{ $order->created_at->format('d M Y H:i') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500">
                                    Nama User
                                </p>

                                <p class="mt-1 font-medium text-gray-900">
                                    {{ $order->user->name }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500">
                                    Email
                                </p>

                                <p class="mt-1 font-medium text-gray-900">
                                    {{ $order->user->email }}
                                </p>
                            </div>

                        </div>

                        <div class="mt-6 border-t border-gray-100 pt-6">

                            <p class="text-xs text-gray-500">
                                Alamat Pengiriman
                            </p>

                            <p class="mt-2 whitespace-pre-line text-sm text-gray-900">
                                {{ $order->address }}
                            </p>

                        </div>

                    </div>

                    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200">

                        <div class="border-b border-gray-100 px-6 py-4">
                            <h3 class="font-semibold text-gray-900">
                                Item Pesanan
                            </h3>
                        </div>

                        <div class="divide-y divide-gray-100">

                            @foreach ($order->items as $item)
                                <div class="flex gap-4 p-6">

                                    <div class="shrink-0">

                                        @if ($item->book && $item->book->cover_image)
                                            <img
                                                src="{{ asset('storage/' . $item->book->cover_image) }}"
                                                alt="{{ $item->book_title }}"
                                                class="h-24 w-16 rounded-md object-cover ring-1 ring-gray-200"
                                            >
                                        @else
                                            <div
                                                class="flex h-24 w-16 items-center justify-center rounded-md bg-gray-100 px-2 text-center text-xs text-gray-400"
                                            >
                                                No Cover
                                            </div>
                                        @endif

                                    </div>

                                    <div class="flex flex-1 justify-between gap-4">

                                        <div>
                                            <h4 class="font-medium text-gray-900">
                                                {{ $item->book_title }}
                                            </h4>

                                            <p class="mt-1 text-sm text-gray-500">
                                                {{ $item->quantity }}
                                                ×
                                                Rp {{ number_format($item->price, 0, ',', '.') }}
                                            </p>
                                        </div>

                                        <div class="font-semibold text-gray-900">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </div>

                                    </div>

                                </div>
                            @endforeach

                        </div>

                    </div>

                </div>

                <div class="space-y-6">

                    <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

                        <h3 class="text-lg font-semibold text-gray-900">
                            Ringkasan Pesanan
                        </h3>

                        <div class="mt-6 space-y-4">

                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Status</span>

                                @if ($order->status === 'completed')
                                    <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">
                                        Selesai
                                    </span>
                                @elseif ($order->status === 'processing')
                                    <span class="rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-700">
                                        Diproses
                                    </span>
                                @elseif ($order->status === 'cancelled')
                                    <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">
                                        Dibatalkan
                                    </span>
                                @else
                                    <span class="rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                        Menunggu
                                    </span>
                                @endif
                            </div>

                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Pembayaran</span>

                                <span>
                                    {{ $order->payment_method === 'cod'
                                        ? 'Payment at Delivery'
                                        : strtoupper($order->payment_method) }}
                                </span>
                            </div>

                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Total Item</span>

                                <span>
                                    {{ $order->items->sum('quantity') }}
                                </span>
                            </div>

                            <div class="border-t border-gray-100 pt-4">

                                <div class="flex items-center justify-between">

                                    <span class="font-semibold text-gray-900">
                                        Total
                                    </span>

                                    <span class="text-xl font-bold text-gray-900">
                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

                        <h3 class="text-lg font-semibold text-gray-900">
                            Ubah Status Pesanan
                        </h3>

                        <form
                            action="{{ route('admin.orders.update-status', $order) }}"
                            method="POST"
                            class="mt-5"
                        >
                            @csrf
                            @method('PATCH')

                            <label
                                for="status"
                                class="mb-2 block text-sm font-medium text-gray-700"
                            >
                                Status
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >
                                <option
                                    value="pending"
                                    @selected($order->status === 'pending')
                                >
                                    Menunggu
                                </option>

                                <option
                                    value="processing"
                                    @selected($order->status === 'processing')
                                >
                                    Diproses
                                </option>

                                <option
                                    value="completed"
                                    @selected($order->status === 'completed')
                                >
                                    Selesai
                                </option>

                                <option
                                    value="cancelled"
                                    @selected($order->status === 'cancelled')
                                >
                                    Dibatalkan
                                </option>
                            </select>

                            @error('status')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                            <button
                                type="submit"
                                class="mt-4 w-full rounded-md bg-gray-800 px-4 py-2.5 text-sm font-semibold text-white hover:bg-gray-700"
                            >
                                Simpan Status
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>