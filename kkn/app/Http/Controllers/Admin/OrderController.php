<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // 1. MENAMPILKAN SEMUA PESANAN
    public function index()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // 2. MENAMPILKAN DETAIL PESANAN
    public function show($id)
    {
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // 3. UPDATE STATUS & KIRIM WA (LOGIKA UTAMA)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,shipped,completed,cancelled'
        ]);

        $order = Order::findOrFail($id);
        
        // Cek jika status berubah
        if ($order->status !== $request->status) {
            
            // 1. Update Database
            $order->status = $request->status;
            $order->save();

            // 2. Siapkan Data Pelanggan & Format Nomor HP
            $userPhone = $order->user->phone;
            $userName  = $order->user->name;
            
            // Format Nomor HP (Hapus 0 di depan, ubah jadi 62)
            $userPhone = preg_replace('/[^0-9]/', '', $userPhone);
            if (substr($userPhone, 0, 1) == '0') {
                $userPhone = '62' . substr($userPhone, 1);
            }

            // 3. Siapkan Variabel Data (ID Order & Harga)
            // Buat ID terlihat keren seperti di gambar: ORD-20260106-XXXX
            $orderId = "ORD-" . date('Ymd') . "-" . $order->id;
            
            // Format Rupiah (Pastikan kolom di database Anda 'total_price' atau sesuaikan)
            $totalHarga = "Rp " . number_format($order->total_price ?? 0, 0, ',', '.'); 
            
            // Status dalam Bahasa Indonesia yang rapi
            $statusLabel = match($request->status) {
                'pending' => 'Menunggu Pembayaran ',
                'paid' => 'Sudah Dibayar ',
                'shipped' => 'Sedang Dikirim ',
                'completed' => 'Selesai ',
                'cancelled' => 'Dibatalkan ',
                default => strtoupper($request->status),
            };

            // 4. SUSUN PESAN WHATSAPP (SESUAI GAMBAR REQUEST)
            // Menggunakan \n untuk Enter agar rapi
            
            $message = "PESANAN SELESAI\n\n"; // Header
            
            $message .= "Halo $userName,\n\n";
            $message .= "Pesanan Anda telah sampai dan selesai! \n\n";
            
            $message .= " Detail Pesanan:\n";
            $message .= "Order ID: $orderId\n";
            $message .= "Total: $totalHarga\n";
            $message .= "Status: $statusLabel\n\n";
            
            $message .= " Terima kasih telah berbelanja di Strideelle!\n\n";
            
            $message .= " Bagaimana pengalaman Anda?\n";
            $message .= "Kami sangat menghargai feedback Anda untuk meningkatkan layanan.\n\n";
            
            $message .= " Belanja Lagi?\n\n";
            $message .= "Dapatkan promo menarik di kunjungan berikutnya!\n\n";
            
            $message .= "_Strideelle - Your Confidence Partner_ ";

            // 5. ENCODE URL (PENTING!)
            // Gunakan rawurlencode agar spasi jadi %20 dan Enter terbaca oleh WhatsApp
            $waUrl = "https://wa.me/$userPhone?text=" . rawurlencode($message);
            
            // Redirect admin ke WhatsApp
            return redirect()->away($waUrl);
        }

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }
}