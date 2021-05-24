@extends('admin.layouts.app')
@push('stylesheets')
<style>
    .subject-img {
        /* width: 70% !important; */
        height: 250px !important;
        border: none;
    }
</style>
@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ !empty($subject->id ?? null) ? 'Update' : 'Create New' }} Subject</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form name="subject-form" id="subject-form" action="{{ url('admin/subjects/store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input hidden id="subject_id" name="id" value="{{ $subject->id ?? NULL }}" />
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ $subject->title ?? NULL }}" />
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        @if(isset($subject) && $subject->image_path !== NULL)
                        <div class="text-center">
                            <img src="{{asset($subject->image_path)}}" class="form-control subject-img" />
                            <button type="button" data-id="{{$subject->id}}" class="btn btn-danger delete">Remove Image</button>
                        </div>
                        @else
                        <input type="file" id="image" name="image_path" class="form-control" accept="image/*" />
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label><br>
                        <label>
                            <input type="radio" id="status-inactive" name="status" value="0" {{ ($subject->status ?? 0) === 0 ? 'checked' : '' }} /> Inactive
                        </label>
                        <label class="ml-3">
                            <input type="radio" id="status-active" name="status" value="1" {{ ($subject->status ?? 0) === 1 ? 'checked' : '' }}> Active
                        </label>
                    </div>
                    <a type="button" href="{{ url('admin/subjects') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success ml-3">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(".delete").click(function() {
        let subjectId = $(this).data('id');
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
                    formData.append('id', subjectId);

                    $.ajax({
                        url: BASE_URL + '/subjects/delete-image',
                        type: 'post',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.status === true) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                );
                                window.location.reload();
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
</script>
@endpush