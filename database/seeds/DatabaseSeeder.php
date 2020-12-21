<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $u1 = DB::table('users')->insertGetId([
            'name' => "Teste 1",
            'email' => "a@a.com",
            'password' => Hash::make('senha123'),
            'api_token' => Str::random(80),
        ]);
        $u2 = DB::table('users')->insertGetId([
            'name' => "Teste 2",
            'email' => "a2@a.com",
            'password' => Hash::make('senha123'),
            'api_token' => Str::random(80),
        ]);
        $u3 = DB::table('users')->insertGetId([
            'name' => "Teste 3",
            'email' => "a3@a.com",
            'password' => Hash::make('senha123'),
            'api_token' => Str::random(80),
        ]);

        DB::table('messages')->insert([
            'user_id' => $u1,
            'receiver_id' => $u2,
            'message' => "Teste inicial",
        ]);
        DB::table('messages')->insert([
            'user_id' => $u1,
            'receiver_id' => $u3,
            'message' => "Teste inicial 2",
        ]);
        DB::table('messages')->insert([
            'user_id' => $u2,
            'receiver_id' => $u1,
            'message' => "Teste inicial 3",
        ]);

        $e1 = DB::table('emotions')->insertGetId([
            'name' => "Happy"
        ]);
        $e2 = DB::table('emotions')->insertGetId([
            'name' => "Sad"
        ]);

        $h1 = DB::table('histories')->insertGetId([
            'user_id' => $u1,
            'description' => "Essa é a minha história.",
            'history_date' => Carbon::now(),
            'country' => "Portugal",
            'city' => "Porto",
            'active' => true,
            'emotion_id' => $e1,
        ]);
        $h2 =  DB::table('histories')->insertGetId([
            'user_id' => $u1,
            'description' => "Essa é a minha história 2.",
            'history_date' => Carbon::now(),
            'country' => "Portugal",
            'city' => "Lisboa",
            'active' => true,
            'emotion_id' => $e2,
        ]);
        $h3 = DB::table('histories')->insertGetId([
            'user_id' => $u2,
            'description' => "Essa é a minha história 3.",
            'history_date' => Carbon::now(),
            'country' => "Brasil",
            'city' => "Curitiba",
            'active' => true,
            'emotion_id' => $e1,
        ]);

        DB::table('history_history')->insert([
            'history_one' => $h1,
            'history_two' => $h2
        ]);
        DB::table('history_history')->insert([
            'history_one' => $h1,
            'history_two' => $h3
        ]);
    }
}
