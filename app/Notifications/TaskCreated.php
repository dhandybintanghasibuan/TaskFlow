<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class TaskCreated extends Notification implements ShouldQueue
{
    use Queueable;

    public Task $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Tentukan channel notifikasi (hanya telegram).
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    /**
     * Format pesan untuk notifikasi Telegram.
     */
    public function toTelegram($notifiable)
{
    $deadline = \Carbon\Carbon::parse($this->task->deadline)->format('d F Y, H:i');
    // $url = route('tasks.show', $this->task->id); // Baris ini tidak diperlukan lagi

    return TelegramMessage::create()
        ->to($notifiable->telegram_chat_id)
        ->content("🔔 *Tugas Baru Ditambahkan!*\n\n*Nama Tugas:*\n" . $this->task->nama_tugas . "\n\n*Mata Kuliah:*\n" . $this->task->mata_kuliah . "\n\n*Deadline:*\n" . $deadline);
        // ->button('Lihat Detail Tugas', $url); // <-- HAPUS ATAU BERI KOMENTAR PADA BARIS INI
}
}