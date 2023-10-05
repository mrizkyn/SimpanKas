 
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

@extends('layouts.frontend.app')

<body style=" background-color: rgba(0, 131, 116, 0.9);">
    
@section('content')
<div class="container">
    <div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDataModalLabel">Edit Nama Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('account.update', ['id' => 1]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="edit_account_name">Nama Akun:</label>
                            <input type="text" class="form-control" id="edit_account_name" name="edit_account_name" required>
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
    
    
<div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDataModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('account.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="parent_account">Induk Akun:</label>
                        <select class="form-control" id="parent_account" name="parent_id">
                            <option value="">Pilih Induk Akun</option>
                            @foreach ($a as $account)
                                <option value="{{ $account->id }}" data-code="{{ $account->code_name }}">{{ $account->code_name }} - {{ $account->account_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="child_account">Sub Akun:</label>
                        <select class="form-control" id="child_account" name="child_account" disabled>
                            <option value="" selected disabled>Pilih Sub Akun</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="code_name">No Akun:</label>
                        <input type="text" class="form-control" id="code_name" name="code_name" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="account_name">Nama Akun:</label>
                        <input type="text" class="form-control" id="account_name" name="account_name" required>
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
                <h2><b>Nomor Akun</b></h2>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDataModal">
                    Tambah Data
                </button>
                <br>
                <br>
        <div class="table-responsive nowrap" style="width:100%">
            <table id="accountsTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Akun</th>
                        <th>Nama Akun</th>
                        <th>Action</th>
                </thead>
                <tbody class="table-striped">
                    @foreach ($accounts as $account)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{  $account->code_name }}
                        </td>
                        <td>{{ $account->account_name }}</td>
                        <td>
                            <button type="button" class="btn btn-primary edit-btn" 
                                    data-bs-toggle="modal" data-bs-target="#editDataModal"
                                    data-account-id="{{ $account->id }}" data-account-name="{{ $account->account_name }}">
                                    <i class="bi bi-pencil-square"></i>
                            </button>
                        </td>
                        
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <script>setMobileTable('table')</script>

          
        </div>
    </div>
    @endsection
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    

    <script>
        $(document).ready(function () {
            var table = $('#accountsTable').DataTable( {
             responsive: true
         } );
 
            new $.fn.dataTable.FixedHeader( table );
          } );
      
        </script>
        

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
                                childAccountSelect.append('<option value="">Tidak Memilih Sub</option>');
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
            
                $('#child_account').change(function () {
                    var selectedChildCode = $('option:selected', this).text().split(' ')[0];
                    var selectedParentCode = $('#parent_account option:selected').data('code');
            
                    if (selectedChildCode === 'Tidak') {
                        var parentCodeNumber = parseInt(selectedParentCode);
                        if (!isNaN(parentCodeNumber)) {
                            var newCode = parentCodeNumber + 10;
                            checkAndSetCode(newCode);
                        }
                    } else {
                        var childCodeNumber = parseInt(selectedChildCode);
                        if (!isNaN(childCodeNumber)) {
                            var newCode = findNextAvailableCode(childCodeNumber + 1);
                            checkAndSetCode(newCode);
                        }
                    }
                });
            
                function checkAndSetCode(code) {
                    $.ajax({
                        url: '{{ route("check.code") }}',
                        type: 'GET',
                        data: { code: code },
                        success: function (response) {
                            if (response.exists) {
                                checkAndSetCode(code + 10);
                                
                            } else {
                                $('#code_name').val(code);
                            }
                        }
                    });
                }
            
                function findNextAvailableCode(startCode) {
                    var currentCode = startCode;
                    while (codeExistsInDatabase(currentCode)) {
                        currentCode += 1;
                    }
                    return currentCode;
                }
            
                function codeExistsInDatabase(code) {
                    var exists = false;
                    $.ajax({
                        async: false, 
                        url: '{{ route("check.code") }}',
                        type: 'GET',
                        data: { code: code },
                        success: function (response) {
                            exists = response.exists;
                        }
                    });
                    return exists;
                }
            
                $('#parent_account').change();
            });
            </script>
            
            <script>
                $(document).ready(function () {
                    $('.edit-btn').click(function () {
                        var accountId = $(this).data('account-id');
                        var accountName = $(this).data('account-name');
                        $('#edit_account_name').val(accountName);            
                        var editFormAction = "{{ route('account.update', ['id' => ':id']) }}".replace(':id', accountId);
                        $('#editDataModal form').attr('action', editFormAction);
                    });
                });
            </script>
            
            


        </body>