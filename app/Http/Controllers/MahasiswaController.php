<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;

use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::query();
        $query->select('mahasiswa.*', 'prodi');
        // $mahasiswa = DB::table('mahasiswa')->orderBy('nama_mhs')
        //     ->paginate(2);
        $query->orderBy('nama_mhs');
        $mahasiswa = $query->paginate(3);
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
        $npm = $request->npm;
        $nama_mhs = $request->nama_mhs;
        $prodi = $request->prodi;
        $nohp_mhs = $request->nohp_mhs;
        $tempat_pkl = $request->tempat_pkl;
        $password = Hash::make('12345');
        // $mahasiswa = DB::table('mahasiswa')->where('npm', $npm)->first();
        if ($request->hasFile('foto')) {
            $foto = $npm . "." . $request->filr('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }

        try {
            $data = [
                'npm' => $npm,
                'nama_mhs' => $nama_mhs,
                'prodi' => $prodi,
                'nohp_mhs' => $nohp_mhs,
                'tempat_pkl' => $tempat_pkl,
                'foto' => $foto,
                'password' => $password
            ];
            $simpan = DB::table('mahasiswa')->insert($data);
            if ($simpan) {
                if ($request->hasFile('foto')) {
                    $folderPath = "public/uploads/mahasiswa/";
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
            }
            return Redirect::back()->with(['success' => 'Data Berhasil di Simpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal di Simpan']);
        }
        // $request->validate([
        //     'npm' => 'required|unique:mahasiswa,npm',
        //     'nama_mhs' => 'required',
        //     'prodi' => 'required',
        //     'nohp_mhs' => 'required|numeric',
        //     'tempat_pkl' => 'nullable'
        // ]);

        // Mahasiswa::create([
        //     'npm' => $request->npm,
        //     'nama_mhs' => $request->nama_mhs,
        //     'prodi' => $request->prodi,
        //     'nohp_mhs' => $request->nohp_mhs,
        //     'tempat_pkl' => $request->tempat_pkl,
        // ]);


        // return response()->json(['message' => 'Mahasiswa berhasil ditambahkan!']);
    }

    public function edit(Request $request)
    {
        $npm = $request->npm;
        $mahasiswa = DB::table('mahasiswa')->where('npm', $npm)->first();
        return view('mahasiswa.edit');
    }
}
