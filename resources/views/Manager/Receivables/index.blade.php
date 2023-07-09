<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Sisipkan file CSS dan JavaScript Bootstrap -->
    <style>
      .table-container {
        margin-top: 5cm;
      }
    </style>
</head>

<body style="background-color: rgba(0, 131, 116, 0.9)">
    @extends('layouts.app')

    @section('content')

    
    <div class="container-fluid table-container rounded" style="background-color: white">
        <div class="row mb-3">
            <div class="col-md-6 mt-3">
                <button type="button" class="btn btn-success">Tambah Data</button>
            </div>
            <div class="col-md-6 mt-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari...">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </div>
        </div>
        <h1><b>Pemasukan</b></h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>johndoe@example.com</td>
                        <td>1234567890</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>janesmith@example.com</td>
                        <td>9876543210</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <!-- Tambahkan data lainnya di sini -->
                </tbody>
            </table>
        </div>
    </div>
    @endsection
</body>
