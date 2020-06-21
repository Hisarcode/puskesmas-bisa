<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <form action="<?= base_url('pasien/buat_antrian/') ?>" method="POST">
                <!-- pasien/antrian -->
                <div class="form-group" hidden>

                    <input type="text" class="form-control" id="pasien_id" name="pasien_id" value="<?= $pasien_id ?>">

                </div>

                <div class="form-group" hidden>
                    <input type="text" class="form-control" id="no_antrian" name="no_antrian" value="<?= $no_antrian ?>">

                </div>

                <div class="form-group" hidden>

                    <input type="text" class="form-control" id="dokter_id" name="dokter_id" value="<?= $dokter_id ?>">

                </div>
                <div class="form-group">
                    <label for="nama_dokter">Nama Dokter</label>

                    <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" readonly value="<?= $nama_dokter_terpilih ?>">


                </div>

                <div class="form-group">
                    <label for="jam">Jam</label>
                    <input type="text" class="form-control" id="jam" name="jam" value="<?= $jampilih ?>" readonly>

                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="text" class="form-control" id="tanggal" name="tanggal" value=<?= $tanggalantrianpilih ?> readonly>

                </div>


                <div class="form-group">
                    <a type="button" href="<?= base_url('pasien/antrian') ?>" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Buat</button>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->