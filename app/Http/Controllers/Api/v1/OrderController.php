<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\GetPercent;
use App\Models\Order;
use App\Models\Profit;
use App\Services\DriverService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function all_driver_assigned()
    {
        $orders = Order::where('status', Order::STATUS_ENTRY)->get();
        if (empty($orders)) return response()->json(['message' => 'нет новых заказов']);
        $drs = new DriverService;
        foreach ($orders as $order) {
            $drs->assigned_driver($order);
        }
        return response()->json(['message' => 'водители назначены']);
    }

    public function driver_assigned($id)
    {
        $order = Order::findOrFail($id);
        $drs = new DriverService;
        $drs->assigned_driver($order);
        return response()->json(['message' => 'водител назначен']);
    }

    public function completed($id)
    {
        $order = Order::findOrFail($id);
        if ($order->driver_id !== Auth::user()->id) return response()->json(['message' => 'это не ваш заказ']);
        $drs = new DriverService;
        return $drs->completed_profit($order);
    }
}
