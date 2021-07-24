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
                <button type="button" id="button-edit" class="btn btn-warning ml-2"><i class="fa fa-plus"
                    aria-hidden="true"></i> Edit Data</button>
            </li>
            <li class="nav-item">
                <button type="button" id="button-delete" class="btn btn-danger ml-2"><i class="fa fa-plus"
                    aria-hidden="true"></i> Hapus Data</button>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div id="daftarvaksin" class="d-none">
            <p class="card-text">Kamu Belum Terdaftar Silahkan Daftar.</p>
            <button type="button" id="button-tambah" class="btn btn-primary ml-2"><i class="fa fa-plus"
                aria-hidden="true"></i> Daftar Vaksinasi</button>
        </div>
        {{-- konten di sini --}}
        <table class="table text-left d-none" id="tablevaksin">
            <tbody>
                <tr>
                    <td>Nama</td>
                    <td>: <span id="tnama"></span></td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>: <span id="tnik"></span></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: <span id="talamat"></span></td>
                </tr>
                <tr>
                    <td>Kelurahan</td>
                    <td>: <span id="tkelurahan"></span></td>
                </tr>
                <tr>
                    <td>Kecamatan</td>
                    <td>: <span id="tkecamatan"></span></td>
                </tr>
                <tr>
                    <td>Kota</td>
                    <td>: <span id="tkota"></span></td>
                </tr>
                <tr>
                    <td>Provinsi</td>
                    <td>: <span id="tprovinsi"></span></td>
                </tr>
                <tr>
                    <td>Tlpn</td>
                    <td>: <span id="ttlpn"></span></td>
                </tr>
                <tr>
                    <td>Kelompok</td>
                    <td>: <span id="tkelompok"></span></td>
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
                        <select class="form-control input-lg" id="provinsi" style="width:100%">
                            <option value="Jawa Tengah">Jawa Tengah</option>
                            <option value="Jawa Barat">Jawa Barat</option>
                            <option value="Jawa Timur">Jawa Timur</option>
                            <option value="Yogyakarta">Yogyakarta</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Kota:</label>
                        <select class="form-control input-lg" id="kota" style="width:100%">
                            <option value="Semarang">Semarang</option>
                            <option value="Bandung">Bandung</option>
                            <option value="Surabaya">Surabaya</option>
                            <option value="Sleman">Sleman</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Kecamatan:</label>
                        <select class="form-control input-lg" id="kecamatan" style="width:100%">
                            <option value="Semarang Utara">Semarang Utara</option>
                            <option value="Ciamplas">Ciamplas</option>
                            <option value="Kediri">Kediri</option>
                            <option value="Kulon">Kulon</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Kelurahan:</label>
                        <select class="form-control input-lg" id="kelurahan" style="width:100%">
                            <option value="Pelombokan">Pelombokan</option>
                            <option value="Pendurian">Pendurian</option>
                            <option value="Keduren">Keduren</option>
                            <option value="Kali Kiwo">Kali Kiwo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">No. Tlpn:</label>
                        <input type="text" class="form-control" id="tlpn">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Kelompok</label>
                        <select class="form-control input-lg" id="kelompok" style="width:100%">
                            <option value="umum">Umum</option>
                            <option value="nakes">Nakes</option>
                            <option value="pelajar">Pelajar</option>
                            <option value="pns">PNS</option>
                        </select>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <input class="d-none" type="text" id="action" value="">
                <input class="d-none" type="text" id="idvaksin" value="{{$idv}}">
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function init() {
        $.ajax({
            url: "/api/vaksin/detail/" + $('#idusr').val(),
            method: "GET",
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (data) {
                $('#tnama').text(data.data[0].name);
                $('#tnik').text(data.data[0].nik);
                $('#talamat').text(data.data[0].alamat);
                $('#tkelurahan').text(data.data[0].kelurahan);
                $('#tkecamatan').text(data.data[0].kecamatan);
                $('#tkota').text(data.data[0].kota);
                $('#tprovinsi').text(data.data[0].provinsi);
                $('#ttlpn').text(data.data[0].tlpn);
                $('#tkelompok').text(data.data[0].kelompok);
                $('#tablevaksin').removeClass('d-none');
                $('#nama').val(data.data[0].name);
                $('#nik').val($('#tnik').text());
                $('#alamat').text(data.data[0].alamat);
                $('#kelurahan').val(data.data[0].kelurahan);
                $('#kecamatan').val(data.data[0].kecamatan);
                $('#kota').val(data.data[0].kota);
                $('#provinsi').val(data.data[0].provinsi);
                $('#tlpn').val(data.data[0].tlpn);
                $('#kelompok').val(data.data[0].kelompok);
            }
        })
    }
    $(function () {
        if ($('#idusr').val() !== '0') {
            init();
        }else{
            $('#daftarvaksin').removeClass('d-none');
        }
        $('#kelompok').on('change', function () {
            $('#buttonsubmit').removeClass('disabled')
        });
        var idnow;
        toastr.options = {
            "closeButton": true,
        }
        $('#button-tambah').click(function () {
            // $('#button-delete').addClass('d-none');
            $('#action').val('create');
            $('#formvaksin')[0].reset();
            // $('#button-delete').addClass('d-none');
            $('#modal-vaksin').modal('show');
        });
        $('#button-edit').click(function () {
            // $('#button-delete').addClass('d-none');
            $('#action').val('create');
            $('#formvaksin')[0].reset();
            // $('#button-delete').addClass('d-none');
            $('#modal-vaksin').modal('show');
        });
        $('#button-delete').click(function () {
            $.ajax({
                url: "/api/buku/delete/" + idnow,
                dataType: "json",
                success: function (html) {
                    toastr["success"](html.success, "Success")
                    init();
                    // $('#button-delete').addClass('d-none');
                    setTimeout(function () {
                        $('#formvaksin')[0].reset();
                        $('#modal-vaksin').modal('hide');
                    }, 2000);

                }
            })
        });

        $('#buttonsubmit').on("click", function () {
            var formData = new FormData();
            formData.append('nik', $('#nik').val());
            formData.append('alamat', $('#alamat').val());
            formData.append('provinsi', $('#provinsi').val());
            formData.append('kota', $('#kota').val());
            formData.append('kecamatan', $('#kecamatan').val());
            formData.append('tlpn', $('#tlpn').val());
            formData.append('kelompok', $('#kelompok').val());
            formData.append('kelurahan', $('#kelurahan').val());
            formData.append('user_id', $('#idusr').val());
            formData.append('idnow', idnow);
            if ($('#action').val() == 'create') {
                $.ajax({
                    url: "/api/vaksin/create",
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
                            init()
                            setTimeout(function () {
                                $('#formvaksin')[0].reset();
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
                            init()
                            toastr["success"](data.success[count], "Success")
                            setTimeout(function () {
                                $('#formvaksin')[0].reset();
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
