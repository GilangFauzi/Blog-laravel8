<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // seeders ini berguna buat ngisi table secara otomatis menggunakan php artisan migrate:fresh --seed
        User::create([
            'name' => 'Gilang Fauzi',
            'username' => 'gilangfauzi',
            'email' => 'gilang@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // User::create([
        //     'name' => 'Intan',
        //     'email' => 'intan@gmail.com',
        //     'password' => bcrypt('12345')
        // ]);
        // di factory, dia bakal buat 3 user acak
        User::factory(3)->create();


        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming'
        ]);

        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design'
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        Post::factory(20)->create();
        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, aliquam sit iure in fuga optio quaerat blanditiis nobis ratione facilis distinctio doloribus consequuntur aspernatur, culpa porro esse atque? Qui officia asperiores id. Quibusdam dolor at neque ratione aut soluta aperiam enim magnam asperiores nobis nisi quidem, adipisci pariatur doloribus odit voluptate perferendis quasi autem laudantium fugit sed ipsam? Ipsam eaque fuga esse est dolorum debitis error, iste dignissimos odit quibusdam aut eligendi maxime et aperiam blanditiis. Consequuntur quis suscipit voluptatibus ut eum amet nostrum. Praesentium quis adipisci blanditiis fugit sunt, fuga nesciunt maiores quia consequatur rerum corporis accusamus corrupti quos.',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Ke Dua',
        //     'slug' => 'judul-ke-dua',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, aliquam sit iure in fuga optio quaerat blanditiis nobis ratione facilis distinctio doloribus consequuntur aspernatur, culpa porro esse atque? Qui officia asperiores id. Quibusdam dolor at neque ratione aut soluta aperiam enim magnam asperiores nobis nisi quidem, adipisci pariatur doloribus odit voluptate perferendis quasi autem laudantium fugit sed ipsam? Ipsam eaque fuga esse est dolorum debitis error, iste dignissimos odit quibusdam aut eligendi maxime et aperiam blanditiis. Consequuntur quis suscipit voluptatibus ut eum amet nostrum. Praesentium quis adipisci blanditiis fugit sunt, fuga nesciunt maiores quia consequatur rerum corporis accusamus corrupti quos.',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Ke Tiga',
        //     'slug' => 'judul-ke-tiga',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, aliquam sit iure in fuga optio quaerat blanditiis nobis ratione facilis distinctio doloribus consequuntur aspernatur, culpa porro esse atque? Qui officia asperiores id. Quibusdam dolor at neque ratione aut soluta aperiam enim magnam asperiores nobis nisi quidem, adipisci pariatur doloribus odit voluptate perferendis quasi autem laudantium fugit sed ipsam? Ipsam eaque fuga esse est dolorum debitis error, iste dignissimos odit quibusdam aut eligendi maxime et aperiam blanditiis. Consequuntur quis suscipit voluptatibus ut eum amet nostrum. Praesentium quis adipisci blanditiis fugit sunt, fuga nesciunt maiores quia consequatur rerum corporis accusamus corrupti quos.',
        //     'category_id' => 2,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Ke Empat',
        //     'slug' => 'judul-ke-empat',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, aliquam sit iure in fuga optio quaerat blanditiis nobis ratione facilis distinctio doloribus consequuntur aspernatur, culpa porro esse atque? Qui officia asperiores id. Quibusdam dolor at neque ratione aut soluta aperiam enim magnam asperiores nobis nisi quidem, adipisci pariatur doloribus odit voluptate perferendis quasi autem laudantium fugit sed ipsam? Ipsam eaque fuga esse est dolorum debitis error, iste dignissimos odit quibusdam aut eligendi maxime et aperiam blanditiis. Consequuntur quis suscipit voluptatibus ut eum amet nostrum. Praesentium quis adipisci blanditiis fugit sunt, fuga nesciunt maiores quia consequatur rerum corporis accusamus corrupti quos.',
        //     'category_id' => 2,
        //     'user_id' => 2
        // ]);
    }
}