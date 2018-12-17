<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DateService 
{
    public static function in_today($date) {
        $startDate = Carbon::now()->startOfDay();
        $endDate   = $startDate->copy()->endOfDay();
        Log::info('today - date');
        Log::info($date);
        Log::info('today - start');
        Log::info($startDate);
        Log::info('today - end');
        Log::info($endDate);
        if ($startDate < $date && $date < $endDate) {
            return true;
        } else {
            return false;
        }
    }
    public static function in_week($date) {
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);

        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();
        Log::info('week - date');
        Log::info($date);
        Log::info('week - start');
        Log::info($startDate);
        Log::info('week - end');
        Log::info($endDate);
        if ($startDate < $date && $date < $endDate) {
            return true;
        } else {
            return false;
        }
    }
    public static function in_month($date) {
        $start = new Carbon('first day of this month');
        $startDate = $start->startOfMonth();
        $end = new Carbon('last day of this month');
        $endDate = $end->endOfMonth();
        Log::info('month - date');
        Log::info($date);
        Log::info('month - start');
        Log::info($startDate);
        Log::info('month - end');
        Log::info($endDate);
        if ($startDate < $date && $date < $endDate) {
            return true;
        } else {
            return false;
        }
    }
}