<?php

namespace App\Notifications;

use App\Models\Task; // Tambahkan ini
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskCreated extends Notification
{
    use Queueable;

    public Task $task;

    /**
     * Buat instance notifikasi baru.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = route('dashboard');

        return (new MailMessage)
                    ->subject('TaskFlow: Tugas Baru Berhasil Dibuat!')
                    ->greeting('Halo, ' . $notifiable->name . '!')
                    ->line('Tugas baru Anda telah berhasil ditambahkan ke dalam daftar:')
                    ->line('**Nama Tugas:** ' . $this->task->nama_tugas)
                    ->line('**Mata Kuliah:** ' . $this->task->mata_kuliah)
                    ->line('**Deadline:** ' . \Carbon\Carbon::parse($this->task->deadline)->format('d F Y'))
                    ->action('Lihat Semua Tugas', $url)
                    ->salutation('Terima kasih telah menggunakan TaskFlow.');
    }
}