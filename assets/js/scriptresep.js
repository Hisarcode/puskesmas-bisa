$(function () {

    $('.tampilModalResepbtn').on('click', function () {
        $('#tambahMenuModalLabel').html('Lihat Resep');

        const id = $(this).data('id');
        // jquery ajax, request data tanpa mereload seluruh halamannya 
        console.log(id);
        $.ajax({
            url: 'http://localhost/puskesmas-bisa/pasien/getresepdetail',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                let totaldata = data.length;
                let i = 0;
                let buka = `<table class="table table-bordered" id="myTable">
                <tr align="center">
                    <th>Nama Obat</th>
                    <th>Aturan Minum</th>
                    <th>Catatan Dokter</th>
                </tr>
            `;
                let tutup = `</table>`;
                let isi = '';

                for (; i < totaldata; i++) {
                    let d = data[i];

                    tmp = ' <tr><td>' + d.nama_obat + '</td>' +
                        '<td>' + d.aturan + '</td>' +
                        '<td>' + d.catatan_dokter + '</td></tr>';
                    isi = isi + tmp;
                }

                console.log(isi);
                let detail = buka + isi + tutup;
                $('.modal-body').html(detail);
            }
        });
    });



});