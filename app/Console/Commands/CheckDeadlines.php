<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Task;
use App\Notifications\DeadlineReminder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CheckDeadlines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-deadlines';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Periksa tugas yang mendekati deadline (H-7, H-3, H-1) dan kirim notifikasi.';

    /**
     * Execute the console command.
     */
    public function handle()
{
    Log::info('Cron Job CheckDeadlines: Mulai berjalan.');

    $users = User::all();

    foreach ($users as $user) {
        if (!$user->telegram_chat_id || empty($user->notification_preferences)) {
            continue; // Lewati user yang tidak ingin notifikasi
        }

        // Ambil hari pengingat dari preferensi user
        $reminderDays = json_decode($user->notification_preferences);

        // Buat daftar tanggal target berdasarkan preferensi user
        $targetDates = [];
        foreach ($reminderDays as $day) {
            $targetDates[] = Carbon::today()->addDays($day)->toDateString();
        }

        // Cari tugas user yang deadline-nya cocok
        $tasksToRemind = $user->tasks()
            ->where('status', '!=', 'Selesai')
            ->whereIn(\DB::raw('DATE(deadline)'), $targetDates)
            ->get();

        if ($tasksToRemind->isNotEmpty()) {
            $user->notify(new DeadlineReminder($tasksToRemind));
            Log::info("Mengirim notifikasi ke user {$user->name} untuk {$tasksToRemind->count()} tugas.");
        }
    }

    Log::info('Cron Job CheckDeadlines: Selesai.');
    return 0;
}
}