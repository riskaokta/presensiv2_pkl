@extends('layouts.admin.tabler')
@section('content')
    <div class="page-header d-print-none">
        <div class="content-wrapper" style="margin-left: 250px;">
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
            <div class="page-body">
                <div class="container-xl">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <class class="card-body">
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
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-start gap-3">
                                                <!-- Tombol Tambah Data -->
                                                <a href="#" class="btn btn-primary d-flex align-items-center me-4"
                                                    id="btnTambahmahasiswa" data-bs-toggle="modal"
                                                    data-bs-target="#modal-inputmahasiswa">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="me-2">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M12 5l0 14" />
                                                        <path d="M5 12l14 0" />
                                                    </svg>
                                                    Tambah Data
                                                </a>

                                                <!-- Form Import -->
                                                <form action="{{ route('mahasiswa.import') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="file" name="file" id="file" class="d-none"
                                                        accept=".xlsx, .xls" required>

                                                    <button type="button" class="btn btn-success d-flex align-items-center"
                                                        onclick="document.getElementById('file').click()">
                                                        <i class="fas fa-file-import me-2"></i> Import
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        document.getElementById('file').addEventListener('change', function () {
                                            if (this.files.length > 0) {
                                                this.closest('form').submit();
                                            }
                                        });
                                    </script>



                                    <!-- Modal Import Excel -->
                                    <div class="modal fade" id="modal-importdata" tabindex="-1" aria-labelledby="modalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('mahasiswa.import') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalLabel">Import Data Mahasiswa</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Tutup"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="file" class="form-label">Pilih File Excel</label>
                                                            <input class="form-control" type="file" name="file" id="file"
                                                                accept=".xlsx, .xls" required>
                                                            <div class="form-text">Gunakan template: <strong>No, NPM, Nama,
                                                                    Program
                                                                    Studi, No HP, Foto, Tempat PKL</strong></div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Import</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
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
                                                            <select name="prodi" id="prodi" class="form-control">
                                                                <option value="">Program Studi</option>
                                                                @foreach ($prodi as $p)
                                                                    <option value="{{ $p }}">{{ $p }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
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
                                                        <tr class="text-center">
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
                                                                        <img src="{{ asset('assets/img/nopoto.png') }}"
                                                                            class="avatar" alt="" width="50" height="50">
                                                                    @else
                                                                        <img src="{{ url($path) }}" class="avatar" alt="" width="50"
                                                                            height="50">
                                                                    @endif
                                                                </td>
                                                                <td>{{ $d->tempat_pkl }}</td>
                                                                <td>
                                                                    <!-- Tombol Edit dan Hapus dalam baris yang sama -->
                                                                    <div class="d-flex justify-content-start">
                                                                        <!-- Tombol Edit dengan Icon -->
                                                                        <a href="#" class="btn btn-sm btn-primary edit me-2"
                                                                            data-npm="{{ $d->npm }}"
                                                                            data-nama="{{ $d->nama_mhs }}"
                                                                            data-prodi="{{ $d->prodi }}"
                                                                            data-nohp="{{ $d->nohp_mhs }}"
                                                                            data-tempat="{{ $d->tempat_pkl }}">
                                                                            <i class="fas fa-edit"></i> Edit
                                                                        </a>

                                                                        <!-- Tombol Hapus dengan Icon -->
                                                                        <!-- <form action="{{ route('mahasiswa.destroy', $d->npm) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                                                                @csrf
                                                                                                @method('DELETE')
                                                                                                <button type="submit" class="btn btn-sm btn-danger">
                                                                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                                                                </button>
                                                                                                </form> -->
                                                                        <form id="form-delete-{{ $d->npm }}"
                                                                            action="{{ route('mahasiswa.destroy', $d->npm) }}"
                                                                            method="POST" class="d-inline delete-form">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="button"
                                                                                class="btn btn-sm btn-danger btn-delete"
                                                                                data-npm="{{ $d->npm }}">
                                                                                <i class="fas fa-trash-alt"></i> Hapus
                                                                            </button>
                                                                        </form>

                                                                    </div>
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
                                </class>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bagian Tambah Data -->
    <div class="modal modal-blur fade" id="modal-inputmahasiswa" tabindex="-1" role="dialog" aria-modal="true">
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
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
                                        <option {{ Request('prodi') == $d ? 'selected' : ''}} value="{{ $d }}">
                                            {{ $d }}
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
            // Ketika tombol tambah mahasiswa diklik
            $("#btnTambahmahasiswa").click(function () {
                $("#modal-inputmahasiswa").modal("show"); //modalnya masih blm di tambah
            });

            // Ketika tombol edit diklik
            // $(".edit").click(function () {
            //     var npm = $(this).data('npm');
            $(document).on('click', '.edit', function (e) {
                e.preventDefault(); // <== ini penting agar tidak mengubah URL

                var npm = $(this).data('npm');

                // Tampilkan modal
                $('#modal-editmahasiswa').modal('show');
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
                                    error: function () {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Gagal memuat data untuk edit',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
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