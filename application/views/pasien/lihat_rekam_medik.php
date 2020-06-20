<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Dokter</th>
                        <th scope="col">Jenis Penyakit</th>
                        <th scope="col">Keterangan</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($lihat as $lht) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $nama['nama_gelar']; ?></td>
                            <td><?= $lht['jenis_penyakit']; ?></td>
                            <td><?= $lht['keterangan']; ?></td>
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