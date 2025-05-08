<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;

use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpSpreadsheet\IOFactory;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::query();
        $query->select('mahasiswa.*', 'prodi');
        // $mahasiswa = DB::table('mahasiswa')->orderBy('nama_mhs')
        //     ->paginate(2);
        $query->orderBy('nama_mhs');
        $mahasiswa = $query->paginate(5
    
    );
        if (!empty($request->nama_mhs)) {
            $query->where('nama_mhs', 'like', '%' . $request->nama_mhs . '%'); //belum jalan search
        }

        if (!empty($request->prodi)) {
            $query->where('prodi', $request->prodi);
        }

        $prodi = DB::table('mahasiswa')->get();

        return view('mahasiswa.index', compact('mahasiswa', 'prodi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'npm' => 'required|unique:mahasiswa,npm',
            'nama_mhs' => 'required',
            'prodi' => 'required',
            'nohp_mhs' => 'required|numeric',
            'tempat_pkl' => 'nullable',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->npm . '.' . $request->file('foto')->getClientOriginalExtension();
        }

        try {
            $data = [
                'npm' => $request->npm,
                'nama_mhs' => $request->nama_mhs,
                'prodi' => $request->prodi,
                'nohp_mhs' => $request->nohp_mhs,
                'tempat_pkl' => $request->tempat_pkl,
                'foto' => $foto,
                'password' => Hash::make('12345')
            ];

            DB::table('mahasiswa')->insert($data);

            if ($foto) {
                $request->file('foto')->storeAs('public/uploads/mahasiswa/', $foto);
            }

            return Redirect::back()->with(['success' => 'Data berhasil disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data gagal disimpan']);
        }
    }

    public function importExcel(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        // Dapatkan path file Excel yang diupload
        $path = $request->file('file')->getRealPath();

        // Load file Excel
        $spreadsheet = IOFactory::load($path);

        // Ambil data dari sheet pertama
        $data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        // Loop untuk setiap baris data
        foreach ($data as $index => $row) {
            // Pastikan kita melewatkan header atau baris kosong
            if ($index == 1 || empty($row['A'])) {
                continue; // Lewatkan baris pertama atau baris kosong
            }
            $namaPerusahaan = empty($row['G']) ? 'Tidak Tersedia' : $row['G'];
            // Simpan data ke database
            Mahasiswa::create([
                'npm' => $row['B'],           // Kolom B adalah NPM
                'nama_mhs' => $row['C'],      // Kolom C adalah Nama Mahasiswa
                'nohp_mhs' => $row['D'],      // Kolom D adalah No HP
                'prodi' => $row['E'],         // Kolom E adalah Program Studi
                'tempat_pkl' => $namaPerusahaan, // Kolom F adalah Nama Perusahaan
                // 'ipk' => $row['G'], // Kolom G adalah IPK, namun tidak akan dimasukkan
            ]);
        }

        // Berikan notifikasi sukses
        return back()->with('success', 'Data berhasil diimpor!');
    }

    // public function edit(Request $request)
    // {
    //     $npm = $request->npm;
    //     $mahasiswa = Mahasiswa::where('npm', $npm)->first();
    //     $prodi = Prodi::all();

    //     return view('mahasiswa.editform', compact('mahasiswa', 'prodi'));
    // }
    public function edit(Request $request)
    {
        $mhs = Mahasiswa::where('npm', $request->npm)->first();
        if ($mhs) {
            return view('mahasiswa.edit-form', compact('mhs'));
        }
        return response()->json(['error' => 'Mahasiswa tidak ditemukan'], 404);
    }


}
