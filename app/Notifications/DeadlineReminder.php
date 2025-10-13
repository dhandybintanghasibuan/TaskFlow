<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection; // Tambahkan ini

class DeadlineReminder extends Notification
{
    use Queueable;

    // Properti untuk menyimpan daftar tugas
    public Collection $tasks;

    /**
     * Buat instance notifikasi baru.
     *
     * @param \Illuminate\Support\Collection $tasks
     * @return void
     */
    public function __construct(Collection $tasks)
    {
        $this->tasks = $tasks;
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
        $url = url('/dashboard');

        return (new MailMessage)
                    ->subject('TaskFlow: Pengingat Deadline Tugas')
                    ->greeting('Halo, ' . $notifiable->name . '!')
                    ->line('Ini adalah pengingat bahwa Anda memiliki beberapa tugas yang mendekati deadline:')
                    ->view('notifications.deadline_email', ['tasks' => $this->tasks, 'url' => $url]) // Menggunakan view kustom
                    ->salutation('Semangat mengerjakan!');
    }
}