<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
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
                <h2><b>Laporan Posisi Keuangan</b></h2>
                <br>
                <form id="tahunForm" method="POST" action="{{ route('financial.post') }}">
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
                    <table id="accountsTable" class="table " style="font-size: 12px;">
                        <thead>
                        <tr>
                                <center><h3 style="color: white">Laporan Posisi Keuangan</h3></center>
                                <center><p style="color: white">{{ $startDate }} s.d {{ $endDate }}</p></center>
                                
                            </tr>
                            <tr >
                                <th >Aset :</th>
                                <th ></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td ><b>Aset Lancar :</b></td>
                                <td ></td>
                            </tr>
                            <tr>
                                <td  style="background-color: rgb(92, 214, 255);">- Kas</td>
                                <td  style="background-color: rgb(92, 214, 255);" class="text-right">{{ 'Rp ' . number_format($labaBersih, 0, ',', '.') }}</td>
                            </tr>
                  
                         
                            <tr>
                                <td  style="background-color: rgb(92, 214, 255);">- Piutang</td>
                                <td  style="background-color: rgb(92, 214, 255);" class="text-right">{{ 'Rp ' . number_format($totalPiutang, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td  style="background-color: rgb(92, 214, 255);">- Perlengkapan</td>
                                <td  style="background-color: rgb(92, 214, 255);" class="text-right">{{ 'Rp ' . number_format($totalPerlengkapan, 0, ',', '.') }}</td>
                            </tr>
                            
                            
                            
                            
                            <tr>
                                <td style="background-color: rgb(92, 214, 255);" ><b>Total Aset Lancar :</b></td>
                                <td style="background-color: rgb(92, 214, 255);" class="text-right"><b>{{ 'Rp ' . number_format($totalAsetLancar, 0, ',', '.') }}</b></td>
                            </tr>
                            
                            <tr>
                                <td ><b>Aset Tetap :</b></td>
                                <td ></td>
                            </tr>
                            
                            <tr>
                                <td  style="background-color: rgb(92, 214, 255);">- Peralatan</td>
                                <td  style="background-color: rgb(92, 214, 255);" class="text-right">{{ 'Rp ' . number_format($totalPeralatan, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td  style="background-color: rgb(92, 214, 255);">- Akumulasi Penyusutan Peralatan</td>
                                <td  style="background-color: rgb(92, 214, 255);" class="text-right">({{ 'Rp ' . number_format($akumPenyusutanPeralatan, 0, ',', '.') }})</td>
                            </tr>

                            @foreach ($asetTetap as $tetap)
                            <tr>
                                <td style="background-color: rgb(92, 214, 255);">- {{ $tetap->account_name }}</td>
                                <td style="background-color: rgb(92, 214, 255);" class="text-right">
                                    {{ 'Rp ' . number_format($tetap->total_nominal, 0, ',', '.') }}
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td  style="background-color: rgb(92, 214, 255);">- Akumulasi Penyusutan Bangunan</td>
                                <td  style="background-color: rgb(92, 214, 255);" class="text-right">({{ 'Rp ' . number_format($akumPenyusutanBangunan, 0, ',', '.') }})</td>
                            </tr>
                            
                            <tr>
                                <td style="background-color: rgb(92, 214, 255);" ><b>Total Aset Tetap :</b></td>
                                <td style="background-color: rgb(92, 214, 255);" class="text-right"><b>{{ 'Rp ' . number_format($totalAsetTetap, 0, ',', '.') }}</b></td>
                            </tr>
                        
                            <tr>
                                <td ><b>Total Aset :</b></td>
                                <td  class="text-right"><b>{{ 'Rp ' . number_format($totalAset, 0, ',', '.') }}</b></td>
                            </tr>
                            
                            <tr>
                                <td ><b>Liabilitas :</b></td>
                                <td ></td>
                            </tr>
                            
                            <tr>
                                <td  style="background-color: rgb(92, 214, 255);">- Utang Usaha</td>
                                <td  style="background-color: rgb(92, 214, 255);" class="text-right">({{ 'Rp ' . number_format($totalUtang, 0, ',', '.') }})</td>
                            </tr>
                            
                            <tr>
                                <td ><b>Ekuitas  :</b></td>
                                <td ></td>
                            </tr>

                            <tr>
                                <td  style="background-color: rgb(92, 214, 255);">- Modal</td>
                                <td  style="background-color: rgb(92, 214, 255);" class="text-right">{{ 'Rp ' . number_format($modal, 0, ',', '.') }}</td>
                            </tr>

                            <tr>
                                <td style="background-color: rgb(3, 160, 212);"><b>Total Liabilitas dan Ekuitas :</b></td>
                                <td style="background-color: rgb(3, 160, 212);" class="text-right"><b>{{ 'Rp ' . number_format($totalLiabilitasdanEkuitas, 0, ',', '.') }}</b></td>
                            </tr>
                        </tbody>
                    </table>

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
