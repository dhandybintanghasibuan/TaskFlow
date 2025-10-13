<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tugas') }}
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
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 backdrop-blur-sm border border-gray-200/50 overflow-hidden shadow-xl sm:rounded-xl">
                <div class="p-6 md:p-8 text-gray-900">
                    
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Perbarui Detail Tugas</h3>
                    <p class="text-gray-600 mb-6">Lakukan perubahan yang diperlukan pada tugas Anda.</p>

                    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                        @csrf
                        @method('PUT') <div class="mb-4">
                            <label for="nama_tugas" class="block text-sm font-medium text-gray-700">Nama Tugas</label>
                            <input id="nama_tugas" type="text" name="nama_tugas" value="{{ old('nama_tugas', $task->nama_tugas) }}" required 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <x-input-error :messages="$errors->get('nama_tugas')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="mata_kuliah" class="block text-sm font-medium text-gray-700">Mata Kuliah</label>
                            <input id="mata_kuliah" type="text" name="mata_kuliah" value="{{ old('mata_kuliah', $task->mata_kuliah) }}" required 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <x-input-error :messages="$errors->get('mata_kuliah')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-6">
                            <div>
                                <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                                <input id="deadline" type="date" name="deadline" value="{{ old('deadline', $task->deadline) }}" required
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                            </div>
                            <div>
                                <label for="prioritas" class="block text-sm font-medium text-gray-700">Prioritas</label>
                                <select name="prioritas" id="prioritas" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="Rendah" @selected(old('prioritas', $task->prioritas) == 'Rendah')>Rendah</option>
                                    <option value="Sedang" @selected(old('prioritas', $task->prioritas) == 'Sedang')>Sedang</option>
                                    <option value="Tinggi" @selected(old('prioritas', $task->prioritas) == 'Tinggi')>Tinggi</option>
                                </select>
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="Belum Dikerjakan" @selected(old('status', $task->status) == 'Belum Dikerjakan')>Belum Dikerjakan</option>
                                    <option value="Sedang Dikerjakan" @selected(old('status', $task->status) == 'Sedang Dikerjakan')>Sedang Dikerjakan</option>
                                    <option value="Selesai" @selected(old('status', 'Selesai') == 'Selesai')>Selesai</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" 
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('deskripsi', $task->deskripsi) }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6 border-t border-gray-200 pt-6">
                            <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>