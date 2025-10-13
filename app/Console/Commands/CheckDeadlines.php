<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Task;
use App\Notifications\DeadlineReminder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log; // Untuk logging

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
    protected $description = 'Periksa tugas yang mendekati deadline dan kirim notifikasi email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mulai memeriksa deadline tugas...');
        Log::info('Cron Job CheckDeadlines: Mulai berjalan.');

        // 1. Cari semua tugas yang belum selesai dan akan deadline dalam 3 hari ke depan.
        $tasksToRemind = Task::where('status', '!=', 'Selesai')
            ->whereBetween('deadline', [Carbon::now(), Carbon::now()->addDays(3)])
            ->get();

        if ($tasksToRemind->isEmpty()) {
            $this->info('Tidak ada tugas yang perlu diingatkan hari ini.');
            Log::info('Cron Job CheckDeadlines: Tidak ada tugas yang perlu diingatkan.');
            return 0; // Selesai
        }

        // 2. Kelompokkan tugas berdasarkan user_id
        $tasksByUser = $tasksToRemind->groupBy('user_id');

        // 3. Loop melalui setiap user dan kirim notifikasi
        foreach ($tasksByUser as $userId => $tasks) {
            $user = User::find($userId);
            if ($user) {
                // Kirim notifikasi ke user dengan daftar tugasnya
                $user->notify(new DeadlineReminder($tasks));
                $this->info("Mengirim notifikasi ke: {$user->email} untuk {$tasks->count()} tugas.");
                Log::info("Cron Job CheckDeadlines: Mengirim notifikasi ke {$user->email}.");
            }
        }

        $this->info('Selesai memeriksa deadline tugas.');
        Log::info('Cron Job CheckDeadlines: Selesai.');
        return 0;
    }
}