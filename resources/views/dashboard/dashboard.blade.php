@extends('layouts.absensi')
@section('content')
<style>
    .logout {
        position: absolute;
        color: white;
        font-size: 30px;
        text-decoration: none;
        right: 8px;
    }

    .logout:hover {
        color: white;

    }
</style>
<div class="section" id="user-section">
    <a href="/proseslogout" class="logout"><ion-icon name="exit-outline"></ion-icon></a>
    <div id="user-detail">
        <div class="avatar">
            <!-- @if(!empty(Auth::guard('mahasiswa')->user()->foto))
                        @php
                            $path = Storage::url('uploads/mahasiswa/' . Auth::guard('mahasiswa')->user()->foto);
                        @endphp
                        <img src="{{ url($path) }}" alt="avatar" class="imaged w64" style="">
            @else -->
            <!-- <img src="assets/img/sample/avatar/pia.jpg" alt="avatar" class="imaged w64 rounded"> -->
            <!-- @endif -->

            <!-- ini akuteh pusing kenapa gambar gamau tampil hiss -->
            <img src="{{ asset('storage/uploads/mahasiswa/' . $presensihariini->foto) }}"
                alt="{{ $presensihariini->nama_mhs }}" class="imaged w64 rounded">


        </div>
        <div id="user-info">
            <h2 id="user-name">Riska Oktafia</h2>
            <span id="user-role">Mahasiswa</span>
        </div>
    </div>
</div>

<div class="section" id="menu-section">
    <div class="card">
        <div class="card-body text-center">
            <div class="list-menu">
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/presensi/izin" style="font-size: 40px;">
                            <ion-icon name="calendar-outline"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Izin</span>
                    </div>
                </div>

                <!-- <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="" class="danger" style="font-size: 40px;">
                            <ion-icon name="calendar-number"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Cuti</span>
                    </div>
                </div> -->
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/presensi/histori" class="warning" style="font-size: 40px;">
                            <ion-icon name="document-text"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Histori</span>
                    </div>
                </div>
                <!-- <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="" class="orange" style="font-size: 40px;">
                            <ion-icon name="location"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        Lokasi
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
<div class="section mt-2" id="presence-section">
    <div class="todaypresence">
        <div class="row">
            <div class="col-6">
                <div class="card gradasigreen">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                <ion-icon name="time-outline"></ion-icon>
                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle">Masuk</h4>
                                <!-- <span>{{ $presensihariini != null ? $presensihariini->jam_in : 'Belum Absen'}}</span> -->
                                <span>{{ $presensihariini != null && $presensihariini->jam_in != null ? $presensihariini->jam_in : 'Belum Absen' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card gradasired">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                <ion-icon name="timer-outline"></ion-icon>
                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle">Pulang</h4>
                                <span>{{ $presensihariini != null && $presensihariini->jam_out != null ? $presensihariini->jam_out : 'Belum Absen'}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- chart -->

    @php
        $totalHari = now()->daysInMonth; // Ganti dengan jumlah hari kerja/bulan
        $hadir = 5; // Ganti dengan data dari database
        $izin = 2; // Ganti dengan data dari database
        $sakit = 3; // Ganti dengan data dari database
        $persentaseHadir = ($totalHari > 0) ? ($hadir / $totalHari) * 100 : 0;
        $persentaseIzin = ($totalHari > 0) ? ($izin / $totalHari) * 100 : 0;
        $persentaseSakit = ($totalHari > 0) ? ($sakit / $totalHari) * 100 : 0;
    @endphp

    <div class="rekappresence">
        <div id="chartdiv"></div>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence primary">
                                <ion-icon name="log-in"></ion-icon>
                            </div>
                            <div class="presencedetail">
                                <h4 class="rekappresencetitle">Hadir</h4>
                                <span class="rekappresencedetail">{{ $hadir }} Hari
                                    ({{ number_format($persentaseHadir, 1) }}%)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence blue">
                                <ion-icon name="calendar-outline"></ion-icon>
                            </div>
                            <div class="presencedetail">
                                <h4 class="rekappresencetitle">Izin</h4>
                                <span class="rekappresencedetail">{{ $izin }} Hari
                                    ({{ number_format($persentaseIzin, 1) }}%)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence warning">
                                <ion-icon name="sad"></ion-icon>
                            </div>
                            <div class="presencedetail">
                                <h4 class="rekappresencetitle">Sakit</h4>
                                <span class="rekappresencedetail">{{ $sakit }} Hari
                                    ({{ number_format($persentaseSakit, 1) }}%)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="presencetab mt-2">
        <div class="tab-pane fade show active" id="pilled" role="tabpanel">
            <ul class="nav nav-tabs style1" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                        Bulan Ini
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                        Leaderboard
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content mt-2" style="margin-bottom:100px;">
            <div class="tab-pane fade show active" id="home" role="tabpanel">
                <ul class="listview image-listview">
                    <li>
                        <div class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="image-outline" role="img" class="md hydrated"
                                    aria-label="image outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Photos</div>
                                <span class="badge badge-danger">10</span>
                            </div>
                        </div>
                    </li>
                    <li>
                </ul>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel">
                <ul class="listview image-listview">
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>Riska Oktafia</div>
                                <!-- <span class="text-muted">Designer</span> -->
    <!-- </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>Riska Oktafia</div>
                                <span class="badge badge-primary">3</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>Riska Oktafia</div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div> --> -->
</div>
@endsection