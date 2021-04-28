<?php

return [
    'ACCESS_DENIED' => 'Access Denied!',
    'USER_ID_REQUIRED' => 'User Id Required.',
    'PROFILE_SUCCESS' => 'Profile Updated Successfully!',
    'FAIL' => 'There is some problem.',
    'PASSWORD_SUCCESS' => 'Password Updated Successfully!',
    'IMAGE_DELETE_SUCCESS' => 'Image Deleted Successfully!',
    'OLD_PASSWORD_NOT_MATCH' => 'Old Password does not Match.',
    'IMAGE_REQUIRED' => 'Image required.',

    'INSERT_MSG' => 'Record Inserted Successfully.',
    'UPDATE_MSG' => 'Record Updated Successfully.',
    'DELETE_MSG' => 'Record Deleted Successfully.',
    'ACTIVE_MSG' => 'Record Actived Successfully.',
    'INACTIVE_MSG' => 'Record In-Actived Successfully.',
    'NOACCESS' => 'You have no login access. Please contact administrator.',
    'LOGIN_SUCCESS' => 'Login Successfully.',
    'LOGOUT_SUCCESS' => 'Logout Successfully. Thank you visit again.',
    'LOGIN_FAIL' => 'Email or Password incorrect. Please try again.',
    'SUCCESS' => 'Successfully.',
    'SIGNUP_SUCCESS' => 'User Signup Successfully.',
    'PROFILE_DETAILS' => 'User detail get successfully.!',
    'NODATA' => 'No data found.!',

    'AP' => 'ArtistPersonal',
    'AC' => 'ArtistCommisioned',
    'CC' => 'Commissioner',

    'admin' => [
        'display_name' => env('ADMIN_NAME'),
        'username' => env('ADMIN_USERNAME'),
        'email' => env('ADMIN_EMAIL'),
        'password' => env('ADMIN_PASSWORD'),
    ],

    'app' => [
        'version' => env('APP_VERSION', '1.0.0')
    ]
];
