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
                <input type="text" value="" id="nohp_mhs" class="form-control" name="nohp_mhs" placeholder="Nomor HP">
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