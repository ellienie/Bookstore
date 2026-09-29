<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-900">
                Profile
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Kelola informasi akun dan keamanan password.
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-[1200px] space-y-6 px-5 sm:px-6 lg:px-8">

            @if (session('status') === 'profile-updated')
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-show="show"
                    x-transition
                    class="fixed right-6 top-6 z-50 rounded-lg bg-[#71806f] px-5 py-4 text-sm font-medium text-white shadow-lg"
                >
                    Profile berhasil diperbarui.
                </div>
            @endif

            @if (session('status') === 'password-updated')
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-show="show"
                    x-transition
                    class="fixed right-6 top-6 z-50 rounded-lg bg-[#71806f] px-5 py-4 text-sm font-medium text-white shadow-lg"
                >
                    Password berhasil diperbarui.
                </div>
            @endif

            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-[#e7e7e1]">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-[#e7e7e1]">
                @include('profile.partials.update-password-form')
            </div>

            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-[#e7e7e1]">
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>