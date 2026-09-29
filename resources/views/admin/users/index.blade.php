<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Data User
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Daftar user yang sudah terdaftar di BookStore.
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200">

                @if ($users->isEmpty())
                    <div class="px-6 py-16 text-center">
                        <p class="text-sm text-gray-500">
                            Belum ada user yang terdaftar.
                        </p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full">

                            <thead class="bg-gray-50">
                                <tr class="border-b border-gray-200">
                                    <th class="w-20 px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        No
                                    </th>

                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        Nama
                                    </th>

                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        Email
                                    </th>

                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        Role
                                    </th>

                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        Tanggal Daftar
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                                @foreach ($users as $user)
                                    <tr class="hover:bg-gray-50">

                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="font-medium text-gray-900">
                                                {{ $user->name }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $user->email }}
                                        </td>

                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-700"
                                            >
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $user->created_at->format('d M Y H:i') }}
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