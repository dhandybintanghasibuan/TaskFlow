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

            <div class="bg-white rounded-xl shadow-md p-4 mb-8">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="w-full sm:w-auto">
                        <h3 class="text-lg font-semibold text-gray-800">Daftar Tugasmu</h3>
                        <p class="text-sm text-gray-500">Lihat dan kelola semua tugasmu di sini.</p>
                    </div>
                    <div class="w-full sm:w-auto flex justify-end">
                         @if (session('success'))
                            <div class="text-sm text-green-600 mr-4 self-center">
                                {{ session('success') }}
                            </div>
                        @endif
                        <a href="{{ route('tasks.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 whitespace-nowrap">
                            + Tugas Baru
                        </a>
                    </div>
                </div>
            </div>

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
                                    <a href="{{ route('tasks.edit', $task->id) }}">{{ $task->nama_tugas }}</a>
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
                                <span>{{ \Carbon\Carbon::parse($task->deadline)->format('d F Y') }}</span>
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
                        <div class="bg-gray-50 px-5 py-3 flex justify-end space-x-3">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="text-sm text-indigo-600 hover:text-indigo-900 font-semibold">Edit</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-600 hover:text-red-900 font-semibold" onclick="return confirm('Anda yakin ingin menghapus tugas ini?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    {{-- ... Tampilan Tugas Kosong ... --}}
                    <div class="md:col-span-2 lg:col-span-3 text-center py-12 px-6 bg-white rounded-lg shadow-md">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada tugas</h3>
                        <p class="mt-1 text-sm text-gray-500">Selamat, kamu belum punya tugas! Saatnya bersantai 🌴 atau tambah tugas baru.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>