<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>A4</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4
        }

        #title {
            /* font-family: Arial, Helvetica, sans-serif; */
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
        }

        .tabeldatamahasiswa {
            margin-top: 40px;
        }

        .tabeldatamahasiswa {
            padding: 3px;
        }

        .tabelpresensi {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            font-size: 10px;
        }

        .tabelpresensi tr th {
            border: 1px solid #131212;
            padding: 8px;
            background-color: #dbdbdb;
        }

        .tabelpresensi tr td {
            border: 1px solid #131212;
            padding: 5px;
            font-size: ;
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4 landscape">

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-10mm">

        <table style="width: 100%">
            <tr>
                <td>
                    <img src="{{ asset('assets/img/logouti.png') }}" width="70" height="70" alt="">
                </td>
                <td style="">
                    <span id="title" text-align: center;>
                        PRESENSI DAN CATATAN HARIAN MAHASISWA<br>
                        {{ $namabulan[$bulan] }} {{ $tahun }}<br>
                        Universitas Teknokrat Indonesia<br>
                    </span>
                    <span><i>Jl. ZA. Pagar Alam No.9-11, Labuhan Ratu, Kec.Kedaton, Kota Bandar Lampung</i></span>
                </td>
            </tr>
        </table>

        <table class="tabelpresensi">
            <tr>
                <th rowspan="2">NPM</th>
                <th rowspan="2">Nama Mahasiswa</th>
                <th colspan="31">Tanggal</th>
            </tr>
            <tr>
                <?php
for ($i = 1; $i <= 31; $i++) {
            ?>
                <th>{{ $i }}</th>
                <?php   
            }
            ?>
            </tr>
            @foreach ($rekap as $d)
                        <tr>
                            <td>{{ $d->npm }}</td>
                            <td>{{ $d->nama_mhs }}</td>

                            <?php
                for ($i = 1; $i <= 31; $i++) {
                    $tgl = "tgl_" . $i;
                        ?>
                            <td>{{ $d->$tgl }}</td>
                            <?php   
                        }
                        ?>
                        </tr>
            @endforeach
        </table>

        <table width="100%" style="margin-top:100px">
            <tr>
                <td></td>
                <td style="text-align: center">Bandar Lampung, {{ date('d-m-Y') }}</td>
            </tr>
            <tr>
                <td style="text-align: center; vertical-align:bottom height=" 100px">
                    <u>Nama</u><br>
                    <i><b>P3LT</b></i>
                </td>
                <td style="text-align: center; vertical-align:bottom">
                    <u>Nama</u><br>
                    <i><b>Petinggi</b></i>
                </td>
            </tr>
        </table>

    </section>

</body>

</html>