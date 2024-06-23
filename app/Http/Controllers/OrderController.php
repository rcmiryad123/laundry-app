<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\View\View;
use App\Models\PaketLaundry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orders', ['orders' => $orders]);
    }

    public function indexJson()
    {
        $orders = Order::all();
        return response()->json(['orders' => $orders]);
    }

    public function DetailsOrder($id)
    {
        $order = Order::where('id', $id)->first();

        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Order not found.');
        }

        // Ambil jenis layanan dari order
        $jenisLayanan = $order->jenis_layanan;

        // Cari data paket laundry berdasarkan jenis layanan
        $paketLaundry = PaketLaundry::where('nama_paket', $jenisLayanan)->first();

        // Kirim data order dan paket laundry ke view
        return view('order', ['order' => $order, 'paketLaundry' => $paketLaundry]);
    }

    public function InvoicesDetailsOrder($id)
    {
        $order = Order::where('id', $id)->first();

        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Order not found.');
        }

        // Ambil jenis layanan dari order
        $jenisLayanan = $order->jenis_layanan;

        // Cari data paket laundry berdasarkan jenis layanan
        $paketLaundry = PaketLaundry::where('nama_paket', $jenisLayanan)->first();

        // Kirim data order dan paket laundry ke view
        return view('invoices', ['order' => $order, 'paketLaundry' => $paketLaundry]);
    }

    public function FinishedOrder($id)
    {
        $order = Order::where('id', $id)->first();

        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Order not found.');
        }

        // Ganti status jadi Selesai
        $order->status = 'Selesai';
        $order->save();

        // Kembali ke halaman Order
        return redirect()->route('orders.index')->with('success', 'Order selesai.');
    }

    public function store(Request $request)
    {

        $paket = PaketLaundry::where('nama_paket', $request->paket)->first();
        $lama_pelayanan = $paket->lama_pelayanan;

        Order::create([
            'customer' => $request->input('customer'),
            'total_berat' => $request->input('total_berat'),
            'jenis_layanan' => $request->input('paket'),
            'jenis_proses' => $request->input('jenis_proses'),
            'jenis_pembayaran' => $request->input('pembayaran'),
            'status' => 'Belum Selesai',
            'dead_line' => now()->addHours($lama_pelayanan),
        ]);
        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

}
