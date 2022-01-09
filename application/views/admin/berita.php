<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $title; ?></h1>
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= flashdata('message'); ?>

            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Daftar Berita</li>
            </ol>

            <a class="btn btn-primary mb-3" href="<?= base_url('/admin/editor?action=1'); ?>">Tambah Berita</a>
            <table id="listberita">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Text</th>
                        <th>Penulis</th>
                        <th>Tanggal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Text</th>
                        <th>Penulis</th>
                        <th>Tanggal</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($berita as $news) :
                    ?>
                        <tr>
                            <th>#</th>
                            <td><?= $i++; ?></td>
                            <td><?= html_escape($news['judul']); ?></td>
                            <td><?= strlen(html_escape($news['isi'])) > 200 ? substr(html_escape($news['isi']), 0, 200) . '...' : html_escape($news['isi']); ?></td>
                            <td><?= html_escape($news['penulis']); ?></td>
                            <td><?= date('d F Y', $news['tanggal']); ?></td>
                            <td>
                                <a class="btn btn-sm btn-secondary mx-1" href="<?= base_url('/admin/editor?action=2&id=') . $news['id']; ?>">Sunting</a>
                                <button class="btn btn-sm btn-danger mx-1" data-remove data-id="<?= $news['id']; ?>">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <script>
            $(document).ready(() => {
                const listberita = document.getElementById('listberita');
                if (listberita) {
                    dataTable = new simpleDatatables.DataTable(listberita);
                }

                $('button[data-remove]').on('click', function() {
                    const id = $(this).data('id');

                    $('#beritaid').html(id);
                    $('#yes').attr('onclick', 'remove(' + id + ')');

                    $('#deleteBerita').modal('toggle');
                });
            });

            function remove(id) {
                if (id != null) {
                    window.location = "<?= base_url('/admin/editor?action=3&id='); ?>" + id;
                }
            }
        </script>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="deleteBerita" tabindex="-1" aria-labelledby="deleteBeritaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteBeritaLabel">Hapus berita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus berita ini?<br>
                    ID : <span id="beritaid"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <button type="button" id="yes" class="btn btn-primary" onclick="remove(null)">Ya</button>
                </div>
            </div>
        </div>
    </div>