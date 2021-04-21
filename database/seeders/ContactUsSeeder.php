<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactUs;

class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactUs::create([
            'name' => 'Check',
            'phone' => '9668787970',
            'email' => 'check@gmail.com',
            'subject' => 'Testing',
            'message' => 'Testing',
            'status' => 1
        ]);
    }
}
