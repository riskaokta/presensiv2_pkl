@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Mahasiswa
                </div>
                <h2 class="page-title">
                    Data Mahasiswa
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if (Session::get('success'))
                                    <div class="alert alert-success">
                                        {{Session::get('success') }}
                                    </div>
                                @endif

                                @if (Session::get('warning'))
                                    <div class="alert alert-warning">
                                        {{Session::get('warning') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <a href="#" class="btn btn-primary" id="btnTambahmahasiswa" data-bs-toggle="modal"
                                data-bs-target="#modal-inputmahasiswa">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>Tambah Data</a>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <form action="/mahasiswa" method="GET">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" name="nama_mahasiswa" id="nama_mahasiswa"
                                                    class="form-control" placeholder="Nama Mahasiswa"
                                                    value="{{ Request('nama_mhs')}}">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <select name="prodi" id="prodi" class="form-control"> //ini seharusnya
                                                    form select
                                                    <option value="">Program Studi</option>
                                                    @foreach ($prodi as $d)
                                                        <option {{ Request('prodi') == $d->prodi ? 'selected' : ''}}
                                                            value="{{ $d->prodi }}">{{ $d->prodi }}</option> //search belum
                                                        jalan
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                        <path d="M21 21l-6 -6" />
                                                    </svg>
                                                    Cari</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row mt-2">
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NPM</th>
                                                <th>Nama</th>
                                                <th>Program Studi</th>
                                                <th>No HP</th>
                                                <th>Foto</th>
                                                <th>Tempat PKL</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($mahasiswa as $d)
                                                                                        @php
                                                                                            $path = Storage::url('uploads/mahasiswa/' . $d->foto)
                                                                                        @endphp
                                                                                        <tr>
                                                                                            <td>{{ $loop->iteration + $mahasiswa->firstItem() - 1 }}</td>
                                                                                            <td>{{ $d->npm }}</td>
                                                                                            <td>{{ $d->nama_mhs }}</td>
                                                                                            <td>{{ $d->prodi }}</td>
                                                                                            <td>{{ $d->nohp_mhs }}</td>
                                                                                            <!-- foto belum muncul -->
                                                                                            <td>
                                                                                                @if (empty($d->foto))
                                                                                                    <img src="{{ asset('assets/img/nopoto.png') }}" class="avatar"
                                                                                                        alt="" width="50" height="50">
                                                                                                @else
                                                                                                    <img src="{{ url($path) }}" class="avatar" alt="" width="50"
                                                                                                        height="50">
                                                                                                @endif
                                                                                            </td>
                                                                                            <td>{{ $d->tempat_pkl }}</td>
                                                                                            <td>
                                                                                                <a href="#" class="edit" npm="{{ $d->npm }}">
                                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                                                        stroke-width="2" stroke-linecap="round"
                                                                                                        stroke-linejoin="round"
                                                                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                                                        <path
                                                                                                            d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                                                                        <path
                                                                                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                                                                        <path d="M16 5l3 3" />
                                                                                                    </svg>
                                                                                                </a>
                                                                                            </td>
                                                                                        </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- pagination belum muncul -->
                                    {{ $mahasiswa->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade show" id="modal-inputmahasiswa" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-1 modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/mahasiswa/store" method="POST" id="formMhs" enctype="multipart/form-data">
                    @csrf
                    <!-- NPM -->
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                                <!-- <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    </svg>
                                </span> -->
                                <input type="text" value="" class="form-control" name="npm" id="npm" placeholder="NPM">
                            </div>
                        </div>
                    </div>

                    <!-- NAMA -->
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                                <input type="text" value="" class="form-control" name="nama_mhs" id="nama_mhs"
                                    placeholder="Nama Lengkap">
                            </div>
                        </div>
                    </div>

                    <!-- PROGRAM STUDI -->
                    <div class="row">
                        <div class="col-12">
                            <select name="prodi" id="prodi" class="form-control">
                                <option value="">Program Studi</option>
                                @foreach ($prodi as $d)
                                    <option {{ Request('prodi') == $d->prodi ? 'selected' : ''}} value="{{ $d->prodi }}">
                                        {{ $d->prodi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- NO HP -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                                <input type="text" value="" id="nohp_mhs" class="form-control" name="nohp_mhs"
                                    placeholder="Nomor HP">
                            </div>
                        </div>
                    </div>

                    <!-- TEMPAT PKL -->
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                                <input type="text" value="" class="form-control" id="tempat_pkl" name="tempat_pkl"
                                    placeholder="Tempat PKL">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <input type="file" name="foto" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="c0l-12">
                            <div class="form-group">
                                <button class="btn btn-primary w-100">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit -->
<div class="modal modal-blur fade show" id="modal-editmahasiswa" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-1 modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="loadeditform">

            </div>
        </div>
    </div>
</div>
@endsection

@push('myscript')
    <script>
        $(function () {
            $("#btnTambahmahasiswa").click(function () {
                $("#modal-inputmahasiswa").modal("show"); //modalnya masih blm di tambah
            });

            $(".edit").click(function () {
                var npm = $(this).attr('npm');
                // alert(npm);
                $.ajax({
                    type: 'POST',
                    url: '/mahasiswa/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        npm: npm,
                    },
                    success: function (respond) {
                        $("#loadeditform").html(respond);
                    }
                });
                $("#modal-editmahasiswa").modal("show"); //modalnya masih blm di tambah
            });

            $("#formMhs").submit(function () {
                var npm = $("#npm").val();
                var nama_mhs = $("#nama_mhs").val();
                var prodi = $("frmMhs").find("#prodi").val();
                var nohp_mhs = $("#nohp_mhs").val();
                var tempat_pkl = $("#tempat_pkl").val();

                if (npm == "") {
                    // alert('NPM Harus di Isi');
                    Swal.fire({
                        title: 'Warning!',
                        text: 'NPM Harus di Isi',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $('#npm').focus();
                    });
                    return false;
                }

                if (nama_mhs == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Nama Mahasiswa Harus di Isi',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    });
                    return false;
                }

                if (prodi == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Silakan Pilih Program Studi',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    });
                    return false;
                }

                if (nohp_mhs == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Nomor HP Harus di Isi',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    });
                    return false;
                }

                // Jika semua validasi lolos, submit form dengan AJAX
                $.ajax({
                    url: $("#formMhs").attr("action"),
                    method: "POST",
                    data: $("#formMhs").serialize(),
                    success: function (response) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Mahasiswa berhasil ditambahkan',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(); // Refresh halaman setelah berhasil
                            }
                        });
                    },
                    error: function (xhr) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat menyimpan data',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                });
            });
        });

        $("#modal-inputmahasiswa").on("hidden.bs.modal", function () {
            $(".modal-backdrop").remove(); // Hapus backdrop saat modal ditutup
        });
    </script>
@endpush