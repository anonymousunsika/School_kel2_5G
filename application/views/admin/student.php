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

                            <div class="row">
                                <div class="col-md-5">
                                    Semester
                                    <select class="form-control form-control-sm mb-3" id="opt_semester">
                                        <?php foreach ($semester as $s) : ?>
                                            <option value="<?= $s['semester'] ?>"><?= $s['semester']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    Class
                                    <select class="form-control form-control-sm mb-3" id="opt_class">
                                    </select>
                                </div>
                            </div>

                            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#insertStudent">Insert Student</a>

                            <table class="table table-hover table-responsive" id="opt_student">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">NIM</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Time Group</th>
                                        <th scope="col">Accepted</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <script>
                    var fieldId = null;

                    function showDeleteModal(msg, npm) {
                        var modal = $('#deletemodal')
                        modal.find('.modal-body').html('Remove this student?<br>' + msg)
                        modal.modal('toggle');
                        fieldId = npm;
                    }

                    function removeStudent() {
                        if (fieldId != null) {
                            $.ajax({
                                url: "<?= base_url('admin/studentAction'); ?>",
                                type: 'post',
                                data: {
                                    action: 2,
                                    id: fieldId
                                },
                                success: function() {
                                    getStudent();
                                }
                            })
                        }
                        var modal = $('#deletemodal')
                        modal.modal('hide');
                    }

                    $('#opt_semester').change(function() {
                        getOptClass()
                    })

                    $('#opt_class').change(function() {
                        getStudent()
                        getOptTime()
                    })

                    getOptClass();
                    getStudent();

                    function getOptClass() {
                        $.post(
                            "<?= base_url('admin/studentAction'); ?>", {
                                action: 3,
                                semester: $('#opt_semester').val()
                            },
                            function(data) {
                                var classroom = jQuery.parseJSON(data);
                                $('#opt_class').html("");
                                classroom.forEach(element => {
                                    $('#opt_class').append("<option value='" + element['id'] + "'>" + element['name'] + ' - ' + element['prodi'] + "</option>");
                                });
                                getStudent();
                            }
                        );
                    }

                    function getOptTime() {
                        $('#classId').val($('#opt_class').val());
                        $.post(
                            "<?= base_url('admin/scheduleAction'); ?>", {
                                action: 4,
                                classId: $('#opt_class').val()
                            },
                            function(data) {
                                var timeGroup = jQuery.parseJSON(data);

                                $('#opt_timeGroup').html("");
                                $('#opt_timeGroup').append("<option value='0'>None</option>");
                                timeGroup.forEach(element => {
                                    $('#opt_timeGroup').append("<option value='" + element['timeGroup'] + "'>" + element['timeGroup'] + "</option>");
                                });
                            }
                        );
                    }

                    function getStudent() {
                        $.post(
                            "<?= base_url('admin/studentAction'); ?>", {
                                action: 1,
                                classId: $('#opt_class').val(),
                            },
                            function(data) {
                                var student = jQuery.parseJSON(data);

                                $('#opt_student > tbody').html("");
                                var index = 1;
                                student.forEach(element => {
                                    var row = document.createElement('tr');
                                    var th = document.createElement('th');
                                    th.innerHTML = index;
                                    row.append(th);
                                    var elem = ['npm', 'name', 'semester', 'kelas', 'time_group']
                                    for (var o in elem) {
                                        var td = document.createElement('td');
                                        td.innerHTML = element[elem[o]] == null ? "&lt;Not set&gt;" : element[elem[o]];
                                        row.append(td);
                                    }
                                    var tdaccepted = document.createElement('td');
                                    tdaccepted.innerHTML = `<div class="form-group form-check">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" ${element['accepted'] == 1?'checked':''} data-id="${element['id']}">
                                                            </div>
                                                        </div>`;

                                    var tdaction = document.createElement('td');
                                    tdaction.innerHTML = `<button class="btn btn-danger btn-sm" onclick="showDeleteModal('NIM : ${ element['npm'] }',${element['id']})">Remove</button>`;

                                    row.append(tdaccepted);
                                    row.append(tdaction);
                                    $('#opt_student > tbody').append(row);
                                    index++;
                                });

                                $('input[data-id]').on('click', function() {
                                    const userId = $(this).data('id');
                                    const accepted = $(this).is(':checked');

                                    $.ajax({
                                        url: "<?= base_url('admin/studentAction'); ?>",
                                        type: 'post',
                                        data: {
                                            action: 5,
                                            userId: userId,
                                            accepted: accepted
                                        },
                                    })
                                });
                            }
                        );
                    }

                    $(document).ready(function() {
                        getOptTime()
                        $('#search').on('input', function() {
                            const userId = $(this).data('id');

                            clearError();

                            $.ajax({
                                url: "<?= base_url('admin/studentAction'); ?>",
                                type: 'post',
                                data: {
                                    action: 6,
                                    contain: $(this).val()
                                },
                                success: function(data) {
                                    var student = jQuery.parseJSON(data);

                                    $('#student_search > tbody').html("");
                                    var index = 1;
                                    student.forEach(element => {
                                        var row = document.createElement('tr');
                                        var th = document.createElement('th');
                                        th.innerHTML = index;
                                        row.append(th);
                                        var elem = ['npm', 'name', 'fakultas', 'jurusan', 'kelas', 'year_join']
                                        for (var o in elem) {
                                            var td = document.createElement('td');
                                            td.innerHTML = element[elem[o]] == null ? "&lt;Not set&gt;" : element[elem[o]];
                                            row.append(td);
                                        }

                                        var tdaction = document.createElement('td');
                                        tdaction.innerHTML = `<button class="btn btn-warning btn-sm" data-userid="${element['id']}">Add</button>`;

                                        row.append(tdaction);
                                        $('#student_search > tbody').append(row);
                                        index++;
                                    });

                                    $('button[data-userid]').on('click', function() {
                                        const userId = $(this).data('userid');
                                        const timeGroup = $('#opt_timeGroup').val();

                                        if (timeGroup == undefined) {
                                            errorForm('Please choose Time Groups first!');
                                        } else {
                                            clearError();
                                            $.ajax({
                                                url: "<?= base_url('admin/studentAction'); ?>",
                                                type: 'post',
                                                data: {
                                                    action: 4,
                                                    userId: userId,
                                                    classId: $('#opt_class').val(),
                                                    time_group: timeGroup
                                                },
                                                success: function(data) {
                                                    var message = jQuery.parseJSON(data);
                                                    if (message['id'] == 1) {
                                                        $('#successForm').removeAttr('hidden');
                                                        $('#errorForm').prop('hidden', true);
                                                    } else {
                                                        errorForm(message['message']);
                                                    }
                                                    getStudent();
                                                }
                                            })
                                        }
                                    });
                                }
                            })
                        });
                    });

                    function errorForm(str) {
                        $('#successForm').prop('hidden', true);
                        $('#errorForm').removeAttr('hidden');
                        $('#errorForm').html(str);
                    }

                    function clearError() {
                        $('#successForm').prop('hidden', true);
                        $('#errorForm').prop('hidden', true);
                    }
                </script>

                <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">Remove this student?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger" onclick="removeStudent()">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="insertStudent" tabindex="-1" aria-labelledby="insertStudentLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="insertStudentLabel">Insert Student</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="alert alert-danger" hidden role="alert" id="errorForm">

                                </div>
                                <div class="alert alert-success" hidden role="alert" id="successForm">
                                    Data added!
                                </div>
                                <input type="number" hidden value="" id="classId" name="classId">

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm mb-3 col-md-3" id="search" name="search" placeholder="Search">
                                </div>
                                <table class="table table-hover table-responsive" id="student_search">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">NIM</th>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Fakultas</th>
                                            <th scope="col">Prodi</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Tahun</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        Time Group
                                        <select class="form-control form-control-sm mb-3" id="opt_timeGroup">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class=" modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>