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
<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#">Identitas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Status</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Jadwal</a>
            </li>
            <li class="nav-item">
                <button type="button" id="button-tambah" class="btn btn-primary ml-2"><i class="fa fa-plus"
                    aria-hidden="true"></i> Daftar Vaksinasi</button>
            </li>
        </ul>
    </div>
    <div class="card-body">
        {{-- konten di sini --}}
        <table class="table text-left">
            <tbody>
                <tr>
                    <td>Nama</td>
                    <td>: Zetta</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>: 08273892348723</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: jl jhl kajsdk</td>
                </tr>
                <tr>
                    <td>Kelurahan</td>
                    <td>: Petompon</td>
                </tr>
                <tr>
                    <td>Kecamatan</td>
                    <td>: Kalideres</td>
                </tr>
                <tr>
                    <td>Kota</td>
                    <td>: Jakarta</td>
                </tr>
                <tr>
                    <td>Provinsi</td>
                    <td>: DKI Jakarta</td>
                </tr>
                <tr>
                    <td>Telp</td>
                    <td>: 04554226123</td>
                </tr>
                <tr>
                    <td>Kelompok</td>
                    <td>: UMUM</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="modal-vaksin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Daftar Vaksin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formvaksin">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">NIK</label>
                        <input type="text" class="form-control" id="nik">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Provinsi:</label>
                        <input type="text" class="form-control" id="provvi">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Kota:</label>
                        <input type="text" class="form-control" id="penerbit">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Kecamatan:</label>
                        <input type="text" class="form-control" id="romanji">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">No. Tlpn:</label>
                        <input type="text" class="form-control" id="alt-name">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Kelompok</label>
                        <input type="text" class="form-control" id="alt-name">
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
        var idnow;
        toastr.options = {
            "closeButton": true,
        }
        $('#button-tambah').click(function () {
            $('#button-delete').addClass('d-none');
            $('#action').val('create');
            $('#buttonsubmit').addClass('disabled')
            $('#formvaksin')[0].reset();
            $('#button-delete').addClass('d-none');
            $('#modal-vaksin').modal('show');
        });
        $('#button-delete').click(function () {
            $.ajax({
                url: "/api/buku/delete/" + idnow,
                dataType: "json",
                success: function (html) {
                    toastr["success"](html.success, "Success")
                    $('#button-delete').addClass('d-none');
                    setTimeout(function () {
                        $('#formvaksin')[0].reset();
                        $('#buttonsubmit').addClass('disabled')
                        $('#modal-vaksin').modal('hide');
                    }, 2000);

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
                                $('#formvaksin')[0].reset();
                                $('#buttonsubmit').addClass('disabled')
                                $('#modal-vaksin').modal('hide');
                            }, 2000);
                        }
                    }
                })
            }
            if ($('#action').val() == 'edit') {
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
                                $('#formvaksin')[0].reset();
                                $('#buttonsubmit').addClass('disabled')
                                $('#modal-vaksin').modal('hide');
                            }, 2000);
                        }
                    }
                })
            }
        });
    });

</script>
@endsection
