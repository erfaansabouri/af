<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use App\Services\Convert;
use Illuminate\Console\Command;

class FixPhoneCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix-phone';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (Tenant::query()->whereNotNull('phone_number')->get() as $tenant){
            $tenant->phone_number = Convert::convertToEnNumbers($tenant->phone_number);
            $tenant->save();
        }
    }
}
