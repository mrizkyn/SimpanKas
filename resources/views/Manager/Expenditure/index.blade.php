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
    @extends('layouts.frontend.app')

    @section('content')

    <div class="container">
        <div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDataModalLabel">Tambah Penyesuaian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('expenditure.update', ['id' => 1]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="edit_exp_name">Total Penjualan:</label>
                                <input type="text" class="form-control" id="edit_exp_name" name="edit_exp_name" required>
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
                                    <label for="parent">Jenis Pengeluaran:</label>
                                    <select class="form-control" id="parent" >
                                        <option value="">Pilih Jenis Pengeluaran</option>
                                        @foreach ($a as $account)
                                            <option value="{{ $account->id }}" data-code="{{ $account->code_name }}">{{ $account->code_name }} - {{ $account->account_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="child">No Akun:</label>
                                    <select class="form-control" id="child"  disabled>
                                        <option value="" selected disabled>Pilih No Akun</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sub">Sub Akun:</label>
                                    <select class="form-control" id="sub" name="account_id" disabled>
                                        <option value="" selected disabled>Pilih Sub Akun</option>
                                    </select>
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
                                
                                <div class="mb-3">
                                    <label for="asset_period" class="form-label">Masa Manfaat (Tahun)</label>
                                    <input type="text" class="form-control @error('asset_period') is-invalid @enderror" id="asset_period"
                                    name="asset_period" value="{{ old('asset_period') }}" placeholder="Masa Manfaat" disabled>
                                    <div class="@error('asset_period') @enderror invalid-feedback">
                                        @foreach ($errors->get('asset_period') as $message)
                                            {{ $message }}
                                            @endforeach
                                        </div>
                                    </div>
                                <div class="mb-3">
                                    <label for="annual_dep" class="form-label">Penyusutan Per-Tahun</label>
                                    <input type="text" class="form-control @error('annual_dep') is-invalid @enderror" id="annual_dep"
                                    name="annual_dep" value="{{ old('annual_dep') }}" placeholder="Penyusutan Per-Tahun" disabled>
                                    <div class="@error('annual_dep') @enderror invalid-feedback" >
                                        @foreach ($errors->get('annual_dep') as $message)
                                            {{ $message }}
                                            @endforeach
                                        </div>
                                    </div>
                                <div class="mb-3">
                                    <label for="dep_month" class="form-label">Penyusutan Per-Bulan</label>
                                    <input type="text" class="form-control @error('dep_month') is-invalid @enderror" id="dep_month"
                                    name="dep_month" value="{{ old('dep_month') }}" placeholder="Penyusutan Per-Bulan" disabled>
                                    <div class="@error('dep_month') @enderror invalid-feedback" >
                                        @foreach ($errors->get('dep_month') as $message)
                                            {{ $message }}
                                            @endforeach
                                        </div>
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
                                    <th>Nominal</th>
                                    <th>Deskripsi</th>
                                    <th>Pencatat</th>
                                    <th>Tambah Penyesuaian</th>
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
                                    <td>{{ $exp->exp_desc }}</td>
                                    <td>rizky</td>
                                    <td>
                                    <button type="button" class="btn btn-primary edit-btn" 
                                    data-bs-toggle="modal" data-bs-target="#editDataModal"
                                    data-exp-id="{{ $exp->id }}" data-exp-total="{{ $exp->nominal_exp }}">
                                    <i class="bi bi-clipboard-plus"></i>
                                    </button></td>
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


    <script>
        $(document).ready(function () {
            $('#accountsTable').DataTable();
        });
        </script> 
        
<script>
    $(document).ready(function() {
    $('#parent').on('change', function() {
        var parent_id = $(this).val();
        if(parent_id) {
            $.ajax({
                url: '/getChild',
                type: 'GET',
                data: {parent_id: parent_id},
                dataType: 'json',
                success: function(data) {
                    $('#child').empty();
                    $('#child').append('<option value="" selected disabled>Pilih No Akun</option>');
                    $('#child').append('<option value="" selected>Tidak Memilih Sub Akun</option>');
                    $.each(data, function(key, value) {
                        $('#child').append('<option value="'+ value.id +'">'+ value.code_name + ' - ' + value.account_name +'</option>');
                    });
                    $('#child').prop('disabled', false);
                }
            });
        } else {
            $('#child').empty();
            $('#child').append('<option value="" selected disabled>Pilih No Akun</option>');
            $('#child').prop('disabled', true);
        }
    });
    $('#child').on('change', function() {
        var parent_id = $(this).val();
        if(parent_id) {
            $.ajax({
                url: '/getChild',
                type: 'GET',
                data: {parent_id: parent_id},
                dataType: 'json',
                success: function(data) {
                    $('#sub').empty();
                    $('#sub').append('<option value="" selected disabled>Pilih No Akun</option>');
                    $('#sub').append('<option value="" selected>Tidak Memilih Sub Akun</option>');
                    $.each(data, function(key, value) {
                        $('#sub').append('<option value="'+ value.id +'">'+ value.code_name + ' - ' + value.account_name +'</option>');
                    });
                    $('#sub').prop('disabled', false);
                }
            });
        } else {
            $('#sub').empty();
            $('#sub').append('<option value="" selected disabled>Pilih No Akun</option>');
            $('#sub').prop('disabled', true);
        }
    });
});

</script>


<script>
    $(document).ready(function () {
        $('#parent').on('change', function () {
            var parent_id = $('#parent option:selected').data('code');
            
            if (parent_id === 100) {
                $('#asset_period').prop('disabled', false);
                $('#annual_dep').prop('disabled', false);
                $('#dep_month').prop('disabled', false);
            } else {
                $('#asset_period').prop('disabled', true);
                $('#annual_dep').prop('disabled', true);
                $('#dep_month').prop('disabled', true);
            }
        });

        $('#nominal_exp, #asset_period').on('input', function () {
            var nominalExp = parseInt($('#nominal_exp').val());
            var assetPeriod = parseInt($('#asset_period').val());

            if (!isNaN(nominalExp) && !isNaN(assetPeriod) && assetPeriod > 0) {
                var annualDep = nominalExp / assetPeriod;
                var depMonth = annualDep / 12;

                $('#annual_dep').val(annualDep.toFixed());
                $('#dep_month').val(depMonth.toFixed());
            } else {
                $('#annual_dep').val('');
                $('#dep_month').val('');
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('.edit-btn').click(function () {
            var expId = $(this).data('exp-id');
            var expTotal = $(this).data('exp-total');
            $('#edit_exp_name').val(expTotal);            
            var editFormAction = "{{ route('expenditure.update', ['id' => ':id']) }}".replace(':id', expId);
            $('#editDataModal form').attr('action', editFormAction);
        });
    });
</script>


</body>
</html>
