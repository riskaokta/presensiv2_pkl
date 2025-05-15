<?php

namespace App\Exports;

use App\Models\Presensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

// class PresensiExport implements FromCollection, WithHeadings
// {
//     public function collection()
//     {
//         return Presensi::select('id', 'nama_mahasiswa', 'tanggal', 'jam_masuk', 'jam_keluar')->get();
//     }

//     public function headings(): array
//     {
//         return ['ID', 'Nama Mahasiswa', 'Tanggal', 'Jam Masuk', 'Jam Keluar'];
//     }
// }

// class PresensiExport implements FromCollection, WithHeadings
// {
//     protected $bulan, $tahun, $npm;

//     public function __construct($bulan, $tahun, $npm)
//     {
//         $this->bulan = $bulan;
//         $this->tahun = $tahun;
//         $this->npm = $npm;
//     }

//     public function collection()
//     {
//         return Presensi::whereMonth('tanggal', $this->bulan)
//             ->whereYear('tanggal', $this->tahun)
//             ->when($this->npm, fn($q) => $q->where('npm', $this->npm))
//             ->select('id', 'nama_mhs', 'tgl_presensi', 'jam_in', 'jam_out')
//             ->get();
//     }

//     public function headings(): array
//     {
//         return ['ID', 'Nama Mahasiswa', 'Tanggal', 'Jam Masuk', 'Jam Keluar'];
//     }
// }

