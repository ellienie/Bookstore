<x-guest-layout>

    <div>
        <p class="text-sm font-semibold uppercase tracking-[0.16em] text-[#71806f]">
            Create Account
        </p>

        <h2 class="mt-3 text-3xl font-bold tracking-tight text-gray-900">
            Buat akun BookStore
        </h2>

        <p class="mt-2 text-sm leading-6 text-gray-500">
            Daftar untuk mulai menambahkan buku ke keranjang dan melakukan pemesanan.
        </p>
    </div>

    <form
        method="POST"
        action="{{ route('register') }}"
        class="mt-8 space-y-5"
    >
        @csrf

        <div>
            <label
                for="name"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Nama
            </label>

            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                placeholder="Nama lengkap"
                class="w-full rounded-lg border-gray-300 bg-white px-4 py-3 shadow-sm focus:border-[#71806f] focus:ring-[#71806f]"
            >

            @error('name')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

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
            <label
                for="password"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Password
            </label>

            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="Minimal 8 karakter"
                class="w-full rounded-lg border-gray-300 bg-white px-4 py-3 shadow-sm focus:border-[#71806f] focus:ring-[#71806f]"
            >

            @error('password')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label
                for="password_confirmation"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Konfirmasi Password
            </label>

            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Ulangi password"
                class="w-full rounded-lg border-gray-300 bg-white px-4 py-3 shadow-sm focus:border-[#71806f] focus:ring-[#71806f]"
            >
        </div>

        <button
            type="submit"
            class="w-full rounded-lg bg-gray-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-gray-800"
        >
            Buat Akun
        </button>

    </form>

    <div class="mt-8 border-t border-gray-200 pt-6 text-center">

        <p class="text-sm text-gray-500">
            Sudah punya akun?

            <a
                href="{{ route('login') }}"
                class="font-semibold text-gray-900 hover:underline"
            >
                Masuk
            </a>
        </p>

    </div>

</x-guest-layout>