<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class Images extends Seeder {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() {
            DB::table('images')->insert([
                [
                    'user_id' => 1,
                    'path' => '/storage/post-images/amulet-of-awesomeness.jpeg'
                ],
                [
                    'user_id' => 2,
                    'path' => '/storage/post-images/5-headed-dragon.jpeg'
                ],
                [
                    'user_id' => 3,
                    'path' => '/storage/post-images/midtown-mystery.jpeg'
                ],
                [
                    'user_id' => 2,
                    'path' => '/storage/post-images/hydra.jpeg'
                ],
            ]);
        }
    }
