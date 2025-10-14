<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Tugas') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 md:p-8 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-between sm:items-center">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">{{ $task->nama_tugas }}</h2>
                            <p class="text-gray-500">{{ $task->mata_kuliah }}</p>
                        </div>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Edit Tugas
                        </a>
                    </div>
                </div>

                <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2 space-y-6">
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-2">Deskripsi</h3>
                            <p class="text-gray-600 prose max-w-none">
                                {!! nl2br(e($task->deskripsi)) ?: '<span class="italic text-gray-400">Tidak ada deskripsi.</span>' !!}
                            </p>
                        </div>
                        
                        {{-- BLOK BARU: Checklist / Sub-Tugas --}}
                        <div class="border-t pt-6">
                            <h3 class="font-semibold text-gray-800 mb-4">Checklist / Sub-Tugas</h3>

                            {{-- Form Tambah Checklist --}}
                            <form action="{{ route('subtasks.store', $task->id) }}" method="POST" class="flex items-center gap-2 mb-4">
                                @csrf
                                <input type="text" name="deskripsi" placeholder="Tambahkan item checklist..." class="flex-grow border-gray-300 rounded-md shadow-sm text-sm" required>
                                <button type="submit" class="p-2 text-sm bg-gray-800 text-white rounded-md hover:bg-gray-700">Tambah</button>
                            </form>

                            {{-- Daftar Checklist --}}
                            <div class="space-y-2">
                                @forelse($task->subTasks as $subTask)
                                <div class="flex items-center justify-between p-2 rounded-md transition hover:bg-gray-100">
                                    <div class="flex items-center">
                                        <form action="{{ route('subtasks.update', $subTask->id) }}" method="POST">
                                            @csrf
                                            @method('patch')
                                            <input type="hidden" name="is_completed" value="{{ $subTask->is_completed ? '0' : '1' }}">
                                            <input type="checkbox" @checked($subTask->is_completed) onchange="this.form.submit()" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        </form>
                                        <span class="ml-3 text-sm text-gray-700 {{ $subTask->is_completed ? 'line-through text-gray-400' : '' }}">{{ $subTask->deskripsi }}</span>
                                    </div>
                                    <form action="{{ route('subtasks.destroy', $subTask->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="text-gray-400 hover:text-red-600 p-1" onclick="return confirm('Hapus item ini?')">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm8 0a1 1 0 01-2 0v6a1 1 0 112 0V8z" clip-rule="evenodd"></path></svg>
                                        </button>
                                    </form>
                                </div>
                                @empty
                                <p class="text-gray-500 italic">Tidak ada item checklist. Tambahkan satu untuk memulai!</p>
                                @endforelse
                            </div>
                        </div>

                    </div>

                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-sm text-gray-500 mb-2">Status</h4>
                            <span class="px-2 py-1 text-sm font-semibold rounded-full 
                                @if($task->status == 'Selesai') bg-green-100 text-green-800 @endif
                                @if($task->status == 'Sedang Dikerjakan') bg-yellow-100 text-yellow-800 @endif
                                @if($task->status == 'Belum Dikerjakan') bg-gray-100 text-gray-800 @endif">
                                {{ $task->status }}
                            </span>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-sm text-gray-500 mb-2">Prioritas</h4>
                            <span class="px-2 py-1 text-sm font-semibold rounded-full 
                                @if($task->prioritas == 'Tinggi') bg-red-100 text-red-800 @endif
                                @if($task->prioritas == 'Sedang') bg-yellow-100 text-yellow-800 @endif
                                @if($task->prioritas == 'Rendah') bg-green-100 text-green-800 @endif">
                                {{ $task->prioritas }}
                            </span>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-sm text-gray-500 mb-2">Deadline</h4>
                            <p class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($task->deadline)->isoFormat('dddd, D MMMM YYYY [pukul] HH:mm') }}</p>
                            <p class="text-sm text-red-600">{{ \Carbon\Carbon::parse($task->deadline)->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>