<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

    <div class="container" data-aos="zoom-out" data-aos-delay="100">
        <div class="row">
            <div class="col-xl-3">
                <img class="logo-sq" src="<?= base_url(); ?>/assets/img/unsika.png" alt="Unsika">
            </div>
            <div class="col-xl-6">
                <h1>Tentang Unsika</h1>
                <h2>Tentang UNSIKA
                    Perguruan Tinggi yang dibina oleh Yayasan Pembina Perguruan Tinggi Pangkal Pangkal Perjuangan pada awalnya adalah Perguruan Tinggi Pangkal Perjuangan (PTPP) Karawang terdiri dari Fakultas Hukum, dan Fakultas Ekonomi yang berdiri pada tanggal 5 September 1965.</h2>
            </div>
        </div>
    </div>

</section><!-- End Hero -->

<main id="main">



    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>UNSIKA DALAM ANGKA</h2>
            </div>
            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <span data-purecounter-start="0" data-purecounter-end="9" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Fakultas</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                    <div class="count-box">
                        <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Program Studi</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <span data-purecounter-start="0" data-purecounter-end="16826" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Mahasiswa</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <span data-purecounter-start="0" data-purecounter-end="495" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Dosen</p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Counts Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="berita" class="testimonials">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Berita</h2>
                <p>Berita terbaru mengenai Unsika</p>
            </div>

            <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">
                    <?php foreach ($berita as $news) : ?>

                        <a class="swiper-slide" href="<?= base_url('berita/') . $news['id'] ?>">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <h3><?= $news['judul']; ?></h3>
                                    <h4><?= date('d F Y', $news['tanggal']); ?></h4>
                                </div>
                            </div>
                        </a><!-- End testimonial item -->

                    <?php endforeach; ?>

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section><!-- End Testimonials Section -->


    <!-- ======= Services Section ======= -->
    <section id="visimisi" class="services section-bg ">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Visi</h2>
            </div>

            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                <p>Inovatif, kompetitif, dan unggul yang dijiwai budaya bangsa</p>
            </div>

            <div class="section-title">
                <h2>Misi</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                        <p>Menyiapkan sumber daya manusia yang profesional dan berakhlak mulia</p>
                    </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                        <p>Menciptakan, menerapkan, dan mengembangkan ilmu pengetahuan, teknologi, dan seni yang berdaya guna dan berhasil guna</p>
                    </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                        <p>Melaksanakan pengabdian pada masyarakat secara aktif untuk meningkatkan kesejahteraan masyarakat</p>
                    </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
                        <p>Menciptakan sistem pengelolaan tridharma perguruan tinggi yang akuntabel, transparan, efisien, efektif, dan responsibel</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Services Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Frequently Asked Questions</h2>
            </div>

            <ul class="faq-list accordion" data-aos="fade-up">

                <li>
                    <a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq1">Bagaimana cara pembayaran UKT<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
                    <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            Cara pembayaran UKT sudah dijelaskan pada halaman akademik unsika
                        </p>
                    </div>
                </li>

                <li>
                    <a data-bs-toggle="collapse" data-bs-target="#faq2" class="collapsed">Apakah Unsika menerima beasiswa<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
                    <div id="faq2" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            Ya, kami menerima mahasiswa dengan beasiswa.
                        </p>
                    </div>
                </li>

                <li>
                    <a data-bs-toggle="collapse" data-bs-target="#faq3" class="collapsed">Bagaimana cara untuk penangguhan UKT<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
                    <div id="faq3" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            Untuk Penangguhan UKT, silakan isi formulir penangguhan yang diberikan oleh Dosen kemahasiswaan.
                        </p>
                    </div>
                </li>
            </ul>

        </div>
    </section><!-- End Frequently Asked Questions Section -->


    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Kontak</h2>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">

                <div class="col-lg-6">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="info-box">
                                <i class="bx bx-map"></i>
                                <h3>Alamat Kami</h3>
                                Jl. HS. Ronggo Waluyo, <br>
                                Telukjambe Timur, Karawang, Jawa Barat, Indonesia - 41361 <br>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="info-box mt-4">
                                <i class="bx bx-envelope"></i>
                                <h3>Email Kami</h3>
                                <p>info@unsika.ac.ids</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="col form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->