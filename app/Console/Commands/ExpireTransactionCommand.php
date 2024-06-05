<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Illuminate\Console\Command;

class ExpireTransactionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire-transactions';

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
        Transaction::query()->where('created_at', '<', now()->subMinutes(10))->whereNull('failed_at')->whereNull('paid_at')
            ->update(['failed_at' => now()]);
    }
}
