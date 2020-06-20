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
                        <th scope="col">ID Pasien</th>
                        <th scope="col">ID Dokter</th>
                        <th scope="col">Nomor Antrian</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jam</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($antrian as $ant) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $ant['pasien_id']; ?></td>
                            <td><?= $ant['dokter_id']; ?></td>
                            <td><?= $ant['no_antrian']; ?></td>
                            <td><?= $ant['tanggal']; ?></td>
                            <td><?= $ant['jam']; ?></td>
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