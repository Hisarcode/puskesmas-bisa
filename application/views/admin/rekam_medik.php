<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <a href="<?= base_url() ?>admin/rekam_medik" class="btn btn-primary mb-3">+ Buat Rekam Medik</a>

    <div class="row">
        <div class="col-lg">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nomor Rekam Medik</th>
                        <th scope="col">Dibuat Tanggal</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($history as $hty) : ?>
                        <tr>
                            <td><?= $hty['no_rekam_medik']; ?></td>
                            <td><?= date('d/m/Y', strtotime($hty['date_created'])); ?></td>
                            <td>
                                <a href="<?= base_url() ?>admin/lihat_rekam_medik/<?= $hty['id']; ?>/<?= $hty['pasien_id']; ?>/<?= $hty['dokter_id']; ?>" class="badge badge-primary">Lihat Rekam Medik</a> </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->