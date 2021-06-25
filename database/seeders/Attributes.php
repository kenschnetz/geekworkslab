<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class Attributes extends Seeder {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() {
            DB::table('attributes')->insert([
                [
                    'name' => 'Item Type',
                    'description' => 'Descriptor for the type of item (weapon, jewelry, armor, etc.)'
                ],
                [
                    'name' => 'Requires',
                    'description' => 'This requires something in order to be used (attunement, other item, etc.)'
                ],
                [
                    'name' => 'Rarity',
                    'description' => 'Common, uncommon, rare, epic, legendary, etc.'
                ],
                [
                    'name' => 'Modifies',
                    'description' => 'Describes any trait, attribute, etc. that this modifies'
                ],
            ]);
        }
    }
