<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-900">
                Keranjang Belanja
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Kelola buku yang akan kamu beli.
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-[1600px] px-5 sm:px-6 lg:px-8">

            @if (session('success'))
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-show="show"
                    x-cloak
                    x-transition
                    class="fixed right-6 top-6 z-50 rounded-lg bg-[#71806f] px-5 py-4 text-sm font-medium text-white shadow-lg"
                >
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-show="show"
                    x-cloak
                    x-transition
                    class="fixed right-6 top-6 z-50 rounded-lg bg-red-600 px-5 py-4 text-sm font-medium text-white shadow-lg"
                >
                    {{ session('error') }}
                </div>
            @endif

            @if (empty($cart))

                <div class="rounded-xl bg-white px-6 py-16 text-center shadow-sm ring-1 ring-[#e7e7e1]">

                    <h3 class="text-lg font-semibold text-gray-900">
                        Keranjang masih kosong
                    </h3>

                    <p class="mt-2 text-sm text-gray-500">
                        Tambahkan buku dari katalog untuk mulai berbelanja.
                    </p>

                    <a
                        href="{{ route('user.books.index') }}"
                        class="mt-6 inline-flex rounded-md bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-800"
                    >
                        Lihat Katalog Buku
                    </a>

                </div>

            @else

                @php
                    $totalItems = collect($cart)->sum('quantity');

                    $totalPrice = collect($cart)->sum(function ($item) {
                        return $item['price'] * $item['quantity'];
                    });
                @endphp

                <div class="grid grid-cols-1 gap-6 xl:grid-cols-[minmax(0,1fr)_340px]">

                    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-[#e7e7e1]">

                        <div class="border-b border-[#e7e7e1] px-6 py-4">
                            <h3 class="font-semibold text-gray-900">
                                Daftar Buku
                            </h3>
                        </div>

                        <div class="divide-y divide-gray-100">

                            @foreach ($cart as $bookId => $item)

                                <div
                                    class="p-6"
                                    x-data="{
                                        quantity: {{ (int) $item['quantity'] }},
                                        maxStock: {{ (int) $item['stock'] }},
                                        submitting: false,

                                        submitUpdate() {
                                            if (this.submitting) {
                                                return;
                                            }

                                            let value = parseInt(this.quantity);

                                            if (isNaN(value)) {
                                                value = 1;
                                            }

                                            if (value < 1) {
                                                value = 1;
                                            }

                                            if (value > this.maxStock) {
                                                value = this.maxStock;
                                            }

                                            this.quantity = value;
                                            this.submitting = true;

                                            this.$nextTick(() => {
                                                this.$refs.updateForm.submit();
                                            });
                                        },

                                        decrement() {
                                            if (this.submitting || this.quantity <= 1) {
                                                return;
                                            }

                                            this.quantity = Number(this.quantity) - 1;

                                            this.submitUpdate();
                                        },

                                        increment() {
                                            if (this.submitting || this.quantity >= this.maxStock) {
                                                return;
                                            }

                                            this.quantity = Number(this.quantity) + 1;

                                            this.submitUpdate();
                                        }
                                    }"
                                >

                                    <div class="flex flex-col gap-5 lg:flex-row lg:items-center">

                                        <div class="flex min-w-0 flex-1 gap-4">

                                            @if (! empty($item['cover_image']))

                                                <img
                                                    src="{{ asset('storage/' . $item['cover_image']) }}"
                                                    alt="{{ $item['title'] }}"
                                                    class="h-32 w-24 shrink-0 rounded-lg object-cover ring-1 ring-gray-200"
                                                >

                                            @else

                                                <div class="flex h-32 w-24 shrink-0 items-center justify-center rounded-lg bg-gray-100 px-2 text-center text-xs text-gray-400">
                                                    No Cover
                                                </div>

                                            @endif

                                            <div class="min-w-0 flex-1">

                                                <h4 class="truncate font-semibold text-gray-900">
                                                    {{ $item['title'] }}
                                                </h4>

                                                <p class="mt-2 text-sm font-medium text-gray-700">
                                                    Rp {{ number_format($item['price'], 0, ',', '.') }}
                                                </p>

                                                <p class="mt-1 text-xs text-gray-500">
                                                    Stok tersedia: {{ $item['stock'] }}
                                                </p>

                                                <form
                                                    x-ref="updateForm"
                                                    action="{{ route('user.cart.update', $bookId) }}"
                                                    method="POST"
                                                    class="mt-4"
                                                >
                                                    @csrf
                                                    @method('PATCH')

                                                    <label
                                                        for="quantity-{{ $bookId }}"
                                                        class="mb-2 block text-xs font-medium text-gray-600"
                                                    >
                                                        Jumlah
                                                    </label>

                                                    <div class="flex items-center gap-2">

                                                        <button
                                                            type="button"
                                                            @click="decrement()"
                                                            :disabled="quantity <= 1 || submitting"
                                                            class="flex h-9 w-9 items-center justify-center rounded-md bg-[#f3f3ee] text-lg font-medium text-gray-700 transition hover:bg-[#e9e9e3] disabled:cursor-not-allowed disabled:opacity-40"
                                                        >
                                                            −
                                                        </button>

                                                        <input
                                                            id="quantity-{{ $bookId }}"
                                                            type="number"
                                                            name="quantity"
                                                            x-model.number="quantity"
                                                            min="1"
                                                            max="{{ $item['stock'] }}"
                                                            @change="submitUpdate()"
                                                            @keydown.enter.prevent="submitUpdate()"
                                                            :readonly="submitting"
                                                            class="h-9 w-16 rounded-md border-gray-300 bg-white text-center text-sm shadow-sm focus:border-[#71806f] focus:ring-[#71806f] read-only:bg-gray-50"
                                                        >

                                                        <button
                                                            type="button"
                                                            @click="increment()"
                                                            :disabled="quantity >= maxStock || submitting"
                                                            class="flex h-9 w-9 items-center justify-center rounded-md bg-[#f3f3ee] text-lg font-medium text-gray-700 transition hover:bg-[#e9e9e3] disabled:cursor-not-allowed disabled:opacity-40"
                                                        >
                                                            +
                                                        </button>

                                                        <span
                                                            x-show="submitting"
                                                            x-cloak
                                                            class="ml-1 text-xs text-gray-400"
                                                        >
                                                            Menyimpan...
                                                        </span>

                                                    </div>

                                                </form>

                                            </div>

                                        </div>

                                        <div class="flex items-center justify-between gap-4 lg:block lg:min-w-[150px] lg:text-right">

                                            <div>
                                                <p class="text-xs text-gray-500">
                                                    Subtotal
                                                </p>

                                                <p class="mt-1 font-semibold text-gray-900">
                                                    Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                                </p>
                                            </div>

                                            <form
                                                action="{{ route('user.cart.destroy', $bookId) }}"
                                                method="POST"
                                                class="lg:mt-4"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="rounded-md bg-red-600 px-3 py-2 text-sm font-medium text-white transition hover:bg-red-700"
                                                >
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                    <aside class="h-fit rounded-xl bg-white p-6 shadow-sm ring-1 ring-[#e7e7e1]">

                        <h3 class="text-lg font-semibold text-gray-900">
                            Ringkasan Belanja
                        </h3>

                        <div class="mt-6 space-y-4 text-sm">

                            <div class="flex items-center justify-between text-gray-600">
                                <span>Total Item</span>

                                <span>
                                    {{ $totalItems }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between text-gray-600">
                                <span>Total Harga</span>

                                <span>
                                    Rp {{ number_format($totalPrice, 0, ',', '.') }}
                                </span>
                            </div>

                        </div>

                        <div class="my-5 border-t border-gray-100"></div>

                        <div class="flex items-center justify-between">

                            <span class="font-semibold text-gray-900">
                                Total
                            </span>

                            <span class="text-xl font-bold text-gray-900">
                                Rp {{ number_format($totalPrice, 0, ',', '.') }}
                            </span>

                        </div>

                        <a
                            href="{{ route('user.checkout.index') }}"
                            class="mt-6 block w-full rounded-md bg-gray-900 px-5 py-3 text-center text-sm font-semibold text-white transition hover:bg-gray-800"
                        >
                            Lanjut Checkout
                        </a>

                        <a
                            href="{{ route('user.books.index') }}"
                            class="mt-3 block w-full rounded-md bg-[#f3f3ee] px-5 py-3 text-center text-sm font-medium text-gray-700 transition hover:bg-[#e9e9e3]"
                        >
                            Lanjut Belanja
                        </a>

                    </aside>

                </div>

            @endif

        </div>
    </div>
</x-app-layout>