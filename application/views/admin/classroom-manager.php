                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    <div class="row">
                        <div class="col-lg">
                            <?php if (validation_errors()) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= validation_errors(); ?>
                                </div>
                            <?php endif; ?>

                            <?= $this->session->flashdata('message'); ?>

                            Semester
                            <select class="form-control form-control-sm mb-3" id="opt_semester">
                                <option value="0">All</option>
                                <?php foreach ($semester as $s) : ?>
                                    <option <?= $opt != null && $opt == $s['semester'] ? 'selected' : ''; ?> value="<?= $s['semester'] ?>"><?= $s['semester']; ?></option>
                                <?php endforeach; ?>
                            </select>

                            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newClassroom">Add New Classroom</a>

                            <table class="table table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Class Name</th>
                                        <th scope="col">Prodi</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">Is Open</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($classroom as $c) : ?>
                                        <?php if ($opt == null) : ?>
                                            <tr>
                                                <th scope="row"><?= $c['id']; ?></th>
                                                <td><?= $c['name']; ?></td>
                                                <td><?= $c['prodi']; ?></td>
                                                <td><?= $c['semester']; ?></td>
                                                <td>
                                                    <div class="form-group form-check">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" <?= check_open($c['id']) ?> data-id="<?= $c['id'] ?>">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm" onclick="showDeleteModal(<?= $c['id']; ?>)">Remove</button>
                                                    <button class="btn btn-success btn-sm" onclick="edit(<?= $c['id']; ?>)">Edit</button>
                                                </td>
                                            </tr>
                                        <?php else : ?>
                                            <?php if ($c['semester'] == $opt) : ?>
                                                <tr>
                                                    <th scope="row"><?= $c['id']; ?></th>
                                                    <td><?= $c['name']; ?></td>
                                                    <td><?= $c['prodi']; ?></td>
                                                    <td><?= $c['semester']; ?></td>
                                                    <td>
                                                        <div class="form-group form-check">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" <?= check_open($c['id']) ?> data-id="<?= $c['id'] ?>">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm" onclick="showDeleteModal(<?= $c['id']; ?>)">Remove</button>
                                                        <button class="btn btn-success btn-sm" onclick="edit(<?= $c['id']; ?>)">Edit</button>
                                                    </td>
                                                </tr>

                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <script>
                    var classId = null;

                    function showDeleteModal(id) {
                        var modal = $('#deletemodal')
                        modal.find('.modal-body').html('Are you sure to delete this class?<br> class id:' + id)
                        modal.modal('toggle');
                        classId = id;
                    }

                    function deleteClass() {
                        if (classId != null) {
                            $.ajax({
                                url: "<?= base_url('admin/classroomAction'); ?>",
                                type: 'post',
                                data: {
                                    action: 2,
                                    classId: classId
                                },
                                success: function() {
                                    document.location.href = "<?= base_url('admin/classroom') . ($opt != null ? '?s=' . $opt : '');  ?>";
                                }
                            })
                        }
                        var modal = $('#deletemodal')
                        modal.modal('hide');
                    }

                    function edit(id) {
                        document.location.href = "<?= base_url('admin/classroomAction'); ?>?id=" + id;
                    }

                    $("input[data-id]").on('click', function() {
                        const classId = $(this).data('id');
                        const is_open = $(this).is(':checked');

                        $.ajax({
                            url: "<?= base_url('admin/classroomAction'); ?>",
                            type: 'post',
                            data: {
                                action: 1,
                                classId: classId,
                                is_open: is_open
                            },
                        })
                    });

                    $('#opt_semester').change(function() {
                        if ($(this).val() == 0) {
                            document.location.href = "<?= base_url('admin/classroom'); ?>";
                        } else {
                            document.location.href = "<?= base_url('admin/classroom?s='); ?>" + $(this).val();
                        }
                    })
                </script>

                <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">Delete the classroom?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger" onclick="deleteClass()">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="newClassroom" tabindex="-1" aria-labelledby="newClassroomLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="newClassroomLabel">Add Classroom</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url('admin/classroom') ?>" method="POST">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Class name">
                                    </div>
                                    <div class="form-group">
                                        <select name="prodi_id" id="prodi_id" class="form-control">
                                            <option value="">Select Prodi</option>
                                            <?php foreach ($prodi as $p) : ?>
                                                <option value="<?= $p['id']; ?>"><?= $p['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="semester" name="semester" placeholder="Semester">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>