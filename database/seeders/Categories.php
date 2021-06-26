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
                    'slug' => 'items',
                    'description' => 'RPG items'
                ],
                [
                    'name' => 'Monsters',
                    'slug' => 'monsters',
                    'description' => 'RPG monsters'
                ],
                [
                    'name' => 'Hooks',
                    'slug' => 'hooks',
                    'description' => 'RPG story hooks'
                ],
                [
                    'name' => 'Abilities',
                    'slug' => 'abilities',
                    'description' => 'RPG abilities such as spells, traits, etc.'
                ],
                [
                    'name' => 'Art',
                    'slug' => 'art',
                    'description' => 'RPG art'
                ],
            ]);
        }
    }
