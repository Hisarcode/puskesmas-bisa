$(function () {
    var temp = $('#no_surat').val();
    $('.tambahSuratRujukanBtn').on('click', function () {
        $('#tambahSuratRujukanModalLabel').html('Tambah Surat Baru');
        $('.modal-footer button[type=submit]').html('Tambah');
        $('.modal-body form').attr('action', 'http://localhost/puskesmas-bisa/suratrujukan/');
        $('#no_surat').val(temp);
        $('.pilihpasien').show();
        $('.pasien_id_edit').hide();

        $('#dokter_id').val('');
        $('#tujuan').val('');
        $('#keterangan').val('')
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
                console.log(data);
                $('#id').val(data.id);
                $('#idpasien').val(data.idpasien);
                $('#date_created').val(data.date_created);
                $('#date_expired').val(data.date_expired);
                $('#is_active').val(data.is_active);
                $('#no_surat').val(data.nomor_surat);
                $('#dokter_id').val(data.dokter_id);
                $('#tujuan').val(data.tujuan);
                $('#keterangan').val(data.keterangan);
                $('.pilihpasien').hide();
                $('#pasien_id_edit').val(data.nama);
                $('.pasien_id_edit').show();
                // $('.selectpicker').selectpicker('val', [data.user_id]);
                // // $('select[name=pasien_id]').val(data.user_id);
                // $('.selectpicker').selectpicker('refresh');
            }
        });
    });


});