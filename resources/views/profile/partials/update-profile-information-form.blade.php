<section>
    <header>
        <h3 class="text-lg font-semibold text-gray-900">
            Informasi Akun
        </h3>

        <p class="mt-1 text-sm text-gray-500">
            Perbarui nama dan alamat email akun kamu.
        </p>
    </header>

    <form
        id="send-verification"
        method="POST"
        action="{{ route('verification.send') }}"
    >
        @csrf
    </form>

    <form
        method="POST"
        action="{{ route('profile.update') }}"
        class="mt-6 space-y-5"
    >
        @csrf
        @method('PATCH')

        <div>
            <label
                for="name"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Nama
            </label>

            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
                class="w-full max-w-2xl rounded-lg border-gray-300 bg-white px-4 py-3 shadow-sm focus:border-[#71806f] focus:ring-[#71806f]"
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
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
                class="w-full max-w-2xl rounded-lg border-gray-300 bg-white px-4 py-3 shadow-sm focus:border-[#71806f] focus:ring-[#71806f]"
            >

            @error('email')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 rounded-lg bg-amber-50 p-4 text-sm text-amber-700 ring-1 ring-amber-100">

                    <p>
                        Email kamu belum diverifikasi.
                    </p>

                    <button
                        form="send-verification"
                        class="mt-2 font-semibold underline underline-offset-4"
                    >
                        Kirim ulang email verifikasi
                    </button>

                </div>
            @endif
        </div>

        <div class="pt-1">
            <button
                type="submit"
                class="rounded-md bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-800"
            >
                Simpan Perubahan
            </button>
        </div>

    </form>
</section>