<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nomor Surat</th>
                        <th><?= $suratrujukan['nomor_surat'] ?></th>

                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <th scope="row">Tujuan</th>
                        <td><?= $suratrujukan['tujuan']; ?></td>

                    </tr>
                    <tr>
                        <th scope="row">Tanggal Di Buat</th>
                        <td><?= $suratrujukan['date_created']; ?></td>

                    </tr>
                    <tr>
                        <th scope="row">Nama Pasien</th>
                        <td><?= $user['nama']; ?></td>

                    </tr>
                    <tr>
                        <th scope="row">Dirujuk Oleh</th>
                        <td><?= $nama_dokter; ?></td>

                    </tr>
                    <tr>
                        <th scope="row">Keterangan</th>
                        <td><?= $suratrujukan['keterangan']; ?></td>

                    </tr>

                </tbody>
            </table>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End