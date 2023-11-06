<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <!-- Sisipkan file CSS dan JavaScript Bootstrap -->
    <style>
       

        #totalBeban {

            color: red
        }
        .text-right {
            text-align: right;
        }
        #card1 {
            margin-top: 100px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 0px;
            margin-bottom: 25px
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
            margin-top: 29.5px
        }
      
        
  
    </style>
  </head>
  
  <body style="background-color: rgba(0, 131, 116, 0.9)">
    @extends('layouts.laporan.calk.app')
  
    @section('content')

    <div class="container-fluid">
        <div class="card" id="card1">
            <div class="card-body">
                <h2><b>Laporan Laba Rugi</b></h2>
<br>
            <form id="bulanForm" method="POST" action="{{ route('statement.post') }}">
                @csrf
                <table>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label" for="start_month">Periode Awal:</label>
                            <input class="form-control" type="date" name="start_month" id="start_month">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="end_month">Periode Akhir:</label>
                            <input class="form-control" type="date" name="end_month" id="end_month">
                        </div>
                        
                        <div class="col-md-4">
                            <button class="btn btn-success" type="submit">Tampilkan Laporan</button>
                            {{-- <button class="btn btn-danger" id="cetakButton" type="submit">Cetak Laporan</button> --}}
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
                    @if (isset($startMonth) && isset($endMonth))
                    <br>
                      @php
                        setlocale(LC_TIME, 'id_ID.utf8');

                        $startDate = strftime('%d %B %Y', strtotime($startMonth));
                        $endDate = strftime('%d %B %Y', strtotime($endMonth));
                      @endphp
                   
                    <br>
                    
                    <table id="accountsTable" class="table " style="font-size: 12px;">
                        <thead>
                        <tr>
                                <center><h3 style="color: white">Laporan Laba Rugi</h3></center>
                                <center><p style="color: white">{{ $startDate }} s.d {{ $endDate }}</p></center>
                                
                            </tr>
                            <tr >
                                <th >Pendapatan :</th>
                                <th ></th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incomes as $income)
                            <tr>
                                <td  style="background-color: rgb(92, 214, 255);">- {{ $income->account_name }}</td>
                                <td  style="background-color: rgb(92, 214, 255);" class="text-right">{{ 'Rp ' . number_format($income->total_inc, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td  style="background-color: rgb(92, 214, 255);" ><b>Total Pendapatan</b></td>
                            <td   style="background-color: rgb(92, 214, 255);" class="text-right"><b>{{ 'Rp ' . number_format($totalPendapatan, 0, ',', '.') }}</b></td>
                        </tr>
                        <tr>
                            <td ><b>Harga Pokok Produksi</b></td>
                            <td  class="text-right"><b>{{ 'Rp ' . number_format($totalHPP, 0, ',', '.') }}</b></td>
                        </tr>
                            <tr>
                                <td ><b>Beban Beban :</b></td>
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
                            <tr>
                                <td ><b>Laba Kotor</b></td>
                                <td  class="text-right"><b>{{ 'Rp ' . number_format($labaKotor, 0, ',', '.') }}</b></td>
                            </tr>
                            <tr>
                                <td style="background-color: rgb(3, 160, 212);"><b>Laba Bersih</b></td>
                                <td style="background-color: rgb(3, 160, 212);" class="text-right"><b>{{ 'Rp ' . number_format($labaBersih, 0, ',', '.') }}</b></td>
                            </tr>
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
        @endif

    @endsection
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  

     <script>
        document.addEventListener("DOMContentLoaded", function() {
            var accountSelect = document.getElementById('account_id');
            var accountNameInput = document.getElementById('account_name');
            
            accountSelect.addEventListener('change', function() {
                var selectedOption = accountSelect.options[accountSelect.selectedIndex];
                var accountName = selectedOption.text.split(" - ")[1];
                
                accountNameInput.value = accountName;
                document.getElementById('selected_account_id').value = selectedOption.value;
            });
        });
    </script>
    {{-- <script>
        document.getElementById('cetakButton').addEventListener('click', function () {
            window.print();
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var startDateInput = document.getElementById('start_month');
            var endDateInput = document.getElementById('end_month');

            startDateInput.addEventListener('change', function () {
                endDateInput.min = startDateInput.value;
            });
        });
    </script>
