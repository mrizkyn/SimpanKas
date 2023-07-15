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

    <div class="container-fluid table-container rounded" style="background-color: white">
        <div class="row mb-3">
            <div class="col-md-6 mt-3">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahDataModal">Tambah Data</button>

                <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel"
                    aria-hidden="true">
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
                                    <form id="formTambahData" action="/Account/store" method="POST">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="code_name" class="form-label">No Akun</label>
                                            <input type="text" class="form-control  @error('code_name') is-invalid @enderror"
                                                id="code_name" name="code_name" value="{{ old('code_name') }}"
                                                placeholder="code_name">
                                            <div class="@error('code_name') @enderror invalid-feedback">
                                                @foreach ($errors->get('code_name') as $message)
                                                {{ $message }}
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="account_name" class="form-label">Nama Akun</label>
                                            <input type="text" class="form-control @error('account_name') is-invalid @enderror"
                                                id="account_name" name="account_name" value="{{ old('account_name') }}"
                                                placeholder="account_name">
                                            <div class="@error('account_name') @enderror invalid-feedback">
                                                @foreach ($errors->get('account_name') as $message)
                                                {{ $message }}
                                                @endforeach
                                            </div>
                                        </div>
                                </div>
                                <!-- Tambahkan input dan elemen lainnya di sini -->
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
                <div class="input-group">
                    <input type="text" class="form-control" id="searchInput" placeholder="Cari...">


                    <div class="input-group-append">
                       <button type="button" class="btn btn-primary" id="searchButton">Cari</button>

                    </div>
                </div>
            </div>
        </div>
        <h2><b>Kelola No Akun</b></h2>
        <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>No Akun</th>
                        <th>Nama Akun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    @foreach ($accounts as $account)
                    <tr>
                        <th scope="row">{{ $account->id }}</th>
                        <td>{{ $account->code_name }}</td>
                        <td>{{ $account->account_name }}</td>
                        <td>
                            <div class="btn-group">
                                <form action="">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editDataModal{{ $account->id }}">Edit</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <div class="modal fade" id="editDataModal{{ $account->id }}"
                            tabindex="-1" aria-labelledby="editDataModalLabel{{ $account->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editDataModalLabel{{ $account->id }}">Edit Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('account.update', $account->id) }}" method="POST">
                                            @csrf

                                            <div class="mb-3">
                                                <label for="edit_code_name" class="form-label">No Akun</label>
                                                <input type="text"
                                                    class="form-control  @error('edit_code_name') is-invalid @enderror"
                                                    id="edit_code_name" name="edit_code_name"
                                                    value="{{ $account->code_name }}" placeholder="code_name">
                                                <div class="@error('edit_code_name') @enderror invalid-feedback">
                                                    @foreach ($errors->get('edit_code_name') as $message)
                                                    {{ $message }}
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="edit_account_name" class="form-label">Nama Akun</label>
                                                <input type="text"
                                                    class="form-control @error('edit_account_name') is-invalid @enderror"
                                                    id="edit_account_name" name="edit_account_name"
                                                    value="{{ $account->account_name }}" placeholder="account_name">
                                                <div class="@error('edit_account_name') @enderror invalid-feedback">
                                                    @foreach ($errors->get('edit_account_name') as $message)
                                                    {{ $message }}
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            {{  $accounts->links('pagination::bootstrap-4')}}
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
