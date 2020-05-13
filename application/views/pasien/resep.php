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

            <p>
            <form action="<?= base_url('pasien/resep/'); ?>" method="POST">
                <table class="table table-striped">
                    <tr>
                        <td>
                            <label class="ml-5 mt-2" for="cari">Cari Data Resep</label>
                        </td>
                        <td>
                            <input value="<?php echo $cari; ?>" type="text" class="form-control" name="cari" 
                            id="cari" placeholder="silahkan cari data berdasarkan tanggal resep" autofocus>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-success" name="tombolcari">Cari</button>
                        </td>
                    </tr>
                </table>
            </form>
            </p>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal Resep</th>
                        <th scope="col">Di Buat Oleh</th>
                        <th scope="col">Jenis Dokter</th>
                        <th scope="col">Tanggal Kadaluwarsa</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    
                    <?php foreach ($tampildata as $dr) : //if ($user['username' == $dr['nama']]) ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td><?= $dr['date_created']; ?></td>
                            <td><?= $dr['nama_gelar'], $dr['nama']; ?></td>
                            <td><?= $dr['jenis_dokter']; ?></td>
                            <td><?= $dr['date_expired']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>pasien/detail_resep/<?= $dr['id']; ?>" class="badge badge-primary" data-id="<?= $dr['id']; ?>">Lihat Resep</a> 
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