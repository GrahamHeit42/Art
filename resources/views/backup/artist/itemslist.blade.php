@extends('layouts.sidebar')
@section('content')
<div class=" row">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">All Items Details</h3>
                    <h3 class="card-title float-right">Total Items : {{count($items ?? '')}}</h3>
                </div>

                <div class="form-group row">
                    <a style="margin: 10px;" href="{{url('/item')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle" aria-hidden="true" style="padding-right: 5px;"></i>New Item</a>
                </div>
                <table id="tablelist" class="table table-bordered table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Tags</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($items))
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $loop->index+1 }} </td>
                            <td><a href="{{url('itemview',$item->id)}}">{{$item->name}}</a></td>
                            <td>{{$item->tags}}</td>
                            <td><img src="{{$item->path}}" width="30" height="30" /></td>
                            <td><?php if ($item->status == 1) echo 'Active';
                                if ($item->status == 0) echo 'Inactive';  ?></td>
                            <td>

                                <button class="btn open-modal dlt-btn" data-toggle="modal" data-target="#modal" data-id="{{ $item->id }}" data-url="{{ url('itemdlt',['id'=>$item->id]) }}"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Tags</th>
                            <th>Image</th>
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
                    <p>Do you really want to delete this Item?</p>
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
@endsection