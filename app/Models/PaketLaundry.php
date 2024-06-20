<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketLaundry extends Model
{
    use HasFactory;

    protected $table = 'paket_laundry';

    protected $fillable = [
        'nama_paket',
        'harga_per_kg',
        'proses_cuci',
        'mesin_pengering',
        'lipat_rapi',
        'setrika',
        'lama_pelayanan',
        'keterangan_tambahan'
    ];
}
