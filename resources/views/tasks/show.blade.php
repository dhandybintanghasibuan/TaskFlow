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
                        
                        {{-- Di sini kita akan menambahkan fitur Checklist nanti --}}
                        <div class="border-t pt-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Checklist / Sub-Tugas</h3>
                            <p class="italic text-gray-400">Fitur checklist akan ditambahkan di sini.</p>
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