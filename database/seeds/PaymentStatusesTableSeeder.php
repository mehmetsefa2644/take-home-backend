<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use App\Helpers;

class PaymentStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();
        $orders = \App\Order::all()->pluck('id')->toArray();

        foreach ($orders as $order_id) {
            $fields = array();

            $year = 2018;
            $month = rand(11, 12);
            $day = rand(1, 16);

            $date = Carbon\Carbon::create($year,$month ,$day , rand(1, 12), rand(1, 30), rand(1, 30));

            $random = rand(1, 100);

            $fields = \App\Helpers\Collection::array_push_assoc($fields, 'order_id', $order_id);
            $fields = \App\Helpers\Collection::array_push_assoc($fields, 'amount_in_cents', $faker->numberBetween(100,20000));

            if ($random > 30) { // paid or refunded
                $fields = \App\Helpers\Collection::array_push_assoc($fields, 'paid_at', $date->format('Y-m-d H:i:s'));
                if($random < 50) { // refunded
                    $fields = \App\Helpers\Collection::array_push_assoc($fields, 'refunded_at', $date->addWeeks(1)->format('Y-m-d H:i:s'));
                } else {
                }
            } else { // declined
                $fields = \App\Helpers\Collection::array_push_assoc($fields, 'declined_at', $date->format('Y-m-d H:i:s'));
            }
            echo json_encode($fields);



            \App\PaymentStatus::create($fields);
        }
    }
}
