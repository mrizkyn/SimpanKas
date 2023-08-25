<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <!-- Sisipkan file CSS dan JavaScript Bootstrap -->
    <style>
         .card {
            margin-top: 100px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 0px;
            margin-bottom: 200px
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
    @extends('layouts.app')
  
    @section('content')
  
    
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h2><b>Laporan Laba Rugi</b></h2>
<br>
                <form id="bulanForm">
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
           
                <!-- Tabel untuk menampilkan laporan -->
                <div class="table-responsive nowrap" style="width:100%; display:none;" id="reportTable">
                    <table id="accountsTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Keterangan</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b>Total Pendapatan</b></td>
                                <td id="pendapatan"></td>
                            </tr>
                            <tr>
                                <td><b>HPP</b></td>
                                <td id="hpp"></td>
                            </tr>
                            @foreach ($beban as $b)

                            <tr>
                                <td>{{ $b->account->account_name }}</td>
                                <td>Rp {{ number_format($b->nominal_exp, 0, ',', '.')}}</td>
                            </tr>
                        @endforeach
                        
                            <tr>
                                <td><b>Total Beban</b></td>
                                <td id="totalBeban"></td>
                            </tr>
                            <tr>
                                <td><b>Laba Kotor</b></td>
                                <td id="labaKotor"></td>
                            </tr>
                            <tr>
                                <td><b>Laba Bersih</b></td>
                                <td id="labaBersih"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    @endsection
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
    @if (session('success'))
    <script>
        alert('{{ session('success') }}');
        </script>
    @endif
  
    {{-- <script>
        $(document).ready(function () {
            $('#accountsTable').DataTable();
        });
        </script> --}}
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
    function formatRupiah(angka) {
        var numberString = angka.toString();
        var sisa = numberString.length % 3;
        var rupiah = numberString.substr(0, sisa);
        var ribuan = numberString.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            var separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return 'Rp ' + rupiah;
    }

    $(document).ready(function() {
    $('#bulanForm').submit(function(event) {
        event.preventDefault();
        var startMonth = $('#start_month').val();
        var endMonth = $('#end_month').val();

        // Set nilai selected_month dengan bulan yang dipilih
        var selectedMonth = $('#start_month').val(); // Misalnya, Anda mengambil bulan awal
        $('#selected_month').val(selectedMonth);

        $.ajax({
            url: '{{ route('statement.index') }}',
            method: 'GET',
            data: {
                start_month: startMonth,
                end_month: endMonth,
                selected_month: selectedMonth // Kirim selected_month ke server
            },
                success: function(data) {
                    // Tampilkan tabel dan isi data
                    $('#reportTable').show();
                    $('#pendapatan').text(formatRupiah(data.totalPendapatan));
                    $('#hpp').text(formatRupiah(data.totalHPP));
                    // $('#bebanOperasional').text(formatRupiah(data.totalBebanOperasional));
                    // $('#bebanUtilitas').text(formatRupiah(data.totalBebanUtilitas));
                    // $('#bebanGaji').text(formatRupiah(data.totalBebanGaji));
                    $('#totalBeban').text(formatRupiah(data.totalBeban));
                    $('#labaKotor').text(formatRupiah(data.labaKotor));
                    $('#labaBersih').text(formatRupiah(data.labaBersih));
                }
            });
        });
    });
</script>
