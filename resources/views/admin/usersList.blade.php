@extends('admin.layouts.sidebar')
@section('title','Users List')
@section('content')
<div class=" row">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">All Users Details</h3>
                    <h3 class="card-title float-right">Total Users : {{count($users ?? '')}}</h3>
                </div>

                <div class="form-group row">
                    <a style="margin: 10px;" href="{{url('/user')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle" aria-hidden="true" style="padding-right: 5px;"></i>New User</a>
                </div>
                <table id="tablelist" class="table table-bordered table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th data-orderable="false">ID</th>
                            <th>Role</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Register At</th>
                            <th>Last Active</th>
                            <th>Status</th>
                            <th data-orderable="false">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($users))
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->index+1 }} </td>
                            <td>@if($user->is_admin == '0') End User @else Admin @endif</td>
                            <td><a href="{{url('userView',$user->id)}}">{{$user->display_name}} {{$user->username}}</a></td>
                            <td>{{$user->email}}</td>
                            <td><?php echo date('M-d-Y g:i:A', strtotime($user->created_at)); ?></td>
                            <td><?php if (!empty($user->last_login_at)) echo date('M-d-Y g:i:A', strtotime($user->last_login_at));
                                else echo date('M-d-Y g:i:A', strtotime($user->created_at));; ?></td>
                            <td><?php if ($user->status == 0) echo 'Pending';
                                if ($user->status == 1) echo 'Active';
                                if ($user->status == 2) echo 'Deleted';
                                if ($user->status == 3) echo 'Suspended'; ?></td>
                            <td style="padding: 0px;">

                                <button class="btn open-modal dlt-btn text-danger" data-toggle="modal" data-target="#modal" data-id="{{ $user->id }}" data-url="{{ url('userDelete',['id'=>$user->id]) }}"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Role</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Register At</th>
                            <th>Last Active</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<form id="userForm" action="" method="post">
    <div id="modal" class="modal fade" role='dialog'>
        <div class="modal-dialog">
            <div class="modal-content bg-default">
                <div class="modal-header">
                    <h4 class="modal-title">Are you sure?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                    <p>Do you really want to delete this User?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                    @csrf
                    <button class="btn btn-danger" value="submit" type="submit">Confirm</button>


                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</form>
@endsection
@section('page-script')
<script>
    $(function() {
        $("#tablelist").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>
<script type="text/javascript">
    $(document).on("click", ".open-modal", function() {

        var id = $(this).data('id');
        var url = $(this).data('url');
        $('#userForm').attr("action", url);
        $('#modal').modal('show');
    });
</script>
@if(session()->has('success'))
<script type="text/javascript">
    toastr.success('<?php echo session()->get('success'); ?>')
</script>
@endif
@if ($errors->any())
@foreach ($errors->all() as $error)
<script type="text/javascript">
    toastr.error('{{$error}}')
</script>
@endforeach
@endif
@endsection
