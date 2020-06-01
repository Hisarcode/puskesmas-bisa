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
                        <th scope="col">Tanggal Resep</th>
                        <th scope="col">Di Buat Oleh</th>
                        <th scope="col">Spesialis</th>
                        <th scope="col">Tanggal Kadaluwarsa</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($tampildata as $dr) : //if ($user['username' == $dr['nama']]) 
                    ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td><?= $dr['date_created']; ?></td>
                            <td><?= $dr['nama_gelar']; ?></td>
                            <td><?= $dr['jenis_dokter']; ?></td>
                            <td><?= $dr['date_expired']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>pasien/resep/<?= $dr['id']; ?>" class="badge badge-success tampilModalResepbtn" data-toggle="modal" data-target="#tampilResepModal" data-id="<?= $dr['date_created']; ?>">Lihat Resep</a>
                            </td>
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



<!-- Modal -->
<div class="modal fade" id="tampilResepModal" tabindex="-1" role="dialog" aria-labelledby="tampilResepModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tampilResepModalLabel">Resep</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>