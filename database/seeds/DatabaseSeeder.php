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
            'password' => Hash::make('senha123'),
            'api_token' => Str::random(80),
        ]);
        $u5 = DB::table('users')->insertGetId([
            'name' => "Teste 5 (No history connected to Teste 1)",
            'email' => "a5@a.com",
            'description' => 'Description of user 5, without city and country.',
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
            'city_id' => $city->id,
            'active' => true,
            'emotion_id' => $e1,
        ]);
        $h2 =  DB::table('histories')->insertGetId([
            'user_id' => $u1,
            'description' => "Essa é a minha história 2.",
            'history_date' => Carbon::now(),
            'city_id' => $city->id,
            'active' => true,
            'emotion_id' => $e2,
        ]);
        $h3 = DB::table('histories')->insertGetId([
            'user_id' => $u2,
            'description' => "Essa é a minha história 3.",
            'history_date' => Carbon::now(),
            'city_id' => $brasil_city->id,
            'active' => true,
            'emotion_id' => $e1,
        ]);
        $h4 = DB::table('histories')->insertGetId([
            'user_id' => $u3,
            'description' => "Essa é a minha história 4.",
            'history_date' => Carbon::now(),
            'city_id' => $germany_city->id,
            'active' => true,
            'emotion_id' => $e2,
        ]);
        $h5 = DB::table('histories')->insertGetId([
            'user_id' => $u4,
            'description' => "Essa é a minha história 5.",
            'history_date' => Carbon::now(),
            'city_id' => $spain_city->id,
            'active' => true,
            'emotion_id' => $e1,
        ]);
        $h6 = DB::table('histories')->insertGetId([
            'user_id' => $u5,
            'description' => "Essa é a minha história 6.",
            'history_date' => Carbon::now(),
            'city_id' => $spain_city->id,
            'active' => true,
            'emotion_id' => $e1,
        ]);

        DB::table('history_history')->insert([
            'history_one' => $h1,
            'history_two' => $h3
        ]);
        DB::table('history_history')->insert([
            'history_one' => $h1,
            'history_two' => $h4
        ]);
        DB::table('history_history')->insert([
            'history_one' => $h1,
            'history_two' => $h5
        ]);
    }
}
