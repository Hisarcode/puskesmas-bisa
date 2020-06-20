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
                <form action="<?= base_url('dokter/tambahresep/'); ?>" method="POST">
                    <table class="table table-striped">
                        <tr>
                            <td>
                                <label class="ml-5 mt-2" for="cari">Cari Data Pasien</label>
                            </td>
                            <td>
                                <input value="<?php echo $cari; ?>" type="text" class="form-control" name="cari" id="cari" placeholder="silahkan cari data berdasarkan username/nama" autofocus>
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
                        <th scope="col">Username</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tampildata as $dp) : ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td><?= $dp['username']; ?></td>
                            <td><?= $dp['nama']; ?></td>
                            <td><?= $dp['alamat']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>dokter/buatreseppasien/<?= $dp['id']; ?>" class="badge badge-primary" data-id="<?= $dp['id']; ?>">Buat Resep</a>
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