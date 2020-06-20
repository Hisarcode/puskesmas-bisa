<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('category_success'); ?>

            <form action="<?= base_url('dokter/tambahresep') ?>" method="POST">


                <div class="form-group">
                    <label for="pasien_id">Pilih Pasien</label>
                    <select class="selectpicker form-control" name="pasien_id" id="pasien_id" data-live-search="true">

                        <?php foreach ($pilih_pasien as $pas) : ?>
                            <option value="<?= $pas['id']; ?>" data-tokens="<?= $pas['nama']; ?>"><?= $pas['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="obat_id">Pilih Obat</label>
                    <select class="selectpicker form-control" name="obat_id" id="obat_id" data-live-search="true">

                        <?php foreach ($pilih_obat as $ob) : ?>
                            <option value="<?= $ob['id']; ?>" data-tokens="<?= $ob['nama_obat']; ?>"><?= $ob['nama_obat']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="aturan" name="aturan" placeholder="Aturan pemakaian">
                    <?= form_error('aturan', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="catatan" name="catatan" placeholder="Catatan">
                </div>


                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-user" name="tanggalpembuatan" id="tanggalpembuatan" placeholder="Tanggal pembuatan" autocomplete="off">
                    </div>
                    <?= form_error('tanggalpembuatan', '<small class="text-danger pl-3">', '</small>'); ?>
                    <!-- /.input group -->
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-user" name="tanggalkadaluwarsa" id="tanggalkadaluwarsa" placeholder="Tanggal kadaluwarsa" autocomplete="off">
                    </div>
                    <?= form_error('tanggalkadaluwarsa', '<small class="text-danger pl-3">', '</small>'); ?>
                    <!-- /.input group -->
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Tambah Resep</button>
                </div>

            </form>
        </div>
    </div>
</div>
</div>