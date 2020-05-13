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

            <a href="<?= base_url()?>dokter/datapasien" class="btn btn-danger mb-3">Back</a>

            <table class="table table-bordered" style="width: 80%" align="center">
            
            <tr><th colspan="2">
                <img class="card-img mx-auto d-block" style="width:150px; height:auto;" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
            </th>
            </tr>
                <tr>
                    <th style="width: 40%">Nama</th>
                    <td style="width: 40%"><?= $detail['nama'] ;?></td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td><?= $detail['nik']; ?></td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td><?= $detail['tanggallahir']; ?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><?= $detail['alamat']; ?></td>
                </tr>
                <tr>
                    <th>Pekerjaan</th>
                    <td><?= $detail['pekerjaan'] ;?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= $detail['email']; ?></td>
                </tr>
            </table>

            </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

