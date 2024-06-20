<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        try {
            $orders = Order::select('id', 'billing_name', 'package', 'status', 'dead_line', 'process_method', 'total_kilos')
                ->where('status', 'Not Finished')
                ->orderBy('dead_line', 'asc')
                ->get();

            return response()->json($orders);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    public function getOrdersNotFinish()
    {
        try {
            $orders = Order::select('id', 'billing_name', 'package', 'status', 'dead_line', 'process_method', 'total_kilos')
                ->where('status', 'Not Finished')
                ->orderBy('dead_line', 'asc')
                ->get();
            return response()->json($orders);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getOrdersAll()
    {
        $orders = Order::select('id', 'status', 'created_at', 'dead_line', 'billing_name', 'total_kilos', 'package', 'process_method', 'payment_method')
            ->orderBy('status', 'asc')
            ->get();

        $orders->transform(function ($order) {
            $order->created_at_for_human = $order->created_at->diffForHumans();
            return $order;
        });

        return response()->json($orders);
    }

    public function finish($orderId)
    {
        try {
            // Temukan order berdasarkan ID
            $order = Order::findOrFail($orderId);

            // Ubah status order menjadi "selesai"
            $order->status = 'selesai';
            $order->save();

            return response()->json(['message' => 'Order berhasil ditandai sebagai selesai']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function showOnGoingOrders()
    {
        return view('on-going-order');
    }

    public function store(Request $request)
    {
        // Lakukan validasi form jika diperlukan
        $validatedData = $request->validate([
            'package' => 'required',
            'billing_name' => 'required',
            'total_kilos' => 'required|numeric',
            'payment_method' => 'required',
            'process_method' => 'required',
        ]);

        try {
            // Tentukan deadline berdasarkan process_method
            if ($request->process_method == 'express') {
                $deadline = now(); // Deadline hari ini
            } else {
                $deadline = now()->addDays(3); // Deadline +3 hari dari hari ini
            }

            // Simpan order ke dalam database menggunakan model Order
            $order = new Order();
            $order->package = $request->package;
            $order->billing_name = $request->billing_name;
            $order->total_kilos = $request->total_kilos;
            $order->payment_method = $request->payment_method;
            $order->process_method = $request->process_method;
            $order->status = 'Not Finished';
            $order->dead_line = $deadline; // Atur deadline sesuai dengan kondisi di atas
            $order->save();

            return redirect('/details-orders')->with('success', 'Order created successfully!');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getOrderDetails($orderId)
    {
        $order = Order::find($orderId);
        if ($order) {
            return response()->json($order);
        }else {
            return response()->json(['Order tidak ditemukan'], 404);
        }
    }
}
