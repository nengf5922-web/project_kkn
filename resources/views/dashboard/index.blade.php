@extends('layouts.main')



@section('content')



<div class="editorial-header">

    <h2>Strideelle X Collection</h2>

    <p class="text-muted small">Confidence in Every Step</p>

</div>



<div class="row mb-5 align-items-center">

    <div class="col-md-7">

        <div class="row g-2">

            <div class="col-6">

                <img src="{{ asset('assets/products/banner1.jpeg') }}" class="img-editorial aspect-portrait" alt="Detail 1">

            </div>

            <div class="col-6 mt-4">

                <img src="{{ asset('assets/products/banner2.jpeg') }}" class="img-editorial aspect-portrait" alt="Detail 2">

            </div>

        </div>

    </div>



    <div class="col-md-5 ps-md-5 mt-4 mt-md-0">

        <h6 class="section-title">Strideelle's History</h6>

        <p class="text-content">

            Strideelle didirikan dengan visi untuk memadukan kenyamanan dan estetika modern.

            Setiap pasang sepatu dirancang dengan teliti, menggunakan bahan kulit premium

            yang lembut namun tahan lama.

            <br><br>

            Kami percaya bahwa sepatu bukan hanya alas kaki, melainkan fondasi dari

            rasa percaya diri wanita modern dalam melangkah setiap hari.

        </p>

    </div>

</div>



<div class="row mb-5 g-2">

    <div class="col-3">

        <a href="#" class="clean-link">

            <img src="{{ asset('assets/products/p1.jpeg') }}" class="img-editorial aspect-square" alt="Shoe">

        </a>

    </div>

    <div class="col-3">

        <a href="#" class="clean-link">

            <img src="{{ asset('assets/products/p2.jpeg') }}" class="img-editorial aspect-square" alt="Shoe">

        </a>

    </div>

    <div class="col-3">

        <a href="#" class="clean-link">

            <img src="{{ asset('assets/products/p3.jpeg') }}" class="img-editorial aspect-square" alt="Shoe">

        </a>

    </div>

    <div class="col-3">

        <a href="#" class="clean-link">

            <img src="{{ asset('assets/products/p4.jpeg') }}" class="img-editorial aspect-square" alt="Shoe">

        </a>

    </div>

</div>



<div class="row mb-5 align-items-center">

    <div class="col-md-5 pe-md-5">

        <h6 class="section-title">Strideelle's Target</h6>

        <p class="text-content">

            Koleksi musim ini ditujukan untuk wanita yang dinamis.

            Desain *timeless* seperti Mary Jane dan Ankle Boots menjadi sorotan utama,

            cocok untuk gaya kasual maupun formal.

        </p>

    </div>

   

    <div class="col-md-7 mt-4 mt-md-0 text-end">

        <img src="{{ asset('assets/products/b2.jpeg') }}" class="img-editorial" style="width: 45%; height: 47%; object-fit: cover;" alt="Big Feature">

    </div>

</div>



<div class="row g-3 mb-5">

    <div class="col-md-4">

        <img src="{{ asset('assets/products/b3.jpeg') }}" class="img-editorial aspect-portrait d-block mx-auto" style="width: 45%;" alt="Look 1">

        <div class="text-center mt-2">

            <small class="text-muted text-uppercase fw-bold">Ankle Boots</small>

        </div>

    </div>

    <div class="col-md-4">

        <img src="{{ asset('assets/products/b1.jpeg') }}" class="img-editorial aspect-portrait d-block mx-auto" style="width: 45%;" alt="Look 2">

        <div class="text-center mt-2">

            <small class="text-muted text-uppercase fw-bold">Leather Series</small>

        </div>

    </div>

    <div class="col-md-4">

        <img src="{{ asset('assets/products/b4.jpeg') }}" class="img-editorial aspect-portrait d-block mx-auto" style="width: 45%;" alt="Look 3">

        <div class="text-center mt-2">

            <small class="text-muted text-uppercase fw-bold">White Edition</small>

        </div>

    </div>

</div>


@endsection