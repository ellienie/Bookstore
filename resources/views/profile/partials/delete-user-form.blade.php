<section
    x-data="{
        deleteAccountOpen: false
    }"
>
    <header>
        <h3 class="text-lg font-semibold text-gray-900">
            Hapus Akun
        </h3>

        <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">
            Setelah akun dihapus, seluruh data yang terkait dengan akun ini dapat ikut terhapus.
            Tindakan ini tidak dapat dibatalkan.
        </p>
    </header>

    <div class="mt-6">

        <button
            type="button"
            @click="deleteAccountOpen = true"
            class="rounded-md bg-red-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700"
        >
            Hapus Akun
        </button>

    </div>

    <div
        x-show="deleteAccountOpen"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-[100] flex items-center justify-center px-4"
    >

        <div
            class="absolute inset-0 bg-black/30 backdrop-blur-[1px]"
            @click="deleteAccountOpen = false"
        ></div>

        <div
            x-show="deleteAccountOpen"
            x-transition
            @keydown.escape.window="deleteAccountOpen = false"
            class="relative w-full max-w-md rounded-2xl bg-[#fafaf7] p-6 shadow-2xl ring-1 ring-[#e7e7e1]"
        >

            <div class="flex h-11 w-11 items-center justify-center rounded-full bg-red-50 text-red-600">

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
                        d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"
                    />
                </svg>

            </div>

            <h3 class="mt-5 text-lg font-semibold text-gray-900">
                Yakin ingin menghapus akun?
            </h3>

            <p class="mt-2 text-sm leading-6 text-gray-500">
                Masukkan password untuk mengonfirmasi penghapusan akun.
            </p>

            <form
                method="POST"
                action="{{ route('profile.destroy') }}"
                class="mt-5"
            >
                @csrf
                @method('DELETE')

                <div>
                    <label
                        for="delete_password"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Password
                    </label>

                    <input
                        id="delete_password"
                        name="password"
                        type="password"
                        placeholder="Masukkan password"
                        class="w-full rounded-lg border-gray-300 bg-white px-4 py-3 shadow-sm focus:border-red-500 focus:ring-red-500"
                    >

                    @error('password', 'userDeletion')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mt-6 flex justify-end gap-3">

                    <button
                        type="button"
                        @click="deleteAccountOpen = false"
                        class="rounded-md bg-[#f0f0eb] px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-[#e7e7e1]"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="rounded-md bg-red-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-red-700"
                    >
                        Ya, Hapus Akun
                    </button>

                </div>

            </form>

        </div>

    </div>

</section>