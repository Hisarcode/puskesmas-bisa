    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">

                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Registrasi Puskesmas Bisa</h1>
                            </div>
                            <form class="user" method="POST" action="<?= base_url('auth/registrasi'); ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= set_value('nama'); ?>">
                                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="nik" name="nik" placeholder="Masukkan Nomor Induk Kependudukan" value="<?= set_value('nik'); ?>">
                                    <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Masukkan alamat" value="<?= set_value('alamat'); ?>">
                                    <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-user" name="tanggallahir" id="tanggallahir" placeholder="Tanggal" autocomplete="off">
                                    </div>
                                    <?= form_error('tanggallahir', '<small class="text-danger pl-3">', '</small>'); ?>
                                    <!-- /.input group -->
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Masukkan Email" value="<?= set_value('email'); ?>">
                                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Username" value="<?= set_value('username'); ?>">
                                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="passsword1" name="password1" placeholder="Password">
                                        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('auth'); ?>">Sudah memiliki akun? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>