<?php

namespace App\Exports;

use App\Models\DailyLog;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DailyLogByDateExport implements FromView {
    public $started_at;
    public $ended_at;

    public function __construct ( $started_at , $ended_at ) {
        $this->started_at = $started_at;
        $this->ended_at = $ended_at;
    }

    public function view (): View {
        $daily_logs = DailyLog::query()
                              ->where('date' , '>=' , Carbon::createFromTimestamp($this->started_at)->startOfDay())
                              ->where('date' , '<=' , Carbon::createFromTimestamp($this->ended_at)->endOfDay())
                              ->get();

        return view('exports.daily-log-by-plaque' , [
            'daily_logs' => $daily_logs ,
        ]);
    }
}
