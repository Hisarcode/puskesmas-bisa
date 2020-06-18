<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->


    <div class="row">
        <div class="col-lg">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?php if ($this->session->flashdata('category_error')) : ?>
                <div class="alert alert-danger" role="alert"> <?= $this->session->flashdata('category_error') ?> </div>
            <?php endif; ?>

            <a href="<?= base_url() ?>dokter/tambahresep" class="btn btn-danger mb-3">Back</a>

            <table class="table table-bordered" style="width: 80%" align="center">


                <tr>
                    <th style="width: 40%">Nama</th>
                    <td style="width: 40%"><?= $detail['nama']; ?></td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td><?= $detail['tanggallahir']; ?></td>
                </tr>
                <tr>
                    <th style="color: green;"><b>Resep</b></th>
                </tr>
            </table>

            <table class="table table-bordered" style="width: 80%" align="center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Obat</th>
                        <th>Jenis Obat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($obat as $obt) : ?>
                        <tr>
                            <th><?= ++$mulai; ?></th>
                            <td><?= $obt['nama_obat']; ?></td>
                            <td><?= $obt['jenis_obat']; ?></td>
                            <td>
                                <a href="" class="badge badge-warning">Tambah</a>
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