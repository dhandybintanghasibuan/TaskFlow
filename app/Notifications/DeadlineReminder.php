<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class DeadlineReminder extends Notification implements ShouldQueue
{
    use Queueable;

    public Collection $tasks;

    public function __construct(Collection $tasks)
    {
        $this->tasks = $tasks;
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
    // $url = route('dashboard'); // Baris ini tidak diperlukan lagi
    $content = "⏰ *Pengingat Deadline Tugas!*\n\nAnda memiliki " . $this->tasks->count() . " tugas yang akan segera berakhir:\n";

    foreach ($this->tasks as $task) {
        $deadline = \Carbon\Carbon::parse($task->deadline)->format('d M Y, H:i');
        $content .= "\n- *" . $task->nama_tugas . "* (Deadline: " . $deadline . ")";
    }

    return TelegramMessage::create()
        ->to($notifiable->telegram_chat_id)
        ->content($content);
        // ->button('Buka Dashboard', $url); // <-- HAPUS ATAU BERI KOMENTAR PADA BARIS INI
}
}