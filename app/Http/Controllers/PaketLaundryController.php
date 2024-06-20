<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketLaundry;

class PaketLaundryController extends Controller
{
    public function getByNamaPaket($nama_paket)
    {
        $paket = PaketLaundry::where('nama_paket', $nama_paket)->first();

        if (!$paket) {
            return response()->json(['message' => 'Paket laundry tidak ditemukan'], 404);
        }

        return response()->json($paket);
    }
}
