<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class DatabaseSeeder extends Seeder {
        /**
         * Seed the application's database.
         *
         * @return void
         */
        public function run() {
            DB::table('users')->insert([[
                'name' => 'Ken Schnetz',
                'email' => 'ken@syntaxflow.com',
                'password' => bcrypt('Pplppd95634!')
            ]]);
            DB::table('categories')->insert([
                [
                    'name' => 'Items',
                    'description' => 'RPG items'
                ],
                [
                    'name' => 'Monsters',
                    'description' => 'RPG monsters'
                ],
                [
                    'name' => 'Hooks',
                    'description' => 'RPG story hooks'
                ],
                [
                    'name' => 'Abilities',
                    'description' => 'RPG abilities such as spells, traits, etc.'
                ],
            ]);
        }
    }
