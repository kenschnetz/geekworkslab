<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class Categories extends Seeder {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() {
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
                [
                    'name' => 'Art',
                    'description' => 'RPG art'
                ],
            ]);
        }
    }
