<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Carbon;
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
                    'name' => 'amulet-of-awesomeness',
                    'path' => '/storage/post-images/amulet-of-awesomeness.jpeg',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'user_id' => 2,
                    'name' => '5 headed dragon',
                    'path' => '/storage/post-images/5-headed-dragon.jpeg',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'user_id' => 3,
                    'name' => 'Midtown Mystery',
                    'path' => '/storage/post-images/midtown-mystery.jpeg',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'user_id' => 2,
                    'name' => 'hydra',
                    'path' => '/storage/post-images/hydra.jpeg',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
            ]);
        }
    }
