<main id="main">

    <style>
        article img {
            max-width: 100%;
        }
    </style>

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="<?= base_url(); ?>">Home</a></li>
                <li><a href="<?= base_url('berita'); ?>">Berita</a></li>
                <li><?= strlen($berita['judul']) > 50 ? substr($berita['judul'], 0, 50) . "..." : $berita['judul']; ?></li>
            </ol>
            <h2><?= $berita['judul']; ?></h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="berita" class="blog">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 entries">

                    <article class="entry entry-single">

                        <?= $berita['isi']; ?>
                    </article><!-- End blog entry -->

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
    </section><!-- End Blog Single Section -->

</main><!-- End #main -->