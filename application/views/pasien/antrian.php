<!-- Begin Page Content -->
<div class="container-fluid">
    <?php $jam = []; ?>
    <?php foreach ($jadwal as $jd) {
        array_push($jam, $jd['jam']);
    }; ?>


    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <form action="<?= base_url('pasien/antrian/'); ?>" method="POST">
                <table class="table table-striped">
                    <tr>
                        <td>
                            <label class="ml-5 mt-2" for="tanggalantrian">Pilih Tanggal Antrian</label>
                        </td>
                        <td>
                            <input type="text" value="<?= $tanggalantrian ?>" class="form-control form-control-user" name="tanggalantrian" id="tanggalantrian" placeholder="Tanggal" autocomplete="off">
                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="ml-5 mt-2" for="tanggalantrian">Pilih Dokter</label>
                        </td>
                        <td>
                            <select name="dokter_id" id="dokter_id" class="form-control">
                                <option value="">Pilih Dokter</option>

                                <?php foreach ($pilih_dokter as $dr) : ?>
                                    <option value="<?= $dr['id']; ?>" <?php if ($dr['id'] == $dokter_terpilih) echo 'selected'; ?>><?= $dr['nama_gelar']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <input type="submit" class="btn btn-success" value="Pilih" name="tombolpilihtanggal">
                        </td>
                    </tr>
                </table>
            </form>


            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Jam</th>
                        <th scope="col" hidden>Id Dokter</th>
                        <th scope="col">Nama Dokter</th>
                        <th scope="col">No Antrian</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $jamloop = "09.00"; ?>

                    <?php for ($x = 0; $x < 10; $x++) { ?>
                        <tr>
                            <td scope="row"><?= $jamloop ?></td>
                            <td scope="row"><?= $nama_dokter ?></td>
                            <td scope="row"><?= $x + 1 ?></td>
                            <?php if (in_array($jamloop, $jam)) : ?>
                                <td scope="row">
                                    <span class="btn btn-secondary">Ada Antrian</span>
                                </td>
                            <?php else : ?>
                                <td scope="row">
                                    <form action="<?= base_url('pasien/buat_antrian/'); ?>" method="POST">

                                        <input type="hidden" value="<?php echo $tanggalantrian ?>" name="tanggalantrianpilih" id="tanggalantrianpilih">
                                        <input type="hidden" value="<?php echo $jamloop ?>" name="jampilih" id="jampilih">
                                        <input type="hidden" value="<?php echo $dokter_terpilih ?>" name="dokter_id" id="dokter_id">
                                        <input type="hidden" value="<?php echo $pasien_id ?>" name="pasien_id" id="pasien_id">
                                        <input type="hidden" value="<?php echo $x + 1 ?>" name="no_antrian" id="no_antrian">

                                        <input type="submit" class="btn btn-primary" value="Buat Antrian" name="buatantrian">

                                    </form>

                                </td>
                            <?php endif ?>
                        </tr>
                        <?php $jamloop = date('H.i', strtotime('+30 minutes', strtotime($jamloop))); ?>

                    <?php }; ?>
                </tbody>
            </table>

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
                    <input type="hidden" name="pasien_id" id="pasien_id" value="<?= $user['id']; ?>">
                    <input type="hidden" name="dokter_id" id="dokter_id" value="<?= $jdw['user_id']; ?>">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" value="<?= $jdw['nama_gelar']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="no_antrian" name="no_antrian" placeholder="Nomor Antrian">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal Antrian">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="jam" name="jam" placeholder="jam">
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