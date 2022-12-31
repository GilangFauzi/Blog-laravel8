<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // masukin middleware yang udah dibuat ke dalam kernel biar bisa dipake

        // cara 1
        // cek udah login atau belum
        // if (auth()->guest()) {
        // 403 itu forbiden
        //     abort(403);
        // }
        // cek usernya admin bukan, kalau bukan, gabisa akses menu category
        // if (auth()->user()->username !== 'gilangfauzi') {
        // abort(403);
        // }

        // cara 2
        // check bisa dipake, cuma depannya harus ada tanda !, karena check menghasilkan true ketika udah login, jadi mau nya ketika belum login, itu bernilai true.
        // check bisa di ganti guest, cuma tanda not atau ! ilangin, dia bernilai true ketika belum login
        // if (!auth()->check() || auth()->user()->username !== 'gilangfauzi') {
        //     abort(403);
        // }

        // ini dipake setelah nambahain field is_admin ke tabel users
        // jadi, kalau yang masuk bukan admin, maka jangan dikasih akses
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403);
        }
        return $next($request);
    }
}