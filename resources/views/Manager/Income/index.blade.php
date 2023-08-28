<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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

    </style>
</head>

<body style="background-color: rgba(0, 131, 116, 0.9)">
    @extends('layouts.frontend.app')

    @section('content')

    <div class="container">

                <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                  
                                        <form id="formTambahData" action="/income/store" method="POST">
                                            @csrf
                                            
                                            <div class="mb-3">
                                                <label for="" class="form-label">Jenis Akun</label>
                                                <input type="text" class="form-control" id="" name="" value="400 - Pendapatan" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="date" class="form-label">Tanggal</label>
                                                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ date('Y-m-d') }}" placeholder="Tanggal">
                                                <div class="@error('date') @enderror invalid-feedback">
                                                    @foreach ($errors->get('date') as $message)
                                                        {{ $message }}
                                                    @endforeach
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="account_id" class="form-label">No Akun</label>
                                                <select class="form-control @error('account_id') is-invalid @enderror" id="account_id" name="account_id">
                                                    <option value="Pilih No Akun"></option>
                                                    @foreach ($accounts as $account)
                                                        @if ($account->parent_id == 4) 
                                                            <option value="{{ $account->id }}">{{ $account->code_name }} - {{ $account->account_name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <div class="@error('account_id') @enderror invalid-feedback">
                                                    @foreach ($errors->get('account_id') as $message)
                                                        {{ $message }}
                                                    @endforeach
                                                </div>
                                            </div>
                                            
                                                
                                        <div class="mb-3">
                                            <label for="account_name" class="form-label">Nama Akun</label>
                                            <input type="text" class="form-control" id="account_name" name="account_name" readonly>
                                            <input type="hidden" id="selected_account_id" name="selected_account_id">
                                        </div>         
                                        
                                        <div class="mb-3">
                                            <label for="total" class="form-label">Total Pendapatan</label>
                                            <input type="text" class="form-control @error('total') is-invalid @enderror" id="total"
                                            name="total" value="{{ old('total') }}" placeholder="Total Pemasukan">
                                            <div class="@error('total') @enderror invalid-feedback">
                                                @foreach ($errors->get('total') as $message)
                                                    {{ $message }}
                                                @endforeach
                                            </div>
                                        </div>
                
                                        <div class="mb-3">
                                            <label for="descrription" class="form-label">Deskripsi</label>
                                            <input type="text" class="form-control @error('descrription') is-invalid @enderror"
                                                id="descrription" name="descrription" value="{{ old('descrription') }}"
                                                placeholder="Deskripsi">
                                            <div class="@error('descrription') @enderror invalid-feedback">
                                                @foreach ($errors->get('descrription') as $message)
                                                    {{ $message }}
                                                @endforeach
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="btnSimpan" type="submit" class="btn btn-success">Simpan</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                </div>
                                </form>
                            </div>
                        </div>
                        </div>
             
                
            </div>
          
        </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        Data Yang Anda Masukan Tidak Lengkap!
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <h2><b>Pendapatan</b></h2>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahDataModal">Tambah Data</button>
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
                        <th>Deskripsi</th>
                        <th>Total Penjualan</th>
                        <th>Pencatat</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    @foreach ($incomes as $income)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $income->date }}</td>
                        <td>{{ $income->Account->code_name }}</td>
                        <td>{{ $income->Account->account_name }}</td>
                        <td>{{ $income->descrription }}</td>
                        <td>Rp {{ number_format($income->total, 0, ',', '.') }}</td>
                        <td>Rizky</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>

                </tfoot>

            </table>
            <script>setMobileTable('table')</script>
        </div>
    </div>
    </div>
</div>
</div>

    @endsection
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



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
    



    
</body>
