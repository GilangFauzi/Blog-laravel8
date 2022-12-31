<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsAdminToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // buat migrasi baru, ini buat nyisipin atau nambihin field baru ke table users. buat migrasi di terminal atas

    // tambahin is_admin ke table users
    // add_is_admin_to_users_table
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //buat tambahin filed baru di users dengan nama is_admin. kalau emang gamau pake hak akses, apus aja field ini, terus gates nya juga.

            // jadi ini settingan default nya false bukan true, jadi kalau mau true setting di db
            $table->boolean('is_admin')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
        });
    }
}