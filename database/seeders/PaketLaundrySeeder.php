<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaketLaundry;

class PaketLaundrySeeder extends Seeder
{
    public function run()
    {
        PaketLaundry::factory()->count(10)->create();
    }
}
