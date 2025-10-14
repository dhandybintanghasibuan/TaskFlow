<?php

namespace App\Notifications;

use App\Models\SubTask;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class SubTaskNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public SubTask $subTask;
    public string $action;

    public function __construct(SubTask $subTask, string $action = 'created')
    {
        $this->subTask = $subTask;
        $this->action = $action;
    }

    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($notifiable)
{
    $taskTitle = $this->subTask->task->nama_tugas;
    $subTaskDesc = $this->subTask->deskripsi;
    

    if ($this->action === 'created') {
        $message = "📝 *Sub-Tugas Baru Ditambahkan!*\n\n*Tugas Utama:* {$taskTitle}\n*Sub-Tugas:* {$subTaskDesc}";
    } else {
        $message = "✅ *Sub-Tugas Selesai!*\n\n*Tugas Utama:* {$taskTitle}\n*Sub-Tugas:* {$subTaskDesc}";
    }

    return TelegramMessage::create()
        ->to($notifiable->telegram_chat_id)
        ->content($message); // <-- Tombol dihapus dari sini
}
}