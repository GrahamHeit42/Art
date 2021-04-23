<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
    .rounded2r {
        border-radius: 0px 25px 25px 0px;
    }

    input[type=file] {
        display: none;
    }

    .file-upload {
        margin: 1rem;
        background-color: grey;
        color: #fff;
        padding: 0.5rem;
        cursor: pointer;
    }

    .imgDiv {
        margin: auto;
        text-align: center;
    }
</style>

<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo"></x-slot>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" enctype="multipart/form-data" action="{{ route('register') }}">
            @csrf

            <div class="form-group mt-4 imgDiv">
                <div class="custom-file mb-4">
                    <input type="file" class="custom-file-input cursor-pointer" id="profile_image"
                           name="profile_image" />
                    <label for="profile_image" class="file-upload custom-file-label cursor-pointer">
                        <span class="rounded2r">Upload Profile Image</span>
                    </label>
                </div>
                <span id="filename"></span>
            </div>

            <div class="mt-4">
                <x-label for="display_name" :value="__('Display Name')" />

                <x-input id="display_name" class="block mt-1 w-full" type="text" name="display_name"
                         :value="old('display_name')" required />
            </div>
            <div class="mt-4">
                <x-label for="username" :value="__('User Name')" />

                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                         required />
            </div>

            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                         required />
            </div>

            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                         autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                         name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
        <div class="form-group">
            <div class="col-md-6" style="text-align: center;">
                <a href="{{ url('login/facebook') }}" class="btn btn-social-icon btn-facebook">
                    <button class="btn-fb"><img src="{{asset('/images/fb_icon1.png')}}" alt="Facebook Login" width="50"
                                                height="50" /></button>
                </a>

                <a href="{{ url('login/google') }}" class="btn btn-social-icon btn-google-plus">
                    <button class="btn-g"><img src="{{asset('/images/google_icon1.png')}}" alt="Google Login" width="50"
                                               height="50" /></button>
                </a>

            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
<script>
    $(document).ready(function () {
        $('input[type=file]').change(function () {
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
