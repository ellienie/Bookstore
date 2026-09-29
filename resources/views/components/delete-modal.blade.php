@props([
    'title' => 'Hapus data?',
    'message' => 'akan dihapus. Tindakan ini tidak dapat dibatalkan.',
])

<div
    x-show="deleteOpen"
    x-cloak
    x-transition.opacity
    class="fixed inset-0 z-[100] flex items-center justify-center px-4"
>
    <div
        class="absolute inset-0 bg-black/30 backdrop-blur-[1px]"
        @click="closeDelete()"
    ></div>

    <div
        x-show="deleteOpen"
        x-transition
        @keydown.escape.window="closeDelete()"
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
            {{ $title }}
        </h3>

        <p class="mt-2 text-sm leading-6 text-gray-500">
            <span
                class="font-semibold text-gray-800"
                x-text="deleteName"
            ></span>

            {{ $message }}
        </p>

        <div class="mt-6 flex justify-end gap-3">
            <button
                type="button"
                @click="closeDelete()"
                class="rounded-md bg-[#f0f0eb] px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-[#e7e7e1]"
            >
                Batal
            </button>

            <form
                :action="deleteAction"
                method="POST"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="rounded-md bg-red-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700"
                >
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>