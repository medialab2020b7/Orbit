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
        $germany = DB::table('countries')->where('name', "Bolivia")->first();
        $germany_state = DB::table('states')->where('country_id',  $germany->id)->first();
        $germany_city = DB::table('cities')->where('state_id',  $germany_state->id)->first();
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
            'sound' => "Amusing.wav"
        ]);
        $e2 = DB::table('emotions')->insertGetId([
            'name' => "Annoying",
            'sound' => "default.wav"
        ]);
        $e3 = DB::table('emotions')->insertGetId([
            'name' => "Anxious and Tense",
            'sound' => "Anxious.wav"
        ]);
        $e4 = DB::table('emotions')->insertGetId([
            'name' => "Beautiful",
            'sound' => "Beautiful.wav"
        ]);
        $e5 = DB::table('emotions')->insertGetId([
            'name' => "Calm, Relaxing and Serene",
            'sound' => "Calm.wav"
        ]);
        $e6 = DB::table('emotions')->insertGetId([
            'name' => "Dreamy",
            'sound' => "Dreamy.wav"
        ]);
        $e7 = DB::table('emotions')->insertGetId([
            'name' => "Energizing and Pump-up",
            'sound' => "Energizing.wav"
        ]);
        $e8 = DB::table('emotions')->insertGetId([
            'name' => "Erotic and Desirous",
            'sound' => "Erotic.wav"
        ]);
        $e9 = DB::table('emotions')->insertGetId([
            'name' => "Indignant and Defiant",
            'sound' => "Indignant.wav"
        ]);
        $e10 = DB::table('emotions')->insertGetId([
            'name' => "Joyful and Cheerful",
            'sound' => "Joyful.wav"
        ]);
        $e11 = DB::table('emotions')->insertGetId([
            'name' => "Sad and Depressing",
            'sound' => "Sad.wav"
        ]);
        $e12 = DB::table('emotions')->insertGetId([
            'name' => "Scary and Fearful",
            'sound' => "Scary.wav"
        ]);
        $e13 = DB::table('emotions')->insertGetId([
            'name' => "Triumphant and Heroic",
            'sound' => "Triumphant.wav"
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
            'description' => "This is an amusing history (3) on Brazil from user (2)",
            'history_date' => Carbon::now(),
            'city_id' => $brasil_city->id,
            'active' => true,
            'emotion_id' => $e1,
        ]);
        $h4 = DB::table('histories')->insertGetId([
            'user_id' => $u3,
            'description' => "This is an amusing history (4) on Germany from user (3)",
            'history_date' => Carbon::now(),
            'city_id' => $germany_city->id,
            'active' => true,
            'emotion_id' => $e1,
        ]);
        $h5 = DB::table('histories')->insertGetId([
            'user_id' => $u4,
            'description' => "This is an amusing history (5) on Spain from user (4)",
            'history_date' => Carbon::now(),
            'city_id' => $spain_city->id,
            'active' => true,
            'emotion_id' => $e1,
        ]);
        $h6 = DB::table('histories')->insertGetId([
            'user_id' => $u5,
            'description' => "This is an amusing history (6) on Spain from user (5)",
            'history_date' => Carbon::now(),
            'city_id' => $spain_city->id,
            'active' => true,
            'emotion_id' => $e1,
        ]);
        $h7 = DB::table('histories')->insertGetId([
            'user_id' => $u3,
            'description' => "This is an annoying history (7) on Portugal from user (3)",
            'history_date' => Carbon::now(),
            'city_id' => $city->id,
            'active' => true,
            'emotion_id' => $e2,
        ]);
        $h8 = DB::table('histories')->insertGetId([
            'user_id' => $u1,
            'description' => "This is an annoying history (8) on Portugal from user (1)",
            'history_date' => Carbon::now(),
            'city_id' => $city->id,
            'active' => true,
            'emotion_id' => $e2,
        ]);
        $h9 = DB::table('histories')->insertGetId([
            'user_id' => $u6,
            'description' => "This is an annoying history (9) on Italy from user (6)",
            'history_date' => Carbon::now(),
            'city_id' => $italy_city->id,
            'active' => true,
            'emotion_id' => $e2,
        ]);

        DB::table('history_history')->insert([
            'history_one' => $h1,
            'history_two' => $h3
        ]);
        DB::table('history_history')->insert([
            'history_one' => $h3,
            'history_two' => $h1
        ]);

        DB::table('history_history')->insert([
            'history_one' => $h1,
            'history_two' => $h4
        ]);
        DB::table('history_history')->insert([
            'history_one' => $h4,
            'history_two' => $h1
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
            'history_one' => $h1,
            'history_two' => $h5
        ]);
        DB::table('history_history')->insert([
            'history_one' => $h5,
            'history_two' => $h1
        ]);

        DB::table('history_history')->insert([
            'history_one' => $h3,
            'history_two' => $h5
        ]);
        DB::table('history_history')->insert([
            'history_one' => $h5,
            'history_two' => $h3
        ]);

        DB::table('history_history')->insert([
            'history_one' => $h8,
            'history_two' => $h9
        ]);
        DB::table('history_history')->insert([
            'history_one' => $h9,
            'history_two' => $h8
        ]);
    }
}
