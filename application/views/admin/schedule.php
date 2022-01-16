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
                                <div class="col-md-6">
                                    Semester
                                    <select class="form-control form-control-sm mb-3" id="opt_semester">
                                        <?php foreach ($semester as $s) : ?>
                                            <option value="<?= $s['semester'] ?>"><?= $s['semester']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    Class
                                    <select class="form-control form-control-sm mb-3" id="opt_class">
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    Time Group
                                    <select class="form-control form-control-sm mb-3" id="opt_timeGroup">
                                    </select>
                                </div>
                            </div>

                            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newClassroom">Add Schedule</a>

                            <table class="table table-hover table-responsive" id="opt_schedule">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">SKS</th>
                                        <th scope="col">Day</th>
                                        <th scope="col">Time Start</th>
                                        <th scope="col">Time End</th>
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
                    var scheduleId = null;

                    function showDeleteModal(msg, id) {
                        var modal = $('#deletemodal')
                        modal.find('.modal-body').html('Are you sure to delete this schedule?<br>' + msg)
                        modal.modal('toggle');
                        scheduleId = id;
                    }

                    function deleteShedule() {
                        if (scheduleId != null) {
                            $.ajax({
                                url: "<?= base_url('admin/scheduleAction'); ?>",
                                type: 'post',
                                data: {
                                    action: 2,
                                    scheduleId: scheduleId
                                },
                                success: function() {
                                    getSchedule();
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
                        getOptTime()
                    })

                    $('#opt_timeGroup').change(function() {
                        getSchedule()
                    })


                    getOptClass();
                    getOptTime();

                    function getOptClass() {
                        $.post(
                            "<?= base_url('admin/scheduleAction'); ?>", {
                                action: 3,
                                semester: $('#opt_semester').val()
                            },
                            function(data) {
                                var classroom = jQuery.parseJSON(data);
                                $('#opt_class').html("");
                                classroom.forEach(element => {
                                    $('#opt_class').append("<option value='" + element['id'] + "'>" + element['name'] + ' - ' + element['prodi'] + "</option>");
                                });
                                getOptTime();
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
                                timeGroup.forEach(element => {
                                    $('#opt_timeGroup').append("<option value='" + element['timeGroup'] + "'>" + element['timeGroup'] + "</option>");
                                });

                                getSchedule();
                            }
                        );
                    }

                    function getSchedule() {
                        $.post(
                            "<?= base_url('admin/scheduleAction'); ?>", {
                                action: 1,
                                classId: $('#opt_class').val(),
                                timeGroup: $('#opt_timeGroup').val()
                            },
                            function(data) {
                                var schedule = jQuery.parseJSON(data);

                                $('#opt_schedule > tbody').html("");
                                var index = 1;
                                schedule.forEach(element => {
                                    var row = document.createElement('tr');
                                    var th = document.createElement('th');
                                    th.innerHTML = index;
                                    row.append(th);
                                    var elem = ['id', 'mk', 'semester', 'sks', 'day', 'time_start', 'time_end']
                                    for (var o in elem) {
                                        var td = document.createElement('td');
                                        td.innerHTML = element[elem[o]];
                                        row.append(td);
                                    }
                                    var tdaction = document.createElement('td');
                                    tdaction.innerHTML = `<button class="btn btn-danger btn-sm" onclick="showDeleteModal('Course : ${ element['mk'] }',${element['id']})">Remove</button>`;

                                    row.append(tdaction);
                                    $('#opt_schedule > tbody').append(row);
                                    index++;
                                });


                            }
                        );
                    }
                </script>

                <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">Delete the schedule?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger" onclick="deleteShedule()">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="newClassroom" tabindex="-1" aria-labelledby="newClassroomLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="newClassroomLabel">Add Schedule</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url('admin/schedule') ?>" method="POST">
                                <div class="modal-body">
                                    <input type="number" hidden value="" id="classId" name="classId">
                                    <div class="form-group">
                                        <select class="form-control form-control-sm mb-3" name="course_id">
                                            <option value="0">Choose a course</option>
                                            <?php foreach ($courses as $p) : ?>
                                                <option value="<?= $p['id']; ?>"><?= $p['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" id="day" name="day" placeholder="Day">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" id="time_start" name="time_start" placeholder="Time Start (hh:mm:ss)">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" id="time_end" name="time_end" placeholder="Time End (hh:mm:ss)">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" id="timeGroup" maxlength="1" name="timeGroup" placeholder="Time Group">
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