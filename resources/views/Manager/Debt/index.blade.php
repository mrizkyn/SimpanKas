
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


        .card-status {
            width: 90px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
            border-radius: 4px;
        }

        .bg-lunas {
            background-color: #28a745;
            color: #ffffff;
        }

        .bg-belum-lunas {
            background-color: #dc3545;
            color: #ffffff;
        }
        body {
        height: 100vh;
        }
    </style>

@extends('layouts.frontend.app')
<body style="  background-color: rgba(0, 131, 116, 0.9)">
    

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
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            Validation Error!
                                        </div>
                                    @endif
                
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <form id="formTambahData" action="/debt/store" method="POST">
                                        @csrf
                
                                        {{-- <div class="mb-3">
                                            <label for="" class="form-label">Jenis Akun</label>
                                            <input type="text" class="form-control" id="" name="" value="200 - Hutang" readonly>
                                        </div> --}}
                                        
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
                                            <select class="form-control @error('account_id') is-invalid @enderror" id="account_id" name="account_id" placeholder="Pilih No Akun">
                                                <option value="Pilih No Akun"></option>
                                                @foreach ($accounts as $account)
                                                    @if ($account->code_name == 200) 
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
                                            <label for="creditor" class="form-label">Kreditur</label>
                                            <input type="text" class="form-control @error('creditor') is-invalid @enderror"
                                                id="creditor" name="creditor" value="{{ old('creditor') }}"
                                                placeholder="Kreditur">
                                            <div class="@error('creditor') @enderror invalid-feedback">
                                                @foreach ($errors->get('creditor') as $message)
                                                    {{ $message }}
                                                @endforeach
                                            </div>
                                        </div>
                
                                        <div class="mb-3">
                                            <label for="debt_nominal" class="form-label">Nominal Hutang</label>
                                            <input type="text" class="form-control @error('debt_nominal') is-invalid @enderror" id="debt_nominal"
                                                name="debt_nominal" value="{{ old('debt_nominal') }}" placeholder="Nominal Hutang">
                                            <div class="@error('debt_nominal') @enderror invalid-feedback">
                                                @foreach ($errors->get('debt_nominal') as $message)
                                                    {{ $message }}
                                                @endforeach
                                            </div>
                                        </div>
                
                                        <div class="mb-3">
                                            <label for="due_date" class="form-label">Tanggal Jatuh Tempo</label>
                                            <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ date('Y-m-d') }}" placeholder="Tanggal Jatuh Tempo">
                                            <div class="@error('due_date') @enderror invalid-feedback">
                                                @foreach ($errors->get('due_date') as $message)
                                                    {{ $message }}
                                                @endforeach
                                            </div>
                                        </div>
                                        

                                        <div class="mb-3">
                                            <label for="debt_desc" class="form-label">Deskripsi Hutang</label>
                                            <input type="text" class="form-control @error('debt_desc') is-invalid @enderror" id="debt_desc"
                                                name="debt_desc" value="{{ old('debt_desc') }}" placeholder="Deskripsi Hutang">
                                            <div class="@error('debt_desc') @enderror invalid-feedback">
                                                @foreach ($errors->get('debt_desc') as $message)
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
        
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h2><b>Catat Hutang</b></h2>
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
                            <th>Kreditor</th>
                            <th>Nominal Hutang</th>
                            <th>Tanggal Jatuh Tempo</th>
                            <th>Deskripsi Hutang</th>
                            <th>Status</th>
                            <th>Pencatat</th>
                        </tr>
                    </thead>
                    <tbody class="table-striped">
                        @foreach ($debts as $debt)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $debt->date }}</td>
                            <td>{{ $debt->Account->code_name }}</td>
                            <td>{{ $debt->Account->account_name }}</td>
                            <td>{{ $debt->creditor }}</td>
                            <td>Rp {{ number_format($debt->debt_nominal, 0, ',', '.') }}</td> 
                            <td>{{ $debt->due_date }}</td>
                            <td>{{ $debt->debt_desc }}</td>
                            <td>
                                <a href="{{ route('debt.toggleStatus', $debt->id) }}" class="card-link" onclick="event.preventDefault(); document.getElementById('toggle-status-form-{{ $debt->id }}').submit();">
                                    <div class="card-status {{ $debt->status === 'lunas' ? 'bg-lunas' : 'bg-belum-lunas' }}">
                                        {{ $debt->status }}
                                    </div>
                                </a>
                                <form id="toggle-status-form-{{ $debt->id }}" action="{{ route('debt.toggleStatus', $debt->id) }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </td>
                            <td>Rizky</td>
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
        
</body>
