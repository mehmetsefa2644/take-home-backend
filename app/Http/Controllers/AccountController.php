<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    public function get_accounts_data() {
        $result = array();

        // all accounts' data
        $accounts_data = \App\Account::with('orders.paymentStatus', 'orders.product')->get();

        foreach ($accounts_data as $account_data) {
            $amounts = \App\Services\OrderService::get_amounts($account_data->orders);

            $amounts['name'] = $account_data->name;
            $amounts['id'] = $account_data->id;
            Log::info(json_encode($amounts));
            array_push($result, $amounts);
        }
        Log::info(json_encode($result));
        return response()->json($result);
    }

    public function get_account_detail($account_id) {
        $result = array();

        $account_data = \App\Account::where('id', $account_id)->with('orders.paymentStatus', 'orders.product')->get();

        [$this_month, $this_week, $today] = \App\Services\OrderService::get_order_details($account_data[0]->orders);

        $result['name'] = $account_data[0]->name;
        $result['this_month'] = $this_month;
        $result['this_week'] = $this_week;
        $result['today'] = $today;
        
        return response()->json($result);
    }
}
