<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::guard('mahasiswa')->check()) {

            $npm = Auth::guard('mahasiswa')->user()->npm;

            if (!empty($npm)) {
                $bulanini = date("m") * 1;
                $tahunini = date("Y");
                $hariini = date("Y-m-d");
                $presensihariini = DB::table('presensi')
                    ->join('mahasiswa', 'presensi.npm', '=', 'mahasiswa.npm')
                    ->where('presensi.npm', $npm)
                    ->where('presensi.tgl_presensi', $hariini)
                    ->select('presensi.*', 'mahasiswa.nama_mhs', 'mahasiswa.foto')
                    ->first();

                $historibulanini = DB::table('presensi')
                    ->where('npm', $npm)
                    ->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
                    ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
                    ->orderBy('tgl_presensi')
                    ->get();

                $rekappresensi = DB::table('presensi')
                    ->selectRaw('COUNT(npm) as jmlhadir')
                    ->where('npm', $npm)
                    ->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
                    ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
                    ->first();

                // $leaderboard = DB::table('absen')
                // ->join('mahasiswa', 'absen.npm', '=' 'mahasiswa.npm')
                // ->where('tgl_presensi', $hariini)
                // ->orderBy('jam_in')
                // ->get();

                $rekapizin = DB::table('pengajuan_izin')
                    ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin,SUM(IF(status ="s",1,0)) as jmlsakit')
                    ->where('npm', $npm)
                    ->whereRaw('MONTH(tgl_izin)="' . $bulanini . '"')
                    ->whereRaw('YEAR(tgl_izin)="' . $tahunini . '"')
                    ->first();


                // Jika tidak ada data absen, ambil data mahasiswa saja
                if (!$presensihariini) {
                    $presensihariini = DB::table('mahasiswa')
                        ->where('npm', $npm)
                        ->select('mahasiswa.nama_mhs', 'mahasiswa.foto')
                        ->first();

                    $presensihariini->jam_in = null;
                    $presensihariini->jam_out = null;
                }
                // dump($presensihariini);
                return view('dashboard.dashboard', compact('presensihariini'));

            } else {
                return redirect('/');
            }

        } else {
            return redirect('/');
        }

        // Query untuk mencari data absen hari ini
    }

    public function dashboardadmin()
    {
        $hariini = date("Y-m-d");
        $rekappresensi = DB::table('presensi')
            ->selectRaw('COUNT(npm) as jmlhadir')
            ->where('tgl_presensi', $hariini)
            ->first();


        $rekapizin = DB::table('pengajuan_izin')
            ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin,SUM(IF(status ="s",1,0)) as jmlsakit')
            ->where('tgl_izin', $hariini)
            ->first();
        return view('dashboard.dashboardadmin', compact('rekappresensi', 'rekapizin'));
    }
}


