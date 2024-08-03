<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Illuminate\Console\Command;

class TransactionTenantNameCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:transaction-tenant-name-command';

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
        $transactions = Transaction::query()
            ->whereNull('tenant_name')
            ->get();

        foreach ($transactions as $transaction){
            $transaction->tenant_name = $transaction->tenant->full_name;
            $transaction->saveQuietly();
        }
    }
}
