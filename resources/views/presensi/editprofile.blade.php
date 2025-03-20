@extends('layouts.absensi')
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Edit Profile</div>
    <div class="right"></div>
</div>
<!-- App Header -->
@endsection

@section('content')
<div class="row" style="margin-top:4rem">
    <div class="col">
        @php
            $messagesuccess = Session::get('success');
            $messageerror = Session::get('error');
        @endphp
        @if(Session::get('success'))
            <div class="alert alert-success">
                {{ $messagesuccess}}
            </div>
        @endif
        @if(Session::get('error'))
            <div class="alert alert-danger">
                {{ $messageerror}}
            </div>
        @endif
    </div>
</div>
<form action="/presensi/{{ $mahasiswa->npm }}/updateprofile" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="col">
        <!-- NPM -->
        <div class="form-group boxed" style="margin-bottom: 1px;">
            <label for="npm">NPM</label>
            <div class="input-wrapper">
                <input type="text" class="form-control" value="{{ $mahasiswa->npm }}" name="npm" id="npm"
                    placeholder="NPM" autocomplete="off" style="padding-left: 15px;">
            </div>
        </div>

        <!-- Nama Lengkap -->
        <div class="form-group boxed" style="margin-bottom: 1px;">
            <label for="nama_lengkap">Nama Lengkap</label>
            <div class="input-wrapper">
                <input type="text" class="form-control" value="{{ $mahasiswa->nama_mhs }}" name="nama_lengkap"
                    id="nama_lengkap" placeholder="Nama Lengkap" autocomplete="off">
            </div>
        </div>

        <!-- Program Studi -->
        <div class="form-group boxed" style="margin-bottom: 1px;">
            <label for="prodi">Program Studi</label>
            <div class="input-wrapper">
                <input type="text" class="form-control" value="{{ $mahasiswa->prodi }}" name="prodi" id="prodi"
                    placeholder="Program Studi" autocomplete="off">
            </div>
        </div>

        <!-- No. HP -->
        <div class="form-group boxed" style="margin-bottom: 1px;">
            <label for="no_hp">No. HP</label>
            <div class="input-wrapper">
                <input type="text" class="form-control" value="{{ $mahasiswa->nohp_mhs }}" name="no_hp" id="no_hp"
                    placeholder="No. HP" autocomplete="off">
            </div>
        </div>

        <!-- Password -->
        <div class="form-group boxed" style="margin-bottom: 1px;">
            <label for="password">Password</label>
            <div class="input-wrapper">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                    autocomplete="off">
            </div>
        </div>

        <!-- File Upload with Smaller Square Icon -->
        <div class="custom-file-upload" id="fileUpload1" style="text-align: center; margin-top: 1rem;">
            <input type="file" name="foto" id="fileuploadInput" accept=".png, .jpg, .jpeg" style="display: none;">
            <label for="fileuploadInput"
                style="display: inline-block; background-color: #f0f0f0; padding: 15px; cursor: pointer; border: 2px solid #007bff; border-radius: 5px;">
                <span>
                    <ion-icon name="cloud-upload-outline" role="img" class="md hydrated"
                        aria-label="cloud upload outline" style="font-size: 24px; color: #007bff;"></ion-icon>
                </span>
            </label>
            <p><strong><i>Tap to Upload</i></strong></p>
        </div>



        <!-- Submit Button -->
        <div class="form-group boxed">
            <div class="input-wrapper">
                <button type="submit" class="btn btn-primary btn-block">
                    <ion-icon name="refresh-outline"></ion-icon>
                    Update
                </button>
            </div>
        </div>
    </div>
</form>
@endsection