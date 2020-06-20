<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <!-- penting untuk form -->
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Edit Data User</h1>
            </div>
            <form class="user" method="POST" action="<?= base_url('admin/tambah_user'); ?>">
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= $user['nama']; ?>">
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Options</label>
                    </div>
                    <select class="custom-select" id="role_id" name="role_id" value="<?= $user['role_id']; ?>">
                        <option selected>Masukan Kategori User</option>
                        <option value="1">Admin</option>
                        <option value="2">Dokter</option>
                        <option value="3">Pasien</option>
                    </select>
                    <?= form_error('role_id', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>



                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="nik" name="nik" placeholder="Masukkan Nomor Induk Kependudukan" value="<?= $user['nik']; ?>">
                    <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Masukkan alamat" value="<?= $user['alamat']; ?>">
                    <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-user" name="tanggallahir" id="tanggallahir" placeholder="Tanggal" autocomplete="off" value="<?= $user['alamat']; ?>">
                    </div>
                    <?= form_error('tanggallahir', '<small class="text-danger pl-3">', '</small>'); ?>
                    <!-- /.input group -->
                </div>

                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Masukkan Email" value="<?= $user['email']; ?>">
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Username" value="<?= $user['username']; ?>">
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

                <a type="button" class="btn btn-secondary btn-user" href="<?= base_url('admin/manajemenuser') ?>">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary btn-user">
                    Edit User
                </button>
            </form>

        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>