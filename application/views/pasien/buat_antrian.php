<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <form action="" method="POST"> <!-- pasien/antrian -->
                <div class="form-group" hidden>
                    <label for="pasien_id">Id Pasien</label>
                    <input type="text" class="form-control" id="pasien_id" name="pasien_id" value="<?= $user['id']?>">
                    <small class="form-text text-danger"><?= form_error('pasien_id')?></small>
                </div>
                <div class="form-group">
                    <label for="nama_pasien">Nama Pasien</label>
                    <input type="text" class="form-control" id="nama_pasien" name="nama_pasien">
                    <small class="form-text text-danger"><?= form_error('nama_pasien')?></small>
                </div>
                <div class="form-group" hidden>
                    <label for="dokter_id">Id Dokter</label>
                    <input type="text" class="form-control" id="dokter_id" name="dokter_id" value="<?= $dokter['user_id']?>">
                    <small class="form-text text-danger"><?= form_error('dokter_id')?></small>
                </div>
                <div class="form-group">
                    <label for="nama_dokter">Nama Dokter</label>
                    <div class="div">
                        <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" readonly value="<?= $dokter['nama_gelar']?>">
                    </div>
                    <small class="form-text text-danger"><?= form_error('nama_dokter')?></small>
                </div>
                <div class="form-group">
                    <label for="spesialis">Spesialis</label>
                    <input type="text" class="form-control" id="spesialis" name="spesialis" readonly value="<?= $dokter['jenis_dokter']?>">
                    <small class="form-text text-danger"><?= form_error('spesialis')?></small>
                </div>
                <div class="form-group">
                    <label for="jam">Jam</label>
                    <input type="text" class="form-control" id="jam" name="jam">
                    <small class="form-text text-danger"><?= form_error('jam')?></small>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                    <small class="form-text text-danger"><?= form_error('tanggal')?></small>
                </div>
                <div class="form-group">
                    <label for="no_antrian">Nomor Antrian</label>
                    <input type="text" class="form-control" id="no_antrian" name="no_antrian">
                    <small class="form-text text-danger"><?= form_error('no_antrian')?></small>
                </div>
                <div class="form-group" hidden>
                    <label for="satus">Status</label>
                    <input type="text" class="form-control" id="status" name="status" value="1">
                    <small class="form-text text-danger"><?= form_error('status')?></small>
                </div>
                
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Buat</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



