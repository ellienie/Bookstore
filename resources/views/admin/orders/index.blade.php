<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Data Pesanan
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Daftar pesanan buku dari seluruh user BookStore.
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200">

                @if ($orders->isEmpty())
                    <div class="px-6 py-16 text-center">
                        <p class="text-sm text-gray-500">
                            Belum ada pesanan.
                        </p>

                        <p class="mt-1 text-xs text-gray-400">
                            Pesanan akan muncul setelah user melakukan checkout.
                        </p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full">

                            <thead class="bg-gray-50">
                                <tr class="border-b border-gray-200">
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        No. Order
                                    </th>

                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        User
                                    </th>

                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        Total
                                    </th>

                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        Pembayaran
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
                                @foreach ($orders as $order)
                                    <tr class="hover:bg-gray-50">

                                        <td class="px-6 py-4">
                                            <div class="font-medium text-gray-900">
                                                {{ $order->order_number }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="font-medium text-gray-900">
                                                {{ $order->user->name }}
                                            </div>

                                            <div class="mt-1 text-xs text-gray-500">
                                                {{ $order->user->email }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                        </td>

                                        <td class="px-6 py-4">
                                            <span class="text-sm text-gray-700">
                                                {{ strtoupper($order->payment_method) }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4">
                                            @if ($order->status === 'completed')
                                                <span class="inline-flex rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">
                                                    Selesai
                                                </span>
                                            @elseif ($order->status === 'processing')
                                                <span class="inline-flex rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-700">
                                                    Diproses
                                                </span>
                                            @elseif ($order->status === 'cancelled')
                                                <span class="inline-flex rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">
                                                    Dibatalkan
                                                </span>
                                            @else
                                                <span class="inline-flex rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                                    Menunggu
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $order->created_at->format('d M Y H:i') }}
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex justify-end">
                                                <a
                                                    href="{{ route('admin.orders.show', $order) }}"
                                                    class="inline-flex items-center rounded-md bg-gray-800 px-3 py-2 text-sm font-medium text-white hover:bg-gray-700"
                                                >
                                                    Detail
                                                </a>
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
    </div>
</x-app-layout>