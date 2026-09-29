<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Pesanan Berhasil
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Pesanan kamu sudah berhasil dibuat.
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            <div class="rounded-xl bg-white p-8 shadow-sm ring-1 ring-gray-200">

                <div class="text-center">

                    <div
                        class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-green-100 text-2xl text-green-700"
                    >
                        ✓
                    </div>

                    <h2 class="mt-4 text-2xl font-bold text-gray-900">
                        Pesanan berhasil dibuat
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        Nomor pesanan:
                    </p>

                    <p class="mt-1 font-semibold text-gray-900">
                        {{ $order->order_number }}
                    </p>

                </div>

                <div class="mt-8 rounded-lg bg-gray-50 p-5">

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        <div>
                            <p class="text-xs text-gray-500">
                                Status
                            </p>

                            <p class="mt-1 font-medium text-gray-900">
                                Menunggu
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500">
                                Pembayaran
                            </p>

                            <p class="mt-1 font-medium text-gray-900">
                                Payment at Delivery
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500">
                                Total
                            </p>

                            <p class="mt-1 font-medium text-gray-900">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500">
                                Tanggal Pesanan
                            </p>

                            <p class="mt-1 font-medium text-gray-900">
                                {{ $order->created_at->format('d M Y H:i') }}
                            </p>
                        </div>

                    </div>

                    <div class="mt-5 border-t border-gray-200 pt-5">

                        <p class="text-xs text-gray-500">
                            Alamat Pengiriman
                        </p>

                        <p class="mt-1 whitespace-pre-line text-sm text-gray-900">
                            {{ $order->address }}
                        </p>

                    </div>

                </div>

                <div class="mt-8">

                    <h3 class="font-semibold text-gray-900">
                        Detail Buku
                    </h3>

                    <div class="mt-4 divide-y divide-gray-100 rounded-lg border border-gray-200">

                        @foreach ($order->items as $item)

                            <div class="flex justify-between gap-4 p-4">

                                <div>
                                    <p class="font-medium text-gray-900">
                                        {{ $item->book_title }}
                                    </p>

                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ $item->quantity }} ×
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </p>
                                </div>

                                <div class="font-semibold text-gray-900">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

                <div class="mt-8 flex justify-center">

                    <a
                        href="{{ route('user.books.index') }}"
                        class="rounded-md bg-gray-800 px-5 py-2.5 text-sm font-semibold text-white hover:bg-gray-700"
                    >
                        Kembali ke Katalog
                    </a>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>