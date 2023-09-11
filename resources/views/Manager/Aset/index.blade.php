<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Sisipkan file CSS dan JavaScript Bootstrap -->
  <style>
    .tex-rigt {
        text-align: right;
       
    }
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
    
      

  </style>
</head>

<body style="background-color: rgba(0, 131, 116, 0.9)">
    @extends('layouts.frontend.app')

  @section('content')

  
<div class="container-fluid">
  <div class="card">
      <div class="card-body">
          <h2><b>Aset</b></h2>
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDataModal">
            Tambah Aset
        </button>
          <br>
          <br>
  <div class="table-responsive nowrap" style="width:100%">
      <table id="accountsTable" class="table table-striped">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>No Akun</th>
                  <th>Nama Akun</th>
                  <th>Nilai Aset</th>
                  <th>Masa Manfaat (Tahun)</th>
                  <th>Penyusutan Per-Tahun</th>
                  <th>Penyusutan Per-Bulan</th>
              </tr>
          </thead>
          <tbody class="table-striped">
              @foreach ($assets as $asset)
              <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $asset->date }}</td>
                  <td>{{ $asset->Account->code_name }}</td>
                  <td>{{ $asset->Account->account_name }}</td>
                  <td class="text-rigt">Rp {{ number_format($asset->nominal_exp, 0, ',', '.') }}</td> 
                  <td>{{ $asset->exp_desc }}</td>
                  <td>{{ $asset->asset_periode }}</td>
                  <td>{{ $asset->annual_dep }}</td>
                  <td>{{ $asset->dep_month }}</td>
              </tr>
              @endforeach
          </tbody>
  </table>
  <script>setMobileTable('table')</script>
</div>
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

  <script>
      $(document).ready(function () {
          $('#accountsTable').DataTable();
      });
      </script>
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
  