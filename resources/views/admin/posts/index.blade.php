@extends('admin.layouts.sidebar')
@section('title','Posts')
@section('content')
<!-- <div class="row"> -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Posts</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Posts</li>
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
            <h3 class="card-title">Posts</h3>
            <h3 class="card-title float-right">
                <a href="{{url('/posts/create')}}" class="btn btn-primary btn-sm" style="border-color: white;"><i class="fa fa-plus-circle" aria-hidden="true" style="padding-right: 5px;"></i>New Post</a>
            </h3>
        </div>
        <div class="card-body">
            <table id="tablelist" class="table table-bordered table-striped data-table">
                <thead>
                    <tr>
                        <th data-orderable="false">ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th data-orderable="false" style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($posts))
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $loop->index+1 }} </td>
                        <td>@if(!empty($post->image))<img src="{{$post->image}}" width="50" height="50" />@endif</td>
                        <td>{{$post->title}}</td>
                        <td>
                            <span class="badge badge-success">
                                <?php
                                if ($post->status == 0) echo '<span class="badge badge-danger">Inactive</span>';
                                if ($post->status == 1) echo '<span class="badge badge-success">Active</span>';
                                if ($post->status == 2) echo '<span class="badge badge-danger">Deleted</span>';;
                                ?> </span>
                        </td>
                        <td>
                            <a href="{{url('posts/view',$post->id)}}" class="btn text-info p-2"><i class="fas fa-eye"></i></a>

                            <a href="{{url('posts/update',$post->id)}}" class="btn text-primary p-2"><i class="fas fa-edit"></i></a>

                            <button class="btn open-modal dlt-btn text-danger p-2" data-toggle="modal" data-target="#modal" data-id="{{ $post->id }}" data-url="{{ url('posts/delete',['id'=>$post->id]) }}"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</section>


<!-- </div> -->
<form id="postForm" action="" method="post">
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
            ajax: "{{ route('posts.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'title',
                    name: 'title'
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
                targets: 1,
                render: function(data, type, row, meta) {
                    if (type === 'display') {
                        data = '<img src="' + data + '" width="50" height="50" />';
                    }
                    return data;
                }
            }, {
                targets: 3,
                render: function(data, type, row, meta) {
                    if (type === 'display') {
                        if (data == 1)
                            $status = '<span class="badge badge-success">Active</span>';
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
        $('#postForm').attr("action", url);
        $('#modal').modal('show');
    });
</script>
@endsection