@extends('admin.layouts.sidebar')
@section('title','Users')
@section('content')
<!-- <div class="row"> -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Users</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Users</h3>
            <h3 class="card-title float-right">
                <a href="{{url('/users/create')}}" class="btn btn-primary btn-sm" style="border-color: white;"><i class="fa fa-plus-circle" aria-hidden="true" style="padding-right: 5px;"></i>New User</a>
            </h3>
        </div>
        <div class="card-body">
            <table id="tablelist" class="table table-bordered table-striped data-table">
                <thead>
                    <tr>
                        <th data-orderable="false">ID</th>
                        <th>Role</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Register At</th>
                        <th>Last Active</th>
                        <th>Status</th>
                        <th data-orderable="false" style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

</section>


<!-- </div> -->
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
                    <p>Do you really want to delete this Post?</p>
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
<script type="text/javascript">
    $(function() {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'is_admin_text',
                    name: 'role'
                },
                {
                    data: 'first_name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'register_at',
                    name: 'register_at'
                },
                {
                    data: 'last_active',
                    name: 'last_active'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            columnDefs: [{
                targets: 3,
                render: function(data, type, row, meta) {
                    if (type === 'display') {
                        data = '<a href="mailto:' + data + '">' + data + '</a>';
                    }
                    return data;
                }
            }, {
                targets: 6,
                render: function(data, type, row, meta) {
                    if (type === 'display') {
                        if (data == 0)
                            $status = '<span class="badge badge-warning">Pending</span>';
                        if (data == 1)
                            $status = '<span class="badge badge-success">Active</span>';
                        if (data == 3)
                            $status = '<span class="badge badge-danger">Suspended</span>';
                        return $status;
                        data = $status;
                    }
                    return data;
                }
            }]
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
@endsection