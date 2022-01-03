                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    <div class="row">
                        <div class="col-lg">
                            <?= $this->session->flashdata('message'); ?>

                            <div class="row">
                                <div class="col-md-6">
                                    Semester
                                    <input type="text" readonly class="form-control form-control-sm mb-3" id="opt_semester" value="<?= $classroom['semester'] ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    Class
                                    <input type="text" readonly class="form-control form-control-sm mb-3" id="t_class" value="<?= $classroom['kelas'] . " - " . $classroom['prodi']; ?>">
                                    <input type="text" hidden id="opt_class" value="<?= $classroom['id']; ?>">
                                </div>
                                <div class=" col-md-2">
                                    Time Group
                                    <?php
                                    if ($classroom['accepted'] == 1) {
                                        echo '<input readonly class="form-control form-control-sm mb-3" id="opt_timeGroup" value="' . $classroom['time_group'] . '">';
                                    } else {
                                        echo '<select class="form-control form-control-sm mb-3" id="opt_timeGroup">
                                        </select>';
                                    }
                                    ?>
                                </div>
                            </div>


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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>
                            <?php
                            if ($classroom['accepted'] == 1) {
                                echo '<a class="btn btn-primary mb-3" href="' . base_url('student') . '">Back</a>';
                            } else {
                                echo '<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal_dialog">Choose</a>';
                            }
                            ?>
                        </div>
                    </div>
                    <script>
                        var scheduleId = null;

                        $('#opt_timeGroup').change(function() {
                            getSchedule()
                        })

                        getOptTime();

                        <?php
                        if ($classroom['accepted'] == 1) {
                        ?>

                            function getOptTime() {
                                getSchedule();
                            }
                        <?php } else { ?>

                            function getOptTime() {
                                $('#classId').val($('#opt_class').val());
                                $.post(
                                    "<?= base_url('student/studentAction'); ?>", {
                                        action: 4,
                                        class_id: $('#opt_class').val()
                                    },
                                    function(data) {
                                        var timeGroup = jQuery.parseJSON(data);

                                        $('#opt_timeGroup').html("");
                                        timeGroup.forEach(element => {
                                            $('#opt_timeGroup').append(`<option ${element['timeGroup'] == <?= $classroom['time_group'] == null ? 'undefined' : "'" . $classroom['time_group'] . "'"; ?>?'selected':''} value='${element['timeGroup'] }'> ${element['timeGroup']}</option>`);
                                        });

                                        getSchedule();
                                    }
                                );
                            }
                        <?php } ?>

                        function getSchedule() {
                            $("#time_group").text($('#opt_timeGroup').val())
                            $.post(
                                "<?= base_url('student/studentAction'); ?>", {
                                    action: 1,
                                    class_id: $('#opt_class').val(),
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
                                        $('#opt_schedule > tbody').append(row);
                                        index++;
                                    });


                                }
                            );
                        }

                        function saveChanges() {
                            $.post(
                                "<?= base_url('student/studentAction'); ?>", {
                                    action: 2,
                                    time_group: $('#opt_timeGroup').val(),
                                    class_id: <?= $class_id; ?>

                                },
                                function() {
                                    document.location.href = "<?= base_url('student'); ?>";
                                }
                            );

                        }
                    </script>
                </div>
                <!-- container-fluid -->

                <div class="modal fade" id="modal_dialog" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">Save Changes</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Choose this Time Group?<br>
                                Time Group : <span id="time_group"></span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="button" class="btn btn-primary" onclick="saveChanges()">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
                <!-- End of Main Content -->