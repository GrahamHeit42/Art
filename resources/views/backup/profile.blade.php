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
                                @if(!empty($user->profile_image))
                                <div class="form-group row col-md-12">
                                    <img src="{{$user->profile_image}}" class="m-auto br-50p" width="100" height="100" />
                                </div>
                                <div class="form-group row col-md-12">

                                    <button type="button" class="open-modal m-auto btn btn-sm btn-danger" id="dlt-btn" data-id="{{$user->id}}">Remove Image</button>

                                </div>
                                @endif
                            </div>
                            <div class="row col-md-12">

                                <div class="form-group row col-md-6">
                                    <label for="first_name" class="col-sm-4 col-form-label">First Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="first_name" value="{{$user->first_name ??  ''}}" class="form-control {{ $errors->has('first_name') ? 'border-danger' : ''}}" />
                                        <small class="form-text text-danger">{!! $errors->first('first_name') !!}</small>
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <label for="last_name" class="col-sm-4 col-form-label">Last Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="last_name" value="{{$user->last_name ??  ''}}" class="form-control {{ $errors->has('last_name') ? 'border-danger' : ''}}" />
                                        <small class="form-text text-danger">{!! $errors->first('last_name') !!}</small>
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <label for="email" class="col-sm-4 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="email" value="{{$user->email ?? ''}}" class="form-control {{ $errors->has('email') ? 'border-danger' : ''}}" readonly />
                                        <small class="form-text text-danger">{!! $errors->first('email') !!}</small>
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <label for="email" class="col-sm-4 col-form-label">Upload</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="custom-file-input cursor-pointer" id="profile_image" name="profile_image" />
                                        <label for="profile_image" class="custom-file-label cursor-pointer col-sm-11 m-auto">
                                            <span class="rounded2r">Upload Profile Image</span>
                                        </label>
                                        <span id="filename" class="col-md-12 txt-centre"></span>
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
<script>
    $(document).ready(function() {
        $('input[type=file]').change(function() {
            checkImage(this);
        });
    });

    function checkImage(input) {
        if (input.files && input.files[0]) {
            var filename = $('input[type=file]').val().split('\\').pop();
            $("#filename").html(filename);
        }
    }
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