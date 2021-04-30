<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Page::count() === 0) {
            $aboutPage = [
                'type' => 1,
                'title' => 'About US',
                'content' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Reserved jasmine convenience needs. Jasmine mass. When Pulls Rays Super Bowl mountains instantly. Till than football, ultricies, kids football, the price of one, salad. There is no one recipe for the mass. Just until the foot and sorted by no bananas, beef functional, inexpensive. In fact, justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Said soft foot football relay gas prices. Integer developers. Tomorrow protein. If not always live element. Nunc deductible region. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Lorem before any protein in, pull one feugiat mus. Phasellus viverra nulla ut metus varius laoreet. Each makeup. Jasmine hairstyle. Even if ultricies or propaganda. Chat ullamcorper ultricies nisi. For the functional worth it. Even Zen. Maecenas tempus tellus eget condimentum rhoncus, month than he is always free, but that he himself, nor sit amet adipiscing sem. For now they sit or mourning volleyball, Bureau id, lorem. Maecenas hatred and developers at the time. Till planning free of poisonous jaws. Before any relay. It is also important clinical need peanut taste developers. Homework lion. However, ecological design that nibh. Till members arrows great. However, photography, lion members need drink, propaganda outdoor running now; It is also important clinical need peanut taste developers. Homework lion. However, ecological design that nibh. Till members arrows great. However, photography, lion members need drink, propaganda outdoor running now; It is also important clinical need peanut taste developers. Homework lion. However, ecological design that nibh. Till members arrows great. However, photography, lion members need drink, propaganda outdoor running now;'
            ];
            Page::create($aboutPage);

            $contactPage = [
                'type' => 2,
                'title' => 'Contact US',
                'content' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never was a greater artist than now. When, while the lovely valley teems with vapour around me, and the meridian sun strikes the upper surface of the impenetrable foliage of my trees, and but a few stray gleams steal into the inner sanctuary, I throw myself down among the tall grass by the trickling stream; and, as I lie close to the earth, a thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath'
            ];

            Page::create($contactPage);

            $termsConditionsPage = [
                'type' => 3,
                'title' => 'Terms & Conditions',
                'content' => 'Terms & Conditions
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem.
                                1. Artist
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                2. Buyer
                                Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book . It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged .
                                            3. Post
                                Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                4. Work
                                Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book . It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged .
                                            5. Lorem
                                Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                6. Lorem
                                Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book . It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged . '
            ];

            Page::create($termsConditionsPage);

            $helpFaqsPage = [
                'type' => 4,
                'title' => 'Help & FAQs',
                'content' => 'Help & FAQ
                                Lorem ipsum dolor sit amet consectetur adipisicing elit . Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem .
                                            Q1 . Artist ?
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry .
                                            Q2 . Buyer ?
                                                Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                            Q3. Post ?
                                                Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                Q4. Work ?
                                Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                            Q5. Lorem ?
                                                Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                Q6. Lorem ?
                                Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.'
            ];

            Page::create($helpFaqsPage);
        }
    }
}
