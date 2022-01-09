<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Berita</h1>
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= flashdata('message'); ?>

            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><?= $title; ?></li>
            </ol>
            <form method="POST">
                <div class="row">
                    <div class="mb-3 form-group col-lg-8">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" value="<?php if ($action == 2) echo $berita['penulis'];
                                                                                                    else echo $user['name'] ?>">
                    </div>
                    <div class="mb-3 form-group col-lg-8">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="<?php if ($action == 2) echo $berita['judul']; ?>">
                    </div>
                    <div class="mb-3 form-group col-lg-8">
                        <textarea name="content" id="editor">
                            <?php if ($action == 2) echo $berita['isi']; ?>
                        </textarea>
                    </div>
                    <div class="mb-3 form-group col-lg-8">
                        <a class="btn btn-secondary" href="<?= base_url('/admin/berita') ?>">Cancel</a>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
        <script>
            $(window).ready(() => {
                ClassicEditor
                    .create(document.querySelector('#editor'))
                    .catch(error => {
                        console.error(error);
                    });
            });
        </script>
    </main>