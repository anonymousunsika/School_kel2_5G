                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    <div class="row">
                        <div class="col-lg">
                            <?= $this->session->flashdata('message'); ?>

                            <h5>Members count : <?= count($members) ?></h5>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm mb-3 col-md-3" id="search" name="search" placeholder="Search">
                            </div>

                            <table class="table table-hover table-responsive" id="user_manager">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">NIM</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Fakultas</th>
                                        <th scope="col">Prodi</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Tahun</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($members as $m) : ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $m['npm']; ?></td>
                                            <td><?= $m['name']; ?></td>
                                            <td><?= $m['email']; ?></td>
                                            <td><?= $m['fakultas']; ?></td>
                                            <td><?= $m['jurusan'] == null ? "&lt;Empty&gt;" : $m['jurusan']; ?></td>
                                            <td><?= $m['kelas'] == null ? "&lt;Empty&gt;" : $m['kelas']; ?></td>
                                            <td><?= $m['year_join']; ?></td>
                                            <td>
                                                <button class="btn btn-danger btn-sm" onclick="showDeleteModal(<?= $m['npm']; ?>)">Remove</button>
                                                <button class="btn btn-success btn-sm" onclick="edit(<?= $m['id']; ?>)">Edit</button>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
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
                    var userid = null;

                    function showDeleteModal(npm) {
                        var modal = $('#deletemodal')
                        modal.find('.modal-body').html('Are you sure to delete this user?<br> NIM:' + npm)
                        modal.modal('toggle');
                        userid = npm;
                    }

                    function deleteUser() {
                        if (userid != null) {
                            $.ajax({
                                url: "<?= base_url('admin/userAction'); ?>",
                                type: 'post',
                                data: {
                                    action: 1,
                                    npm: userid
                                },
                                success: function() {
                                    document.location.href = "<?= base_url('admin/usermanager/'); ?>";
                                }
                            })
                        }
                        var modal = $('#deletemodal')
                        modal.modal('hide');
                    }

                    function edit(id) {
                        document.location.href = "<?= base_url('admin/userAction'); ?>?id=" + id;
                    }

                    $(document).ready(function() {
                        $('#search').on('input', function() {

                            $.ajax({
                                url: "<?= base_url('admin/studentAction'); ?>",
                                type: 'post',
                                data: {
                                    action: 6,
                                    contain: $(this).val()
                                },
                                success: function(data) {
                                    var student = jQuery.parseJSON(data);

                                    $('#user_manager > tbody').html("");
                                    var index = 1;
                                    student.forEach(element => {
                                        var row = document.createElement('tr');
                                        var th = document.createElement('th');
                                        th.innerHTML = index;
                                        row.append(th);
                                        var elem = ['npm', 'name', 'email', 'fakultas', 'jurusan', 'kelas', 'year_join']

                                        for (var o in elem) {
                                            var td = document.createElement('td');
                                            td.innerHTML = element[elem[o]] == null ? "&lt;Empty&gt;" : element[elem[o]];
                                            row.append(td);
                                        }

                                        var tdaction = document.createElement('td');
                                        tdaction.innerHTML = `<button class="btn btn-danger btn-sm" onclick="showDeleteModal(${element['id']})">Remove</button>
                                                <button class="btn btn-success btn-sm" onclick="edit(${element['id']})">Edit</button>`;

                                        row.append(tdaction);
                                        $('#user_manager > tbody').append(row);
                                        index++;
                                    });
                                }
                            })
                        });
                    });
                </script>

                <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">Delete the user?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger" onclick="deleteUser()">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>