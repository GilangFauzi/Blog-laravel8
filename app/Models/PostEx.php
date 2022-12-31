<?php

namespace App\Models;

class post
{
    private static $blog_posts = [
        [
            "title" => "Judul Post Pertama",
            "slug" => "judul-post-1",
            "author" => "Gilang Fauzi",
            "body" => "   Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis eius culpa numquam laudantium ab enim architecto qui fugit dolorem alias? Consequatur harum omnis illo eaque pariatur, nemo voluptates quo maiores laboriosam, praesentium earum necessitatibus debitis unde ex. Odit magni corrupti dolorum alias debitis ducimus tempore necessitatibus, praesentium hic officia ea incidunt non architecto esse cupiditate error cum doloremque nihil velit delectus quos reprehenderit ratione atque. Maxime totam accusantium necessitatibus minima."
        ],
        [
            "title" => "Judul Post Gilang Fauzi",
            "slug" => "judul-post-2",
            "author" => "Si Tampan",
            "body" => "   Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis eius culpa numquam laudantium ab enim architecto qui fugit dolorem alias? Consequatur harum omnis illo eaque pariatur, nemo voluptates quo maiores laboriosam, praesentium earum necessitatibus debitis unde ex. Odit magni corrupti dolorum alias debitis ducimus tempore necessitatibus, praesentium hic officia ea incidunt non architecto esse cupiditate error cum doloremque nihil velit delectus quos reprehenderit ratione atque. Maxime totam accusantium necessitatibus minima."
        ]
    ];

    public static function all()
    {
        return collect(self::$blog_posts);
    }

    public static function find($slug)
    {
        $posts = static::all();
        // $post = [];
        // foreach ($posts as $p) {
        //     if ($p["slug"] == $slug) {
        //         $post = $p;
        //     }
        // }
        return $posts->firstWhere('slug', $slug);
    }
}