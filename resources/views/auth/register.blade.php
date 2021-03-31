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
        /* border-radius: 25px; */
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
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" enctype="multipart/form-data" action="{{ route('register') }}">
            @csrf

            <!-- <input type="file" name="path" id="path" /> -->
            <div class="form-group mt-4 imgDiv">
                <div class="custom-file">
                    <input type="file" class="custom-file-input cursor-pointer" id="path" name="path" />
                    <label for="path" class="file-upload custom-file-label cursor-pointer">
                        <span class="rounded2r">Upload Profile Image</span>
                        <!-- insert filename using javaScript when file has uploaded -->
                    </label>
                    <span id="filename"></span>
                </div>
            </div>

            <div class="mt-4">
                <x-label for="username" :value="__('User Name')" />

                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />
            </div>
            <div class="mt-4">
                <x-label for="firstname" :value="__('First Name')" />

                <x-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required />
            </div>
            <div class="mt-4">
                <x-label for="lastname" :value="__('Last Name')" />

                <x-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required />
            </div>

            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
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
    </x-auth-card>
</x-guest-layout>
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