@extends('layouts.admin.tabler')
@section('content')
    <div class="page-header d-print-none">
        <div class="content-wrapper" style="margin-left: 250px;">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Mahasiswa</div>
                        <!-- seluruh mahasiswa -->
                        <h2 class="page-title">Rekap Presensi</h2>
                    </div>
                </div>
            </div>

            <div class="page-body">
                <div class="container-xl">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card shadow-sm border-light bg-dark text-white p-4">
                                <div class="card-body">
                                    <form action="/presensi/cetakrekap" target="_blank" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="bulan" class="form-label">Bulan</label>
                                            <select name="bulan" id="bulan" class="form-select w-100">
                                                <option value="">Pilih Bulan</option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}" {{ date("m") == $i ? 'selected' : '' }}>
                                                        {{ $namabulan[$i] }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tahun" class="form-label">Tahun</label>
                                            <select name="tahun" id="tahun" class="form-select w-100">
                                                <option value="">Pilih Tahun</option>
                                                @php
                                                    $tahunmulai = 2024;
                                                    $tahunskrg = date("Y");
                                                @endphp
                                                @for($tahun = $tahunmulai; $tahun <= $tahunskrg; $tahun++)
                                                    <option value="{{ $tahun }}" {{ date("Y") == $tahun ? 'selected' : '' }}>
                                                        {{ $tahun }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-6 pe-1">
                                                <button type="submit"
                                                    class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-print me-2"></i> Cetak
                                                </button>
                                            </div>
                                            <div class="col-6 ps-1">
                                                <button type="submit" name="exportexcel"
                                                    class="btn btn-success w-100 d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-file-excel me-2"></i> Export to Excel
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection