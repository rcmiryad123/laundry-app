<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        $jenis_proses = $this->faker->randomElement(['express', 'normal']);
        $dead_line = $jenis_proses == 'express' ? now() : now()->addDays(3);

        return [
            'customer' => $this->faker->name,
            'total_berat' => $this->faker->randomFloat(2, 0, 20), // asumsi berat antara 0 - 20 kg dengan 2 angka desimal
            'jenis_layanan' => $this->faker->randomElement(['paket-1', 'paket-2', 'paket-3']),
            'jenis_proses' => $jenis_proses,
            'jenis_pembayaran' => $this->faker->randomElement(['cash', 'qris', 'transfer']),
            'status' => 'Not Finished',
            'dead_line' => $dead_line
        ];
    }
}
