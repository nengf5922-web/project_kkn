<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. DATA KARTU (COUNTERS)
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCustomers = User::where('role', 'user')->count();

        // 2. DATA PESANAN TERBARU (PESANAN MASUK)
        // Mengambil 5 pesanan terakhir untuk ditampilkan di tabel dashboard
        $latestOrders = Order::with('user')->latest()->take(5)->get();

        // 3. LOGIKA STATISTIK PENJUALAN (GRAFIK)
        // Mengambil total pendapatan per bulan di tahun ini
        $salesData = Order::select(
            DB::raw('SUM(total_price) as total'),
            DB::raw('MONTH(created_at) as month')
        )
        ->whereYear('created_at', date('Y'))
        ->where('status', '!=', 'cancelled') // Hanya hitung yang tidak batal
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Menyiapkan array kosong untuk 12 bulan (Jan - Des)
        $chartData = array_fill(1, 12, 0);

        // Mengisi array dengan data dari database
        foreach ($salesData as $data) {
            $chartData[$data->month] = $data->total;
        }

        // Konversi keys array jadi string untuk label chart (Jan, Feb, dst)
        $chartValues = array_values($chartData);

        return view('admin.dashboard.index', compact(
            'totalCategories', 
            'totalProducts', 
            'totalOrders', 
            'totalCustomers',
            'latestOrders',
            'chartValues'
        ));
    }

    // 4. FUNGSI DOWNLOAD LAPORAN (CSV / EXCEL)
    public function downloadReport()
    {
        $fileName = 'laporan-penjualan-' . date('Y-m-d') . '.csv';
        
        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Order ID', 'Pelanggan', 'Tanggal', 'Status', 'Total Harga', 'Metode Pembayaran');

        $callback = function() use($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($orders as $order) {
                $row['Order ID']  = $order->id;
                $row['Pelanggan'] = $order->user->name ?? 'Guest';
                $row['Tanggal']   = $order->created_at->format('d-m-Y H:i');
                $row['Status']    = ucfirst($order->status);
                $row['Total']     = $order->total_price;
                $row['Payment']   = $order->payment_method;

                fputcsv($file, array($row['Order ID'], $row['Pelanggan'], $row['Tanggal'], $row['Status'], $row['Total'], $row['Payment']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}