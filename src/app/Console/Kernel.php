<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * アプリケーションのコマンドスケジューラーを定義する。
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // コマンドのスケジュールを定義
    }

    /**
     * アプリケーションのコマンドを登録する。
     *
     * @return void
     */
    protected function commands()
    {
        // コマンドを登録
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
