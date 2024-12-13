@extends('client.layouts.index')

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
    <div class="container">
        <h1>Selamat Datang di </h1>
            <h1>PearlCare</h1>
        <h2>Terhubung Lebih Cepat, Sehat Lebih Dekat.</h2>
        <a href="#appointment" class="btn-get-started scrollto">Daftar</a>
    </div>
</section><!-- End Hero -->

<main id="main">
    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="content">
                        <h3>Mengapa Memilih PearlCare?</h3>
                        <p>
                            PearlCare memberikan kemudahan dalam menjadwalkan janji temu di rumah sakit, akses informasi dokter terpercaya, dan layanan kesehatan yang terintegrasi. Dengan desain yang intuitif dan fitur lengkap, kami hadir untuk memastikan Anda mendapatkan perawatan terbaik dengan cara yang mudah dan cepat.
                        </p>                        
                    </div>
                </div>
                <div class="col-lg-8 d-flex align-items-stretch">
                    <div class="icon-boxes d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-receipt"></i>
                                    <h4>Penjadwalan Mudah</h4>
                                    <p>Atur janji temu dengan dokter pilihan Anda dalam hitungan menit, tanpa ribet.</p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-cube-alt"></i>
                                    <h4>Akses Mudah 24/7</h4>
                                    <p>Akses aplikasi kapan saja, di mana saja, untuk mengatur janji temu, berkonsultasi dengan dokter, atau mengecek hasil pemeriksaan.</p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-images"></i>
                                    <h4>Privasi & Keamanan Terjaga</h4>
                                    <p>Kami menjaga privasi Anda dan memastikan data Anda selalu terlindungi.</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .content-->
                </div>
            </div>

        </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Counts Section ======= -->
    {{-- <section id="counts" class="counts">
        <div class="container">

            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="fas fa-user-md"></i>
                        <span data-purecounter-start="0" data-purecounter-end="85" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Dokter</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                    <div class="count-box">
                        <i class="far fa-hospital"></i>
                        <span data-purecounter-start="0" data-purecounter-end="18" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Poli</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <i class="fas fa-flask"></i>
                        <span data-purecounter-start="0" data-purecounter-end="12" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Obat</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <i class="fas fa-award"></i>
                        <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Pemeriksaan Selesai</p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Counts Section --> --}}

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container">

            <div class="section-title">
                <h2>Layanan Poli</h2>
                <p>Temukan berbagai pilihan poli spesialis. Pilih poli yang sesuai dengan kebutuhan medis Anda dan jadwalkan janji temu dengan mudah melalui aplikasi PearlCare.</p>
            </div>

            <div class="row">
                {{-- @foreach ($poli as $item)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                        <div class="icon-box">
                            <div class="icon"><i class="fas fa-heartbeat"></i></div>
                            <h4><a href="">Poli {{ $item->nama }}</a></h4>
                            <p>{{ $item->deskripsi }}</p>
                        </div>
                    </div>
                @endforeach --}}
            </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors">
        <div class="container">

            <div class="section-title">
                <h2>Dokter</h2>
                <p>Temukan daftar dokter spesialis berlisensi yang siap membantu Anda. Lihat jadwal praktek yang tersedia dan buat janji temu sesuai dengan kenyamanan Anda melalui aplikasi PearlCare.</p>
            </div>

            <div class="row">
                {{-- @foreach ($dokter as $item)
                    <div class="col-lg-6">
                        <div class="member d-flex align-items-start">
                            <div class="pic">
                                @if ($item->foto == null)
                                    <img class="img-fluid" src="/medilab/assets/img/doctors/doctors-1.jpg"
                                        alt="">
                                @else
                                    <img src="{{ Storage::url($item->foto) }}" class="img-fluid" alt="">
                                @endif
                            </div>
                            <div class="member-info">
                                <h4>{{ $item->nama_dokter }}</h4>
                                <span>Spesialis {{ $item->spesialis }}</span>
                                <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>
                                <div class="social">
                                    <a href="{{ $item->twitter }}"><i class="ri-twitter-fill"></i></a>
                                    <a href="{{ $item->facebook }}"><i class="ri-facebook-fill"></i></a>
                                    <a href="{{ $item->instagram }}"><i class="ri-instagram-fill"></i></a>
                                    <a href="{{ $item->tiktok }}"> <i class="ri-tiktok-fill"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach --}}


            </div>

        </div>
    </section><!-- End Doctors Section -->

    <!-- ======= Registration Section ======= -->
    <section id="appointment" class="appointment section-bg">
        <div class="container">

            <div class="section-title">
                <h2>REGISTRASI PASIEN BARU</h2>
                <p>Silakan melakukan registrasi terlebih dahulu jika belum memiliki akun, untuk dapat menggunakan layanan kami. Dengan mendaftar, Anda dapat menikmati kemudahan dalam mengatur janji temu, memeriksa jadwal dokter, dan mengakses layanan kesehatan lainnya.</p>
            </div>
                <div class="container">
                            <div class="login-box">
                                <!-- /.login-logo -->
                                <div class="">                                    
                                    <div class="card-body">
                                        {{-- message valdation error --}}
                                        @if ($errors->any())
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Whoops!</strong> Terjadi kesalahan input data yang anda masukan.<br><br>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }} </li>
                                                    @endforeach
                                                </ul>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                                    <span aria-hidden="true"> &times; </span>
                                                </button>
                                            </div>
                                        @endif
                                        <form action="" method="post">
                                            @csrf
                                            <div class="input-group mb-3">
                                                <input type="email" class="form-control @error('email') is-invalid  @enderror" name="email"
                                                       value="{{ old('email') }}" placeholder="Email">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-envelope"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control @error('name') is-invalid  @enderror" name="name"
                                                       value="{{ old('name') }}" placeholder="Nama">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-envelope"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control @error('alamat') is-invalid  @enderror"
                                                       name="alamat" value="{{ old('alamat') }}" placeholder="Alamat">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-envelope"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control @error('no_ktp') is-invalid  @enderror"
                                                       name="no_ktp" value="{{ old('no_ktp') }}" placeholder="Nomor KTP">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-envelope"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control @error('no_hp') is-invalid  @enderror"
                                                       name="no_hp" value="{{ old('no_hp') }}" placeholder="Nomor Telepon">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-envelope"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                       value="" name="password" placeholder="Password">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-lock"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- /.col -->
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.login-box -->
                </div>
        </div>
    </section><!-- End Appointment Section -->
</main>