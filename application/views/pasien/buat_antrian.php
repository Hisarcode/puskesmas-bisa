<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?> 
            <form action="" method="POST"> <!-- pasien/antrian -->
                <div class="form-group">
                    <label for="nama_pasien">Nama Pasien</label>
                    <input type="text" class="form-control" id="nama_pasien" name="nama_pasien">
                </div>
                <div class="form-group">
                    <label for="nama_dokter">Nama Dokter</label>
                    <input type="text" class="form-control" id="nama_dokter" name="nama_dokter">
                </div>
                <div class="form-group">
                    <label for="spesialis">Spesialis</label>
                    <input type="text" class="form-control" id="spesialis" name="spesialis">
                </div>
                <div class="form-group">
                    <label for="jam">Jam</label>
                    <input type="text" class="form-control" id="jam" name="jam">
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Buat</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



