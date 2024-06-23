<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model
    protected $table = 'orders';

    // Kolom-kolom yang dapat diisi nilai nya
    protected $fillable = [
        'customer',
        'total_berat',
        'jenis_layanan',
        'jenis_proses',
        'jenis_pembayaran',
        'status',
        'dead_line',
    ];

    // Jika nama primary key di tabel Anda bukan 'id'
    // protected $primaryKey = 'nama_primary_key';

}
