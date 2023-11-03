
    
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


<body style="background-color: rgba(0, 131, 116, 0.9)">
    @extends('layouts.frontend.app')
    @section('content')

    <div class="container"></div>
    <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <form id="formTambahData" action="/receivables/store" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Jenis Akun</label>
                                <input type="text" class="form-control" id="" name="" value="300 - Piutang" readonly>
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
                                <select class="form-control @error('account_id') is-invalid @enderror" id="account_id" name="account_id" placeholder="Pilih No Akun">
                                    <option value="Pilih No Akun"></option>
                                    @foreach ($accounts as $account)
                                        @if ($account->parent_id == 3) 
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
                                <label for="debt_recipient" class="form-label">Debitur</label>
                                <input type="text" class="form-control @error('debt_recipient') is-invalid @enderror"
                                    id="debt_recipient" name="debt_recipient" value="{{ old('debt_recipient') }}"
                                    placeholder="Debitur">
                                <div class="@error('debt_recipient') @enderror invalid-feedback">
                                    @foreach ($errors->get('debt_recipient') as $message)
                                        {{ $message }}
                                    @endforeach
                                </div>
                            </div>
    
                            <div class="mb-3">
                                <label for="receive_nominal" class="form-label">Nominal Piutang</label>
                                <input type="text" class="form-control text-end @error('receive_nominal') is-invalid @enderror" id="receive_nominal"
                                    name="receive_nominal" value="{{ old('receive_nominal') }}" placeholder="Nominal Piutang">
                                <div class="@error('receive_nominal') @enderror invalid-feedback">
                                    @foreach ($errors->get('receive_nominal') as $message)
                                        {{ $message }}
                                    @endforeach
                                </div>
                            </div>
    
                            <div class="mb-3">
                                <label for="payment_date" class="form-label">Tanggal Pembayaran</label>
                                <input type="date" class="form-control @error('payment_date') is-invalid @enderror" id="payment_date" name="payment_date" value="{{ date('Y-m-d') }}" placeholder="Tanggal Pembayaran">
                                <div class="@error('payment_date') @enderror invalid-feedback">
                                    @foreach ($errors->get('payment_date') as $message)
                                        {{ $message }}
                                    @endforeach
                                </div>
                            </div>
                            

                            <div class="mb-3">
                                <label for="receive_desc" class="form-label">Deskripsi Piutang</label>
                                <input type="text" class="form-control @error('receive_desc') is-invalid @enderror" id="receive_desc"
                                    name="receive_desc" value="{{ old('receive_desc') }}" placeholder="Deskripsi Piutang">
                                <div class="@error('receive_desc') @enderror invalid-feedback">
                                    @foreach ($errors->get('receive_desc') as $message)
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
        <h2><b>Catat Piutang</b></h2>
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
                <th>Debitur</th>
                <th>Nominal Piutang</th>
                <th>Tanggal Pembayaran</th>
                <th>Deskripsi Piutang</th>
                <th>Status</th>
                <th>Pencatat</th>
            </tr>
        </thead>
        <tbody class="table-striped">
            @foreach ($receivables as $r)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $r->date)->format('d F Y') }}</td>
                <td>{{ $r->account->code_name }}</td>
                <td>{{ $r->account->account_name }}</td>
                <td>{{ $r->debt_recipient }}</td>
                <td>Rp {{ number_format($r->receive_nominal, 0, ',', '.') }}</td> 
                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $r->payment_date)->format('d F Y') }}</td>
                <td>{{ $r->receive_desc }}</td>
                <td>
                    <a href="#" onclick="showConfirmationModal({{ $r->id }});" class="card-status {{ $r->status ? 'bg-lunas' : 'bg-belum-lunas' }}">
                        {{ $r->status ? 'Lunas' : 'Belum Lunas' }}
                    </a>
                    <form style="display: none;" id="r-status-form-{{ $r->id }}" method="POST" action="{{ route('receivable.status', $r->id) }}">
                        @csrf
                    </form>
                </td>
                <td>{{ $r->noted_by }}</td>
            </tr>
            @endforeach
        </tbody>
       
       

    </table>
    <script>setMobileTable('table')</script>

    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Perubahan Status Piutang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin mengubah status Piutang?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-success" onclick="submitForm()">Ya</button>
                </div>
            </div>
        </div>
    </div>
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
        function showConfirmationModal(rId) {
            var form = document.getElementById('r-status-form-' + rId);
            var modal = document.getElementById('confirmationModal');
    
            var modalInstance = new bootstrap.Modal(modal);
            modalInstance.show();
    
            // Simpan referensi form dalam variabel global agar bisa di-submit
            window.currentForm = form;
        }
    
        function submitForm() {
            if (window.currentForm) {
                window.currentForm.submit();
                var modal = document.getElementById('confirmationModal');
                var modalInstance = bootstrap.Modal.getInstance(modal);
                modalInstance.hide();
            }
        }
    </script>
</body>
