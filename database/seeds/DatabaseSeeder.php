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
        $this->call(CountriesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);

        $portugal = DB::table('countries')->where('name', "Portugal")->first();
        $state = DB::table('states')->where('country_id',  $portugal->id)->first();
        $city = DB::table('cities')->where('state_id',  $state->id)->first();

        $brasil = DB::table('countries')->where('name', "Brazil")->first();
        $brasil_state = DB::table('states')->where('country_id',  $brasil->id)->first();
        $brasil_city = DB::table('cities')->where('state_id',  $brasil_state->id)->first();
        $bolivia = DB::table('countries')->where('name', "Bolivia")->first();
        $bolivia_state = DB::table('states')->where('country_id',  $bolivia->id)->first();
        $bolivia_city = DB::table('cities')->where('state_id',  $bolivia_state->id)->first();
        $spain = DB::table('countries')->where('name', "Spain")->first();
        $spain_state = DB::table('states')->where('country_id',  $spain->id)->first();
        $spain_city = DB::table('cities')->where('state_id',  $spain_state->id)->first();
        $italy = DB::table('countries')->where('name', "Italy")->first();
        $italy_state = DB::table('states')->where('country_id',  $italy->id)->first();
        $italy_city = DB::table('cities')->where('state_id',  $italy_state->id)->first();

        $u1 = DB::table('users')->insertGetId([
            'name' => "Teste 1",
            'email' => "a@a.com",
            'description' => 'Description of user 1.',
            'city_id' => $city->id,
            'password' => Hash::make('senha123'),
            'api_token' => Str::random(80),
        ]);
        $u2 = DB::table('users')->insertGetId([
            'name' => "Teste 2",
            'email' => "a2@a.com",
            'description' => 'Description of user 2.',
            'city_id' => $city->id,
            'password' => Hash::make('senha123'),
            'api_token' => Str::random(80),
        ]);
        $u3 = DB::table('users')->insertGetId([
            'name' => "Teste 3",
            'email' => "a3@a.com",
            'description' => 'Description of user 3.',
            'city_id' => $city->id,
            'password' => Hash::make('senha123'),
            'api_token' => Str::random(80),
        ]);
        $u4 = DB::table('users')->insertGetId([
            'name' => "Teste 4 (No initial message with Teste 1)",
            'email' => "a4@a.com",
            'description' => 'Description of user 4, without city and country.',
            'city_id' => null,
            'password' => Hash::make('senha123'),
            'api_token' => Str::random(80),
        ]);
        $u5 = DB::table('users')->insertGetId([
            'name' => "Teste 5 (No history connected to Teste 1)",
            'email' => "a5@a.com",
            'description' => 'Description of user 5, without city and country.',
            'city_id' => null,
            'password' => Hash::make('senha123'),
            'api_token' => Str::random(80),
        ]);
        $u6 = DB::table('users')->insertGetId([
            'name' => "Teste 6 (Connected to user 1 with emotion 2)",
            'email' => "a6@a.com",
            'description' => 'Description of user 6, without city and country.',
            'city_id' => null,
            'password' => Hash::make('senha123'),
            'api_token' => Str::random(80),
        ]);

        DB::table('messages')->insert([
            'user_id' => $u1,
            'receiver_id' => $u2,
            'message' => "Hello Teste 2",
        ]);
        DB::table('messages')->insert([
            'user_id' => $u1,
            'receiver_id' => $u3,
            'message' => "Hello Teste 3",
        ]);
        DB::table('messages')->insert([
            'user_id' => $u2,
            'receiver_id' => $u1,
            'message' => "Hello Teste 1",
        ]);

        $e1 = DB::table('emotions')->insertGetId([
            'name' => "Amusing",
            'sound' => "amusing.wav"
        ]);
        $e2 = DB::table('emotions')->insertGetId([
            'name' => "Annoying",
            'sound' => "default.wav"
        ]);
        $e3 = DB::table('emotions')->insertGetId([
            'name' => "Anxious and Tense",
            'sound' => "anxious.wav"
        ]);
        $e4 = DB::table('emotions')->insertGetId([
            'name' => "Beautiful",
            'sound' => "beautiful.wav"
        ]);
        $e5 = DB::table('emotions')->insertGetId([
            'name' => "Calm, Relaxing and Serene",
            'sound' => "calm.wav"
        ]);
        $e6 = DB::table('emotions')->insertGetId([
            'name' => "Dreamy",
            'sound' => "dreamy.wav"
        ]);
        $e7 = DB::table('emotions')->insertGetId([
            'name' => "Energizing and Pump-up",
            'sound' => "energizing.wav"
        ]);
        $e8 = DB::table('emotions')->insertGetId([
            'name' => "Erotic and Desirous",
            'sound' => "erotic.wav"
        ]);
        $e9 = DB::table('emotions')->insertGetId([
            'name' => "Indignant and Defiant",
            'sound' => "indignant.wav"
        ]);
        $e10 = DB::table('emotions')->insertGetId([
            'name' => "Joyful and Cheerful",
            'sound' => "joyful.wav"
        ]);
        $e11 = DB::table('emotions')->insertGetId([
            'name' => "Sad and Depressing",
            'sound' => "sad.wav"
        ]);
        $e12 = DB::table('emotions')->insertGetId([
            'name' => "Scary and Fearful",
            'sound' => "scary.wav"
        ]);
        $e13 = DB::table('emotions')->insertGetId([
            'name' => "Triumphant and Heroic",
            'sound' => "triumphant.wav"
        ]);

        $h1 = DB::table('histories')->insertGetId([
            'user_id' => $u1,
            'description' => "This is an amusing history (1) on Portugal from user (1)",
            'history_date' => Carbon::now(),
            'city_id' => $city->id,
            'active' => true,
            'emotion_id' => $e1,
        ]);
        $h2 =  DB::table('histories')->insertGetId([
            'user_id' => $u1,
            'description' => "This is an annoying history (2) on Portugal from user (1)",
            'history_date' => Carbon::now(),
            'city_id' => $city->id,
            'active' => true,
            'emotion_id' => $e2,
        ]);
        $h3 = DB::table('histories')->insertGetId([
            'user_id' => $u2,
            'description' => "This is an annoying history (3) on Brazil from user (2)",
            'history_date' => Carbon::now(),
            'city_id' => $brasil_city->id,
            'active' => true,
            'emotion_id' => $e2,
        ]);
        $h4 = DB::table('histories')->insertGetId([
            'user_id' => $u3,
            'description' => "This is an annoying history (4) on Bolivia from user (3)",
            'history_date' => Carbon::now(),
            'city_id' => $bolivia_city->id,
            'active' => true,
            'emotion_id' => $e2,
        ]);
        $h5 = DB::table('histories')->insertGetId([
            'user_id' => $u4,
            'description' => "This is an annoying history (5) on Spain from user (4)",
            'history_date' => Carbon::now(),
            'city_id' => $spain_city->id,
            'active' => true,
            'emotion_id' => $e2,
        ]);
        $h6 = DB::table('histories')->insertGetId([
            'user_id' => $u5,
            'description' => "This is an annoying history (6) on Portugal from user (5)",
            'history_date' => Carbon::now(),
            'city_id' => $city->id,
            'active' => true,
            'emotion_id' => $e2,
        ]);
        $h7 = DB::table('histories')->insertGetId([
            'user_id' => $u2,
            'description' => "This is an amusing history (7) on Spain from user (2)",
            'history_date' => Carbon::now(),
            'city_id' => $spain_city->id,
            'active' => true,
            'emotion_id' => $e1,
        ]);


        DB::table('history_history')->insert([
            'history_one' => $h1,
            'history_two' => $h7
        ]);
        DB::table('history_history')->insert([
            'history_one' => $h7,
            'history_two' => $h1
        ]);

        DB::table('history_history')->insert([
            'history_one' => $h2,
            'history_two' => $h3
        ]);
        DB::table('history_history')->insert([
            'history_one' => $h3,
            'history_two' => $h2
        ]);

        DB::table('history_history')->insert([
            'history_one' => $h3,
            'history_two' => $h4
        ]);
        DB::table('history_history')->insert([
            'history_one' => $h4,
            'history_two' => $h3
        ]);

        DB::table('history_history')->insert([
            'history_one' => $h4,
            'history_two' => $h5
        ]);
        DB::table('history_history')->insert([
            'history_one' => $h5,
            'history_two' => $h4
        ]);

        DB::table('history_history')->insert([
            'history_one' => $h5,
            'history_two' => $h6
        ]);
        DB::table('history_history')->insert([
            'history_one' => $h6,
            'history_two' => $h5
        ]);

        DB::table('history_history')->insert([
            'history_one' => $h6,
            'history_two' => $h1
        ]);
        DB::table('history_history')->insert([
            'history_one' => $h1,
            'history_two' => $h6
        ]);

    }
}
