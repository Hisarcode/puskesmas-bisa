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
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Role</th>
                        <th scope="col">Email</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Tgl Lahir</th>
                        <th scope="col">Tgl Dibuat</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($lihat_user as $mu) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $mu['nama']; ?></td>
                            <td><?= $mu['username']; ?></td>
                            <td><?= $mu['role_id']; ?></td>
                            <td><?= $mu['email']; ?></td>
                            <td><?= $mu['nik']; ?></td>
                            <td><?= $mu['tanggallahir']; ?></td>
                            <td><?= $mu['date_created']; ?></td>
                            
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



