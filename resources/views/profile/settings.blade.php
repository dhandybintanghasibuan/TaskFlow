<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Preferensi Notifikasi') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Atur kapan Anda ingin menerima pengingat tugas di Telegram.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <div>
                                <label for="telegram_chat_id" class="block text-sm font-medium text-gray-700">
                                    Telegram Chat ID
                                </label>
                                <p class="mt-1 text-sm text-gray-600">
                                    <a href="https://t.me/userinfobot" target="_blank" class="text-indigo-600 hover:underline">
                                        Dapatkan Chat ID Anda di sini.
                                    </a>
                                </p>
                                <x-text-input 
                                    id="telegram_chat_id" 
                                    name="telegram_chat_id" 
                                    type="text" 
                                    class="mt-2 block w-full" 
                                    :value="old('telegram_chat_id', $user->telegram_chat_id)" 
                                />
                                <x-input-error class="mt-2" :messages="$errors->get('telegram_chat_id')" />
                            </div>

                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Pengingat Deadline
                                </label>
                                
                                {{-- INI BAGIAN YANG DIPERBAIKI --}}
                                @php
                                    $prefs = $user->notification_preferences;
                                    if (is_string($prefs)) {
                                        $prefs = json_decode($prefs, true);
                                    }
                                    $prefs = $prefs ?? [];
                                @endphp
                                
                                <div class="flex items-center gap-4">
                                    <input type="checkbox" id="reminder_7" name="notification_preferences[]" value="7" @checked(in_array('7', $prefs)) class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <label for="reminder_7" class="text-sm text-gray-900">H-7 (7 hari sebelum deadline)</label>
                                </div>
                                <div class="flex items-center gap-4 mt-2">
                                    <input type="checkbox" id="reminder_3" name="notification_preferences[]" value="3" @checked(in_array('3', $prefs)) class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <label for="reminder_3" class="text-sm text-gray-900">H-3 (3 hari sebelum deadline)</label>
                                </div>
                                <div class="flex items-center gap-4 mt-2">
                                    <input type="checkbox" id="reminder_1" name="notification_preferences[]" value="1" @checked(in_array('1', $prefs)) class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <label for="reminder_1" class="text-sm text-gray-900">H-1 (1 hari sebelum deadline)</label>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Simpan') }}</x-primary-button>

                                @if (session('status') === 'profile-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                        {{ __('Tersimpan.') }}
                                    </p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>