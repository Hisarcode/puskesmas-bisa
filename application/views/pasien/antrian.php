<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <form action="<?= base_url('pasien/antrian/'); ?>" method="POST">
                <table class="table table-striped">
                    <tr>
                        <td>
                            <label class="ml-5 mt-2" for="cari">Cari Data Pasien</label>
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-user" name="tanggalantrian" id="tanggalantrian" placeholder="Tanggal" autocomplete="off">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-success" name="tombolcari">Cari</button>
                        </td>
                    </tr>
                </table>
            </form>

            <a href="<?= base_url() ?>pasien/lihat_antrian/" class="btn btn-primary mb-3">Lihat Antrian</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Dokter</th>
                        <th scope="col">Spesialis</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tampildata as $jdw) : ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td><?= $jdw['nama_gelar']; ?></td>
                            <td><?= $jdw['jenis_dokter']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>pasien/editantrian/<?= $jdw['id']; ?>" class="badge badge-primary tampilModalEditAntrian" data-toggle="modal" data-target="#tambahAntrianModal" data-id="<?= $jdw['id']; ?>">+ Buat Antrian</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->pagination->create_links(); ?>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="tambahAntrianModal" tabindex="-1" role="dialog" aria-labelledby="tambahAntrianModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahAntrianModalLabel">Tambah Antrian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('pasien/antrian/'); ?>" method="POST">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Antrian Title">
                    </div>

                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Pilih Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Sub Menu Url">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Sub Menu Icon">
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" value="1" name="is_active" id="is_active" checked>
                            <label for="is_active" class="form-check-label">Active</label>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>