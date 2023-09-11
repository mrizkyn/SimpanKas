@extends('layouts.app')

@section('content')
    
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<div class="container-fluid">
  <div class="card">
      <div class="card-body">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Role Management</h2>
        </div>
        <div class="pull-right">
        @can('role-create')
            <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
            @endcan
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="table-responsive nowrap" style="width:100%">
    <table id="accountsTable" class="table table-striped">
        <thead>
  <tr>
     <th>No</th>
     <th>Name</th>
     <th width="280px">Action</th>
  </tr>
</thead>
<tbody>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <div style="margin-right: 3px">
            @can('role-edit')
            
                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
            @endcan
        </div>
        <div>
            @can('role-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </div>
        </td>
    </tr>
</tbody>
    @endforeach
</table>
<script>setMobileTable('table')</script>
</div>
</div>
</div>

{!! $roles->render() !!}
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>


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