<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil Anda') }}
        </h2>
    </x-slot>

    {{-- Latar Belakang Kustom --}}
    <style>
        .dashboard-bg {
            background-color: #f8fafc;
            opacity: 1;
            background-image:  
                radial-gradient(#d1d5db 1px, transparent 1px),
                radial-gradient(at 10% 10%, hsla(214, 70%, 75%, 0.25) 0px, transparent 50%),
                radial-gradient(at 80% 20%, hsla(300, 70%, 80%, 0.25) 0px, transparent 50%),
                radial-gradient(at 20% 90%, hsla(160, 70%, 75%, 0.25) 0px, transparent 50%),
                radial-gradient(at 90% 90%, hsla(30, 70%, 80%, 0.25) 0px, transparent 50%);
            background-size: 
                40px 40px,
                100% 100%, 100% 100%, 100% 100%, 100% 100%;
        }
    </style>

    <div class="py-12 dashboard-bg">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Kartu Update Informasi Profil --}}
            <div class="bg-white/70 backdrop-blur-sm border border-gray-200/50 shadow-lg sm:rounded-xl">
                <div class="p-4 sm:p-8">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Kartu Update Password --}}
            <div class="bg-white/70 backdrop-blur-sm border border-gray-200/50 shadow-lg sm:rounded-xl">
                <div class="p-4 sm:p-8">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Kartu Hapus Akun --}}
            <div class="bg-white/70 backdrop-blur-sm border border-gray-200/50 shadow-lg sm:rounded-xl">
                 <div class="p-4 sm:p-8">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>