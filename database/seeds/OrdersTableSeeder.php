<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $accounts = \App\Account::all()->pluck('id')->toArray();
        $products = \App\Product::all()->pluck('id')->toArray();

        for ($i = 0; $i < 200; $i++) {
            $account_id = $faker->randomElement($accounts);
            $product_id = $faker->randomElement($products);

            \App\Order::create([
                'account_id' => $account_id,
                'product_id' => $product_id
            ]);
        }
        
    }
}
