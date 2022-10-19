<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Sosmed;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(3)->create();

        User::create([
            'name' => "Rangga Adithia",
            'username' => "rangga",
            'bio' => 'atibus iusto laudantium consequatur eius, dignissimos nam. Quis iure error tempore, id aperiam blanditiis earum, dolorem eligendi sequi aut fuga delectus mollitia nihil amet praesentium nesciunt tenetur soluta nobis natus autem asperiores eaque totam. Esse possimus libero quas amet, modi mollitia eveniet laudantium placeat numquam, vitae officia fuga!',
            'email' => 'rangga.adithia26@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        User::create([
            'name' => "Satrya Pudja",
            'username' => "satryapudja",
            'bio' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquid eaque neque, reprehenderit maxime ea debitis minus numquam accusantium distinctio nulla excepturi, eos libero ducimus exercitationem. Doloremque hic placeat perferendis blanditiis, officia laudantium accusantium quaerat at iure nemo tempora amet cupiditate debitis voluptas. Quos at ipsa eveniet exercitationem optio distinctio voluptatum sapiente magnam necessitatibus iusto laudantium consequatur eius, dignissimos nam. Quis iure error tempore, id aperiam blanditiis earum, dolorem eligendi sequi aut fuga delectus mollitia nihil amet praesentium nesciunt tenetur soluta nobis natus autem asperiores eaque totam. Esse possimus libero quas amet, modi mollitia eveniet laudantium placeat numquam, vitae officia fuga!',
            'email' => 'satrya.pudja77@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        Sosmed::create([
            'name' => 'instagram',
            'link' => 'https://www.instagram.com/',
            'user_id' => 1,
        ]);
        Sosmed::create([
            'name' => 'facebook',
            'link' => 'https://www.facebook.com/',
            'user_id' => 1,
        ]);
        Sosmed::create([
            'name' => 'tiktok',
            'link' => 'https://www.tiktok.com/',
            'user_id' => 1,
        ]);
        Sosmed::create([
            'name' => 'discord',
            'link' => 'https://www.discord.com/',
            'user_id' => 1,
        ]);

        Sosmed::create([
            'name' => 'instagram',
            'link' => 'https://www.instagram.com/',
            'user_id' => 2,
        ]);
        
        Sosmed::create([
            'name' => 'facebook',
            'link' => 'https://www.facebook.com/',
            'user_id' => 2,
        ]);
        Sosmed::create([
            'name' => 'tiktok',
            'link' => 'https://www.tiktok.com/',
            'user_id' => 2,
        ]);
        Sosmed::create([
            'name' => 'discord',
            'link' => 'https://www.discord.com/',
            'user_id' => 2,
        ]);
        
        Post::factory(40)->create();
    }
}
