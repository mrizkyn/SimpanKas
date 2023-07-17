<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Sisipkan file CSS dan JavaScript Bootstrap -->
    <style>
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

        .bg-tidak-lunas {
            background-color: #dc3545;
            color: #ffffff;
        }
    </style>
</head>

<body style="background-color: rgba(0, 131, 116, 0.9)">
    @extends('layouts.app')

    @section('content')

    <div class="container-fluid table-container rounded" style="background-color: rgb(255, 255, 255)">
        <div class="row mb-3">
            <div class="col-md-6 mt-3">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahDataModal">Tambah Data</button>

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
                                    <form id="formTambahData" action="/Receivables/store" method="POST">
                                        @csrf
                
                                        <div class="mb-3">
                                            <label for="account_id" class="form-label">No Akun</label>
                                            <select class="form-control @error('account_id') is-invalid @enderror" id="account_id"
                                                name="account_id">
                                                @foreach ($accounts as $account)
                                                    <option value="{{ $account->id }}">{{ $account->code_name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="@error('account_id') @enderror invalid-feedback">
                                                @foreach ($errors->get('account_id') as $message)
                                                    {{ $message }}
                                                @endforeach
                                            </div>
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
                                            <input type="text" class="form-control @error('receive_nominal') is-invalid @enderror" id="receive_nominal"
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

                                        <div class="mb-3">
                                            <label for="date" class="form-label">Tanggal</label>
                                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ date('Y-m-d') }}" placeholder="Tanggal">
                                            <div class="@error('date') @enderror invalid-feedback">
                                                @foreach ($errors->get('date') as $message)
                                                    {{ $message }}
                                                @endforeach
                                            </div>
                                        </div>


                                </div>
                                <div class="modal-footer">
                                    <button id="btnSimpan" type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-md-6 mt-3">
    
            </div>
        </div>
        <h2><b>Catat Piutang</b></h2>
        <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Akun</th>
                        <th>Debitur</th>
                        <th>Nominal Piutang</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Deskripsi Piutang</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    @foreach ($receivables as $r)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $r->account->code_name }}</td>
                        <td>{{ $r->debt_recipient }}</td>
                        <td>{{ $r->receive_nominal }}</td>
                        <td>{{ $r->payment_date }}</td>
                        <td>{{ $r->receive_desc }}</td>
                        <td>{{ $r->date }}</td>
                        <td>
                            <a href="{{ route('Receive.toggleStatus', $r->id) }}" class="card-link" onclick="event.preventDefault(); document.getElementById('toggle-status-form-{{ $r->id }}').submit();">
                                <div class="card-status {{ $r->status === 'lunas' ? 'bg-lunas' : 'bg-belum-lunas' }}">
                                    {{ $r->status }}
                                </div>
                            </a>
                            <form id="toggle-status-form-{{ $r->id }}" action="{{ route('Receive.toggleStatus', $r->id) }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            {{  $receivables->links('pagination::bootstrap-4')}}
                        </td>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>

    @endsection

    @if (session('success'))
    <script>
        alert('{{ session('success') }}');
    </script>
    @endif

    <script>
        document.getElementById("searchButton").addEventListener("click", function() {
            var input = document.getElementById("searchInput").value.toLowerCase();
            var rows = document.getElementsByTagName("tr");
    
            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName("td");
                var match = false;
    
                for (var j = 0; j < cells.length; j++) {
                    var cellText = cells[j].textContent.toLowerCase();
    
                    if (cellText.includes(input)) {
                        match = true;
                        break;
                    }
                }
    
                if (match) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        });
    </script>
    
    
</body>
