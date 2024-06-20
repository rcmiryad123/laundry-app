<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        // Buat 50 order menggunakan OrderFactory
        \App\Models\Order::factory(50)->create();
    }
}

