<?php

namespace Database\Factories;

use App\Models\PaketLaundry;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaketLaundryFactory extends Factory
{
    protected $model = PaketLaundry::class;

    public function definition()
    {
        return [
            'nama_paket' => $this->faker->unique()->randomElement([
                'Paket Ekonomis',
                'Paket Standar',
                'Paket Premium',
                'Paket Express',
                'Paket Deluxe',
                'Paket Spesial',
                'Paket Hemat'
            ]),
            'harga_per_kg' => $this->faker->numberBetween(100, 500),
            'proses_cuci' => $this->faker->randomElement(['air hangat', 'air dingin']),
            'mesin_pengering' => $this->faker->randomElement(['standar', 'hemat energi', 'cepat']),
            'lipat_rapi' => $this->faker->boolean(),
            'setrika' => $this->faker->boolean(),
            'lama_pelayanan' => $this->faker->randomElement(['24 jam', '48 jam', '1 minggu', null]),
            'keterangan_tambahan' => $this->faker->text(100),
        ];
    }
}
