<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Setting::count() === 0)
        {
            $settings = [
                'app_name' => config('app.name'),
                'app_version' => config('constants.app.version'),
                'contact_email' => config('constants.app.contact_email'),
            ];
            foreach ($settings as $key => $setting) {
                Setting::create([
                    'key' => $key,
                    'value' => $setting
                ]);
            }
        }
    }
}
