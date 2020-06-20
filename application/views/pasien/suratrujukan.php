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

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">No Surat</th>
                        <th scope="col">Tujuan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (empty($suratrujukan)) : ?>
                        <tr>
                            <td colspan=5>
                                <div class="alert alert-danger" role="alert">
                                    Data Tidak ditemukan
                                </div>
                            </td>
                        </tr>
                    <?php endif ?>
                    <?php $i = 1; ?>
                    <?php foreach ($suratrujukan as $sr) : ?>
                        <tr>
                            <td scope="row"><?= $i; ?></td>
                            <td scope="row"><?= $sr['nomor_surat']; ?></td>
                            <td><?= $sr['tujuan']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>pasien/detail_rujukan/<?= $sr['id']; ?>" class="badge badge-primary" data-id="<?= $sr['id']; ?>">Lihat Surat</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>

            </table>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->