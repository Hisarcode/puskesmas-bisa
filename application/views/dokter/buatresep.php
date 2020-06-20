<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('category_error')) : ?>
                <div class="alert alert-danger" role="alert"> <?= $this->session->flashdata('category_error') ?> </div>
            <?php endif; ?>

            <a href="<?= base_url('dokter/tambahresep'); ?>" class="btn btn-primary mb-3 tambahResep Btn">Tambah Resep</a>

            <table class="table table-hover">
                <thead>
                    <tr>

                        <th scope="col">Pasien</th>
                        <th scope="col">Obat</th>

                        <th scope="col">Tanggal Pembuatan</th>
                        <th scope="col">Tanggal Kadaluwarsa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($dataresep as $dr) : ?>
                        <tr>
                            <td scope="row"><?= $dr['nama']; ?></td>
                            <td scope="row"><?= $dr['nama_obat']; ?></td>


                            <td><?= date("d/m/Y", strtotime($dr['date_created'])); ?></td>
                            <td><?= date("d/m/Y", strtotime($dr['date_expired'])); ?></td>

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