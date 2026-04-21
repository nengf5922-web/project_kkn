@extends('layouts.main') {{-- Menggunakan layout yang sudah diperbaiki --}}

@section('title', 'Hubungi Kami - Strideelle')

@section('content')
<div class="container py-5" style="margin-top: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center mb-5">
            <h2 class="fw-bold text-uppercase" style="letter-spacing: 2px;">Hubungi Kami</h2>
            <p class="text-muted">Punya pertanyaan seputar ukuran atau pengiriman? Tim kami siap membantu Anda.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-5 mb-4">
            <div class="card bg-dark text-white p-4 h-100 border-0 rounded-4 shadow">
                <h4 class="mb-4 fw-bold">Kontak Langsung</h4>
                
                <div class="mb-4">
                    <label class="text-white-50 small fw-bold">WHATSAPP</label>
                    <p class="fs-5 fw-bold mb-0">+62 823-2186-3102</p>
                    <a href="https://wa.me/6282321863102" target="_blank" class="text-warning text-decoration-none small">Chat Sekarang &rarr;</a>
                </div>

                <div class="mb-4">
                    <label class="text-white-50 small fw-bold">EMAIL</label>
                    <p class="fs-5 fw-bold mb-0">support@strideelle.com</p>
                    <a href="mailto:support@strideelle.com" class="text-warning text-decoration-none small">Kirim Email &rarr;</a>
                </div>

                <div class="mb-4">
                    <label class="text-white-50 small fw-bold">INSTAGRAM</label>
                    <p class="fs-5 fw-bold mb-0">@strideelle_official</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 p-4 h-100 rounded-4">
                <h4 class="mb-3 fw-bold">Tulis Pesan</h4>
                <p class="text-muted small mb-4">Isi formulir di bawah ini, pesan akan otomatis diteruskan ke WhatsApp Admin.</p>
                
                <form id="contactForm">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" id="name" class="form-control" placeholder="Contoh: Putri" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email Anda</label>
                        <input type="email" id="email" class="form-control" placeholder="email@contoh.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pesan / Pertanyaan</label>
                        <textarea id="message" class="form-control" rows="4" placeholder="Halo kak, mau tanya tentang sepatu..." required></textarea>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="button" onclick="sendToWhatsapp()" class="btn btn-success fw-bold py-2">
                            <i class="bi bi-whatsapp me-2"></i> Kirim ke WhatsApp Admin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT PENGIRIM PESAN OTOMATIS --}}
<script>
    function sendToWhatsapp() {
        // 1. Ambil nilai dari input
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var message = document.getElementById('message').value;

        // 2. Validasi sederhana
        if (name === "" || message === "") {
            alert("Harap isi Nama dan Pesan terlebih dahulu!");
            return;
        }

        // 3. Nomor Admin (Ganti 08 diganti 62)
        var phoneNumber = "6282321863102"; 

        // 4. Format Pesan
        var text = "Halo Admin Strideelle,\n\n" +
                   "Saya ingin bertanya melalui Website.\n" +
                   "----------------------------------\n" +
                   "Nama: " + name + "\n" +
                   "Email: " + email + "\n" +
                   "----------------------------------\n" +
                   "Pesan:\n" + message;

        // 5. Encode URL agar karakter khusus (spasi, enter) terbaca browser
        var encodedText = encodeURIComponent(text);

        // 6. Buka WhatsApp
        window.open("https://wa.me/" + phoneNumber + "?text=" + encodedText, "_blank");
    }
</script>
@endsection