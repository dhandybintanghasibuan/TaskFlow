<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kalender Tugas') }}
        </h2>
    </x-slot>

    {{-- Latar Belakang Kustom & Styling --}}
    <style>
        .dashboard-bg { /* ... styling background tetap sama ... */ }
        .fc .fc-button-primary { /* ... styling tombol FC tetap sama ... */ }
        .fc .fc-daygrid-event { /* ... styling event FC tetap sama ... */ }
    </style>

    <div class="py-12 dashboard-bg">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 backdrop-blur-sm border border-gray-200/50 overflow-hidden shadow-xl sm:rounded-xl p-6">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    @push('scripts')
    {{-- 1. Tambahkan Library FullCalendar, Popper.js, dan Tippy.js via CDN --}}
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek' // Tambah List View
                },
                locale: 'id',
                buttonText: {
                    today: 'Hari Ini',
                    month: 'Bulan',
                    week: 'Minggu',
                    list: 'Daftar' // Tambah teks untuk List View
                },
                events: '{{ route('api.tasksForCalendar') }}',
                
                // 2. Gunakan eventDidMount untuk menginisialisasi Tippy.js
                eventDidMount: function(info) {
                    // Buat konten untuk pop-up dari data event
                    let content = `
                        <div class="p-1 text-left">
                            <div class="font-bold text-base mb-2">${info.event.title}</div>
                            <div class="text-sm">
                                <strong>Deadline:</strong> ${info.event.start.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}
                            </div>
                            <div class="text-sm">
                                <strong>Prioritas:</strong> ${info.event.extendedProps.prioritas}
                            </div>
                            <div class="text-sm">
                                <strong>Status:</strong> ${info.event.extendedProps.status}
                            </div>
                        </div>
                    `;
                    
                    // Inisialisasi Tippy pada elemen event
                    tippy(info.el, {
                        content: content,
                        allowHTML: true, // Izinkan konten HTML
                        theme: 'light-border', // Tema pop-up
                        placement: 'auto', // Posisi otomatis
                    });
                },

                eventClick: function(info) {
                    info.jsEvent.preventDefault(); // Mencegah browser mengikuti URL
                    if (info.event.url) {
                        window.location.href = info.event.url;
                    }
                }
            });
            calendar.render();
        });
    </script>
    @endpush
</x-app-layout>