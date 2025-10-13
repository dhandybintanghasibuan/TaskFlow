@component('mail::message')
# {{ $greeting }}

{{ $introLines[0] }}

@component('mail::table')
| Nama Tugas | Mata Kuliah | Deadline |
|:-----------|:------------|:---------|
@foreach ($tasks as $task)
| {{ $task->nama_tugas }} | {{ $task->mata_kuliah }} | {{ \Carbon\Carbon::parse($task->deadline)->format('d F Y') }} |
@endforeach
@endcomponent

Silakan cek dashboard Anda untuk detail lebih lanjut.

@component('mail::button', ['url' => $url])
Lihat Dashboard
@endcomponent

{{ $salutation }}
@endcomponent