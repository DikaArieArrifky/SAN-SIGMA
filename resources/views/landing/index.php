
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Landing Page SAN SIGMA</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= IMG; ?>/logo_sigma.png" rel="icon">
    <link href="<?= IMG; ?>/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= VENDOR; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= VENDOR; ?>/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= VENDOR; ?>/aos/aos.css" rel="stylesheet">
    <link href="<?= VENDOR; ?>/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= VENDOR; ?>/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?= CSS; ?>main.css" rel="stylesheet">


</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="#" class="logo d-flex align-items-center me-auto">
                <h1 class="sitename">Pencatatan Prestasi </h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="">Beranda</a></li>
                    <li><a href="#about">Tentang Kami</a></li>
                    <li><a href="#services">Fitur</a></li>
                    <li><a href="#pricing">TO 10</a></li>
                    <li><a href="#contact">Hubungi Kami</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <form method="get" action="login">
                <button class="btn-getstarted" id="login-go" type="submit">Login</button>
            </form>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h1 class="">Simpan Penghargaan Anda
                            Dengan SAN SIGMA</h1>
                        <p class="">Selamat Atas Penghargaan Anda !! ✋😊 </p>
                        <div class="d-flex">
                            <a href="https://youtu.be/8TO38KzkgaI?si=-MrDUZStIz2cm2EL"
                                class="glightbox btn-watch-video d-flex align-items-center"><i
                                    class="bi bi-play-circle"></i><span>Watch Video</span></a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img">
                        <img src="<?= IMG; ?>/logo_sigma.png" class="img-fluid animated" alt="">
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- Clients 2 Section -->
        <section id="clients-2" class="clients-2 section">

            <div class="container">

                <div class="swiper">
                    <script type="application/json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 800,
                            "autoplay": {
                                "delay": 3000
                            },
                            "slidesPerView": "auto",
                            "pagination": {
                                "el": ".swiper-pagination",
                                "type": "bullets",
                                "clickable": true
                            },
                            "breakpoints": {
                                "320": {
                                    "slidesPerView": 2,
                                    "spaceBetween": 40
                                },
                                "480": {
                                    "slidesPerView": 3,
                                    "spaceBetween": 60
                                },
                                "640": {
                                    "slidesPerView": 4,
                                    "spaceBetween": 80
                                },
                                "992": {
                                    "slidesPerView": 5,
                                    "spaceBetween": 120
                                },
                                "1200": {
                                    "slidesPerView": 6,
                                    "spaceBetween": 120
                                }
                            }
                        }
                    </script>
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><img src="<?= IMG; ?>/clients/pimnas.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="<?= IMG; ?>/clients/kmipn.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="<?= IMG; ?>/clients/codejam.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="<?= IMG; ?>/clients/gemastik.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="<?= IMG; ?>/clients/playit.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="<?= IMG; ?>/clients/pkm.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="<?= IMG; ?>/clients/porseni.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="<?= IMG; ?>/clients/worldskill.png" class="img-fluid"
                                alt=""></div>
                    </div>
                </div>

            </div>

        </section><!-- /Clients 2 Section -->

        <!-- About Section -->
        <section id="about" class="about section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2 class="">Tentang Kami</h2>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="1000">
                        <p>
                            SAN SIGMA atau Sistem Pencatatan Prestasi Digital Mahasiswa ini dirancang untuk mencatat dan mengelola informasi prestasi mahasiswa di Polinema
                            secara terpusat dan terstruktur.
                        </p>
                        <h4> Dibuat Oleh Kelompok</h4>
                        <ul style="list-style: none; padding: 0;">
                            <li style="display: flex; align-items: center; margin-bottom: 5px;">
                                <i class="bi bi-check2-circle" style="margin-right: 10px;"></i>
                                <span style="width: 200px;">CINDY LAILI LARASATI</span>
                                <span>: 2341720038</span>
                            </li>
                            <li style="display: flex; align-items: center; margin-bottom: 5px;">
                                <i class="bi bi-check2-circle" style="margin-right: 10px;"></i>
                                <span style="width: 200px;">DIKA ARIE ARRIFKY</span>
                                <span>: 2341720232</span>
                            </li>
                            <li style="display: flex; align-items: center; margin-bottom: 5px;">
                                <i class="bi bi-check2-circle" style="margin-right: 10px;"></i>
                                <span style="width: 200px;">NOKLENT FARDIAN ERIX</span>
                                <span>: 2341720082</span>
                            </li>
                            <li style="display: flex; align-items: center; margin-bottom: 5px;">
                                <i class="bi bi-check2-circle" style="margin-right: 10px;"></i>
                                <span style="width: 200px;">SATRIO AHMAD R</span>
                                <span>: 2341720163</span>
                            </li>
                            <li style="display: flex; align-items: center; margin-bottom: 5px;">
                                <i class="bi bi-check2-circle" style="margin-right: 10px;"></i>
                                <span style="width: 200px;">YANUAR RIZKI A</span>
                                <span>: 2341720030</span>
                            </li>
                        </ul>

                    </div>

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="1000">
                        <div class="content ps-lg-5">
                            <p>Fitur utamanya mencakup input data prestasi akademik dan non
                                akademik, validasi oleh dosen atau staf terkait, serta laporan prestasi mahasiswa dalam bentuk grafik
                                atau tabel. Sistem ini akan mempermudah akses informasi prestasi secara real-time bagi mahasiswa,
                                dosen, dan pihak administrasi, sehingga mendukung evaluasi dan apresiasi yang lebih transparan dan
                                efisien.</p>
                            <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>

                </div>

            </div>

        </section>
        <!-- /About Section -->
        <!--  Services Section -->
        <section id="services" class="services section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Fitur San Sigma</h2>
                <p>Dengan San Sigma menuju prestasi tingkat dunia </p>
            </div><!-- End Section Title -->
            <div class="container">
                <div class="row gy-4">
                    <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="1000">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-people-fill"></i></div>
                            <h4><a href="#" class="stretched-link">Sentralilasi Data Mahasiswa</a></h4>
                            <p>Sistem ini akan mencatat data mahasiswa yang nantinya akan mengajukan verifikasi prestasinya.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="1000">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-patch-check-fill"></i></div>
                            <h4><a href="#" class="stretched-link">Verifikasi Prestasi Mahasiswa </a></h4>
                            <p>Sistem juga dapat melakukan verifikasi prestasi oleh dosen pembimbing dan admin jurusan.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="1000">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-person-badge-fill"></i></div>
                            <h4><a href="#" class="stretched-link">Sentralilasi Data Mahasiswa</a></h4>
                            <p>Sistem ini akan mencatat data dosen yang nantinya akan melakukan verifikasi prestasi.</p>
                        </div>
                    </div><!-- End Service Item -->


                </div>

            </div>

        </section><!-- /Services Section -->

        <!-- Call To Action Section -->
        <section id="call-to-action" class="call-to-action section">

            <img src="<?= IMG; ?>/cta-bg.jpg" alt="">

            <div class="container">

                <div class="row" data-aos="zoom-in" data-aos-delay="100">
                    <div class="col-xl-9 text-center text-xl-start">
                        <h3>Role User</h3>
                        <p>1. Mahasiswa - Sistem SAN Sigma untuk saat ini hanya dapat dipakai oleh mahasiswa jurusan JTI saja.<br>
                            2. Dosen - Dosen akan menjadi dosen pembimbing dalam lomba yang diikuti oleh mahasiswa.<br>
                            3. Admin - Admin dapat membuat ataupun menghapus akun user.</p>
                    </div>
                </div>

            </div>

        </section><!-- /Call To Action Section -->


        <!-- Pricing Section -->
        <section id="pricing" class="pricing section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>HALL OF FAME</h2>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="1000">
                        <div class="pricing-item">
                            <h3>Data Terbaru</h3>
                            <h4><sup>Mahasiswa.</sup></h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">NO</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Prestasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Ahmad Firdaus</td>
                                        <td>Juara KMIPN 2023</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Sarah Amalia</td>
                                        <td>Best Paper PIMNAS</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Budi Santoso</td>
                                        <td>Medali Emas GEMASTIK</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Putri Rahayu</td>
                                        <td>Juara CodeJam 2023</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Reza Pratama</td>
                                        <td>Winner WorldSkills</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="#" class="buy-btn">Lihat Selengkapnya</a>
                        </div>
                    </div>

                    <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="1000">
                        <div class="pricing-item featured">
                            <h3>TOP 10</h3>
                            <h4><sup>Mahasiswa</sup></h4>
                            <ol class="p-0" style="list-style: none;">
                                <?php foreach ($data['top10mahasiswas'] as $index => $mahasiswa): ?>
                                    <li class="d-flex align-items-center mb-3">
                                        <span class="badge bg-gradient-primary px-3 py-2 rounded-pill me-3" style="background: linear-gradient(45deg, <?= $index == 0 ? '#FFD700, #FFA500' : ($index == 1 ? '#C0C0C0, #D3D3D3' : ($index == 2 ? '#CD7F32, #B8860B' : '#4e54c8, #8f94fb')); ?>); width: 50px; text-align: center;"><?= ($index + 1) . 'th'; ?></span>
                                        <span><?= $mahasiswa['name'] . ' - ' . $mahasiswa['score'] . ' Points'; ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                            <a href="#" class="buy-btn">Lihat Selengkapnya</a>
                        </div>
                    </div>
                    <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="1000">
                        <div class="pricing-item featured">
                            <h3>TOP 10</h3>
                            <h4><sup>Dosen</sup></h4>
                            <ol class="p-0" style="list-style: none;">
                                <?php foreach ($data['top10dosen'] as $index => $dosen): ?>
                                    <li class="d-flex align-items-center mb-3">
                                        <span class="badge bg-gradient-primary px-3 py-2 rounded-pill me-3" style="background: linear-gradient(45deg, <?= $index == 0 ? '#FFD700, #FFA500' : ($index == 1 ? '#C0C0C0, #D3D3D3' : ($index == 2 ? '#CD7F32, #B8860B' : '#4e54c8, #8f94fb')); ?>); width: 50px; text-align: center;"><?= ($index + 1) . 'th'; ?></span>
                                        <span><?= $dosen['name'] . ' - ' . $dosen['score'] . ' Points'; ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                            <a href="#" class="buy-btn">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Pricing Section -->
        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Hubungi Kami</h2>
                <p>Berikan saran dan kritik agar membantu dalam perkembangan website kami.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="1000">

                <div class="row gy-4">

                    <div class="col-lg-6">

                        <div class="info-wrap">
                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="1000">
                                <i class="bi bi-geo-alt flex-shrink-0"></i>
                                <div>
                                    <h3>Alamat</h3>
                                    <p>Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141
                                    </p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="1000">
                                <i class="bi bi-telephone flex-shrink-0"></i>
                                <div>
                                    <h3>Nomor Telepon</h3>
                                    <p>+62 878-6192-6248</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="1000">
                                <i class="bi bi-envelope flex-shrink-0"></i>
                                <div>
                                    <h3>Email</h3>
                                    <p>Coba@example.com</p>
                                </div>
                            </div><!-- End Info Item -->

                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15806.497797965125!2d112.61442606697996!3d-7.934233362695417!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78827687d272e7%3A0x789ce9a636cd3aa2!2sPoliteknik%20Negeri%20Malang!5e0!3m2!1sid!2sid!4v1732764514137!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" data-aos="fade-up"></iframe>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="php-email-form" data-aos="fade-up"
                            data-aos-delay="1000">
                            <div class="row gy-4" style="margin-bottom: 10px;">
                                <img src="<?= IMG; ?>\skills.png" alt="">
                            </div>

                            <div class="row gy-4">
                                <img src="<?= IMG; ?>\skills.png" alt="">
                            </div>
                        </div>
                    </div><!-- End Contact Form -->

                </div>

            </div>

        </section><!-- /Contact Section -->


    </main>

    <footer id="footer" class="footer">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-4 footer-about ">
                    <a href="index.html">
                        <p class="sitename">san sigma</p>
                    </a>
                    <div class="footer-contact mt-3">
                        <p>Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru,</p>
                        <p>Kota Malang, Jawa Timur 65141</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-8 footer-links">
                    <h4 class="h4edit">Hubungi San Sigma</h4>
                    <p class="mt-3"><strong>No Telp:</strong> <span>+62 878-6192-6248</span></p>
                    <p><strong>Email:</strong> <span>coba@example.com</span></p>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4 class="h4edit">Lihat Kita</h4>
                    <p>Simpan Penghargaan Anda
                        Dengan SAN SIGMA</p>
                    <div class="social-links d-flex">
                        <a href=""><i class="bi bi-twitter"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong>San Sigma</strong> <span>All Rights
                    Reserved</span>
            </p>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?= VENDOR; ?>/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= VENDOR; ?>/aos/aos.js"></script>
    <script src="<?= VENDOR; ?>/glightbox/js/glightbox.min.js"></script>
    <script src="<?= VENDOR; ?>/swiper/swiper-bundle.min.js"></script>
    <script src="<?= VENDOR; ?>/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="<?= VENDOR; ?>/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- Main JS File -->
    <script src="<?= JS; ?>/main.js"></script>

</body>

</html>