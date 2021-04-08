<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = ['Abstract', 'Anime/Manga', 'Character Design', 'Comic', 'Concept Art', 'Cosplay', 'Emoji/Emoticon', 'Fanart', 'Fantasy', 'Horror', 'Landscape', 'Mecha', 'Pixel', 'Portrait', 'Prop', 'Realism', 'Sketch', 'Stock', 'Storyboard', 'Still Life', 'Tutorial'];
        foreach ($subjects as $subject) {
            // $subject = Subject::create(['type' => $subject]);
        }
    }
}
