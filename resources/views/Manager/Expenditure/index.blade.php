<!DOCTYPE html>
<html>
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
    </style>
</head>

<body style="background-color: rgba(0, 131, 116, 0.9)">
    @extends('layouts.app')

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
                            <form id="formTambahData" action="/expenditure/store" method="POST">
                                @csrf
                       
                                <div class="mb-3">
                                    <label for="date" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ date('Y-m-d') }}" placeholder="Tanggal">
                                    <div class="@error('date') @enderror invalid-feedback">
                                        @foreach ($errors->get('date') as $message)
                                            {{ $message }}
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="parent_account">Jenis Pengeluaran:</label>
                                    <select class="form-control" id="parent_account" >
                                        <option value="">Pilih Jenis Pengeluaran</option>
                                        @foreach ($a as $account)
                                            <option value="{{ $account->id }}" data-code="{{ $account->code_name }}">{{ $account->code_name }} - {{ $account->account_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="child_account">No Akun:</label>
                                    <select class="form-control" id="child_account" name="account_id" disabled>
                                        <option value="" selected disabled>Pilih No Akun</option>
                                    </select>
                                </div>
                                                          
                                <div class="mb-3">
                                    <label for="exp_desc" class="form-label">Deskripsi Pengeluaran/Beban</label>
                                    <input type="text" class="form-control @error('exp_desc') is-invalid @enderror" id="exp_desc"
                                        name="exp_desc" value="{{ old('exp_desc') }}" placeholder="Deskripsi Pengeluaran">
                                    <div class="@error('exp_desc') @enderror invalid-feedback">
                                        @foreach ($errors->get('exp_desc') as $message)
                                            {{ $message }}
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="nominal_exp" class="form-label">Total Pengeluaran/Beban</label>
                                    <input type="text" class="form-control @error('nominal_exp') is-invalid @enderror" id="nominal_exp"
                                        name="nominal_exp" value="{{ old('nominal_exp') }}" placeholder="Total Pengeluaran">
                                    <div class="@error('nominal_exp') @enderror invalid-feedback">
                                        @foreach ($errors->get('nominal_exp') as $message)
                                            {{ $message }}
                                        @endforeach
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
                    <h2><b>Pengeluaran</b></h2>
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
                                    <th>Total Pengeluaran/Beban</th>
                                    <th>Deskripsi Pengeluaran/Beban</th>
                                    <th>Pencatat</th>
                                </tr>
                            </thead>
                            <tbody class="table-striped">
                                @foreach ($expenditures as $exp)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $exp->date }}</td>
                                    <td>{{ $exp->Account->code_name }}</td>
                                    <td>{{ $exp->Account->account_name }}</td>
                                    <td>Rp {{ number_format($exp->nominal_exp, 0, ',', '.') }}</td> 
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
            $('#parent_account').change(function () {
                var parent_id = $(this).val();
                var parent_code = $(this).find(':selected').data('code');
                var childAccountSelect = $('#child_account');
        
                if (parent_id !== '') {
                    $.ajax({
                        url: '{{ route("get.child") }}',
                        type: 'GET',
                        data: { parent_id: parent_id },
                        success: function (response) {
                            childAccountSelect.empty().append('<option value="" selected disabled>Pilih Sub Akun</option>');
                            childAccountSelect.append('<option value="non_select_sub">Tidak Memilih Sub</option>');
                            $.each(response, function (index, childAccount) {
                                childAccountSelect.append('<option value="' + childAccount.id + '">' + childAccount.code_name + ' - ' + childAccount.account_name + '</option>');
                            });
                            childAccountSelect.prop('disabled', false);
                        }
                    });
                } else {
                    childAccountSelect.empty().append('<option value="" selected disabled>Pilih Sub Akun</option>');
                    childAccountSelect.prop('disabled', true);
                }
            });
            });
        
                 </script>
    


</body>
</html>
