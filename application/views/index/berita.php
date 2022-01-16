<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="<?= base_url(); ?>">Home</a></li>
                <li>Berita</li>
            </ol>
            <h2>Berita</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="berita" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 entries">
                    <?php foreach ($berita as $news) : ?>
                        <article class="entry">


                            <h2 class="entry-title">
                                <a href="<?= base_url('berita/') . $news['id']; ?>"><?= $news['judul']; ?></a>
                            </h2>

                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="<?= base_url('berita/') . $news['id']; ?>"><?= $news['penulis']; ?></a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="<?= base_url('berita/') . $news['id']; ?>"><time datetime="2020-01-01"><?= date('d F Y', $news['tanggal']); ?></time></a></li>
                                </ul>
                            </div>

                            <div class="entry-content">
                                <div class="read-more">
                                    <a href="<?= base_url('berita/') . $news['id']; ?>">Baca Selengkapnya</a>
                                </div>
                            </div>

                        </article><!-- End blog entry -->
                    <?php endforeach; ?>


                    <div class="blog-pagination">
                        <ul class="justify-content-center">
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                        </ul>
                    </div>

                </div><!-- End blog entries list -->

                <div class="col-lg-4">

                    <div class="sidebar">

                        <h3 class="sidebar-title">Search</h3>
                        <div class="sidebar-item search-form">
                            <form action="">
                                <input type="text">
                                <button type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End sidebar search formn-->


                    </div><!-- End sidebar -->

                </div><!-- End blog sidebar -->

            </div>

        </div>
    </section><!-- End Blog Section -->

</main><!-- End #main -->