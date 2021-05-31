@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ !empty($page->id ?? null) ? 'Update' : 'Create New' }} Page</h3>
            </div>
            <div class="card-body">
                <form name="page-form" id="page-form" action="{{ url('admin/pages/store') }}" method="post">
                    @csrf
                    <input hidden id="page_id" name="id" value="{{ $page->id ?? NULL }}" />
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control"
                            value="{{ $page->title ?? NULL }}" />
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea id="content" name="content" class="ckeditor form-control"
                            rows="15">{{ $page->content ?? NULL }}</textarea>
                    </div>
                    <div class="form-group d-none">
                        <label for="status">Status</label><br>
                        <label class="ml-3">
                            <input type="radio" id="status-active" name="status" value="1" checked /> Active
                        </label>
                    </div>
                    <a type="button" href="{{ url('admin/pages') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success ml-3">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
@endpush
