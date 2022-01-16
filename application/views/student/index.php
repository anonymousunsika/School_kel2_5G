                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    <?= $this->session->flashdata('message'); ?>
                    <?php
                    if (count($classroom) == 0) {
                        echo '<h4 class="mb-4 text-gray-800">No Schedule Found</h4>';
                    }
                    ?>
                    <div class="row">

                        <?php foreach ($classroom as $class) : ?>
                            <div class="card mb-3 ml-3 <?= $class['time_group'] == null ? 'border-warning' : 'border-success' ?>" style="max-width: 18rem;">
                                <div class="card-header bg-transparent <?= $class['time_group'] == null ? 'border-warning' : 'border-success' ?>">Kelas <?= $class['name']; ?></div>
                                <div class="card-body <?= $class['time_group'] == null ? 'border-warning' : 'border-success' ?>">
                                    <p class="text-muted">Semester : <?= $class['semester']; ?></p>
                                    <p class="text-muted">Time Group : <?= $class['time_group'] == null ? '&lt;Not Set&gt;' : $class['time_group']; ?></p>
                                    <h4><a href="<?= base_url('student/classroom?i=') . $class['id']; ?>" class="badge badge-secondary"><?= $class['accepted'] == 1 ? 'View' : 'Change'; ?></a></h4>
                                    <?php
                                    if ($class['time_group'] == null && $class['accepted'] == 0) {
                                        echo '<div class="alert alert-warning" role="alert">Please change the Time Group!</div>';
                                    }
                                    ?>
                                </div>
                                <div class="card-footer bg-transparent <?= $class['time_group'] == null ? 'border-warning' : 'border-success' ?>">Date Accepted : <?= $class['date_accepted'] == null ? 'None' : $class['date_accepted']; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- container-fluid -->

                </div>
                <!-- End of Main Content -->