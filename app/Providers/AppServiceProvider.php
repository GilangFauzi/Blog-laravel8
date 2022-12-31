<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // ini agar bisa menggunakan template bootsrap, karena default larevel itu tailwind
        Paginator::useBootstrap();

        // Gates, buat admin bisa akses category. kata 'admin' itu bebas, bisa diganti apapun
        // Gate::define('admin', function (User $user) {
        // gilangfauzi itu sebagai admin
        // return $user->username === 'gilangfauzi';
        // });

        // ini digunakan setelah menambahkan field baru ke table user, yaitu is_admin
        Gate::define('admin', function (User $user) {
            // jadi, jika is admin benilai true atau angka 1, maka gerbang terbuka, jika 0 maka false.
            // jangan lupa setting di middleware nya juga
            return $user->is_admin;
        });
    }
}