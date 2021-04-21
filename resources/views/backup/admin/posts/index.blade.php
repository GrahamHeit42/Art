@extends('admin.layouts.sidebar')
@section('title','Posts')
@section('content')
<div class=" row">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">All Posts Details</h3>
                    <h3 class="card-title float-right">Total Posts : {{count($posts ?? '')}}</h3>
                </div>

                <div class="form-group row">
                    <a style="margin: 10px;" href="{{url('/posts/create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle" aria-hidden="true" style="padding-right: 5px;"></i>New Post</a>
                </div>
                <table id="tablelist" class="table table-bordered table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th data-orderable="false">ID</th>
                            <th>User Name</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th data-orderable="false">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($posts))
                        @foreach($posts as $post)
                        <tr>
                            <td>{{ $loop->index+1 }} </td>
                            <td>{{$post->userDetails->first_name}}</td>
                            <td><a href="{{url('posts/view',$post->id)}}">{{$post->title}}</a></td>
                            <td><img src="{{$post->image}}" width="50" height="50" /></td>
                            <td><?php if ($post->status == 0) echo 'Inactive';
                                if ($post->status == 1) echo 'Active';
                                if ($post->status == 2) echo 'Delete'; ?></td>
                            <td style="padding: 0px;">

                                <button class="btn open-modal dlt-btn text-danger" data-toggle="modal" data-target="#modal" data-id="{{ $post->id }}" data-url="{{ url('posts/delete',['id'=>$post->id]) }}"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th data-orderable="false">ID</th>
                            <th>User Name</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th data-orderable="false">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
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
        $('#postForm').attr("action", url);
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