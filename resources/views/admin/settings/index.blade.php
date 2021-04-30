@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Manage Settings</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form name="setting-form" id="setting-form" action="{{ url('admin/settings/store') }}"
                          method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="app_name">App Name</label>
                                    <input type="text" id="app_name" name="app_name" class="form-control"
                                           value="{{ $settings['app_name'] ?? NULL }}" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="app_version">App Version</label>
                                    <input type="text" id="app_version" name="app_version" class="form-control"
                                           value="{{ $settings['app_version'] ?? NULL }}" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="contact_email">Contact Email</label>
                                    <input type="text" id="contact_email" name="contact_email" class="form-control"
                                           value="{{ $settings['contact_email'] ?? NULL }}" />
                                </div>
                            </div>
                        </div>
                        <a type="button" href="{{ url('admin/settings') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success ml-3">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
