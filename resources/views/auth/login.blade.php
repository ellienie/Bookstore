<x-guest-layout>

    <div>
        <p class="text-sm font-semibold uppercase tracking-[0.16em] text-[#71806f]">
            Welcome Back
        </p>

        <h2 class="mt-3 text-3xl font-bold tracking-tight text-gray-900">
            Masuk ke akun kamu
        </h2>

        <p class="mt-2 text-sm leading-6 text-gray-500">
            Masukkan email dan password untuk melanjutkan ke BookStore.
        </p>
    </div>

    <x-auth-session-status
        class="mt-6"
        :status="session('status')"
    />

    <form
        method="POST"
        action="{{ route('login') }}"
        class="mt-8 space-y-5"
    >
        @csrf

        <div>
            <label
                for="email"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Email
            </label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="nama@email.com"
                class="w-full rounded-lg border-gray-300 bg-white px-4 py-3 shadow-sm focus:border-[#71806f] focus:ring-[#71806f]"
            >

            @error('email')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <div class="mb-2 flex items-center justify-between">

                <label
                    for="password"
                    class="text-sm font-medium text-gray-700"
                >
                    Password
                </label>

                @if (Route::has('password.request'))
                    <a
                        href="{{ route('password.request') }}"
                        class="text-xs font-medium text-gray-500 hover:text-gray-900"
                    >
                        Lupa password?
                    </a>
                @endif

            </div>

            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Masukkan password"
                class="w-full rounded-lg border-gray-300 bg-white px-4 py-3 shadow-sm focus:border-[#71806f] focus:ring-[#71806f]"
            >

            @error('password')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <label class="flex items-center gap-3 text-sm text-gray-600">
            <input
                type="checkbox"
                name="remember"
                class="rounded border-gray-300 text-[#71806f] focus:ring-[#71806f]"
            >

            Ingat saya
        </label>

        <button
            type="submit"
            class="w-full rounded-lg bg-gray-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-gray-800"
        >
            Masuk
        </button>

    </form>

    <div class="mt-8 border-t border-gray-200 pt-6 text-center">

        <p class="text-sm text-gray-500">
            Belum punya akun?

            <a
                href="{{ route('register') }}"
                class="font-semibold text-gray-900 hover:underline"
            >
                Daftar sekarang
            </a>
        </p>

    </div>

</x-guest-layout>