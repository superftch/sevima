@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
    crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
<style>
    .file {
        visibility: hidden;
        position: absolute;
    }

    .dataTables_filter {
        display: none;
    }

</style>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Buku</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="input-group">
            <button type="button" id="button-tambah" class="btn btn-primary mr-2"><i class="fa fa-plus"
                    aria-hidden="true"></i> Tambah Buku</button>
            <input type="text" class="form-control" id="searchbar" placeholder="Cari buku..">
        </div>
        <table id="example2" class="table table-bordered table-hover responsive display nowrap" width="100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th data-priority="2">No. Buku</th>
                    <th data-priority="1">Judul</th>
                    <th data-priority="3">Pengarang</th>
                    <th>Penerbit</th>
                    <th>Alt Name</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<div class="modal fade" id="modal-buku" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formbuku">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Nomor Buku:</label>
                        <input type="text" class="form-control" id="no-buku">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Judul Buku:</label>
                        <input type="text" class="form-control" id="judul">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Pengarang:</label>
                        <input type="text" class="form-control" id="pengarang">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Penerbit:</label>
                        <input type="text" class="form-control" id="penerbit">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Romanji:</label>
                        <input type="text" class="form-control" id="romanji">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Alt Name:</label>
                        <input type="text" class="form-control" id="alt-name">
                    </div>
                    <div class="form-group" id="input-gambar">
                        <label class="col-form-label">Pilih upload gambar menggunakan:</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis-gambar" id="file-trigger"
                                value="option1" id="option1">
                            <label class="form-check-label" for="inlineRadio1">File</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis-gambar" id="link-trigger"
                                value="option2" id="option2">
                            <label class="form-check-label" for="inlineRadio2">Link</label>
                        </div>
                    </div>
                    <div class="form-group" id="filegambar" style="display: none;">
                        <input type="file" name="file-gambar" class="file" accept="image/*">
                        <div class="input-group my-3">
                            <input type="text" class="form-control" disabled placeholder="Upload Foto" id="file">
                            <div class="input-group-append">
                                <button type="button" class="browse btn btn-primary">Browse...</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="linkgambar" style="display: none;">
                        <input type="text" class="form-control" id="link-gambar">
                    </div>
                    <div class="form-group text-center" style="display: none;">
                        <img src="" id="preview" class="img-thumbnail" style="max-width:420px;">
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <input class="d-none" type="text" id="action" value="">
                <input class="d-none" type="text" id="idusr" value="{{ auth()->user()->id }}">
                <button type="button" id="button-delete" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="buttonsubmit" class="btn btn-primary disabled">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous"></script>
<script>
    $(function () {
        var gambar;
        var tipe;
        var idnow;
        toastr.options = {
            "closeButton": true,
        }
        var tablebuku = $('#example2').DataTable({
            responsive: {
                details: false
            },
            paging: true,
            lengthChange: false,
            ordering: true,
            info: true,
            autoWidth: false,
            ajax: {
                type: 'GET',
                url: "/api/buku/get",
            },
            columnDefs: [
                { responsivePriority: 1, targets: 2 },
                { responsivePriority: 2, targets: 1 },
                { responsivePriority: 3, targets: 3 }
            ],
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'no_buku',
                    name: 'no_buku',
                },
                {
                    data: 'judul',
                    name: 'judul'
                },
                {
                    data: 'pengarang',
                    name: 'pengarang'
                },
                {
                    data: 'penerbit',
                    name: 'penerbit'
                },
                {
                    data: 'alt_name',
                    name: 'alt_name'
                },
            ],
            rowId: 'id'
        });
        $('#searchbar').on('keyup change', function () {
            tablebuku.search($(this).val()).draw();
        })
        $(document).on("click", ".browse", function () {
            var file = $(this).parents().find(".file");
            file.trigger("click");
        });
        $('#button-tambah').click(function () {
            $('#button-delete').addClass('d-none');
            $('#action').val('create');
            $('#preview').parent().hide()
            $('#buttonsubmit').addClass('disabled')
            $('#formbuku')[0].reset();
            $('#input-gambar').removeClass('d-none');
            $('#button-delete').addClass('d-none');
            $('#filegambar').hide();
            $('#linkgambar').hide();
            $('#modal-buku').modal('show');
        });
        $('#link-trigger').click(function () {
            $('#filegambar').hide();
            $('#linkgambar').fadeIn('slow');
        });

        $('#file-trigger').click(function () {
            $('#linkgambar').hide();
            $('#filegambar').fadeIn('slow');
        });
        $("img").on("error", function () {
            $('#preview').parent().hide()
            $('#link-gambar').addClass('is-invalid')
            $('#buttonsubmit').addClass('disabled')
        });
        $('#link-gambar').change(function (e) {
            $('#buttonsubmit').removeClass('disabled')
            $('#link-gambar').removeClass('is-invalid')
            linkval = $(this).val();
            $('#preview').parent().fadeIn('slow')
            $('#preview').attr('src', linkval)
            gambar = linkval
            tipe = 'link'
        });
        $('#button-delete').click(function () {
            $.ajax({
                url: "/api/buku/delete/" + idnow,
                dataType: "json",
                success: function (html) {
                    toastr["success"](html.success, "Success")
                    $('#button-delete').addClass('d-none');
                    setTimeout(function () {
                        $('#preview').parent().hide()
                        $('#formbuku')[0].reset();
                        $('#buttonsubmit').addClass('disabled')
                        $('#modal-buku').modal('hide');
                        $('#example2').DataTable().ajax.reload();
                    }, 2000);

                }
            })
        });
        $('input[type="file"]').change(function (e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);

            var reader = new FileReader();
            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
            tipe = 'file';
            gambar = $(this).val();
            $('#preview').parent().fadeIn('slow')
            $('#buttonsubmit').removeClass('disabled')
        });
        $('#example2 tbody').on('click', 'tr', function () {
            idnow = tablebuku.row(this).id();
            $.ajax({
                url: "/api/buku/detail/" + idnow,
                dataType: "json",
                success: function (html) {
                    $('#action').val('edit')
                    $('#button-delete').removeClass('d-none');
                    $('#buttonsubmit').removeClass('disabled')
                    $('#formbuku')[0].reset();
                    gambar = html.data.gambar;
                    tipe = html.data.jenis_gambar
                    $('#no-buku').val(html.data.no_buku);
                    $('#judul').val(html.data.judul);
                    $('#penerbit').val(html.data.penerbit);
                    $('#pengarang').val(html.data.pengarang);
                    $('#romanji').val(html.data.romanji);
                    $('#alt-name').val(html.data.alt_name);
                    $('#preview').parent().fadeIn('fast')
                    if (html.data.jenis_gambar == 'link') {
                        $('#preview').attr('src', html.data.gambar)
                        $('#link-gambar').val(html.data.gambar);
                        $('#linkgambar').fadeIn('slow');
                        $('#filegambar').hide();
                        $("input[name=jenis-gambar][value='option2']").prop("checked",true);

                    } else {
                        $("#file").val(html.data.gambar);
                        $('#filegambar').fadeIn('slow');
                        $('#preview').attr('src', '/foto/' + html.data.gambar + '')
                        $('#linkgambar').hide();
                        $("input[name=jenis-gambar][value='option1']").prop("checked",true);
                    }
                    $('#modal-buku').modal('show');
                }
            })
        });
        $('#buttonsubmit').on("click", function () {
            var formData = new FormData();
            formData.append('no_buku', $('#no-buku').val());
            formData.append('judul', $('#judul').val());
            formData.append('penerbit', $('#penerbit').val());
            formData.append('pengarang', $('#pengarang').val());
            formData.append('romanji', $('#romanji').val());
            formData.append('alt_name', $('#alt-name').val());
            formData.append('jenis_gambar', tipe);
            formData.append('user_id', $('#idusr').val()); 
            formData.append('idnow', idnow);
            if (tipe == 'file') {
                if ($('.file')[0].files[0] == null) {
                    formData.append('gambar', gambar);    
                } else {
                    formData.append('gambar', $('.file')[0].files[0])
                }
            }else if (tipe == 'link') {
                formData.append('gambar', gambar);
            }
            if ($('#action').val() == 'create') {
                $.ajax({
                    url: "/api/buku/tambah",
                    method: "POST",
                    dataType: "json",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        var html = '';
                        if (data.errors) {
                            for (var count = 0; count < data.errors.length; count++)
                                toastr["error"](data.errors[count], "Error")
                        }
                        if (data.success) {
                            toastr["success"](data.success[count], "Success")
                            setTimeout(function () {
                                $('#preview').parent().hide()
                                $('#formbuku')[0].reset();
                                $('#buttonsubmit').addClass('disabled')
                                $('#modal-buku').modal('hide');
                                $('#example2').DataTable().ajax.reload();
                            }, 2000);
                        }
                    }
                })
            }
            if ($('#action').val() == 'edit') {
                if (formData.get('gambar') == null) {
                    formData.set('gambar', gambar)
                }
                $.ajax({
                    contentType: false,
                    url: "/api/buku/edit",
                    method: "POST",
                    dataType: "json",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        var html = '';
                        if (data.errors) {
                            for (var count = 0; count < data.errors.length; count++)
                                toastr["error"](data.errors[count], "Error")
                        }
                        if (data.success) {
                            toastr["success"](data.success[count], "Success")
                            setTimeout(function () {
                                $('#preview').parent().hide()
                                $('#formbuku')[0].reset();
                                $('#buttonsubmit').addClass('disabled')
                                $('#modal-buku').modal('hide');
                                $('#example2').DataTable().ajax.reload();
                            }, 2000);
                        }
                    }
                })
            }
        });
    });

</script>
@endsection
