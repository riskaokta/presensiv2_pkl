@extends('layouts.admin.tabler')
@section('content')
    <div class="page-header d-print-none">
        <div class="content-wrapper" style="margin-left: 250px;">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Overview
                        </div>
                        <h2 class="page-title">
                            Dashboard
                        </h2>
                    </div>
                </div>
            </div>

            <div class="page-body">
                <div class="container-xl">
                    <div class="row"> <!-- Pastikan semua widget berada dalam satu row -->

                        <!-- <div class="col-md-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <span class="bg-primary text-white avatar me-3">
                                                    <i class="ti ti-users"></i>
                                                </span>
                                                <div>
                                                    <div class="font-weight-medium">65</div>
                                                    <div class="text-secondary">Total Mahasiswa</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <span class="bg-success text-white avatar me-3">
                                                    <i class="ti ti-checklist"></i>
                                                </span>
                                                <div>
                                                    <div class="font-weight-medium">{{ $rekappresensi->jmlhadir }}</div>
                                                    <div class="text-secondary">Mahasiswa Hadir</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <span class="bg-info text-white avatar me-3">
                                                    <i class="ti ti-notebook"></i>
                                                </span>
                                                <div>
                                                    <div class="font-weight-medium">{{ $rekapizin->jmlizin ?? 0 }}</div>
                                                    <div class="text-secondary">Mahasiswa Izin</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <span class="bg-warning text-white avatar me-3">
                                                    <i class="ti ti-mood-sick"></i>
                                                </span>
                                                <div>
                                                    <div class="font-weight-medium">{{ $rekapizin->jmlsakit ?? 0 }}</div>
                                                    <div class="text-secondary">Mahasiswa Sakit</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                        <div class="col-md-3">
                            <div class="card card-sm bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="fw-bold fs-2">65</div>
                                            <div class="text-white-75">Total Mahasiswa</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card card-sm bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="fw-bold fs-2">{{ $rekappresensi->jmlhadir }}</div>
                                            <div class="text-white-75">Mahasiswa Hadir</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card card-sm bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="fw-bold fs-2">{{ $rekapizin->jmlizin ?? 0 }}</div>
                                            <div class="text-white-75">Mahasiswa Izin</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card card-sm bg-danger text-white">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="fw-bold fs-2">{{ $rekapizin->jmlsakit ?? 0 }}</div>
                                            <div class="text-white-75">Mahasiswa Sakit</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div> <!-- Tutup row -->
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection