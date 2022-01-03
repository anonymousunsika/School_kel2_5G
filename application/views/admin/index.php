                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    Messages
                    <table class="table table-hover table-responsive" id="opt_message">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Message</th>
                                <th scope="col">Time</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <script>
                    getMessage()

                    function getMessage() {
                        $.post(
                            "<?= base_url('admin/adminAction'); ?>", {
                                action: 1,
                            },
                            function(data) {
                                var message = jQuery.parseJSON(data);

                                $('#opt_message > tbody').html("");
                                var index = 1;
                                message.forEach(element => {
                                    var row = document.createElement('tr');
                                    var th = document.createElement('th');
                                    th.innerHTML = index;
                                    row.append(th);
                                    var message = document.createElement('td');
                                    message.innerHTML = element['message'];
                                    row.append(message);
                                    var time = document.createElement('td');
                                    time.innerHTML = element['date_created'];
                                    row.append(time);
                                    var tdaction = document.createElement('td');
                                    tdaction.innerHTML = `<a href="#${element['id']}" class="badge bg-danger text-light" data-id="${element['id']}">Remove</a>`;

                                    row.append(tdaction);
                                    $('#opt_message > tbody').append(row);
                                    index++;
                                });

                                $('a[data-id]').on('click', function() {
                                    const message_id = $(this).data('id');

                                    $.ajax({
                                        url: "<?= base_url('admin/adminAction'); ?>",
                                        type: 'post',
                                        data: {
                                            action: 2,
                                            message_id: message_id
                                        },
                                        success: function() {
                                            getMessage();
                                        }
                                    })
                                });
                            }
                        );
                    }
                </script>