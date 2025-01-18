<?php

namespace App\Exports;

use App\Models\DailyLog;
use App\Models\Tenant;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DailyLogByPlaqueExport implements FromView {
    public $tenant_id;
    public function __construct ($tenant_id) {
        $this->tenant_id = $tenant_id;
    }

    public function view (): View {
        $daily_logs = DailyLog::query()
            ->where('tenant_id', $this->tenant_id)->get();
        return view('exports.daily-log-by-plaque' , [
            'daily_logs' => $daily_logs ,
        ]);
    }
}
