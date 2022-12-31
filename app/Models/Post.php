<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory;
    // digunakan biar buat slug otomatis (itu liblary)
    use Sluggable;

    //ini yang boleh di isi, sisanya gaboleh (input data TINKER)
    // protected $fillable = ['title', 'excerpt', 'body'];

    //ini yang gaboleh di isi, sisanya boleh (input data TINKER)
    protected $guarded = ['id'];
    // n+1 biar lebih optimal
    protected $with = ['category', 'author'];

    //filter search
    public function scopeFilter($query, array $filters)
    {
        // pake operator ternary, jadi "jika ada filters maka jalankan, jika tidak, maka false atau skip"
        // if (isset($filters['search']) ? $filters['search'] : false) {
        //     return $query->where('title', 'like', '%' . $filters['search'] . '%')
        //         ->orWhere('body', 'like', '%' . $filters['search'] . '%');
        // }

        //coalescing operator, yaitu fitur baru dari php, hampir sama kek ternary
        $query->when(($filters['search']) ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%');
        });

        //script dari komentar sandika galih
        // $query->when($filters['search'] ?? false, function ($query, $search) {
        //     return $query->where(function ($query) use ($search) {
        //         $query->where('title', 'like', '%' . $search . '%')
        //             ->orWhere('body', 'like', '%' . $search . '%');
        //     });
        // });

        $query->when(($filters['category']) ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        //versi ero function
        $query->when(($filters['author']) ?? false,
            fn ($query, $author) =>
            $query->whereHas(
                'author',
                fn ($query) =>
                $query->where('username', $author)
            )
        );
    }

    //relasi tabel
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // tambahin ini kalau mau liat detail data dari slug, bukan dari ID, tapi kalau mau pake ID tinggal apus aja yang ini
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // digunakan biar buat slug otomatis
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}