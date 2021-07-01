<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class Tags extends Seeder {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() {
            DB::table('tags')->insert([
                [
                    'name' => 'Jewelry',
                    'description' => 'Personal ornaments such as rings, necklaces, bracelets, etc.'
                ],
                [
                    'name' => 'Attuned',
                    'description' => ''
                ],
                [
                    'name' => 'Rare',
                    'description' => ''
                ],
                [
                    'name' => 'Constitution',
                    'description' => ''
                ],
            ]);
        }
    }
