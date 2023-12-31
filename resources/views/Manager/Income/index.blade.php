<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDataModalLabel">Catat Penyesuaian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('income.update', ['id' => 1]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="date">Tanggal Sebelum Revisi :</label>
                                <input type="date" class="form-control" id="date" name="date" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="date_after">Tanggal Revisi :</label>
                                <input type="date" class="form-control" id="date_after" name="date_after" required>
                            </div>
                            <div class="mb-3">
                                <label for="account_name">Nama Akun:</label>
                                <input type="text" class="form-control" id="codename" name="codename" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="initial_nominal">Total Awal:</label>
                                <input type="text" class="form-control" id="edit_income_name" name="edit_income_name" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="revised_nominal">Revisi :</label>
                                <input type="number" class="form-control" id="revised_nominal" name="revised_nominal" required>
                            </div>
                            <div class="mb-3">
                                <label for="desc">Deskripsi :</label>
                                <input type="text" class="form-control" id="desc" name="desc" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
                                            <input type="number" class="form-control text-end" id="total" name="total" oninput="formatRupiah(this)" placeholder="Total Pemasukan">
                                            <div class="invalid-feedback">
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
                        <th>Catat Revisi</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    @foreach ($incomes as $income)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $income->date)->format('d F Y') }}</td>
                        <td>{{ $income->Account->code_name }}</td>
                        <td>{{ $income->Account->account_name }}</td>
                        <td>{{ $income->descrription }}</td>
                        <td>Rp {{ number_format($income->total, 0, ',', '.') }}</td>
                        <td>{{ $income->noted_by }}</td>
                        <td >
                            <button type="button" class="btn btn-primary edit-btn" 
                            data-bs-toggle="modal" data-bs-target="#editDataModal"
                            data-income-id="{{ $income->id }}" 
                            data-income-account-name="{{ $income->Account->account_name }}"
                            data-income-total="{{ $income->total }}"
                            data-income-date="{{ $income->date }}">
                        <i class="bi bi-clipboard-plus"></i>
                    </button>
                        </td>
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
    

    <script>
        $(document).ready(function () {
            $('.edit-btn').click(function () {
                var incomeId = $(this).data('income-id');
                var incomeCodeName = $(this).data('income-account-name');
                $('#codename').val(incomeCodeName);            
                var incomeTotal = $(this).data('income-total');
                $('#edit_income_name').val(incomeTotal);            
                var incomeDate = $(this).data('income-date');
                $('#date').val(incomeDate);            
                     
                var editFormAction = "{{ route('income.update', ['id' => ':id']) }}".replace(':id', incomeId);
                $('#editDataModal form').attr('action', editFormAction);
            });
        });
    </script>

    
</body>
