<?php

namespace App\Services;

use App\Models\Driver;
use App\Models\GetPercent;
use App\Models\Order;
use App\Models\Profit;
use Illuminate\Support\Facades\DB;

class DriverService
{
    public function __construct()
    {
        //
    }

    public function assigned_driver($order)
    {
        $percent = GetPercent::firstOrFail();
        $driver = Driver::active()->select(DB::raw('ABS(longitude-(' . $order->longitude . ')) as lng,
                ABS(latitude-(' . $order->latitude . ')) as ltd'),
            'balance', 'user_id', 'rating')
            ->where('balance', '>=', ceil($order->amount * $percent->percent / 100))
            ->orderBy('lng', 'ASC')->orderBy('ltd', 'ASC')->orderBy('rating', 'DESC')
            ->firstOrFail();
        DB::beginTransaction();
        try {
            $driver->status=Driver::STATUS_INACTIVE;
            $driver->save();
            $order->driver_id = $driver->user_id;
            $order->status = Order::STATUS_DRIVER_ASSIGNED;
            $order->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }
    public function completed_profit($order)
    {
        $percent = GetPercent::firstOrFail();
        $profit = ceil($order->amount * $percent->percent / 100);
        DB::beginTransaction();
        try {
            $driver = Driver::findOrFail($order->driver_id);
            $driver->balance = $driver->balance - $profit;
            $driver->status = Driver::STATUS_ACTIVE;
            $driver->save();
            Profit::create([
                'driver_id' => $driver->id,
                'amount' => $profit,
                'order_id' => $order->id
            ]);
            $order->status = Order::STATUS_COMPETED;
            $order->save();
            DB::commit();
            return response()->json(['message' => 'Заказ завершёнь']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => 'повторите ещё:' . $exception]);
        }
    }
}
