<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Change Password') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form class="form-horizontal justify-content-center" id="validateForm" method="POST" action="{{ url('change-password') }}">
                        @csrf
                        <div class="container col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12 text-center">
                                        <label for="old_password" class="col-sm-4 col-form-label">Old Password</label>
                                        <div class="col-sm-12">
                                            <input type="password" name="old_password" value="" class="form-control {{ $errors->has('old_password') ? 'border-danger' : ''}}" />
                                            @if(!empty($errors->first('old_password')))
                                            <small class="form-text text-danger">{!! $errors->first('old_password') !!}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <label for="password" class="col-sm-4 col-form-label">New Password</label>
                                        <div class="col-sm-12">
                                            <input type="password" name="password" value="" class="form-control {{ $errors->has('password') ? 'border-danger' : ''}}" />
                                            @if(!empty($errors->first('password')))
                                            <small class="form-text text-danger">{!! $errors->first('password') !!}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <label for="confirm_password" class="col-sm-4 col-form-label">Confirm Password</label>
                                        <div class="col-sm-12">
                                            <input type="password" name="confirm_password" value="" class="form-control {{ $errors->has('confirm_password') ? 'border-danger' : ''}}" />
                                            @if(!empty($errors->first('confirm_password')))
                                            <small class="form-text text-danger">{!! $errors->first('confirm_password') !!}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row col-md-12 mt-4">
                                    <button type="submit" class="btn btn-info m-auto">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endif