<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Mata Kuliah') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 font-semibold rounded-lg shadow-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Mata Kuliah</h3>
                        
                        {{-- Tombol untuk membuka modal --}}
                        <x-primary-button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'add-course-modal')"
                        >{{ __('Tambah Mata Kuliah') }}</x-primary-button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Mata Kuliah</th>
                                    <th class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($courses as $course)
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $course->name }}</td>
                                        <td class="px-6 py-4 text-right text-sm font-medium">
                                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-semibold" onclick="return confirm('Yakin ingin menghapus mata kuliah ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="px-6 py-4 text-center text-gray-500">Belum ada mata kuliah yang ditambahkan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Komponen Modal untuk Tambah Mata Kuliah --}}
    <x-modal name="add-course-modal" :show="$errors->isNotEmpty()" focusable>
        <form method="post" action="{{ route('courses.store') }}" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Tambah Mata Kuliah Baru') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Masukkan nama mata kuliah yang ingin Anda tambahkan.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="name" value="{{ __('Nama Mata Kuliah') }}" class="sr-only" />

                <x-text-input
                    id="name"
                    name="name"
                    class="mt-1 block w-full"
                    placeholder="{{ __('Contoh: Proyek Mandiri') }}"
                    required
                />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </x-secondary-button>

                <x-primary-button class="ml-3">
                    {{ __('Simpan') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>