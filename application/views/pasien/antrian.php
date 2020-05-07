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

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahMenuModal">Tambah Antrian</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID Dokter</th>
                        <th scope="col">ID Pasien</th>
                        <th scope="col">Nomor Antrian</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status</th>
                        <th scope="col">Jam</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($antrian as $ant) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $ant['dokter_id']; ?></td>
                            <td><?= $ant['pasien_id']; ?></td>
                            <td><?= $ant['no_antrian']; ?></td>
                            <td><?= $ant['tanggal']; ?></td>
                            <td><?= $ant['status']; ?></td>
                            <td><?= $ant['jam']; ?></td>
                            <td>
                                <a href="" class="badge badge-primary">Detail</a>
                                <a href="" class="badge badge-success">Edit</a>
                                <a href="" class="badge badge-danger">Delete</a>
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
<div class="modal fade" id="tambahMenuModal" tabindex="-1" role="dialog" aria-labelledby="tambahMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahMenuModalLabel">Tambah Menu Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Nama Menu">
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