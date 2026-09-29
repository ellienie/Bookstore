<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Checkout
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Periksa pesanan dan lengkapi alamat pengiriman.
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <form
                action="{{ route('user.checkout.store') }}"
                method="POST"
            >
                @csrf

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_380px]">

                    <div class="space-y-6">

                        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

                            <h3 class="text-lg font-semibold text-gray-900">
                                Alamat Pengiriman
                            </h3>

                            <div class="mt-5">
                                <label
                                    for="address"
                                    class="mb-2 block text-sm font-medium text-gray-700"
                                >
                                    Alamat Lengkap
                                </label>

                                <textarea
                                    id="address"
                                    name="address"
                                    rows="6"
                                    placeholder="Masukkan alamat lengkap penerima..."
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >{{ old('address') }}</textarea>

                                @error('address')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>

                        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

                            <h3 class="text-lg font-semibold text-gray-900">
                                Metode Pembayaran
                            </h3>

                            <label
                                class="mt-5 flex cursor-pointer items-start gap-3 rounded-lg border border-gray-200 p-4"
                            >
                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="cod"
                                    checked
                                    class="mt-1 border-gray-300 text-gray-800 focus:ring-gray-500"
                                >

                                <div>
                                    <div class="font-medium text-gray-900">
                                        Payment at Delivery
                                    </div>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Pembayaran dilakukan saat pesanan diterima.
                                    </p>
                                </div>
                            </label>

                            @error('payment_method')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-200">

                            <div class="border-b border-gray-100 px-6 py-4">
                                <h3 class="font-semibold text-gray-900">
                                    Buku yang Dipesan
                                </h3>
                            </div>

                            <div class="divide-y divide-gray-100">

                                @foreach ($cart as $item)
                                    <div class="flex gap-4 p-6">

                                        @if ($item['cover_image'])
                                            <img
                                                src="{{ asset('storage/' . $item['cover_image']) }}"
                                                alt="{{ $item['title'] }}"
                                                class="h-24 w-16 rounded-md object-cover ring-1 ring-gray-200"
                                            >
                                        @else
                                            <div
                                                class="flex h-24 w-16 items-center justify-center rounded-md bg-gray-100 text-xs text-gray-400"
                                            >
                                                No Cover
                                            </div>
                                        @endif

                                        <div class="flex flex-1 justify-between gap-4">

                                            <div>
                                                <h4 class="font-medium text-gray-900">
                                                    {{ $item['title'] }}
                                                </h4>

                                                <p class="mt-1 text-sm text-gray-500">
                                                    {{ $item['quantity'] }}
                                                    ×
                                                    Rp {{ number_format($item['price'], 0, ',', '.') }}
                                                </p>
                                            </div>

                                            <div class="font-semibold text-gray-900">
                                                Rp {{ number_format(
                                                    $item['price'] * $item['quantity'],
                                                    0,
                                                    ',',
                                                    '.'
                                                ) }}
                                            </div>

                                        </div>

                                    </div>
                                @endforeach

                            </div>

                        </div>

                    </div>

                    <div>
                        <div class="sticky top-24 rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

                            <h3 class="text-lg font-semibold text-gray-900">
                                Ringkasan Pesanan
                            </h3>

                            <div class="mt-6 space-y-4">

                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Total Item</span>

                                    <span>
                                        {{ collect($cart)->sum('quantity') }}
                                    </span>
                                </div>

                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Metode Pembayaran</span>

                                    <span>
                                        Payment at Delivery
                                    </span>
                                </div>

                                <div class="border-t border-gray-100 pt-4">

                                    <div class="flex items-center justify-between">

                                        <span class="font-semibold text-gray-900">
                                            Total
                                        </span>

                                        <span class="text-xl font-bold text-gray-900">
                                            Rp {{ number_format($total, 0, ',', '.') }}
                                        </span>

                                    </div>

                                </div>

                            </div>

                            <button
                                type="submit"
                                class="mt-6 w-full rounded-md bg-gray-800 px-5 py-3 text-sm font-semibold text-white hover:bg-gray-700"
                            >
                                Buat Pesanan
                            </button>

                            <a
                                href="{{ route('user.cart.index') }}"
                                class="mt-3 block w-full rounded-md bg-gray-100 px-5 py-3 text-center text-sm font-medium text-gray-700 hover:bg-gray-200"
                            >
                                Kembali ke Keranjang
                            </a>

                        </div>
                    </div>

                </div>

            </form>

        </div>
    </div>
</x-app-layout>