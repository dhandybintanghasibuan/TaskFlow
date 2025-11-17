<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard TaskFlow') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8 px-4 sm:px-0">
                <h1 class="text-3xl font-bold text-gray-800">Selamat Datang Kembali, {{ Auth::user()->name }}!</h1>
                <p class="mt-1 text-gray-500">Berikut adalah ringkasan dan daftar tugasmu hari ini.</p>
            </div>

            {{-- Statistik Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                {{-- Card Total Tugas --}}
                <div class="flex items-start p-5 bg-white rounded-xl shadow-md transition hover:shadow-lg hover:-translate-y-1">
                    <div class="flex-shrink-0 p-3 text-blue-500 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Tugas</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $totalTugas }}</p>
                    </div>
                </div>
                {{-- Card Tugas Selesai --}}
                <div class="flex items-start p-5 bg-white rounded-xl shadow-md transition hover:shadow-lg hover:-translate-y-1">
                    <div class="flex-shrink-0 p-3 text-green-500 bg-green-100 rounded-lg">
                           <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Tugas Selesai</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $tugasSelesai }}</p>
                    </div>
                </div>
                {{-- Card Belum Dikerjakan --}}
                <div class="flex items-start p-5 bg-white rounded-xl shadow-md transition hover:shadow-lg hover:-translate-y-1">
                    <div class="flex-shrink-0 p-3 text-yellow-500 bg-yellow-100 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Belum Dikerjakan</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $tugasBelumDikerjakan }}</p>
                    </div>
                </div>
                {{-- Card Mendekati Deadline --}}
                <div class="flex items-start p-5 bg-white rounded-xl shadow-md transition hover:shadow-lg hover:-translate-y-1">
                    <div class="flex-shrink-0 p-3 text-red-500 bg-red-100 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Mendekati Deadline</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $tugasMendekatiDeadline }}</p>
                    </div>
                </div>
            </div>

            {{-- Panel Filter & Aksi --}}
            <div class="bg-white rounded-xl shadow-md p-4 mb-8">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    
                    <form action="{{ route('dashboard') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-4 w-full">
                        <div class="w-full sm:w-auto">
                            <label for="status_filter" class="sr-only">Filter Status</label>
                            <select name="status" id="status_filter" class="block w-full border-gray-300 rounded-md shadow-sm text-sm" onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                                <option value="Belum Dikerjakan" @selected(request('status') == 'Belum Dikerjakan')>Belum Dikerjakan</option>
                                <option value="Sedang Dikerjakan" @selected(request('status') == 'Sedang Dikerjakan')>Sedang Dikerjakan</option>
                                <option value="Selesai" @selected(request('status') == 'Selesai')>Selesai</option>
                            </select>
                        </div>
                        
                        <div class="w-full sm:w-auto">
                            <label for="prioritas_filter" class="sr-only">Filter Prioritas</label>
                            <select name="prioritas" id="prioritas_filter" class="block w-full border-gray-300 rounded-md shadow-sm text-sm" onchange="this.form.submit()">
                                <option value="">Semua Prioritas</option>
                                <option value="Tinggi" @selected(request('prioritas') == 'Tinggi')>Tinggi</option>
                                <option value="Sedang" @selected(request('prioritas') == 'Sedang')>Sedang</option>
                                <option value="Rendah" @selected(request('prioritas') == 'Rendah')>Rendah</option>
                            </select>
                        </div>

                        {{-- Input tersembunyi untuk mempertahankan parameter lain (jika ada) --}}
                        @foreach(request()->except(['status', 'prioritas', 'page']) as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                    </form>

                    <div class="w-full sm:w-auto flex justify-end items-center mt-4 sm:mt-0">
                         @if (session('success'))
                            <div class="text-sm text-green-600 mr-4 self-center whitespace-nowrap">
                                {{ session('success') }}
                            </div>
                        @endif
                        <a href="{{ route('tasks.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 whitespace-nowrap">
                            + Tugas Baru
                        </a>
                    </div>
                </div>
            </div>

            {{-- Bagian Daftar Tugas --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($tasks as $task)
                    {{-- Setiap kartu tugas memiliki border kiri berwarna sesuai prioritas --}}
                    <div class="bg-white rounded-xl shadow-md overflow-hidden transition hover:shadow-lg hover:-translate-y-1 border-l-4 
                        @if($task->prioritas == 'Tinggi') border-red-500 @endif
                        @if($task->prioritas == 'Sedang') border-yellow-500 @endif
                        @if($task->prioritas == 'Rendah') border-green-500 @endif">
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-3">
                                <h4 class="text-lg font-bold text-gray-800 hover:text-indigo-600 transition">
                                <a href="{{ route('tasks.show', $task->id) }}">{{ $task->nama_tugas }}</a>
                                </h4>
                                {{-- Form untuk Update Status --}}
                                <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="text-xs rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" onchange="this.form.submit()">
                                        <option value="Belum Dikerjakan" @selected($task->status == 'Belum Dikerjakan')>Belum Dikerjakan</option>
                                        <option value="Sedang Dikerjakan" @selected($task->status == 'Sedang Dikerjakan')>Dikerjakan</option>
                                        <option value="Selesai" @selected($task->status == 'Selesai')>Selesai</option>
                                    </select>
                                </form>
                            </div>
                            <p class="text-sm text-gray-500 mb-4">{{ $task->mata_kuliah }}</p>
                            
                            {{-- Detail Deadline dan Prioritas --}}
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span>{{ \Carbon\Carbon::parse($task->deadline)->format('d F Y, H:i') }}</span>
                                <span class="mx-2 text-gray-300">|</span>
                                <div class="w-3 h-3 rounded-full 
                                    @if($task->prioritas == 'Tinggi') bg-red-500 @endif
                                    @if($task->prioritas == 'Sedang') bg-yellow-500 @endif
                                    @if($task->prioritas == 'Rendah') bg-green-500 @endif">
                                </div>
                                <span class="ml-1.5">{{ $task->prioritas }}</span>
                            </div>
                        </div>

                        {{-- Tombol Aksi di Footer Kartu --}}
                        <div class="bg-gray-50 px-5 py-3 flex justify-end items-center space-x-3">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="text-sm text-indigo-600 hover:text-indigo-900 font-semibold">Edit</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-flex">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-600 hover:text-red-900 font-semibold" onclick="return confirm('Anda yakin ingin menghapus tugas ini?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    {{-- Tampilan Tugas Kosong --}}
                    <div class="md:col-span-2 lg:col-span-3 text-center py-12 px-6 bg-white rounded-lg shadow-md">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada tugas</h3>
                        <p class="mt-1 text-sm text-gray-500">Selamat, kamu belum punya tugas! Saatnya bersantai 🌴 atau tambah tugas baru.</p>
                        <div class="mt-6">
                            <a href="{{ route('tasks.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" /></svg>
                                Tambah Tugas Baru
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

    @if ($expiredTasks->isNotEmpty())
    <div 
        x-data="{ open: true }" 
        x-show="open" 
        class="fixed inset-0 z-50 overflow-y-auto" 
        aria-labelledby="modal-title" 
        role="dialog" 
        aria-modal="true"
    >
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            {{-- Background Overlay --}}
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            {{-- Modal Panel --}}
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            {{-- Icon Warning --}}
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                {{ __('Peringatan Deadline Terlewat') }}
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Anda memiliki **{{ $expiredTasks->count() }} tugas** yang *deadline*-nya sudah terlewat. Mohon perbarui status tugas ini.
                                </p>
                                <ul class="mt-3 text-sm text-red-600 space-y-1 max-h-36 overflow-y-auto pr-2">
                                    @foreach ($expiredTasks as $task)
                                        <li class="font-semibold truncate">
                                            - {{ $task->nama_tugas }} ({{ \Carbon\Carbon::parse($task->deadline)->diffForHumans() }})
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" 
                        x-on:click="open = false" 
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                        {{ __('Lihat Tugas') }}
                    </button>
                    <button type="button" 
                        x-on:click="open = false" 
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                        {{ __('Abaikan') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif
</x-app-layout>