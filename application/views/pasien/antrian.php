<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">

            <a href="<?= base_url()?>pasien/lihat_antrian/" class="btn btn-primary mb-3" >Lihat Antrian</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Dokter</th>
                        <th scope="col">Spesialis</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($jadwal as $jdw) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $jdw['nama_gelar']; ?></td>
                            <td><?= $jdw['jenis_dokter']; ?></td>
                            <td>
                                <a href="<?= base_url()?>pasien/buat_antrian/<?= $jdw['id'];?>" class="badge badge-success">+ Buat Antrian</a>
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



