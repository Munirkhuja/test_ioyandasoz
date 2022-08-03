<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Services\DriverService;
use Illuminate\Console\Command;

class AssignedDriverCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:assigned';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = Order::where('status', Order::STATUS_ENTRY)->get();
        if (empty($orders)) return false;
        $drs = new DriverService;
        foreach ($orders as $order) {
            $drs->assigned_driver($order);
        }
        return true;
    }
}
