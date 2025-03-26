<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Redirect;

class PresensiController extends Controller
{
        public function create()
        {
                $hariini = date("Y-m-d"); //Dapatkan tanggal hari ini
                $npm = Auth::guard('mahasiswa')->user()->npm; //Ambil NPM pengguna

                //Periksa apakah sudah ada presensi untuk hari ini
                $cek = DB::table('presensi')
                        ->where('tgl_presensi', $hariini)
                        ->where('npm', $npm)
                        ->count();

                //Kirim data ke view
                return view('presensi.create', compact('cek'));
        }

        public function store(Request $request)
        {

                //video ke7
                $npm = Auth::guard('mahasiswa')->user()->npm;
                $tgl_presensi = date("Y-m-d");
                $jam = carbon::now('Asia/Jakarta')->format('H:i:s');
                $lokasi = $request->lokasi;
                $image = $request->image;
                $folderPath = "public/uploads/presensi";
                $formatName = $npm . "-" . $tgl_presensi;
                $image_parts = explode(";base64", $image);
                $image_base64 = base64_decode($image_parts[1]);
                $fileName = $formatName . ".png";
                $file = $folderPath . $fileName;
                $catat_harian = $request->catat_harian;

                $cek = DB::table('presensi')
                        ->where('tgl_presensi', $tgl_presensi)
                        ->where('npm', $npm)
                        ->count();
                if ($cek > 0) {
                        $data_pulang = [
                                'jam_out' => $jam,
                                'foto_out' => $fileName,
                                'lokasi_out' => $lokasi,
                                'catat_harian' => $catat_harian
                        ];
                        $update = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('npm', $npm)->update($data_pulang);
                        if ($update) {
                                echo "succes|Terimakasih, Hati-Hati di Jalan|out";
                                Storage::put($file, $image_base64);
                        } else {
                                echo "error|Maaf Gagal Absen, Hubungi Tim PUSTIK|out";
                        }
                } else {
                        $data = [
                                'npm' => $npm,
                                'tgl_presensi' => $tgl_presensi,
                                'jam_in' => $jam,
                                'foto_in' => $fileName,
                                'lokasi_in' => $lokasi
                        ];

                        $simpan = DB::table('presensi')->insert($data);
                        if ($simpan) {
                                echo "succes|Terimakasih, Selamat Beraktivitas|in";
                                Storage::put($file, $image_base64);
                        } else {
                                echo "error|Maaf Gagal Absen, Hubungi Tim PUSTIK|out";
                        }

                }


        }

        public function editprofile()
        {
                $npm = Auth::guard('mahasiswa')->user()->npm;
                $mahasiswa = DB::table('mahasiswa')->where('npm', $npm)->first();
                // dd($mahasiswa);

                return view('presensi.editprofile', compact('mahasiswa'));
        }

        public function updateprofile(Request $request)
        {
                $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_lengkap = $request->nama_lengkap;
                $no_hp = $request->no_hp;
                $password = Hash::make($request->password);
                $mahasiswa = DB::table('mahasiswa')->where('npm', $npm)->first();
                if ($request->hasFile('foto')) {
                        $foto = $npm . "." . $request->file('foto')->getClientOriginalExtension();
                } else {
                        $foto = $mahasiswa->foto;
                }
                if (empty($request->password)) {
                        $data = [
                                'nama_mhs' => $nama_lengkap,
                                'nohp_mhs' => $no_hp,
                                'foto' => $foto
                        ];
                } else {
                        $data = [
                                'nama_mhs' => $nama_lengkap,
                                'nohp_mhs' => $no_hp,
                                'password' => $password,
                                'foto' => $foto
                        ];
                }

                $update = DB::table('mahasiswa')->where('npm', $npm)->update($data);
                if ($update) {
                        if ($request->hasFile('foto')) {
                                $folderPath = "public/uploads/mahasiswa/";
                                $request->file('foto')->storeAs($folderPath, $foto);
                        }
                        return Redirect::back()->with(['success' => 'Data Berhasil di Ubah']);
                } else {
                        return Redirect::back()->with(['error' => 'Data Gagal di Ubah']);
                }
        }

        public function histori()
        {
                $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                return view('presensi.histori', compact('namabulan'));
        }

        public function gethistori(Request $request)
        {
                $bulan = $request->bulan;
                $tahun = $request->tahun;
                $npm = Auth::guard('mahasiswa')->user()->npm;

                $histori = DB::table('presensi')
                        ->join('mahasiswa', 'presensi.npm', '=', 'mahasiswa.npm') // Melakukan join berdasarkan kolom npm
                        ->whereRaw('MONTH(tgl_presensi) = "' . $bulan . '"')
                        ->whereRaw('YEAR(tgl_presensi) = "' . $tahun . '"')
                        ->where('presensi.npm', $npm)
                        ->orderBy('tgl_presensi')
                        ->select('presensi.*', 'mahasiswa.nama_mhs', 'mahasiswa.prodi') // Menentukan kolom yang ingin dipilih
                        ->get();
                // Menghitung total jam dari setiap entry
                // Menghitung total waktu keseluruhan
                $totalSeconds = 0;

                foreach ($histori as $h) {
                        if ($h->jam_in && $h->jam_out) {
                                $jamMasuk = Carbon::parse($h->jam_in);
                                $jamKeluar = Carbon::parse($h->jam_out);
                                $totalSeconds += $jamKeluar->diffInSeconds($jamMasuk);
                        }
                }

                // Konversi total detik ke format jam:menit:detik
                $totalHours = floor($totalSeconds / 3600);
                $totalMinutes = floor(($totalSeconds % 3600) / 60);
                $totalSeconds = $totalSeconds % 60;

                $total_waktu = sprintf("%02d:%02d:%02d", $totalHours, $totalMinutes, $totalSeconds);

                return view('presensi.gethistori', compact('histori', 'total_waktu'));

        }

        public function izin()
        {
                $npm = Auth::guard('mahasiswa')->user()->npm;
                $dataizin = DB::table('pengajuan_izin')->where('npm', $npm)->get();
                return view('presensi.izin', compact('dataizin'));
        }

        public function buatizin()
        {
                return view('presensi.buatizin');
        }

        public function storeizin(Request $request)
        {
                $npm = Auth::guard('mahasiswa')->user()->npm;
                $tgl_izin = $request->tgl_izin;
                $status = $request->status;
                $lampiran = $request->lampiran;

                $data = [
                        // 'id' => 1, //tambah random value, mubeng
                        'id' => mt_rand(1, 999999999),
                        'npm' => $npm,
                        'tgl_izin' => $tgl_izin,
                        'status' => $status,
                        'lampiran' => $lampiran
                ];

                $simpan = DB::table('pengajuan_izin')->insert($data);

                if ($simpan) {
                        return redirect('/presensi/izin')->with(['success' => 'Data Berhasil di Simpan']);
                } else {
                        return redirect('/presensi/izin')->with(['error' => 'Data Gagal di Simpan']);
                }
        }

        public function monitoring()
        {
                return view('presensi.monitoring');
        }

        public function getpresensi(Request $request)
        {
                $tanggal = $request->tanggal;
                $presensi = DB::table('presensi')
                        ->join('mahasiswa', 'presensi.npm', '=', 'mahasiswa.npm')
                        ->select('presensi.*', 'mahasiswa.nama_mhs', 'mahasiswa.prodi')
                        ->where('tgl_presensi', $tanggal)
                        ->get();

                return view('presensi.getpresensi', compact('presensi'));
        }

        public function tampilkanpeta(Request $request)
        {
                $id = $request->id;
                $presensi = DB::table('presensi')->where('id', $id)
                        ->join('mahasiswa', 'presensi.npm', '=', 'mahasiswa.npm')
                        ->first();
                return view('presensi.showmap', compact('presensi'));
        }

        public function laporan()
        {
                $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                $mahasiswa = DB::table('mahasiswa')->orderBy('nama_mhs')->get();
                return view('presensi.laporan', compact('namabulan','mahasiswa'));
        }

        public function cetaklaporan(Request $request){
                $npm = $request->npm;
                $bulan = $request->bulan;
                $tahun = $request->tahun;
                $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                $mahasiswa = DB::table('mahasiswa')->where('npm', $npm)->first();

                $presensi = DB::table('presensi')
                ->where('npm', $npm)
                ->whereRaw('MONTH(tgl_presensi)="' . $bulan .'"')
                ->whereRaw('YEAR(tgl_presensi)="' . $tahun .'"')
                ->get();
                return view('presensi.cetaklaporan', compact('bulan','tahun','namabulan','mahasiswa','presensi'));
        }
}





