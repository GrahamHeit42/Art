@extends('admin.layouts.app')

@push('stylesheets')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<style>
    .desc {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 75ch;
    }
</style>
@endpush

@section('content')
<div class="row justify-content-end">
    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
        <a type="button" href="{{ url('admin/posts/create') }}" class="btn btn-primary float-right mb-3"
            title="Add Post">
            <i class="fas fa-plus"></i> Add Post
        </a>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">List Posts</h3>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped w-100" id="posts-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>User</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Subject</th>
                    <th>Medium</th>
                    <th>Count</th>
                    {{-- <th>Status</th> --}}
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<!-- DataTables  & Plugins -->
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script type="text/javascript">
    let postsTable = $('#posts-table').DataTable({
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: "{{ url('admin/posts') }}",
                type: 'post'
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, width: '2%'},
                {data: 'image_url', name: 'image_url', orderable: false, searchable: false, width: '8%'},
                {data: 'display_name', name: 'display_name',width: '20%'},
                {data: 'title', name: 'title', width: '15%'},
                {data: 'description', name: 'description',width: '20%'},
                {data: 'subject_title', name: 'subject_title', width: '10%'},
                {data: 'medium_title', name: 'medium_title', width: '10%'},
                // {data: 'status_text', name: 'status_text'},
                {data: 'count', name: 'count', width: '10%'},
                {data: 'action', name: 'action', orderable: false, searchable: false, width: '5%'},
            ],
            'columnDefs': [
            {
                "targets": 1,
                "className": "text-center",
            },{
                "targets": 4,
                "className": "desc",
            }
            ],
            drawCallback: function () {
                setDeleteEvent();
            }
        });

        function setDeleteEvent() {
            $(".delete").click(function () {
                let postId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to recover this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085D6',
                    cancelButtonColor: '#DD3333',
                    confirmButtonText: 'Yes, delete it!'
                })
                    .then((result) => {
                        if (result.isConfirmed) {
                            let formData = new FormData();
                            formData.append('id', postId);

                            $.ajax({
                                url: BASE_URL + '/posts/delete',
                                type: 'post',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    if (response.status === true) {
                                        Swal.fire(
                                            'Deleted!',
                                            response.message,
                                            'success'
                                        );
                                        postsTable.ajax.reload();
                                    } else {
                                        Swal.fire(
                                            'Error',
                                            response.message,
                                            'error'
                                        );
                                    }
                                }
                            });
                        }
                    })
            });
        }
</script>
@endpush
