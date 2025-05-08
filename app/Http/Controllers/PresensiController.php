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

        public function rekap()
        {
                $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                return view('presensi.rekap', compact('namabulan'));
        }

        public function cetakrekap(Request $request)
        {
                $bulan = $request->bulan;
                $tahun = $request->tahun;
                $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                $rekap = DB::table('presensi')
                        ->selectRaw('presensi.npm,nama_mhs,
                MAX(IF(DAY(tgl_presensi) = 1,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_1,
                MAX(IF(DAY(tgl_presensi) = 2,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_2,
                MAX(IF(DAY(tgl_presensi) = 3,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_3,
                MAX(IF(DAY(tgl_presensi) = 4,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_4,
                MAX(IF(DAY(tgl_presensi) = 5,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_5,
                MAX(IF(DAY(tgl_presensi) = 6,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_6,
                MAX(IF(DAY(tgl_presensi) = 7,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_7,
                MAX(IF(DAY(tgl_presensi) = 8,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_8,
                MAX(IF(DAY(tgl_presensi) = 9,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_9,
                MAX(IF(DAY(tgl_presensi) = 10,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_10,
                MAX(IF(DAY(tgl_presensi) = 11,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_11,
                MAX(IF(DAY(tgl_presensi) = 12,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_12,
                MAX(IF(DAY(tgl_presensi) = 13,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_13,
                MAX(IF(DAY(tgl_presensi) = 14,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_14,
                MAX(IF(DAY(tgl_presensi) = 15,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_15,
                MAX(IF(DAY(tgl_presensi) = 16,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_16,
                MAX(IF(DAY(tgl_presensi) = 17,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_17,
                MAX(IF(DAY(tgl_presensi) = 18,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_18,
                MAX(IF(DAY(tgl_presensi) = 19,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_19,
                MAX(IF(DAY(tgl_presensi) = 20,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_20,
                MAX(IF(DAY(tgl_presensi) = 21,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_21,
                MAX(IF(DAY(tgl_presensi) = 22,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_22,
                MAX(IF(DAY(tgl_presensi) = 23,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_23,
                MAX(IF(DAY(tgl_presensi) = 24,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_24,
                MAX(IF(DAY(tgl_presensi) = 25,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_25,
                MAX(IF(DAY(tgl_presensi) = 26,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_26,
                MAX(IF(DAY(tgl_presensi) = 27,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_27,
                MAX(IF(DAY(tgl_presensi) = 28,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_28,
                MAX(IF(DAY(tgl_presensi) = 29,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_29,
                MAX(IF(DAY(tgl_presensi) = 30,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_30,
                MAX(IF(DAY(tgl_presensi) = 31,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_31')
                        ->join('mahasiswa', 'presensi.npm', '=', 'mahasiswa.npm')
                        ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
                        ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
                        ->groupByRaw('presensi.npm,nama_mhs')
                        ->get();
                return view('presensi.cetakrekap', compact('bulan', 'tahun', 'namabulan', 'rekap'));
        }

        public function cetakhistorimhs(Request $request)
        {
                $npm = $request->npm;
                $bulan = $request->bulan;
                $tahun = $request->tahun;
                $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                $mahasiswa = DB::table('mahasiswa')->where('npm', $npm)->first();

                $presensi = DB::table('presensi')
                        ->where('npm', $npm)
                        ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
                        ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
                        ->get();
                return view('presensi.cetakhistorimhs', compact('bulan', 'tahun', 'namabulan', 'mahasiswa', 'presensi'));
        }
}






