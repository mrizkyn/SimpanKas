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
                                    <form id="formTambahData" action="/Expenditure/store" method="POST">
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
                                            <label for="category_exp" class="form-label">Kategori Pengeluaran</label>
                                            <input type="text" class="form-control @error('category_exp') is-invalid @enderror"
                                                id="category_exp" name="category_exp" value="{{ old('category_exp') }}"
                                                placeholder="Kategori Pengeluaran">
                                            <div class="@error('category_exp') @enderror invalid-feedback">
                                                @foreach ($errors->get('descrription') as $message)
                                                    {{ $message }}
                                                @endforeach
                                            </div>
                                        </div>
                
                                        <div class="mb-3">
                                            <label for="nominal_exp" class="form-label">Total Pengeluaran</label>
                                            <input type="text" class="form-control @error('nominal_exp') is-invalid @enderror" id="nominal_exp"
                                                name="nominal_exp" value="{{ old('nominal_exp') }}" placeholder="Total Pengeluaran">
                                            <div class="@error('nominal_exp') @enderror invalid-feedback">
                                                @foreach ($errors->get('nominal_exp') as $message)
                                                    {{ $message }}
                                                @endforeach
                                            </div>
                                        </div>
                
                                        <div class="mb-3">
                                            <label for="exp_desc" class="form-label">Deskripsi Pengeluaran</label>
                                            <input type="text" class="form-control @error('exp_desc') is-invalid @enderror" id="exp_desc"
                                                name="exp_desc" value="{{ old('exp_desc') }}" placeholder="Deskripsi Pengeluaran">
                                            <div class="@error('exp_desc') @enderror invalid-feedback">
                                                @foreach ($errors->get('exp_desc') as $message)
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
                
                                        <div class="mb-3">
                                            <label for="jenis_dropdown" class="form-label">Jenis Pengeluaran</label>
                                            <select class="form-control @error('jenis_dropdown') is-invalid @enderror" id="jenis_dropdown"
                                                name="jenis_dropdown">
                                                <option value="table1">Jenis 1</option>
                                                <option value="table2">Jenis 2</option>
                                                <!-- Tambahkan opsi lain sesuai kebutuhan -->
                                            </select>
                                            <div class="@error('jenis_dropdown') @enderror invalid-feedback">
                                                @foreach ($errors->get('jenis_dropdown') as $message)
                                                    {{ $message }}
                                                @endforeach
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
                
                
            </div>
            <div class="col-md-6 mt-3">
    
            </div>
        </div>
        <h2><b>Pengeluaran</b></h2>
        <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Akun</th>
                        <th>Kategori Pengeluaran</th>
                        <th>Total Pengeluaran</th>
                        <th>Deskripsi Pengeluaran</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    @foreach ($expenditures as $exp)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $exp->Account->code_name }}</td>
                        <td>{{ $exp->category_exp }}</td>
                        <td>{{ $exp->nominal_exp }}</td>
                        <td>{{ $exp->exp_desc }}</td>
                        <td>{{ $exp->date }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            {{  $expenditures->links('pagination::bootstrap-4')}}
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
