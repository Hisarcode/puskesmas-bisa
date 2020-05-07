$(function () {
    $('.tambahMenuBtn').on('click', function () {
        $('#tambahSubMenuModalLabel').html('Tambah Sub Menu Baru');
        $('.modal-footer button[type=submit]').html('Tambah');
        $('.modal-body form').attr('action', 'http://localhost/puskesmas-bisa/menu/');
    });


    $('.tampilModalEditMenu').on('click', function () {
        $('#tambahMenuModalLabel').html('Edit Sub Menu');
        $('.modal-footer button[type=submit]').html('Edit Data');
        $('.modal-body form').attr('action', 'http://localhost/puskesmas-bisa/menu/editmenu');

        const id = $(this).data('id');

        // jquery ajax, request data tanpa mereload seluruh halamannya 
        $.ajax({
            url: 'http://localhost/puskesmas-bisa/menu/geteditmenu',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#menu').val(data.menu);
            }
        });
    });

    $('.tambahSubMenuBtn').on('click', function () {
        $('#tambahSubMenuModalLabel').html('Tambah Sub Menu Baru');
        $('.modal-footer button[type=submit]').html('Tambah');
        $('#title').val('');
        $('#url').val('');
        $('#icon').val('');
        $('#menu_id').val('');
        $('.modal-body form').attr('action', 'http://localhost/puskesmas-bisa/menu/submenu');
    });

    $('.tampilModalEditSubMenu').on('click', function () {

        $('#tambahSubMenuModalLabel').html('Edit Sub Menu');
        $('.modal-footer button[type=submit]').html('Edit Data');
        $('.modal-body form').attr('action', 'http://localhost/puskesmas-bisa/menu/editsubmenu');

        const id = $(this).data('id');

        // jquery ajax, request data tanpa mereload seluruh halamannya 
        $.ajax({
            url: 'http://localhost/puskesmas-bisa/menu/geteditsubmenu',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#menu_id').val(data.menu_id);
                $('#title').val(data.title);
                $('#url').val(data.url);
                $('#icon').val(data.icon);
                $('#is_active').val(data.is_active);
            }
        });
    });

});