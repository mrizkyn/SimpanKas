<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <!-- Sisipkan file CSS dan JavaScript Bootstrap -->
    <style>
       

       
        
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
    @extends('layouts.bootstrap')
  
    @section('content')
  
    
    <div class="container-fluid">
        <div class="card" id="card1">
            <div class="card-body">
                <h2><b>Laporan Laba Rugi</b></h2>
<br>
            <form id="bulanForm" method="POST" action="{{ route('statement.index') }}">
                @csrf
                <table>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label" for="start_month">Bulan Awal:</label>
                            <input class="form-control" type="date" name="start_month" id="start_month">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="end_month">Bulan Akhir:</label>
                            <input class="form-control" type="date" name="end_month" id="end_month">
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
                    <br>
                    
                    <table id="accountsTable" class="table " style="font-size: 12px;">
                        <thead>
                            <tr>
                                <center><h3 style="color: white">Laporan Arus Kas</h3></center>
                                <center><p style="color: white"> 1 Januari 2022 s.d 31 Desember 2022 </p></center>
                            </tr>
                            <tr>
                                <th >Arus Kas dari Aktivitas Operasi:</th>
                                <th ></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="background-color: rgb(92, 214, 255);" >Kas diterima oleh pelanggan:</td>
                                <td style="background-color: rgb(92, 214, 255);" class="text-right">Rp 583,835,000</td>
                            </tr>
                            <tr>
                                <td>Dikurang :</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="background-color: rgb(92, 214, 255);" >Pembelian pakan:</td>
                                <td style="background-color: rgb(92, 214, 255);" class="text-right">(Rp 242,250,000)</td>
                            </tr>
                            <tr>
                                <td style="background-color: rgb(92, 214, 255);" >Pembelian bibit:</td>
                                <td style="background-color: rgb(92, 214, 255);" class="text-right">(Rp 30,800,000)</td>
                            </tr>
                            <tr>
                                <td style="background-color: rgb(92, 214, 255);" >Beban Gaji:</td>
                                <td style="background-color: rgb(92, 214, 255);" class="text-right">(Rp 1,000,000)</td>
                            </tr>
                            <tr>
                                <td style="background-color: rgb(92, 214, 255);" >Beban Listrik:</td>
                                <td style="background-color: rgb(92, 214, 255);" class="text-right">(Rp 100,000)</td>
                            </tr>
                            <tr>
                                <td style="background-color: rgb(92, 214, 255);" >Beban Lain-lain:</td>
                                <td style="background-color: rgb(92, 214, 255);" class="text-right">(Rp 300,000)</td>
                            </tr>
                            <tr>
                                <td style="background-color: rgb(92, 214, 255);" ><b> Beban</b></td>
                                <td  style="background-color: rgb(92, 214, 255);" class="text-right"><b><u>(Rp 274,450,000)</u></b></td>
                            </tr>
                            <tr>
                                <td > <b>Arus Kas dari Aktivitas Operasi:</b></td>
                                <td class="text-right">Rp 309,385,000</td>
                            </tr>
                            <tr>
                                <td style="background-color: rgb(92, 214, 255);" >Pembuatan Budidaya:</td>
                                <td style="background-color: rgb(92, 214, 255);" class="text-right">(Rp 100,000,000)</td>
                            </tr>
                            <tr>
                                <td style="background-color: rgb(92, 214, 255);" >Pembelian Peralatan:</td>
                                <td style="background-color: rgb(92, 214, 255);" class="text-right"><u>(Rp 200,000)</u></td>
                            </tr>
                            <tr>
                                <td>Arus Kas dari Aktivitas Investasi:</td>
                                <td style="background-color: rgb(92, 214, 255);" class="text-right" >(Rp 100,200,000)</td>
                            </tr>
                            <tr>
                                <td ><b></b></td>
                                <td class="text-right"><b>Rp 209,185,000</b></td>
                            </tr>
                            <tr>
                                <td >Modal:</td>
                                <td class="text-right">Rp 200,000,000</td>
                            </tr>
                            <tr>
                                <td style="background-color: rgb(3, 160, 212);" ><b>Total Arus Kas:</b></td>
                                <td style="background-color: rgb(3, 160, 212);" class="text-right"><b>Rp 409,185,000</b></td>
                            </tr>
                        </tbody>
                    </table>
                    
               
                </div>
            </div>
         

                </div>
         
    

            <div class="container">
               <p style="color: rgba(0, 131, 116, 0.9)">halo</p>
            </div>
    @endsection
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
    @if (session('success'))
    <script>
        alert('{{ session('success') }}');
        </script>
    @endif
  

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

<script>
    document.getElementById('cetakButton').addEventListener('click', function () {
        window.print();
    });
</script>
