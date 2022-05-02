<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        \DB::table('users')->insert(
            [
                [
                    'name' => 'User1',
                    'email' => 'user1@test.com',
                    'login' => 'user1',
                    'password' => bcrypt('user1')
                ],
                [
                    'name' => 'User2',
                    'email' => 'user2@test.com',
                    'login' => 'user2',
                    'password' => bcrypt('user2')
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        \DB::table('users')->truncate();
    }
}
