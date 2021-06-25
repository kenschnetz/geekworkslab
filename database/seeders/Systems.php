<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class Systems extends Seeder {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() {
            DB::table('systems')->insert([
                [
                    'name' => 'D&D 5E',
                    'description' => 'Fifth edition of Dungeons & Dragons (D&D or DnD), a fantasy tabletop role-playing game (RPG). Released 2014',
                ],
                [
                    'name' => 'D&D 4E',
                    'description' => 'Fourth edition of Dungeons & Dragons (D&D or DnD), a fantasy tabletop role-playing game (RPG). Released 2008',
                ],
                [
                    'name' => 'D&D 3E',
                    'description' => 'Third edition of Dungeons & Dragons (D&D or DnD), a fantasy tabletop role-playing game (RPG). Released 2000',
                ],
                [
                    'name' => 'AD&D',
                    'description' => 'Advanced Dungeons & Dragons (AD&D), a fantasy tabletop role-playing game (RPG). Released 1989',
                ],
                [
                    'name' => 'D&D',
                    'description' => 'Original Dungeons & Dragons (D&D), a fantasy tabletop role-playing game (RPG). Released 1974',
                ],
            ]);
        }
    }
