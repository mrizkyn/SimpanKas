@extends('layouts.app')


@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<div class="container-fluid">
  <div class="card">
      <div class="card-body">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
<br>


<div class="table-responsive nowrap" style="width:100%">
  <table id="accountsTable" class="table table-striped">
    <thead>
 <tr>
   <th>No</th>
   <th>Name</th>
   <th>Email</th>
   <th>Roles</th>
   <th width="280px">Action</th>
 </tr>
</thead>
 <tbody>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label style="color: black" class="badge badge-success">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td>
      <div style="margin-right: 3px">
       <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
      </div>
      <div>
        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
        {!! Form::submit('Delete', ['class' => 'btn btn-danger'],) !!}
        {!! Form::close() !!}
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


{!! $data->render() !!}
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