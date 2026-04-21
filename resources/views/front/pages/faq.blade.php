@extends('layouts.main') {{-- Pastikan ini sesuai dengan nama file layout utama Anda --}}

@section('title', 'FAQ - Pertanyaan Umum')

@section('content')
<div class="container py-5" style="margin-top: 20px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-uppercase" style="letter-spacing: 2px;">FAQ</h2>
                <p class="text-muted">Pertanyaan yang sering diajukan seputar produk & layanan Strideelle</p>
            </div>

            <div class="accordion shadow-sm border-0" id="faqAccordion">
                
                <div class="accordion-item border-0 mb-3 shadow-sm rounded">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                            Bagaimana cara menentukan ukuran sepatu yang pas?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            Ukuran sepatu di <strong>Strideelle</strong> menggunakan standar ukuran lokal (Indonesia). Namun, untuk memastikan kenyamanan, kami sarankan Anda mengukur panjang telapak kaki Anda (dari tumit hingga ujung jari terpanjang) dan mencocokkannya dengan <em>Size Chart</em> yang tersedia di deskripsi setiap produk.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 mb-3 shadow-sm rounded">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                            Apakah foto produk sesuai dengan aslinya (Real Picture)?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            Ya, 100% Real Picture. Semua foto produk yang ditampilkan di website Strideelle adalah hasil pemotretan tim kami sendiri menggunakan produk asli. Perbedaan warna mungkin sedikit terjadi karena efek pencahayaan layar HP/Monitor Anda.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 mb-3 shadow-sm rounded">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                            Apakah bisa tukar size jika kekecilan/kebesaran?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            Tentu bisa! Kami memberikan garansi penukaran size maksimal <strong>3 hari</strong> setelah barang diterima, selama kondisi sepatu masih baru, belum dipakai jalan di luar (hanya dicoba), dan tag masih terpasang. Ongkos kirim penukaran ditanggung pembeli, kecuali kesalahan kirim dari pihak kami.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 mb-3 shadow-sm rounded">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                            Berapa lama proses pengiriman barang?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            Pesanan yang masuk sebelum jam 15.00 WIB akan diproses dan dikirim di hari yang sama. Estimasi pengiriman tergantung ekspedisi dan lokasi Anda, biasanya memakan waktu 1-3 hari untuk Pulau Jawa dan 3-7 hari untuk luar Pulau Jawa.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 mb-3 shadow-sm rounded">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
                            Terbuat dari bahan apa sepatu Strideelle?
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            Kami menggunakan berbagai material premium pilihan seperti <em>Premium Synthetic Leather</em>, <em>Suede</em>, dan sol karet anti-slip yang empuk (Double Foam) agar nyaman dipakai seharian tanpa membuat kaki lecet. Detail bahan tercantum di setiap halaman produk.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection