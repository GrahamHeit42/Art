@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ !empty($medium->id ?? null) ? 'Update' : 'Create New' }} Medium</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form name="medium-form" id="medium-form" action="{{ url('admin/mediums/store') }}" method="post">
                        @csrf
                        <input hidden id="medium_id" name="id" value="{{ $medium->id ?? NULL }}"/>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" class="form-control" value="{{ $medium->title ?? NULL }}"/>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label><br>
                            <label>
                                <input type="radio" id="status-inactive" name="status" value="0" {{ ($medium->status ?? 0) === 0 ? 'checked' : '' }}/> Inactive
                            </label>
                            <label class="ml-3">
                                <input type="radio" id="status-active" name="status" value="1" {{ ($medium->status ?? 0) === 1 ? 'checked' : '' }}> Active
                            </label>
                        </div>
                        <a type="button" href="{{ url('admin/mediums') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success ml-3">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
