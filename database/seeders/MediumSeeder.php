<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medium;

class MediumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Medium::count() === 0) {
            $mediums = [
                'Digital 2D', 'Digital 3D',
                'Traditional Paint', 'Traditional Illustration', 'Traditional Sculpture',
                'Mixed Media', 'Animation', 'Photography'
            ];
            foreach ($mediums as $medium) {
                Medium::create([
                    'title' => $medium,
                    'status' => 1
                ]);
            }
        }
    }
}
