<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class OrderService 
{
    public static function get_order_details($orders) {
        $this_month = array();
        $this_week = array();
        $today = array();

        foreach ($orders as $order) {
            $result_order = array();
            $order = json_decode($order, true);
            $fare = $order['payment_status']['amount_in_cents'];
            $product_name = $order['product']['title'];

            if($order['payment_status']['refunded_at']) { // refunded
                $status = 'Refunded';
                $time = $order['payment_status']['refunded_at'];
                if(\App\Services\DateService::in_today($order['payment_status']['refunded_at'])) {
                    $result_order['status'] = $status;
                    $result_order['fare'] = $fare;
                    $result_order['product_name'] = $product_name;
                    $result_order['time'] = $time;
                    array_push($today, $result_order);
                } else if(\App\Services\DateService::in_week($order['payment_status']['refunded_at'])) {
                    $result_order['status'] = $status;
                    $result_order['fare'] = $fare;
                    $result_order['product_name'] = $product_name;
                    $result_order['time'] = $time;
                    array_push($this_week, $result_order);
                } else if(\App\Services\DateService::in_month($order['payment_status']['refunded_at'])) {
                    $result_order['status'] = $status;
                    $result_order['fare'] = $fare;
                    $result_order['product_name'] = $product_name;
                    $result_order['time'] = $time;
                    array_push($this_month, $result_order);
                }
            }
            
            if($order['payment_status']['paid_at']) { // paid
                $status = 'Paid';
                $time = $order['payment_status']['paid_at'];
                if(\App\Services\DateService::in_today($order['payment_status']['paid_at'])) {
                    $result_order['status'] = $status;
                    $result_order['fare'] = $fare;
                    $result_order['product_name'] = $product_name;
                    $result_order['time'] = $time;
                    array_push($today, $result_order);
                } else if(\App\Services\DateService::in_week($order['payment_status']['paid_at'])) {
                    $result_order['status'] = $status;
                    $result_order['fare'] = $fare;
                    $result_order['product_name'] = $product_name;
                    $result_order['time'] = $time;
                    array_push($this_week, $result_order);
                } else if(\App\Services\DateService::in_month($order['payment_status']['paid_at'])) {
                    $result_order['status'] = $status;
                    $result_order['fare'] = $fare;
                    $result_order['product_name'] = $product_name;
                    $result_order['time'] = $time;
                    array_push($this_month, $result_order);
                }
            } else if($order['payment_status']['declined_at']) { // declined
                $status = 'Declined';
                $time = $order['payment_status']['declined_at'];
                if(\App\Services\DateService::in_today($order['payment_status']['declined_at'])) {
                    $result_order['status'] = $status;
                    $result_order['fare'] = $fare;
                    $result_order['product_name'] = $product_name;
                    $result_order['time'] = $time;
                    array_push($today, $result_order);
                } else if(\App\Services\DateService::in_week($order['payment_status']['declined_at'])) {
                    $result_order['status'] = $status;
                    $result_order['fare'] = $fare;
                    $result_order['product_name'] = $product_name;
                    $result_order['time'] = $time;
                    array_push($this_week, $result_order);
                } else if(\App\Services\DateService::in_month($order['payment_status']['declined_at'])) {
                    $result_order['status'] = $status;
                    $result_order['fare'] = $fare;
                    $result_order['product_name'] = $product_name;
                    $result_order['time'] = $time;
                    array_push($this_month, $result_order);
                }
            } else { // pending
                $status = 'Pending';
                if(\App\Services\DateService::in_today($order['payment_status']['updated_at'])) {
                    $result_order['status'] = $status;
                    $result_order['fare'] = $fare;
                    $result_order['product_name'] = $product_name;
                    array_push($today, $result_order);
                } else if(\App\Services\DateService::in_week($order['payment_status']['updated_at'])) {
                    $result_order['status'] = $status;
                    $result_order['fare'] = $fare;
                    $result_order['product_name'] = $product_name;
                    array_push($this_week, $result_order);
                } else if(\App\Services\DateService::in_month($order['payment_status']['updated_at'])) {
                    $result_order['status'] = $status;
                    $result_order['fare'] = $fare;
                    $result_order['product_name'] = $product_name;
                    array_push($this_month, $result_order);
                }
            }
        }
        return [$this_month, $this_week, $today];
    }

    public static function get_amounts($orders) {
        $today = 0;
        $this_week = 0;
        $this_month = 0;
        foreach ($orders as $order) {
            $order = json_decode($order, true);
            if($order['payment_status']['paid_at']) {
                if (\App\Services\DateService::in_today($order['payment_status']['paid_at'])) {
                    $fare = $order['payment_status']['amount_in_cents'];
                    $this_week += $fare;
                    $this_month += $fare;
                    $today += $fare;
                } else if(\App\Services\DateService::in_week($order['payment_status']['paid_at'])){
                    $fare = $order['payment_status']['amount_in_cents'];
                    $this_week += $fare;
                    $this_month += $fare;
                } else if(\App\Services\DateService::in_month($order['payment_status']['paid_at'])) {
                    $this_month += $order['payment_status']['amount_in_cents'];
                }
            }
        }
        return ['today' => $today, 'this_week' => $this_week, 'this_month' => $this_month];
    }
}