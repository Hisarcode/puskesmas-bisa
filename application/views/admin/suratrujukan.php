<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?php if ($this->session->flashdata('category_error')) : ?>
                <div class="alert alert-danger" role="alert"> <?= $this->session->flashdata('category_error') ?> </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('category_success')) : ?>
                <div class="alert alert-success" role="alert"> <?= $this->session->flashdata('category_success') ?> </div>
            <?php endif; ?>

            <a href="" class="btn btn-primary mb-3 tambahSuratRujukanBtn" data-toggle="modal" data-target="#tambahSuratRujukanModal">Tambah Surat Baru</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Pasien</th>
                        <th scope="col">Nomor Surat</th>
                        <th scope="col">Tujuan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($suratrujukan as $sr) : ?>
                        <tr>
                            <td scope="row"><?= date("d/m/Y", strtotime($sr['date_created'])); ?></td>
                            <td scope="row"><?= $sr['nama']; ?></td>
                            <td scope="row"><?= $sr['nomor_surat']; ?></td>
                            <td scope="row"><?= $sr['tujuan']; ?></td>
                            <td scope="row">
                                <a href="<?= base_url(); ?>suratrujukan/editsuratrujukan/<?= $sr['id']; ?>" class="badge badge-success tampilModalEditSuratRujukan" data-toggle="modal" data-target="#tambahSuratRujukanModal" data-id="<?= $sr['id']; ?>">Edit</a>
                                <a href="<?= base_url(); ?>suratrujukan/deletesuratrujukan/<?= $sr['id']; ?>" class="badge badge-danger" onclick="return confirm('Yakin?');">Delete</a>
                                <a href="<?= base_url(); ?>suratrujukan/printsuratrujukan/<?= $sr['id']; ?>" class="badge badge-info">Print</a>
                            </td>
                        </tr>
                        <?php $i++;  ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



<!-- Modal -->
<div class="modal fade" id="tambahSuratRujukanModal" tabindex="-1" role="dialog" aria-labelledby="tambahSuratRujukanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahSuratRujukanModalLabel">Tambah Surat Rujukan Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('suratrujukan'); ?>" method="POST">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="date_created" id="date_created">
                    <input type="hidden" name="date_expired" id="date_expired">
                    <input type="hidden" name="is_active" id="is_active">
                    <input type="hidden" name="idpasien" id="idpasien">

                    <div class="form-group">
                        <label for="no_surat">Nomor Surat</label>
                        <input type="text" class="form-control" id="no_surat" name="no_surat" readonly value="<?= $nomor_surat; ?>">
                    </div>

                    <div class="form-group pasien_id_edit">
                        <label for="pasien_id_edit">Pasien</label>
                        <input type="text" class="form-control" id="pasien_id_edit" name="pasien_id_edit" readonly>
                    </div>

                    <div class="form-group pilihpasien">
                        <label for="pasien_id">Pilih Pasien</label>
                        <select class="selectpicker form-control" name="pasien_id" id="pasien_id" data-live-search="true">

                            <?php foreach ($pilih_pasien as $pas) : ?>
                                <option value="<?= $pas['id']; ?>" data-tokens="<?= $pas['nama']; ?>"><?= $pas['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="dokter_id">Pilih Dokter</label>
                        <select name="dokter_id" id="dokter_id" class="form-control">
                            <option value="">Pilih Dokter</option>

                            <?php foreach ($pilih_dokter as $dr) : ?>
                                <option value="<?= $dr['id']; ?>"><?= $dr['nama_gelar']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mt-1">
                        <input type="text" class="form-control" id="tujuan" name="tujuan" placeholder="Masukkan Tujuan Surat">
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="5" placeholder="Masukkan Keterangan apabila ada"></textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>