$(function () {
    $('.tambahSuratRujukanBtn').on('click', function () {
        $('#tambahSuratRujukanModalLabel').html('Tambah Surat Baru');
        $('.modal-footer button[type=submit]').html('Tambah');
        $('.modal-body form').attr('action', 'http://localhost/puskesmas-bisa/menu/');
    });


    $('.tampilModalEditSuratRujukan').on('click', function () {
        $('#tambahSuratRujukanModalLabel').html('Edit Surat Rujukan');
        $('.modal-footer button[type=submit]').html('Edit Data');
        $('.modal-body form').attr('action', 'http://localhost/puskesmas-bisa/suratrujukan/editsuratrujukan');

        const id = $(this).data('id');

        // jquery ajax, request data tanpa mereload seluruh halamannya 
        $.ajax({
            url: 'http://localhost/puskesmas-bisa/suratrujukan/getEditSuratRujukan',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#menu').val(data.menu);
            }
        });
    });


});