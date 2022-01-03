                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    <div class="row">
                        <div class="col-lg-8">
                            <?= form_open_multipart('admin/useraction?id=' . $useredit['id']); ?>
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" readonly name="email" value="<?= $useredit['email']; ?>">
                                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="npm" class="col-sm-2 col-form-label">NIM</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="npm" name="npm" value="<?= $useredit['npm']; ?>">
                                    <?= form_error('npm', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="name" class="col-sm-2 col-form-label">Full name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" value="<?= $useredit['name']; ?>">
                                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="fakultas" class="col-sm-2 col-form-label">Fakultas</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="fakultas" name="fakultas" value="<?= $useredit['fakultas']; ?>">
                                    <?= form_error('fakultas', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="prodi" class="col-sm-2 col-form-label">Prodi</label>
                                <div class="col-sm-10">
                                    <select name="prodi" class="form-control form-control-sm">
                                        <option value="0" <?= $useredit['prodi_id'] == "" ? "selected" : ""; ?>>Not set</option>
                                        <?php
                                        $i = 1;
                                        foreach ($prodi as $p) : ?>
                                            <option value="<?= $i; ?>" <?php if ($useredit['prodi_id'] == $i) echo "selected"; ?>><?= $p['name']; ?></option>
                                        <?php
                                            $i++;
                                        endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="year" class="col-sm-2 col-form-label">Join Year</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="year" name="year" value="<?= $useredit['year_join']; ?>">
                                    <?= form_error('year', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="password" name="password">
                                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group form-check">
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" <?php if ($useredit['is_active'] == 1) echo "checked"; ?>>
                                        <label class="form-check-label" for="is_active">Is Active?</label>
                                    </div>

                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-2">Picture</div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img src="<?= base_url('assets/img/profile/') . $useredit['avatar']; ?>" class="img-thumbnail">
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

                            <div class="form-group row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->