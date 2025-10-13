<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Tugas Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf

                        <div>
                            <x-input-label for="nama_tugas" :value="__('Nama Tugas')" />
                            <x-text-input id="nama_tugas" class="block mt-1 w-full" type="text" name="nama_tugas" :value="old('nama_tugas')" required autofocus />
                            <x-input-error :messages="$errors->get('nama_tugas')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="mata_kuliah" :value="__('Mata Kuliah')" />
                            <x-text-input id="mata_kuliah" class="block mt-1 w-full" type="text" name="mata_kuliah" :value="old('mata_kuliah')" required />
                            <x-input-error :messages="$errors->get('mata_kuliah')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div>
                                <x-input-label for="deadline" :value="__('Deadline')" />
                                <x-text-input id="deadline" class="block mt-1 w-full" type="date" name="deadline" :value="old('deadline')" required />
                                <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="prioritas" :value="__('Prioritas')" />
                                <select name="prioritas" id="prioritas" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="Rendah" @selected(old('prioritas') == 'Rendah')>Rendah</option>
                                    <option value="Sedang" @selected(old('prioritas', 'Sedang') == 'Sedang')>Sedang</option>
                                    <option value="Tinggi" @selected(old('prioritas') == 'Tinggi')>Tinggi</option>
                                </select>
                                <x-input-error :messages="$errors->get('prioritas')" class="mt-2" />
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <x-input-label for="deskripsi" :value="__('Deskripsi (Opsional)')" />
                            <textarea name="deskripsi" id="deskripsi" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('deskripsi') }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                                Batal
                            </a>
                            <x-primary-button>
                                {{ __('Simpan Tugas') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>