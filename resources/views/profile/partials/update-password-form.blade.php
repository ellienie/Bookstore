<section>
    <header>
        <h3 class="text-lg font-semibold text-gray-900">
            Ubah Password
        </h3>

        <p class="mt-1 text-sm text-gray-500">
            Gunakan password yang kuat dan tidak mudah ditebak.
        </p>
    </header>

    <form
        method="POST"
        action="{{ route('password.update') }}"
        class="mt-6 space-y-5"
    >
        @csrf
        @method('PUT')

        <div>
            <label
                for="update_password_current_password"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Password Saat Ini
            </label>

            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="w-full max-w-2xl rounded-lg border-gray-300 bg-white px-4 py-3 shadow-sm focus:border-[#71806f] focus:ring-[#71806f]"
            >

            @error('current_password', 'updatePassword')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label
                for="update_password_password"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Password Baru
            </label>

            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="w-full max-w-2xl rounded-lg border-gray-300 bg-white px-4 py-3 shadow-sm focus:border-[#71806f] focus:ring-[#71806f]"
            >

            @error('password', 'updatePassword')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label
                for="update_password_password_confirmation"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Konfirmasi Password Baru
            </label>

            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="w-full max-w-2xl rounded-lg border-gray-300 bg-white px-4 py-3 shadow-sm focus:border-[#71806f] focus:ring-[#71806f]"
            >
        </div>

        <div class="pt-1">
            <button
                type="submit"
                class="rounded-md bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-800"
            >
                Ubah Password
            </button>
        </div>

    </form>
</section>