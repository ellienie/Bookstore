<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BookStore') }}</title>

    <x-cdn-assets />
</head>

<body class="font-sans antialiased">

    @auth

        <div class="h-screen overflow-hidden bg-[#fafaf7]">

            <div class="flex h-full">

                <div class="hidden h-full shrink-0 lg:block">
                    @if (auth()->user()->role === 'admin')
                        @include('layouts.admin-sidebar')
                    @else
                        @include('layouts.user-sidebar')
                    @endif
                </div>

                <div
                    x-data="{ sidebarOpen: false }"
                    class="flex min-w-0 flex-1 flex-col"
                >

                    <div class="shrink-0 lg:hidden">

                        <div class="flex h-16 items-center justify-between border-b border-[#e7e7e1] bg-[#fafaf7] px-4">

                            <div>
                                <div class="text-sm font-bold text-gray-900">
                                    BookStore
                                </div>

                                <div class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#71806f]">
                                    {{ auth()->user()->role === 'admin'
                                        ? 'Admin Panel'
                                        : 'Customer Area' }}
                                </div>
                            </div>

                            <button
                                type="button"
                                @click="sidebarOpen = true"
                                class="rounded-md bg-white p-2 text-gray-600 ring-1 ring-[#e7e7e1]"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="h-5 w-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                                    />
                                </svg>
                            </button>

                        </div>

                        <div
                            x-show="sidebarOpen"
                            x-cloak
                            class="fixed inset-0 z-50"
                        >

                            <div
                                class="absolute inset-0 bg-black/30"
                                @click="sidebarOpen = false"
                            ></div>

                            <div class="relative h-screen w-52 shadow-xl">

                                @if (auth()->user()->role === 'admin')
                                    @include('layouts.admin-sidebar')
                                @else
                                    @include('layouts.user-sidebar')
                                @endif

                            </div>

                        </div>

                    </div>

                    <div class="min-h-0 flex-1 overflow-y-auto">

                        @isset($header)
                            <header class="border-b border-[#e7e7e1] bg-[#fafaf7]">
                                <div class="mx-auto max-w-[1600px] px-5 py-5 sm:px-6 lg:px-8">
                                    {{ $header }}
                                </div>
                            </header>
                        @endisset

                        <main class="min-w-0">
                            {{ $slot }}
                        </main>

                    </div>

                </div>

            </div>

        </div>

    @else

        <div class="min-h-screen bg-[#fafaf7]">
            {{ $slot }}
        </div>

    @endauth

</body>
</html>