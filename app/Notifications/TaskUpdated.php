<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class TaskUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    public Task $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($notifiable)
{
    $deadline = \Carbon\Carbon::parse($this->task->deadline)->format('d F Y, H:i');
    // $url = route('tasks.show', $this->task->id); // Tidak perlu lagi

    return TelegramMessage::create()
        ->to($notifiable->telegram_chat_id)
        ->content("✅ *Tugas Berhasil Diperbarui!*\n\n*Nama Tugas:*\n" . $this->task->nama_tugas . "\n\n*Status:*\n" . $this->task->status . "\n\n*Deadline:*\n" . $deadline);
}
}