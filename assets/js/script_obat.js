$(function () {


    $('.tambahDataObatBtn').on('click', function () {
        $('#tambahDataObatModalLabel').html('Tambah Data Obat Baru');
        $('.modal-footer button[type=submit]').html('Tambah');
        $('#title').val('');
        $('#url').val('');
        $('#icon').val('');
        $('#menu_id').val('');
        $('.modal-body form').attr('action', 'http://localhost/puskesmas-bisa/admin/keloladataobat');
    });

    $('.tampilModalEditDataObat').on('click', function () {

        $('#tambahDataObatModalLabel').html('Edit Data Obat');
        $('.modal-footer button[type=submit]').html('Edit Data');
        $('.modal-body form').attr('action', 'http://localhost/puskesmas-bisa/admin/editdataobat');

        const id = $(this).data('id');

        // jquery ajax, request data tanpa mereload seluruh halamannya 
        $.ajax({
            url: 'http://localhost/puskesmas-bisa/admin/geteditdataobat',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#title').val(data.title);
                $('#namaobat').val(data.nama_obat);
                $('#jenisobat').val(data.jenis_obat);
            }
        });
    });

});