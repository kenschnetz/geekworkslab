<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class Badges extends Seeder {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() {
            DB::table('badges')->insert([
                [
                    'name' => 'Novice Poster',
                    'description' => 'Create 10 new posts',
                    'required_points' => 10,
                ],
            ]);
        }
    }
