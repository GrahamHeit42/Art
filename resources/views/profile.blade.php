<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(isset($user))
                    <form method="post" enctype="multipart/form-data" action="{{url('profile')}}">
                        @csrf
                        <div class="container">
                            <div class="row col-md-12">
                                @if(!empty($user->path))
                                <div class="form-group row col-md-12">
                                    <img src="{{$user->path}}" class="m-auto br-50p" width="100" height="100" />
                                </div>
                                <div class="form-group row col-md-12">

                                    <button type="button" class="open-modal m-auto btn btn-sm btn-danger" id="dlt-btn" data-id="{{$user->id}}">Remove Image</button>

                                </div>
                                @else
                                <div class="form-group">
                                    <!-- <button class="btn btn-sm btn-info btn2 col-sm-2">Image</button> -->
                                    <input type="file" class="custom-file-input cursor-pointer" id="path" name="path" />
                                    <label for="path" class="custom-file-label cursor-pointer col-sm-3 m-auto">
                                        <span class="rounded2r">Upload Profile Image</span>
                                    </label>
                                    <span id="filename"></span>
                                </div>
                                @endif
                            </div>
                            <div class="row col-md-12">
                                <div class="form-group row col-md-6">
                                    <label for="email" class="col-sm-4 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="email" value="{{$user->email ?? ''}}" class="form-control {{ $errors->has('email') ? 'border-danger' : ''}}" readonly />
                                        <small class="form-text text-danger">{!! $errors->first('email') !!}</small>
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <label for="username" class="col-sm-4 col-form-label">User Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="username" value="{{$user->username ?? ''}}" class="form-control {{ $errors->has('username') ? 'border-danger' : ''}}" />
                                        <small class="form-text text-danger">{!! $errors->first('username') !!}</small>
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <label for="firstname" class="col-sm-4 col-form-label">First Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="firstname" value="{{$user->firstname ??  ''}}" class="form-control {{ $errors->has('firstname') ? 'border-danger' : ''}}" />
                                        <small class="form-text text-danger">{!! $errors->first('firstname') !!}</small>
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <label for="lastname" class="col-sm-4 col-form-label">Last Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="lastname" value="{{$user->lastname ??  ''}}" class="form-control {{ $errors->has('lastname') ? 'border-danger' : ''}}" />
                                        <small class="form-text text-danger">{!! $errors->first('lastname') !!}</small>
                                    </div>
                                </div>
                                <div class="form-group row col-md-12">
                                    <button class="btn btn-sm btn-primary m-auto" type="submit">Update</button>
                                </div>
                            </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function() {
        $("#dlt-btn").click(function() {
            var id = $(this).data("id");

            $.ajax({
                url: "/profileImageDelete/" + id,
                type: 'post',
                data: {
                    "id": id,
                },
                success: function(result) {
                    console.log(result);
                    window.location.reload();
                },
                error: function(xhr) {
                    console.log(xhr);
                    window.location.reload();
                }
            });

        });
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