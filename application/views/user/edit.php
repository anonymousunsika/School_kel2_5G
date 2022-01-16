                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    <div class="row">
                        <div class="col-lg-8">
                            <?= $this->session->flashdata('message'); ?>
                            <?= form_open_multipart('user/edit'); ?>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" readonly name="email" value="<?= $user['email']; ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="npm">NIM</label>

                                <input type="text" class="form-control" readonly id="npm" name="npm" value="<?= $user['npm']; ?>">

                            </div>
                            <div class="form-group">
                                <label for="name">Full name</label>

                                <input type="text" readonly class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="fakultas">Fakultas</label>

                                <input type="text" readonly class="form-control" id="fakultas" name="fakultas" value="<?= $user['fakultas']; ?>">
                                <?= form_error('fakultas', '<small class="text-danger pl-3">', '</small>'); ?>

                            </div>
                            <div class="form-group">
                                <label for="prodi">Prodi</label>
                                <input type="text" readonly class="form-control" id="prodi" name="prodi" value="<?= $user['jurusan']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <input type="text" readonly class="form-control" id="kelas" name="kelas" value="<?= $user['kelas']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="year">Join Year</label>
                                <input type="number" readonly class="form-control" id="year" name="year" value="<?= $user['year_join']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" class="form-control" id="current_password" name="current_password">
                                <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password1">
                                <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="new_password">Repeat Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password2">
                                <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-sm-2">Picture</div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img src="<?= base_url('assets/img/profile/') . $user['avatar']; ?>" class="img-thumbnail">
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="custom-file">
                                                <input class="custom-file-input" type="file" id="avatar" name="avatar">
                                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                                <label for="avatar" class="custom-file-label">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                            </form>
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->