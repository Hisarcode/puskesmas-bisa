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

            <a href="<?= base_url('admin/keloladataobat'); ?>" class="btn btn-primary mb-3 tambahDataObatBtn" data-toggle="modal" data-target="#tambahDataObatModal">Tambah Data Obat</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Jenis Obat</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($dataobat as $datao) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $datao['nama_obat']; ?></td>
                            <td><?= $datao['jenis_obat']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>admin/editdataobat/<?= $datao['id']; ?>" class="badge badge-success tampilModalEditDataObat" data-toggle="modal" data-target="#tambahDataObatModal" data-id="<?= $datao['id']; ?>">Edit</a>
                                <a href="<?= base_url(); ?>admin/deletedataobat/<?= $datao['id']; ?>" class="badge badge-danger" onclick="return confirm('Yakin?');">Delete</a>
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
<div class="modal fade" id="tambahDataObatModal" tabindex="-1" role="dialog" aria-labelledby="tambahDataObatModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDataObatModalLabel">Tambah Data Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Admin/keloladataobat/'); ?>" method="POST">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <input type="text" class="form-control" id="namaobat" name="namaobat" placeholder="Nama Obat">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="jenisobat" name="jenisobat" placeholder="Jenis Obat">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>