<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @laravelPWA
  
    <!-- Sisipkan file CSS dan JavaScript Bootstrap -->
    <style>
        #totalBeban {
            color: red;
        }
        .text-right {
            text-align: right;
        }
        #card1 {
            margin-top: 100px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 0px;
            margin-bottom: 25px;
        }
        #card2 {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 0px;
        }

        .table-container {
            margin-top: 5cm;
        }

        .btn-group .btn {
            margin-right: 5px;
        }

        .btn-action {
            width: 60px;
        }

        body {
            height: 100vh;
        }

        .btn {
            margin-top: 29.5px;
        }
    </style>
</head>

<body style="background-color: rgba(0, 131, 116, 0.9)">
    @extends('layouts.laporan.calk.app')

    @section('content')

    <div class="container-fluid">
        <div class="card" id="card1">
            <div class="card-body">
                <h2><b>Catatan Atas Poisi Keuangan</b></h2>
                <br>
                <form id="tahunForm" method="POST" action="{{ route('note.post') }}">
                    @csrf
                    <table>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="selected_year">Pilih Tahun:</label>
                                <select class="form-select" name="selected_year" id="selected_year">
                                    @for ($year = date('Y'); $year >= 1900; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-success" type="submit">Tampilkan Laporan</button>
                            </div>
                        </div>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid mb-5">
        <div class="card card-rounded" id="card2" style="background-color: rgb(3, 160, 212);" class="text-right">
            <div class="table-responsive nowrap" style="width:100%;" id="reportTable">
                @if (isset($selectedYear))
                    <br>
                    @php
                        setlocale(LC_TIME, 'id_ID.utf8');
                        $startDate = strftime('%d %B %Y', strtotime("January 1, $selectedYear"));
                        $endDate = strftime('%d %B %Y', strtotime("December 31, $selectedYear"));
                    @endphp
                    <br>
                    <table id="accountsTable" class="table" style="table-layout: fixed" style="font-size: 12px;">
                        <thead>
                        <tr>
                                <center><h3 style="color: white">Catatan Atas Laporan Keuangan</h3></center>
                                <center><p style="color: white">{{ $startDate }} s.d {{ $endDate }}</p></center>
                                
                            </tr>
                            <tr >
                                <th ></th>
                                <th ></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td ><b>1. UMUM :</b></td>
                                <td></td>
                                <tr>
                                    <td style="background-color: rgb(92, 214, 255);">Saung Abah Ambu</td>
                                        <td style="background-color: rgb(92, 214, 255);"></td>
                                </tr>
                            </tr>
                            <tr>
                                <td ><b>2. IKHTISAR KEBIJAKAN AKUNTANSI PENTING :</b></td>
                                <td></td>
                                
                                <tr>
                                    <td style="background-color: rgb(92, 214, 255);"><b>a. Pernyataan Kepatuhan</b></td>
                                        <td style="background-color: rgb(92, 214, 255);"></td>
                                        <tr>
                                            <td style="background-color: rgb(92, 214, 255);">Laporan keuangan disusun berdasarkan Standar Akuntansi Keuangan Entitas Mikro, Kecil,
                                                dan Menengah (SAK EMKM).</td>
                                            <td style="background-color: rgb(92, 214, 255);">       </td>
                                        </tr>
                                </tr>
                                <tr>
                                    <td style="background-color: rgb(92, 214, 255);"><b>b. Dasar Penyusunan</b></td>
                                        <td style="background-color: rgb(92, 214, 255);"></td>
                                        <tr>
                                            <td style="background-color: rgb(92, 214, 255);">Dasar penyusunan laporan keuangan adalah biaya historis dan menggunakan asumsi
                                                dasar akrual. Mata uang penyajian yang digunakan untuk penyusunan laporan keuangan.</td>
                                            <td style="background-color: rgb(92, 214, 255);"></td>
                                        </tr>
                                </tr>
                                <tr>
                                    <td style="background-color: rgb(92, 214, 255);"><b>c. Piutang Usaha</b></td>
                                        <td style="background-color: rgb(92, 214, 255);"></td>
                                        <tr>
                                            <td style="background-color: rgb(92, 214, 255);">Piutang usaha disajikan sebesar jumlah tagihan.
                                            </td>
                                            <td style="background-color: rgb(92, 214, 255);"></td>
                                        </tr>
                                </tr>
                                <tr>
                                    <td style="background-color: rgb(92, 214, 255);"><b>d. Persediaan</b></td>
                                        <td style="background-color: rgb(92, 214, 255);"></td>
                                        <tr>
                                            <td style="background-color: rgb(92, 214, 255);">Entitas menggunakan sistem periodik.
                                            </td>
                                            <td style="background-color: rgb(92, 214, 255);"></td>
                                        </tr>
                                </tr>
                                <tr>
                                    <td style="background-color: rgb(92, 214, 255);"><b>e. Aset Tetap</b></td>
                                        <td style="background-color: rgb(92, 214, 255);"></td>
                                        <tr>
                                            <td style="background-color: rgb(92, 214, 255);">Aset tetap dicatat sebesar biaya perolehannya, jika aset tetap tersebut dimiliki secara
                                                hukum oleh entitas. Aset tetap disusutkan menggunakan metode penyusutan garis lurus.
                                            </td>
                                            <td style="background-color: rgb(92, 214, 255);"></td>
                                        </tr>
                                </tr>
                                <tr>
                                    <td style="background-color: rgb(92, 214, 255);"><b>f. Pengakuan Pendapatan dan Beban</b></td>
                                        <td style="background-color: rgb(92, 214, 255);"></td>
                                        <tr>
                                            <td style="background-color: rgb(92, 214, 255);">Pendapatan penjualan diakui ketika barang sudah keluar dari gudang dan dalam perjalanan
                                                ke pembeli baik melalui pembayaran secara tunai maupun secara kredit. Sedangkan beban
                                                diakui saat terjadi.
                                            </td>
                                            <td style="background-color: rgb(92, 214, 255);"></td>
                                        </tr>
                                </tr>
                            </tr>
                            <tr>
                                <td><b>3. Kas Saung Abah Ambu :</b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td  style="background-color: rgb(92, 214, 255);">- Kas</td>
                                <td  style="background-color: rgb(92, 214, 255);" class="text-right">{{ 'Rp ' . number_format($labaBersih, 0, ',', '.') }}</td>
                            </tr>
                            
                            <tr>
                                <td><b>4. Peralatan :</b></td>
                                <td></td>
                            </tr>
                            
                            <tr>
                                <td  style="background-color: rgb(92, 214, 255);">- Peralatan</td>
                                <td  style="background-color: rgb(92, 214, 255);" class="text-right">{{ 'Rp ' . number_format($totalPeralatan, 0, ',', '.') }}</td>
                            </tr>
                            
                            
                            <tr>
                                <td><b>5. Penjualan :</b></td>
                                <td></td>
                            </tr>
                            
                            @foreach ($incomes as $income)
                            <tr>
                                <td  style="background-color: rgb(92, 214, 255);">- {{ $income->account_name }}</td>
                                <td  style="background-color: rgb(92, 214, 255);" class="text-right">{{ 'Rp ' . number_format($income->total_inc, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td><b>6. Piutang</b></td>
                                <td></td>
                            </tr>
                            
                            <tr>
                                <td  style="background-color: rgb(92, 214, 255);">- Piutang Usaha</td>
                                <td  style="background-color: rgb(92, 214, 255);" class="text-right">{{ 'Rp ' . number_format($totalPiutang, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td><b>7. Utang :</b></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td  style="background-color: rgb(92, 214, 255);">- Utang Usaha</td>
                                <td  style="background-color: rgb(92, 214, 255);" class="text-right">{{ 'Rp ' . number_format($totalUtang, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td><b>8. Harga Pokok Produksi :</b></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td > - Harga Pokok Produksi</td>
                                <td  class="text-right"><b>{{ 'Rp ' . number_format($totalHPP, 0, ',', '.') }}</b></td>
                            </tr>

                            <tr>
                                <td><b>9. Perlengkapan :</b></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td  style="background-color: rgb(92, 214, 255);">Perlengkapan</td>
                                <td  style="background-color: rgb(92, 214, 255);" class="text-right">{{ 'Rp ' . number_format($totalPerlengkapan, 0, ',', '.') }}</td>
                            </tr>
                            
                            <tr>
                                <td ><b>10. Beban Beban :</b></td>
                                <td ></td>
                            </tr>
                           
                            <tr>
                                <td  style="background-color: rgb(92, 214, 255);">- <b>Beban Operasional :</b></td>
                                <td  style="background-color: rgb(92, 214, 255);" class="text-right"></td>
                            </tr>
                   
                            @foreach ($akumulasiOperasional as $operasional)
                                <tr>
                                    <td  style="background-color: rgb(92, 214, 255);">- {{ $operasional->account_name }}</td>
                                    <td  style="background-color: rgb(92, 214, 255);" class="text-right">({{ 'Rp ' . number_format($operasional->total_exp, 0, ',', '.') }})</td>
                                </tr>
                            @endforeach
                            <tr>
                            <tr>
                                <td  style="background-color: rgb(92, 214, 255);">- <b>Beban Tenaga Kerja :</b></td>
                                <td  style="background-color: rgb(92, 214, 255);" class="text-right"></td>
                            </tr>
                   
                            @foreach ($akumulasiTenagaKerja as $tenagakerja)
                                <tr>
                                    <td  style="background-color: rgb(92, 214, 255);">- {{ $tenagakerja->account_name }}</td>
                                    <td  style="background-color: rgb(92, 214, 255);" class="text-right">({{ 'Rp ' . number_format($tenagakerja->total_exp, 0, ',', '.') }})</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td  style="background-color: rgb(92, 214, 255);">- <b>Overhead Pabrik :</b></td>
                                <td  style="background-color: rgb(92, 214, 255);" class="text-right"></td>
                            </tr>
                   
                            @foreach ($akumulasiOverhead as $overhead)
                                <tr>
                                    <td  style="background-color: rgb(92, 214, 255);">- {{ $overhead->account_name }}</td>
                                    <td  style="background-color: rgb(92, 214, 255);" class="text-right">({{ 'Rp ' . number_format($overhead->total_exp, 0, ',', '.') }})</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td  style="background-color: rgb(92, 214, 255);" style="color:red"><b>Total Beban</b></td>
                                <td  style="background-color: rgb(92, 214, 255);" class="text-right" id="totalBeban"><b> ({{  'Rp' . number_format($totalBeban, 0, ',', '.') }})</b></td>
                            </tr>
                            
                           
                        </tbody>
                    </table>
                    <script>setMobileTable('table')</script>
                @endif
            </div>
        </div>
    </div>
    @endsection

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.getElementById('cetakButton').addEventListener('click', function () {
            window.print();
        });
    </script>
</body>
</html>
